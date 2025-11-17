<?php

/**
 * SystemPress Enqueue Scripts and Styles
 *
 * @package SystemPress
 * @since 0.0.1
 */

//declare(strict_types=1);

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Remove inline styles from WordPress.
 */
add_filter(
    'wp_theme_json_data_default',
    static function ($theme_json) {
        $data = $theme_json->get_data();

        $data['settings']['color']['palette']['default']   = [];
        $data['settings']['color']['duotone']['default']   = [];
        $data['settings']['color']['gradients']['default'] = [];
        //$data['settings']['shadow']['presets']['default'] = [];

        $theme_json->update_with($data);

        return $theme_json;
    }
);

/**
 * Replace default WordPress block styles with custom ones.
 */
function sp_replace_media_query_styles(): void
{
    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

    $blocks = [
        //'button',
        'columns',
        'gallery',
        'latest-post',
        'media-text',
        'navigation',
        //'search',
        'post-template',
        'rss',
    ];

    foreach ($blocks as $block) {
        wp_deregister_style("wp-block-{$block}");

        wp_register_style(
            "wp-block-{$block}",
            get_template_directory_uri() . "/assets/css/blocks/{$block}{$suffix}.css"

        );
    }
}
add_action('wp_enqueue_scripts', 'sp_replace_media_query_styles');

/**
 * Deregister unnecessary block styles.
 */
function sp_deregister_styles(): void
{
    $styles_to_remove = [
        'wp-block-post-comments-form',
        'wp-block-archives',
        'wp-block-button',
        'wp-block-categories',
        'wp-block-paragraph',
        'wp-block-group',
        'wp-block-list',
        'wp-block-post-author-name',
        'wp-block-post-date',
        //'wp-block-post-terms',
        'wp-block-post-title',
        'wp-block-query-title',
        //'wp-block-site-logo',
        'wp-block-site-tagline',
        'wp-block-site-title',
        'wp-block-spacer',
        'wp-block-term-description',
        'wp-block-heading',
        'wp-block-separator',
        'wp-block-query-pagination',
    ];

    foreach ($styles_to_remove as $style) {
        wp_dequeue_style($style);
    }
}
add_action('wp_enqueue_scripts', 'sp_deregister_styles', 100);
add_action('wp_print_styles', 'sp_deregister_styles', 100);

add_action('wp_enqueue_scripts', 'sp_enqueue_child_styles_last', 100);

function sp_enqueue_child_styles_last()
{
    if (is_child_theme()) {
        $child = wp_get_theme(get_stylesheet());
        wp_enqueue_style(
            'systempress-child',
            get_stylesheet_uri(),
            [], // You *could* list dependencies here if you want to control layering further
            $child->get('Version'),
            'all'
        );
    }
}

if (!function_exists('sp_enqueue_assets')) {

    // Remove default global styles and custom CSS actions to apply custom loading
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('enqueue_block_editor_assets', 'wp_enqueue_global_styles_css_custom_properties');
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles_custom_css');

    // Register custom function to enqueue styles and scripts
    add_action('enqueue_block_assets', 'sp_enqueue_assets');

    /**
     * Register and enqueue styles and scripts for the theme, both in frontend and admin areas.
     *
     * This function handles the enqueueing of shared styles, global styles, editor styles, and Bootstrap-related
     * styles/scripts, as well as custom scripts and styles specific to the admin interface.
     *
     * @return void
     */
    function sp_enqueue_assets(): void
    {
        $suffix      = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min'; // Determine script suffix based on debug mode
        $theme_dir   = trailingslashit(get_template_directory()); // Theme directory path
        $theme_uri   = trailingslashit(get_template_directory_uri()); // Theme URI
        $version     = wp_get_theme()->get('Version'); // Theme version
        $is_admin    = is_admin(); // Check if we're in the admin area

        // Global styles handling (based on whether we're in the admin area or frontend)
        $global_name = $is_admin ? 'global-styles-css-custom-properties' : 'global-styles';
        $deps        = $is_admin ? ['wp-edit-blocks'] : [];
        $jsdeps      = $is_admin ? ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor'] : [];

        /* Reset CSS - Only for Frontend */
        if (!$is_admin) {
            wp_register_style('@reset', "{$theme_uri}assets/css/bs-reset.min.css", [], $version);
            array_unshift(wp_styles()->queue, '@reset');
            // Prepend reset to the stylesheet queue
        }

        /* Register Shared Styles */

        wp_register_style('@bootstrap', "{$theme_uri}assets/css/bootstrap{$suffix}.css", $deps, filemtime("{$theme_dir}assets/css/bootstrap.css"));

        /* Dynamically Register Bootstrap CSS Files */
        // Register styles from the root 'bootstrap' directory
        foreach (glob("{$theme_dir}assets/css/bootstrap/*{$suffix}.css") as $file) {
            $filename = basename($file);
            $handle = strstr($filename, '.', true); // Extract name without extension

            wp_register_style($handle, "{$theme_uri}assets/css/bootstrap/{$filename}", ['@bootstrap'], filemtime($file));
        }

        // Register styles from subdirectories inside 'bootstrap'
        foreach (glob("{$theme_dir}assets/css/bootstrap/*", GLOB_ONLYDIR) as $subdir) {
            foreach (glob("{$subdir}/*{$suffix}.css") as $file) {
                $filename = basename($file);
                $handle = strstr($filename, '.', true); // Extract name without extension

                wp_register_style($handle, "{$theme_uri}assets/css/bootstrap/" . basename($subdir) . "/{$filename}", ['@bootstrap'], filemtime($file));
            }
        }

        wp_register_style('animate', "{$theme_uri}assets/css/animate{$suffix}.css", $deps, filemtime("{$theme_dir}assets/css/animate.css"));

        /* Register Global Styles */
        wp_register_style($global_name, false, $deps, $version);

        /* Dynamically Register Bootstrap Color CSS Files */
        foreach (glob("{$theme_dir}assets/css/bootstrap-colors/*{$suffix}.css") as $file) {
            $filename = basename($file);
            wp_register_style(strstr($filename, '.', true), "{$theme_uri}assets/css/bootstrap-colors/{$filename}", ['global-styles'], filemtime($file));
        }

        wp_enqueue_style('@bootstrap'); // Enqueue Bootstrap styles

        wp_enqueue_style('animate'); // Enqueue animate.css

        wp_enqueue_style($global_name); // Enqueue global styles
        wp_add_inline_style($global_name, sp_global_vars()); // Add global Bootstrap variable overrides
        wp_add_inline_style($global_name, sp_global_styles_presets()); // Add preset global styles

        /* Admin Area: Enqueue Editor Styles */
        if ($is_admin) {
            wp_register_style('@editor-styles', false, $deps, $version, 'all');
            wp_enqueue_style('@editor-styles');
            wp_add_inline_style('@editor-styles', sp_editor_styles()); // Add editor-specific styles
        } else {
            /* Frontend: Enqueue Custom Global CSS */
            wp_register_style('global-styles-custom-css', false, $deps, $version, 'all');
            wp_enqueue_style('global-styles-custom-css');
            wp_add_inline_style('global-styles-custom-css', sp_global_css()); // Add custom global CSS
            // wp_add_inline_style('global-styles-custom-css', sp_global_styles_presets()); // Add preset global styles

        }

        /* Enqueue Child Theme Styles if Applicable */
        /*
        if (is_child_theme()) {
            wp_enqueue_style('systempress-child', get_stylesheet_uri(), [], $version, 'all');
        }

        if (is_child_theme()) {
            $child_theme = wp_get_theme(get_stylesheet());
            wp_enqueue_style('systempress-child', get_stylesheet_uri(), [], $child_theme->get('Version'), 'all');
        }
        */
        // wp_register_style('dev', "{$theme_uri}assets/css/dev.css", $deps, filemtime("{$theme_dir}assets/css/dev.css"));
        // wp_enqueue_style('dev'); // Enqueue dev.css

        /* Enqueue Shared Scripts */
        $scripts = [
            'wow'               => 'wow.min.js',
            '@bootstrap-bundle' => 'bootstrap.bundle.min.js',
            '@shared'           => 'shared.js',
        ];

        foreach ($scripts as $handle => $script) {
            wp_enqueue_script($handle, "{$theme_uri}assets/js/{$script}", $jsdeps, filemtime("{$theme_dir}assets/js/{$script}"), true);
        }

        /* Dynamically Register Bootstrap JS Files */
        if (!$is_admin) {
            foreach (glob("{$theme_dir}assets/js/bootstrap/*.js") as $file) {
                $filename = basename($file);
                wp_register_script(strstr($filename, '.', true), "{$theme_uri}assets/js/bootstrap/{$filename}", $jsdeps, filemtime($file), true);
            }
        } else {

            /* Enqueue Editor-Specific Scripts */
            foreach (glob("{$theme_dir}assets/js/variations/*.js") as $file) {
                $filename = basename($file);
                wp_register_script(strstr($filename, '.', true), "{$theme_uri}assets/js/variations/{$filename}", $jsdeps, filemtime($file), true);
            }

            wp_localize_script(
                '@shared',
                '@buddypress',
                array(
                    'templateUri' => $theme_uri,
                )
            );

            foreach (glob("{$theme_dir}assets/js/variations/*.js") as $variation) {

                $filename = basename($variation);
                wp_enqueue_script(strstr($filename, '.', true));
            }

            wp_enqueue_script(
                'sp-editor',
                "{$theme_uri}assets/js/sp-editor.js",
                $jsdeps,
                filemtime("{$theme_dir}assets/js/sp-editor.js"),
                true
            );
        }
    }
}

if (!function_exists('sp_add_editor_style')) {

    /**
     * Add Bootstrap and custom styles to the admin block editor.
     *
     * Ensures styles are available in the editor preview, including dynamically generated styles.
     * Uses `add_editor_style` for static stylesheets and filters to provide dynamic inline styles.
     *
     * @since 1.0.0
     */

    // Filter HTTP requests to force dynamic block editor styles.
    add_filter('pre_http_request', 'sp_force_dynamic_block_editor_styles', 10, 3);

    function sp_force_dynamic_block_editor_styles($response, $parsed_args, $url)
    {
        $dynamic_url = site_url('/sp-force-dynamic-block-editor-styles');

        if ($url === $dynamic_url) {
            $response = array(
                'body'     => sp_global_vars() . sp_global_styles_presets() . sp_global_css(),
                'headers'  => new \WpOrg\Requests\Utility\CaseInsensitiveDictionary(),
                'response' => array(
                    'code'    => 200,
                    'message' => 'OK',
                ),
                'cookies'  => array(),
                'filename' => null,
            );
        }
        return $response;
    }

    // Add editor styles for block editor.
    add_action('after_setup_theme', 'sp_add_editor_style');

    function sp_add_editor_style(): void
    {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        $theme_dir   = trailingslashit(get_template_directory()); // Theme directory path
        $theme_uri   = trailingslashit(get_template_directory_uri());

        // Enable editor styles.
        add_theme_support('editor-styles');

        // Add base styles (reset and bootstrap).
        add_editor_style([
            "assets/css/bs-reset{$suffix}.css",
            "assets/css/bootstrap{$suffix}.css",
            //"assets/css/blocks/button{$suffix}.css",

        ]);

        // Dynamically include all Bootstrap partial styles.
        foreach (glob("{$theme_dir}assets/css/bootstrap/*{$suffix}.css") as $file) {
            $filename = basename($file);
            add_editor_style("assets/css/bootstrap/{$filename}");
        }
        foreach (glob("{$theme_dir}assets/css/bootstrap-colors/*{$suffix}.css") as $file) {
            $filename = basename($file);
            add_editor_style("assets/css/bootstrap-colors/{$filename}");
        }

        // Add dynamically generated global styles via a custom endpoint.
        $dynamic_styles_url = site_url('/sp-force-dynamic-block-editor-styles');
        add_editor_style($dynamic_styles_url);

        // Include child theme styles if applicable.
        if (is_child_theme()) {
            add_editor_style(get_stylesheet_uri());
        }
    }
}

/**
 * Print accessibility script in the footer.
 *
 * This script adds accessibility features such as skip links, focus trapping
 * in modals, visible focus outlines for keyboard navigation, and ARIA attributes
 * for forms, ensuring a more accessible user experience.
 */
add_action('wp_footer', 'sp_do_a11y_scripts', 99);

function sp_do_a11y_scripts(): void
{
    // Allow users to filter and disable the script
    if (apply_filters('sp_print_a11y_script', true)) {
?>
        <script id="systempress-a11y">
            (function() {
                // Trap focus in modal/dialog elements to improve keyboard navigation.
                const trapFocus = (element) => {
                    const focusable = element.querySelectorAll("a, button, input, textarea, select, [tabindex]");
                    const first = focusable[0];
                    const last = focusable[focusable.length - 1];

                    element.addEventListener("keydown", (e) => {
                        if (e.key === "Tab") {
                            if (e.shiftKey && document.activeElement === first) {
                                e.preventDefault();
                                last.focus();
                            } else if (!e.shiftKey && document.activeElement === last) {
                                e.preventDefault();
                                first.focus();
                            }
                        }
                    });
                };

                document.addEventListener("DOMContentLoaded", () => {
                    const modals = document.querySelectorAll(".modal, .dialog");
                    modals.forEach(modal => trapFocus(modal));
                });

                // Focus outline visibility for keyboard users.
                document.body.addEventListener("keydown", function(event) {
                    if (event.key === "Tab") {
                        document.body.classList.add("using-keyboard");
                    }
                });

                document.body.addEventListener("mousedown", function() {
                    document.body.classList.remove("using-keyboard");
                });

                // Add ARIA attributes to forms if they don't exist.
                document.querySelectorAll('form').forEach(function(form) {
                    // Add ARIA label if it's missing.
                    if (!form.hasAttribute('aria-label')) {
                        form.setAttribute('aria-label', 'Form');
                    }

                    // Add ARIA role if it's missing.
                    if (!form.hasAttribute('role')) {
                        form.setAttribute('role', 'form');
                    }

                    // Add ARIA-labelledby if neither label nor aria-label exists.
                    if (!form.querySelector('label') && !form.hasAttribute('aria-label')) {
                        form.setAttribute('aria-labelledby', 'form-label');
                    }
                });

            })();
        </script>
<?php
    }
}

/* Block Menu Options */
/**
 * Enqueue block editor assets for Button Block customization.
 */
/*
add_action('enqueue_block_editor_assets', 'sp_editor_scripts_enqueue', 99);

function sp_editor_scripts_enqueue()
{
    // Enqueue the script as a module
    wp_enqueue_script_module(
        'sp-alert-editor',
        get_template_directory_uri() . '/assets/js/editor/alert/editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-components', 'wp-hooks'), // Dependencies
        filemtime(get_template_directory() . '/assets/js/editor/alert/editor.js')
    );
    wp_enqueue_script_module(
        'sp-button-editor',
        get_template_directory_uri() . '/assets/js/editor/button/editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-components', 'wp-hooks'), // Dependencies
        filemtime(get_template_directory() . '/assets/js/editor/button/editor.js')
    );
    wp_enqueue_script_module(
        'sp-list-editor',
        get_template_directory_uri() . '/assets/js/editor/list/editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-components', 'wp-hooks'), // Dependencies
        filemtime(get_template_directory() . '/assets/js/editor/list/editor.js')
    );
    wp_enqueue_script_module(
        'sp-data-atts-editor',
        get_template_directory_uri() . '/assets/js/editor/data-atts/editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-components', 'wp-hooks'), // Dependencies
        filemtime(get_template_directory() . '/assets/js/editor/data-atts/editor.js')
    );
    wp_enqueue_script_module(
        'sp-aria-atts-editor',
        get_template_directory_uri() . '/assets/js/editor/aria-atts/editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-components', 'wp-hooks'), // Dependencies
        filemtime(get_template_directory() . '/assets/js/editor/aria-atts/editor.js')
    );
    wp_enqueue_script_module(
        'sp-animations-editor',
        get_template_directory_uri() . '/assets/js/editor/animations/editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-components', 'wp-hooks'), // Dependencies
        filemtime(get_template_directory() . '/assets/js/editor/animations/editor.js')
    );
}
*/
/**
 * Enqueue block editor assets for custom block customization.
 */
add_action('enqueue_block_editor_assets', 'sp_editor_scripts_enqueue', 99);

function sp_editor_scripts_enqueue()
{
    // Base directory and URI for editor scripts
    $base_dir = get_template_directory() . '/assets/js/editor/';
    $base_uri = get_template_directory_uri() . '/assets/js/editor/';

    // Shared dependencies for all scripts
    $dependencies = ['wp-blocks', 'wp-element', 'wp-editor', 'wp-block-editor', 'wp-components', 'wp-hooks'];

    // List of scripts to enqueue
    $scripts = [
        'sp-alert-editor' => 'alert/editor.js',
        'sp-button-editor' => 'button/editor.js',
        'sp-list-editor' => 'list/editor.js',
        //'sp-list-editor' => 'list-item/editor.js',
        //  'sp-data-atts-editor' => 'data-atts/editor.js',
        // 'sp-aria-atts-editor' => 'aria-atts/editor.js',
        'sp-animations-editor' => 'animations/editor.js',
    ];

    // Loop through each script and enqueue it
    foreach ($scripts as $handle => $relative_path) {
        $file_path = $base_dir . $relative_path;
        $file_uri = $base_uri . $relative_path;

        if (file_exists($file_path)) {
            wp_enqueue_script_module(
                $handle,
                $file_uri,
                $dependencies,
                filemtime($file_path)
            );
        }
    }
}
