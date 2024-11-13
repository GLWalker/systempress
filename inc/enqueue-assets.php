<?php

/**
 * SystemPress Enqueue Scripts and Styles
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

//remove inline styles.
add_filter(
    'wp_theme_json_data_default',
    function ($theme_json) {
        $data = $theme_json->get_data();
        // Remove default color palette.
        $data['settings']['color']['palette']['default'] = [];
        // Remove default duotone.
        $data['settings']['color']['duotone']['default'] = [];
        // Remove default gradients.
        $data['settings']['color']['gradients']['default'] = [];
        // Remove shadow presets.
        //$data['settings']['shadow']['presets']['default'] = [];
        // Update the theme data.
        $theme_json->update_with($data);
        return $theme_json;
    }
);

//add_filter('should_load_separate_core_block_assets', '__return_true');
/* Since v6.4 you need to add a priority of 11 for this filter to work if you are trying to force block themes to load all block styles rather than just those which WordPress detects */
//add_filter( 'should_load_separate_core_block_assets', '__return_false', 11 );

if (!function_exists('sp_replace_media_query_styles')) {

    add_action('wp_enqueue_scripts', 'sp_replace_media_query_styles');

    function sp_replace_media_query_styles()
    {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        //$suffix = '';

        $blocks = array(
            'columns',
            'gallery',
            'latest-post',
            'media-text',
            'navigation',
            'post-template',
            'rss'
        );

        foreach ($blocks as $block) {
            wp_deregister_style('wp-block-' . $block);
            wp_register_style('wp-block-' . $block, get_template_directory_uri() . "/assets/css/blocks/" . $block . $suffix . '.css');
        }
    }
}

if (!function_exists('sp_deregister_styles')) {
    /**
     * Just remove what we dont need if we dont need it.
     */
    add_action('wp_enqueue_scripts', 'sp_deregister_styles', 100);
    add_action('wp_print_styles', 'sp_deregister_styles', 100);

    function sp_deregister_styles()
    {
        wp_dequeue_style('wp-block-post-comments-form');
        wp_dequeue_style('wp-block-archives');
        wp_dequeue_style('wp-block-button');
        wp_dequeue_style('wp-block-buttons');
        wp_dequeue_style('wp-block-categories');
        wp_dequeue_style('wp-block-paragraph');
        wp_dequeue_style('wp-block-group');
        wp_dequeue_style('wp-block-list');
        wp_dequeue_style('wp-block-post-date');
        wp_dequeue_style('wp-block-post-title');
        //wp_dequeue_style('wp-block-site-title');
        wp_dequeue_style('wp-block-spacer');
        wp_dequeue_style('wp-block-heading');
        wp_dequeue_style('wp-block-separator');
        wp_dequeue_style('wp-block-query-pagination');
    }
}

/* Shared Frontend and Editor Bootstap styles */
if (!function_exists('sp_enqueue_assets')) {

    //remove global stylesheet(s) and re-add later with modifications
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
    remove_action('enqueue_block_editor_assets', 'wp_enqueue_global_styles_css_custom_properties');
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles_custom_css');
    remove_action('wp_head', 'wp_custom_css_cb', 120);

    add_action('enqueue_block_assets', 'sp_enqueue_assets');
    /**
     * Add CSS to the admin and frontend.
     *
     * @since 1
     */

    function sp_enqueue_assets()
    {

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        // $suffix = '';

        $deps = '[]';
        $jsdeps = '[]';
        $globalstylename = 'global-styles';

        if (is_admin()) {
            $deps = ['wp-edit-blocks'];
            $jsdeps = ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-editor'];
            $globalstylename = 'global-styles-css-custom-properties';
        }

        /* reset is first */
        if (!is_admin()) {

            wp_register_style('@reset', get_template_directory_uri() . "/assets/css/bs-reset.min.css", [], wp_get_theme()->get('Version'));
            array_unshift(wp_styles()->queue, '@reset');
        }

        wp_register_style(
            '@bootstrap',
            get_template_directory_uri() . "/assets/css/bootstrap{$suffix}.css",
            $deps,
            filemtime(get_template_directory() . "/assets/css/bootstrap.css")
        );

        wp_register_style(
            'animate',
            get_template_directory_uri() . "/assets/css/animate{$suffix}.css",
            $deps,
            filemtime(get_template_directory() . "/assets/css/animate.css")
        );

        wp_register_style(
            $globalstylename,
            false,
            $deps,
            wp_get_theme()->get('Version')
        );

        wp_add_inline_style(
            $globalstylename,
            sp_global_vars()
        );

        wp_add_inline_style(
            $globalstylename,
            sp_preset_styles_css()
        );

        //if (!is_admin()) {
        wp_enqueue_style('@bootstrap');
        wp_enqueue_style('animate');
        wp_enqueue_style($globalstylename);
        // }

        /* Register all bootstrap stylesheets found in dir. */
        foreach (glob(get_template_directory() . "/assets/css/bootstrap/*{$suffix}.css") as $file) {

            $filename = substr($file, strrpos($file, '/') + 1);
            wp_register_style(
                strstr($filename, '.', true),
                get_template_directory_uri() . "/assets/css/bootstrap/" . $filename,
                '@bootstrap',
                filemtime(get_template_directory() . "/assets/css/bootstrap/" . $filename)
            );
        }

        if (is_admin()) {

            foreach (glob(get_template_directory() . '/assets/css/bootstrap/*.css') as $file) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_style('./assets/css/bootstrap/' . $filename);
            }
        }

        wp_register_style(
            'global-styles-custom-css',
            false,
            $deps,
            wp_get_theme()->get('Version'),
            'all'
        );

        // if (!empty(sp_custom_css())) {
        wp_add_inline_style('global-styles-custom-css', sp_custom_css());
        //  }

        /* Enqueue Only Editor styles */
        if (is_admin()) {

            wp_register_style('@editor-styles',  false, $deps, wp_get_theme()->get('Version'), 'all');

            wp_enqueue_style('@editor-styles');
            wp_add_inline_style('@editor-styles', sp_editor_styles());
        }

        if (!is_admin()) {
            wp_enqueue_style('global-styles-custom-css');
        }

        /* Enqueue child theme if available */
        if (is_child_theme()) {
            wp_enqueue_style('systempress-child', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'), 'all');
        }

        wp_enqueue_script(
            'wow',
            get_template_directory_uri() . "/assets/js/wow.min.js",
            $jsdeps,
            filemtime(get_template_directory() . "/assets/js/wow.min.js"),
            true
        );

        wp_enqueue_script(
            'classlist',
            get_template_directory_uri() . "/assets/js/classList.min.js",
            $jsdeps,
            filemtime(get_template_directory() . "/assets/js/classList.min.js"),
            true
        );

        wp_register_script(
            '@shared',
            get_template_directory_uri() . "/assets/js/shared.js",
            $jsdeps,
            wp_get_theme()->get('Version'),
            true
        );
        wp_enqueue_script('@shared');

        wp_enqueue_script(
            '@bootstrap-bundle',
            get_template_directory_uri() . "/assets/js/bootstrap.bundle.min.js",
            $jsdeps,
            filemtime(get_template_directory() . "/assets/js/bootstrap.bundle.min.js"),
            true
        );

        /* Register all bootstrap scripts found in dir. */
        foreach (glob(get_template_directory() . '/assets/js/bootstrap/*.js') as $file) {
            $filename = substr($file, strrpos($file, '/') + 1);
            wp_register_script(
                strstr($filename, '.', true),
                get_template_directory_uri() . "/assets/js/bootstrap/" . $filename,
                $jsdeps,
                filemtime(get_template_directory() . "/assets/js/bootstrap/" . $filename),
                true
            );
        }

        /*
        wp_enqueue_script(
            'buttton-mods-editor-script',
            get_template_directory_uri() . "/blocks/button-mods/build/index.js",
            $jsdeps,
            filemtime( get_template_directory() . "/blocks/button-mods/build/index.js" ) );
        */
        if (is_admin()) {

            wp_enqueue_script(
                'sp-block-variations',
                get_template_directory_uri() . '/assets/js/block-variations.js',
                $jsdeps,
                filemtime(get_template_directory() . '/assets/js/block-variations.js')
            );

            wp_enqueue_script(
                'sp-social-icon-variations',
                get_template_directory_uri() . '/assets/js/social-icon-variations.js',
                $jsdeps,
                filemtime(get_template_directory() . '/assets/js/social-icon-variations.js')
            );

            foreach (glob(get_template_directory() . '/assets/js/bootstrap/*.js') as $file) {
                $filename = substr($file, strrpos($file, '/') + 1);
                wp_enqueue_script('./assets/js/bootstrap/' . $filename);
            }
        }
    }
}

if (!function_exists('sp_add_editor_style')) {
    /**
     * Add Bootstrap to the admin block editor.
     * Originally had it enqued in sp_enqueue_assets,
     * however, block editor doesn\'t seem to show the
     * HTML Block preview markup if it is not added
     * by calling add_editor_style()
     *
     * @since 1
     */

    add_filter('pre_http_request', 'sp_force_dynamic_block_editor_styles', 10, 3);
    function sp_force_dynamic_block_editor_styles($response, $parsed_args, $url)
    {
        if ((is_ssl() ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . '/sp-force-dynamic-block-editor-styles') === $url) {
            $response = array(
                'body'     =>  sp_global_vars() . sp_preset_styles_css() . sp_custom_css(),
                /*  'headers'  => new Requests_Utility_CaseInsensitiveDictionary(), */
                'headers'  =>
                '\WpOrg\Requests\Utility\CaseInsensitiveDictionary',
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

    add_action('after_setup_theme', 'sp_add_editor_style');

    function sp_add_editor_style()
    {

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        //$suffix = '';

        add_theme_support('editor-styles');

        add_editor_style(
            array(
                "./assets/css/bs-reset{$suffix}.css",
                "./assets/css/bootstrap{$suffix}.css"
            )
        );

        foreach (glob(get_template_directory() . "/assets/css/bootstrap/*{$suffix}.css") as $file) {
            $filename = substr($file, strrpos($file, '/') + 1);
            add_editor_style('/assets/css/bootstrap/' . $filename);
        }

        add_editor_style((is_ssl() ? 'https://' : 'http://' . $_SERVER['HTTP_HOST'] . '/sp-force-dynamic-block-editor-styles'));

        if (is_child_theme()) {
            add_editor_style(get_stylesheet_directory_uri() . '/style.css');
        }
    }
}

if (!function_exists('sp_do_a11y_scripts')) {

    add_action('wp_footer', 'sp_do_a11y_scripts', 99);
    /**
     * Enqueue scripts in the footer.
     *
     */
    function sp_do_a11y_scripts()
    {
        if (apply_filters('sp_print_a11y_script', true)) {
            // Add our small a11y script inline.
            printf(
                '<script id="systempress-a11y">%s</script>',
                '! function(){"use strict";if( "querySelector"in document&&"addEventListener"in window  ){var e=document.body;e.addEventListener( "mousedown",function(){e.classList.add( "using-mouse"  )}  ),e.addEventListener( "keydown",function(){e.classList.remove( "using-mouse"  )}  )}}();'
            );
        }
    }
}
