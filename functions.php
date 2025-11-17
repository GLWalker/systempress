<?php

/**
 * SystemPress Functions File
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

declare(strict_types=1);

// Exit if accessed directly.
defined('ABSPATH') || exit;

//define('SP_LOAD_BOOTSTRAP_STYLESHEETS', true);
//define('SP_LOAD_BOOTSTRAP_JAVASCRIPTS', true);
/*
add_action('wp_footer', function () {
    $registered_styles = wp_styles();

    if ($registered_styles && isset($registered_styles->registered)) {
        echo '<strong>Total registered styles:</strong> ' . count($registered_styles->registered) . '<br>';
    } else {
        echo 'No registered styles found.';
    }
});

add_action('wp_footer', function () {
    $wp_styles = wp_styles();

    if (!empty($wp_styles->queue)) {
        echo '<strong>Total enqueued styles:</strong> ' . count($wp_styles->queue) . '<br><ul>';

        foreach ($wp_styles->queue as $handle) {
            echo '<li>' . esc_html($handle) . '</li>';
        }

        echo '</ul>';
    } else {
        echo 'No styles are currently enqueued.';
    }
});
*/
/**
 * Ensure WordPress version is 6.7 or greater.
 */
function systempress_check_wp_version()
{
    global $wp_version;
    $required_wp_version = '6.7';

    // Compare WordPress version.
    if (version_compare($wp_version, $required_wp_version, '<')) {
        // Switch to default theme.
        switch_theme(WP_DEFAULT_THEME);

        // Display admin notice.
        add_action('admin_notices', function () use ($required_wp_version) {
?>
            <div class="notice notice-error">
                <p>
                    <?php
                    echo sprintf(
                        esc_html__('SystemPress requires WordPress version %s or greater. The theme has been deactivated.', 'systempress'),
                        esc_html($required_wp_version)
                    );
                    ?>
                </p>
            </div>
<?php
        });

        // Prevent further execution.
        return;
    }
}
add_action('after_switch_theme', 'systempress_check_wp_version');

/**
 * Load SystemPress files dynamically.
 */
add_action('after_setup_theme', 'sp_load_files', 0);

function sp_load_files(): void
{
    $includes_directory = get_template_directory() . '/inc/';

    // Ensure the directory exists before proceeding.
    if (!is_dir($includes_directory)) {
        error_log("SystemPress: The directory $includes_directory does not exist.");
        return;
    }

    // List of required files.
    $files = [
        // 'buddypress',
        'theme-functions',
        'enqueue-assets',
        'block-filters',
        'block-replacements',
        'block-styles',
        'dynamic-assets',
        'class-css',
        'class-color-palette',
        'css-output',
        'carousel',
        'dark-mode',
        'off-canvas',
        'search-modal',
        'social-icon-filters',
    ];

    // Include each file dynamically if it exists.
    foreach ($files as $file) {
        $file_path = $includes_directory . $file . '.php';

        if (file_exists($file_path)) {
            require_once $file_path;
        } else {
            error_log(sprintf(
                'SystemPress: Missing file - %s',
                $file_path
            ));
        }
    }
}

/**
 * Hook Example Implementation.
 */
add_action('sp_hook_example', 'sp_hook_example_content', 10);

function sp_hook_example_content(): void
{
    // Output HTML content for the example hook.
    echo <<<HTML
    <div class="card h-100 bg-primary">
        <div class="card-body">
            <h3 class="h5 card-title">Template Hooks</h3>
            <p class="card-text">
                SystemPress comes loaded with several action hooks strategically
                placed throughout the theme.
            </p>
            <p class="card-text">
                Use the block editor to add new hooks where you need by selecting
                the SP Action Hook block.<br>
                <strong>In fact</strong>, this card was added with a hook.
            </p>
        </div>
    </div>
    HTML;
}

/**
 * Load dev file.
 */
add_action('after_setup_theme', 'sp_dev_file', 0);

function sp_dev_file(): void
{
    $dev_file = get_template_directory()  . '/dev.php';

    if (file_exists($dev_file)) {
        require_once $dev_file;
    } else {
        error_log(sprintf(
            'SystemPress: Missing file - %s',
            $dev_file
        ));
    }
}
