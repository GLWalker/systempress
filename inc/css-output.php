<?php

/**
 * SystemPress CSS Output functions
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;
/* Remove */
if (!function_exists('sp_remove_color_css')) {

    /**
     * Remove CSS text-color rules tied to a specific WP color preset.
     *
     * @param string $color  The color slug (e.g., 'primary').
     * @param string $string The full CSS block to modify.
     * @return string Modified CSS with the rule removed.
     */
    function sp_remove_color_css($color, $string)
    {
        if (empty($color)) {
            return $string;
        }

        $find = '.has-' . $color . '-color{color: var(--wp--preset--color--' . $color . ') !important;}';

        // Direct replace; safe even if not found
        return sanitize_text_field(str_replace($find, '', $string));
    }
}

if (!function_exists('sp_remove_background_css')) {

    /**
     * Remove CSS background-color rules tied to a specific WP color preset.
     *
     * @param string $color  The color slug.
     * @param string $string The CSS string to modify.
     * @return string Modified CSS.
     */
    function sp_remove_background_css($color, $string)
    {
        if (empty($color)) {
            return $string;
        }

        $find = '.has-' . $color . '-background-color{background-color: var(--wp--preset--color--' . $color . ') !important;}';

        return sanitize_text_field(str_replace($find, '', $string));
    }
}

if (!function_exists('sp_remove_border_css')) {

    /**
     * Remove CSS border-color rules tied to a specific WP color preset.
     *
     * @param string $color  The color slug.
     * @param string $string The CSS to modify.
     * @return string Modified CSS.
     */
    function sp_remove_border_css($color, $string)
    {
        if (empty($color)) {
            return $string;
        }

        $find = '.has-' . $color . '-border-color{border-color: var(--wp--preset--color--' . $color . ') !important;}';

        return sanitize_text_field(str_replace($find, '', $string));
    }
}
/* Manipulate */
if (!function_exists('sp_color_css')) {

    /**
     * Merge WP color classes with Bootstrap text/link utility classes.
     *
     * @param string $color  The WP color slug (e.g., "primary" or "bs-primary").
     * @param string $string The CSS string to modify.
     * @return string Modified CSS string.
     */
    function sp_color_css($color, $string)
    {
        if (empty($color)) {
            return $string;
        }

        // Strip "bs-" prefix when present
        $stripped = (substr($color, 0, 3) === 'bs-') ? substr($color, 3) : $color;

        // WP class to match
        $find = '.has-' . $color . '-color{';

        // Add Bootstrap classes + preserve WP class
        $replace = '.text-' . $stripped . ', .link-' . $stripped . ', .has-' . $color . '-color{';

        // Perform replacement
        $css = str_replace($find, $replace, $string);

        // Only sanitize if something was actually changed
        return ($css !== $string) ? sanitize_text_field($css) : $string;
    }
}

if (!function_exists('sp_background_css')) {

    /**
     * Merge WP background color CSS with Bootstrap background/text/link styles.
     *
     * @param string $color  The color slug (e.g., "primary" or "bs-primary").
     * @param string $string The full CSS to modify.
     * @return string Modified CSS string.
     */
    function sp_background_css($color, $string)
    {
        if (empty($color)) {
            return $string;
        }

        // Strip "bs-" prefix for Bootstrap utilities
        $stripped = (substr($color, 0, 3) === 'bs-') ? substr($color, 3) : $color;

        // WordPress class to locate
        $find = '.has-' . $color . '-background-color{';

        // Build replacement block (Bootstrap + WP merge)
        $replace  = '.text-bg-' . $stripped . ' a, .bg-' . $stripped . ' a, .has-bs-' . $stripped . '-background-color a { color: var(--bs-text-link); }';

        $replace .= '
        .text-bg-' . $stripped . ' a:hover,
        .bg-' . $stripped . ' a:hover,
        .has-bs-' . $stripped . '-background-color a:hover,
        .text-bg-' . $stripped . ' a:active,
        .text-bg-' . $stripped . ' a.active,
        .bg-' . $stripped . ' a:active,
        .bg-' . $stripped . ' a.active,
        .has-bs-' . $stripped . '-background-color a:active,
        .has-bs-' . $stripped . '-background-color a.active,
        .text-bg-' . $stripped . '.active *,
        .bg-' . $stripped . '.active *,
        .has-bs-' . $stripped . '-background-color.active *
        { color: var(--bs-text-hover); }';

        // Base merge
        $replace .= '.text-bg-' . $stripped . ', .bg-' . $stripped . ', .has-' . $color . '-background-color{';
        $replace .= '
        --bs-text: var(--' . $color . '-text);
        --bs-text-link: var(--bs-' . $stripped . '-text-link);
        --bs-text-hover: var(--bs-' . $stripped . '-text-hover);
        --bs-text-emphasis: var(--bs-' . $stripped . '-text-emphasis);

        --bs-background: var(--' . $color . ');
        --bs-background-hover: var(--' . $color . '-hover-bg);

        --bs-border: var(--' . $color . '-border-color);
        --bs-border-hover: var(--' . $color . '-hover-border-color);

        --bs-background-rgb: var(--' . $color . '-rgb);
        --bs-shadow-rgb: var(--' . $color . '-shadow-rgb);

        color: var(--bs-text);
        ';

        // Perform initial WP → BS replacement
        $css = str_replace($find, $replace, $string);

        // Bootstrap subtle border conversions
        $css = sp_replace_it('var(--wp--preset--color--bs', 'var(--bs', $css);
        $css = sp_replace_it('-bg-subtle-border-color', '-border-subtle',            $css);
        $css = sp_replace_it('-bg-subtle-hover-border-color', '-hover-border-subtle', $css);
        $css = sp_replace_it('-bg-subtle-hover-bg', '-hover-bg-subtle',               $css);
        $css = sp_replace_it('-bg-subtle-text-emphasis', '-text-emphasis-subtle',     $css);
        $css = sp_replace_it('-bg-subtle-shadow-rgb', '-shadow-rgb-subtle',           $css);

        // Only sanitize when modified
        return ($css !== $string) ? sanitize_text_field($css) : $string;
    }
}

if (!function_exists('sp_border_css')) {

    /**
     * Merge WP border-color classes with Bootstrap border utilities.
     *
     * @param string $color  The color slug (e.g., "primary" or "bs-primary").
     * @param string $string The CSS block to modify.
     * @return string Modified CSS.
     */
    function sp_border_css($color, $string)
    {
        if (empty($color)) {
            return $string;
        }

        // Strip Bootstrap prefix if present
        $stripped = (substr($color, 0, 3) === 'bs-') ? substr($color, 3) : $color;

        // WP rule to locate (kept exactly as your original structure)
        $find = '.has-' . $color . '-border-color{border-color: var(--wp--preset--color--' . $color . ')';

        // Bootstrap-integrated replacement
        $replace = '.border-' . $stripped . ', .has-' . $color . '-border-color{border-color: var(--' . $color . '-border-color)';

        $css = str_replace($find, $replace, $string);

        return ($css !== $string) ? sanitize_text_field($css) : $string;
    }
}

if (!function_exists('sp_font_size_css')) {

    /**
     * Merge WordPress font-size classes with Bootstrap utility/display classes.
     *
     * @param string $size   The WP font size slug (e.g., "small", "x-large", "display-3").
     * @param string $string The CSS string to modify.
     * @return string Modified CSS string.
     */
    function sp_font_size_css($size, $string)
    {
        if (empty($size)) {
            return $string;
        }

        // WP → BS font-size mapping
        $size_map = [
            'x-small'   => '.tiny, .x-small',
            'small'     => 'small, .small',
            'medium'    => '.fs-6',
            'large'     => '.fs-5',
            'x-large'   => '.fs-4',
            'xx-large'  => '.fs-3',
            'xxx-large' => '.fs-2',
            'huge'      => '.fs-1',
            'display-6' => '.display-6',
            'display-5' => '.display-5',
            'display-4' => '.display-4',
            'display-3' => '.display-3',
            'display-2' => '.display-2',
            'display-1' => '.display-1',
        ];

        // If size not recognized, return original
        if (!isset($size_map[$size])) {
            return $string;
        }

        // Replacement string
        $replace = $size_map[$size] . ', .has-' . $size . '-font-size';

        // Replace and sanitize only if changed
        $css = str_replace('.has-' . $size . '-font-size', $replace, $string);

        return ($css !== $string) ? sanitize_text_field($css) : $string;
    }
}

if (!function_exists('sp_generate_base_vars')) {
    /**
     * Generates base shades and variables for output.
     *
     * @param string $slug Slug name of theme color palette JSON settings.
     * @return string CSS output.
     */

    function sp_generate_base_vars($slug)
    {

        // Enqueue dark mode styles only once
        static $text_bg_set = false;

        $colors = wp_get_global_settings()['color']['palette']['theme'] ?? [];

        // Bail early if slug is empty or no theme colors found
        if (!$slug || empty($colors)) {
            return '';
        }

        $css = new SystemPress_CSS();

        $css->set_selector('rawout');

        /* place other boostrap.css here */

        foreach ($colors as $color) {

            if ($color['slug'] !== $slug) {
                continue;
            }

            $colorValue = $color['color'];
            $colorObj = new SystemPress_ColorPalette($colorValue);

            $rgbValue = str_contains($colorValue, 'rgb') ? $colorValue : $colorObj->hex_to_rgb($colorValue);

            $rgbVar = str_replace(['rgb(', 'rgba(', ')'], '', $rgbValue);

            $darkInvValue = $colorObj->makeDarkInverse($colorValue);

            $rgbDarkValue = str_contains($darkInvValue, 'rgb') ? $colorValue : $colorObj->hex_to_rgb($darkInvValue);

            $rgbDarkVar = str_replace(['rgb(', 'rgba(', ')'], '', $rgbDarkValue);

            if ($slug === 'base') {
                $css->add_property('--bs-body-bg', $colorValue);
                $css->add_property('--bs-body-bg-rgb', $rgbVar);

                $css->add_property('--bs-emphasis-color', $darkInvValue);
                $css->add_property('--bs-emphasis-color-rgb', $rgbDarkVar);
            }

            if ($slug === 'contrast') {
                $css->add_property('--bs-body-color', $colorValue);
                $css->add_property('--bs-body-color-rgb', $rgbVar);
            }

            if ($slug === 'bs-secondary-color') {
                $css->add_property('--bs-secondary-color', $colorValue);
                $css->add_property('--bs-secondary-color-rgb', $rgbVar);
            }

            if ($slug === 'bs-secondary-bg') {
                $css->add_property('--bs-secondary-bg', $colorValue);
                $css->add_property('--bs-secondary-bg-rgb', $rgbVar);
            }

            if ($slug === 'bs-tertiary-color') {
                $css->add_property('--bs-tertiary-color', $colorValue);
                $css->add_property('--bs-tertiary-color-rgb', $rgbVar);
            }

            if ($slug === 'bs-tertiary-bg') {
                $css->add_property('--bs-tertiary-bg', $colorValue);
                $css->add_property('--bs-tertiary-bg-rgb', $rgbVar);
            }

            if ($slug === 'bs-border-color') {
                $css->add_property('--bs-border-color', $colorValue);
                $css->add_property('--bs-border-color-translucent', $colorObj->adjust_alpha($rgbDarkValue, .175));
            }
        }

        // Set common text and background vars only on the first function call
        if (!$text_bg_set) {
            $css->add_property('--bs-text', 'var(--bs-body-color)');
            $css->add_property('--bs-text-link', 'var(--bs-link-color)');
            $css->add_property('--bs-text-hover', 'var(--bs-link-hover-color)');
            $css->add_property('--bs-text-emphasis', 'var(--bs-emphasis-color)');
            $css->add_property('--bs-background', 'var(--bs-body-bg)');
            $css->add_property('--bs-background-hover', 'var(--bs-secondary-bg)');
            $css->add_property('--bs-border', 'var(--bs-border-color)');
            $css->add_property('--bs-border-hover', 'var(--bs-border-color-translucent)');
            $css->add_property('--bs-background-rgb', 'var(--bs-body-bg-rgb)');
            $css->add_property('--bs-shadow-rgb', 'var(--bs-tertiary-bg-rgb)');

            // Mark the static styles as printed
            $text_bg_set = true;
        }

        //$css->stop_scope();

        return $css->css_output();
    }
}

if (!function_exists('sp_generate_color_vars')) {
    /**
     * Generates Bootstrap 5 color shades and variables for output.
     *
     * @param string $slug The slug name of the theme color palette JSON settings.
     * @return string CSS output.
     */
    function sp_generate_color_vars($slug)
    {
        $colors = wp_get_global_settings()['color']['palette']['theme'] ?? [];
        $css = new SystemPress_CSS();

        foreach ($colors as $color) {
            if ($color['slug'] !== $slug) continue;

            $colorValue = $color['color'];
            $colorObj = new SystemPress_ColorPalette($colorValue);

            $rgbValue = str_contains($colorValue, 'rgb') ? $colorValue : $colorObj->hex_to_rgb($colorValue);
            $rgbVar = str_replace(['rgb(', 'rgba(', ')'], '', $rgbValue);

            $emphasisText = $colorObj->makeEmphasis($colorValue);
            $baseTextColor = $colorObj->parse_the_contrast($colorValue);
            $contrastText = $colorObj->adjust_color_contrast($colorValue, $baseTextColor, 3.5);
            $contrastLink = $colorObj->adjust_color_contrast($colorValue, $baseTextColor, 4);
            $colorPalette = $colorObj->createPalette();

            $css->set_selector('rawout');
            $css->add_property('--' . $slug, 'var(--wp--preset--color--' . $slug . ')');

            foreach ($colorPalette as $index => $paletteColor) {

                $counter = $index + 1;

                if ($counter !== 4) {
                    $css->add_property('--' . $slug . '-' . $counter, $paletteColor);
                }

                if ($counter === 2) {
                    $baseTextColor = $colorObj->parse_the_contrast($paletteColor);
                    $contrastHover = $colorObj->adjust_color_contrast($paletteColor, $baseTextColor, 4.0);
                }
                if ($counter === 4) {

                    $rgbPaletteColor = $colorObj->hex_to_rgb($paletteColor);
                    $rgbPaletteColor = str_replace(['rgb(', 'rgba(', ')'], '', $rgbPaletteColor);
                    $css->add_property('--' . $slug . '-shadow-rgb', $rgbPaletteColor);
                }
            }

            $css->add_property('--' . $slug . '-rgb', $rgbVar);
            $css->add_property('--' . $slug . '-text-emphasis', $emphasisText);
            $css->add_property('--' . $slug . '-text', '#' . ltrim($contrastText, '#'));
            $css->add_property('--' . $slug . '-text-link', '#' . ltrim($contrastLink, '#'));
            $css->add_property('--' . $slug . '-text-hover', '#' . ltrim($contrastHover, '#'));

            $cssoutput = $css->css_output();

            $cssoutput = str_replace(['-2', '-bg-subtle-hover-bg'], ['-hover-bg', '-hover-bg-subtle'], $cssoutput);

            $cssoutput = str_replace(['-1', '-bg-subtle-border-color'], ['-border-color', '-border-subtle'], $cssoutput);

            $cssoutput = str_replace(['-3', '-bg-subtle-hover-border-color'], ['-hover-border-color', '-hover-border-subtle'], $cssoutput);

            // $cssoutput = str_replace(['-2', '-bg-subtle-text-emphasis'], ['-text-emphasis', '-text-emphasis-subtle'], $cssoutput);
            $cssoutput = str_replace(['-4', '-bg-subtle-shadow-rgb'], ['-shadow-rgb', '-shadow-rgb-subtle'], $cssoutput);

            return $cssoutput;
        }

        return '';
    }
}

/* Output */
if (!function_exists('sp_editor_styles')) {
    /**
     * Add styles to the block editor. Can be extended or filtered.
     *
     * @since 0.1
     */
    function sp_editor_styles()
    {
        $css = new SystemPress_CSS();

        /* old way *
        $css->set_selector('.editor-styles-wrapper');
        $css->add_property('margin', '0.15rem !important');
        */

        // Helper function to add properties to a selector
        $add_styles = function ($selector, $properties) use ($css) {
            $css->set_selector($selector);
            foreach ($properties as $property => $value) {
                $css->add_property($property, $value);
            }
        };

        // Define styles in an associative array
        $styles = [
            '.editor-styles-wrapper' => ['margin' => '0.15rem !important'],
            '.edit-post-visual-editor__post-title-wrapper' => [
                'margin-top' => '0 !important',
                'padding' => 'var(--wp--preset--spacing--10) var(--wp--preset--spacing--20)',
                'margin-bottom' => '0'
            ],

            '.block-editor-block-list__block.alert' => ['display' => 'inline-flex !important', 'width' => '100% !important'],
            '.block-editor-block-list__block.alert .btn-close' => ['margin-top' => '-.25rem !important'],
            '.block-editor-block-list__block.offcanvas' => [
                'visibility' => 'visible !important',
                'transform' => 'none !important'
            ],
            ':where( .wp-block-button__link )' => [
                'padding' => 'var(--bs-btn-padding-y) var(--bs-btn-padding-x) !important'
            ],
            '.block-editor-block-list__block.btn-group .wp-element-button' => ['margin-right' => '0 !important'],
            '.block-editor-block-list__block.card [class*="card-"]' => ['margin-block-start' => '0 !important'],
            '.block-editor-block-list__block.sp-action-hook' => [
                'height' => '0.12rem',
                'width' => '67% !important',
                'margin' => '0 auto',
                'background-color' => '#cd5c5c'
            ],
            '.wp-block-navigation.nav-pills .block-editor-rich-text__editable' => [
                'display' => 'block',
                'padding' => 'var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x)',
                'font-weight' => 'var(--bs-nav-link-font-weight)',
                'color' => 'var(--bs-nav-link-color)'
            ],
            '.wp-block-navigation.nav-pills .wp-block-navigation__container div:first-child a' => [
                'color' => 'var(--bs-nav-pills-link-active-color)',
                'background-color' => 'var(--bs-nav-pills-link-active-bg)',
                'border-radius' => 'var(--bs-nav-pills-border-radius)'
            ],
            '.block-editor-block-list__block.carousel-indicators p' => ['display' => 'none'],
            '.block-editor-block-list__block.carousel-control-prev' => ['display' => 'none'],
            '.block-editor-block-list__block.carousel-control-next' => ['display' => 'none'],
            '.block-editor-block-list__block.modal' => [
                'position' => 'relative !important',
                'top' => 'auto',
                'right' => 'auto',
                'bottom' => 'auto',
                'left' => 'auto',
                'z-index' => '1',
                'display' => 'block !important',
                'overflow' => 'visible !important'
            ],
            '.block-editor-block-list__block.fade' => [
                'opacity' => '1 !important'
            ]
        ];

        // Apply styles
        foreach ($styles as $selector => $properties) {
            $add_styles($selector, $properties);
        }

        do_action('sp_editor_styles', $css);

        // Return CSS output if available
        if ($css->css_output()) {
            return apply_filters('sp_editor_styles_output', $css->css_output());
        }
    }
}

if (!function_exists('sp_global_vars')) {
    /**
     * Add Bootstrap variables and replace CSS custom properties for global stylesheet compatibility.
     *
     * This function grabs the global styles from the `theme.json` and customizes them by replacing certain
     * CSS custom properties (variables) with Bootstrap-compatible ones. It also adds Bootstrap-specific variables
     * and prepares the global styles to be correctly rendered alongside Bootstrap styles.
     *
     * The function ensures that the global styles are updated whenever changes are made via the theme customizer
     * or the `theme.json` file.
     *
     * @return string Modified global CSS stylesheet with Bootstrap variables and custom replacements.
     */
    function sp_global_vars()
    {
        // Get the global stylesheet from theme.json with only 'variables' section
        $style = wp_get_global_stylesheet(['variables']);

        // Retrieve Bootstrap-specific variables
        $bs_vars = sp_bootstrap_global_vars();

        //$bs_dark_vars = sp_bootstrap_dark_vars();

        // Define the replacements in an associative array
        $replacements = [
            'has-custom-bs' => 'has-bs',  // Rename custom BS class to standard 'has-bs'
            '--wp--preset--color--custom-bs' => '--wp--preset--color--bs', // Map custom BS color preset to standard BS color preset
            ':root{--wp--preset--aspect-ratio--square' => ':root,[data-bs-theme=light]{--wp--preset--aspect-ratio--square', // Adjust for Bootstrap theme variation
            'body{-' => ':root,[data-bs-theme=light]{-', // Adjust body-level styles for theme variations
            '--wp--custom--sp-replace-string: all;' => $bs_vars,  // Insert Bootstrap global variables
            '--wp--custom--bs-' => '--bs-', // Replace custom BS variables with Bootstrap standard
            '--wp--custom--wp-preset-font-family-' => '--wp--preset--font-family--', // Adjust font-family preset for Bootstrap compatibility
            /*
            '--wp--preset--shadow--md' => '--bs-box-shadow',  // Replace custom shadow presets with Bootstrap box-shadow
            '--wp--preset--shadow--sm' => '--bs-box-shadow-sm', // Adjust small shadow preset
            '--wp--preset--shadow--lg' => '--bs-box-shadow-lg', // Adjust large shadow preset
            '--wp--preset--shadow--inset' => '--bs-box-shadow-inset', // Replace with inset shadow
            '--wp--preset--shadow--form-focus' => '--bs-box-shadow-form-focus', // Form focus shadow replacement
            '--wp--preset--shadow--form-control-shadow' => '--bs-form-control-shadow', // Form control shadow replacement
            '--wp--preset--shadow--button' => '--bs-box-shadow-button', // Button shadow replacement
            '--wp--preset--shadow--button-focus' => '--bs-box-shadow-button-focus', // Button focus shadow replacement
            '--wp--preset--shadow-button-active' => '--bs-box-shadow-button-active', // Button active shadow replacement
            */

            /*
            '--wp--custom--sp-darkmode-string: all;' => '}[data-bs-theme=dark] {' . $bs_dark_vars  // Insert Bootstrap global variables
            */

        ];

        // Replace all occurrences in the global stylesheet with Bootstrap-compatible CSS custom properties
        foreach ($replacements as $search => $replace) {
            $style = sp_replace_it($search, $replace, $style);
        }

        // Return the updated global stylesheet with Bootstrap-compatible variables
        return $style;
    }
}

if (!function_exists('sp_global_styles_presets')) {

    /**
     * Grabs the WP global styles and presets from the theme.json file, then filters and modifies
     * the output to match with Bootstrap's CSS conventions.
     *
     * This function includes a series of transformations to replace the global styles and
     * presets, such as font sizes, background colors, borders, and other key styling elements,
     * to align with the expected Bootstrap styles.
     *
     * @return string Modified global CSS that matches Bootstrap styling conventions.
     */
    function sp_global_styles_presets()
    {
        // Retrieve the global stylesheet and presets from theme.json
        $style = wp_get_global_stylesheet(['styles', 'presets']) . wp_add_global_styles_for_blocks();

        // Define an array of unwanted borders to be removed from the global styles
        $remove_borders = [
            'base',
            'contrast',
            'bs-secondary-bg',
            'bs-secondary-color',
            'bs-tertiary-bg',
            'bs-tertiary-color'
        ];

        // Remove unwanted border styles
        foreach ($remove_borders as $border) {
            $style = sp_remove_border_css($border, $style);
        }

        // Loop through the headings (h1 - h6) and update their styles to match Bootstrap's structure
        for ($i = 1; $i <= 6; $i++) {
            $style = sp_replace_it('h' . $i, '.h' . $i . ',h' . $i, $style);
        }

        // Define font sizes to be replaced by their Bootstrap equivalents
        $font_sizes = [
            'x-small',
            'small',
            'medium',
            'large',
            'x-large',
            'xx-large',
            'xxx-large',
            'huge',
            'display-6',
            'display-5',
            'display-4',
            'display-3',
            'display-2',
            'display-1'
        ];

        // Replace font size definitions with Bootstrap's
        foreach ($font_sizes as $size) {
            $style = sp_font_size_css($size, $style);
        }

        // Update the font size for Bootstrap's display classes (display-1 to display-6)
        $style = sp_replace_it('.display-6,', '.display-1, .display-2, .display-3, .display-4, .display-5, .display-6, .has-display-1-font-size, .has-display-2-font-size, .has-display-3-font-size, .has-display-4-font-size, .has-display-5-font-size, .has-display-6-font-size {
        font-family: var(--wp--preset--font-family--display);
        font-weight: var(--bs-display-font-weight);
        line-height: 1.2;
        text-shadow: var(--bs-display-text-shadow);
    }    .display-6,', $style);

        $style = sp_replace_it('.has-base-background-color', '.bg-body,.has-base-background-color', $style);
        $style = sp_replace_it('.has-contrast-color', '.text-body,.has-contrast-color', $style);
        $style = sp_replace_it('.has-bs-secondary-bg-background-color', '.bg-body-secondary,.has-bs-secondary-bg-background-color', $style);
        $style = sp_replace_it('.has-bs-secondary-color-color', '.text-body-secondary,.has-bs-secondary-color-color', $style);
        $style = sp_replace_it('.has-bs-tertiary-bg-background-color', '.bg-body-tertiary,.has-bs-tertiary-bg-background-color', $style);
        $style = sp_replace_it('.has-bs-tertiary-color-color', '.text-body-tertiary,.has-bs-tertiary-color-color', $style);

        // Replace WP Navigation block with Bootstrap's nav classes
        $style = sp_replace_it('.wp-block-navigation{', '.nav, .nav-bar, .wp-block-navigation{', $style);

        // Define Bootstrap color, background, and border presets
        $color_keys = [
            'primary',
            'secondary',
            'success',
            'info',
            'warning',
            'danger',
            'light',
            'dark'
        ];

        // Iterate through each color preset and apply the relevant CSS transformations
        foreach ($color_keys as $key) {
            $style = sp_color_css("bs-{$key}", $style);
            $style = sp_background_css("bs-{$key}", $style);
            $style = sp_border_css("bs-{$key}", $style);

            // Apply subtle versions for color, background, and border
            $style = sp_color_css("bs-{$key}-bg-subtle", $style);
            $style = sp_background_css("bs-{$key}-bg-subtle", $style);
            $style = sp_border_css("bs-{$key}-bg-subtle", $style);
        }

        // Return the modified CSS
        return $style;
    }
}

if (!function_exists('sp_global_css')) {
    /**
     * Retrieves and returns global CSS for the active theme variation or the default theme.
     *
     * Combines Customizer custom CSS and theme global styles CSS (including theme.json
     * and active variations) into a single stylesheet. Returns an empty string if no
     * CSS is present, ensuring compatibility with wp_add_inline_style().
     *
     * @return string The compiled stylesheet CSS, empty if no styles are found.
     */
    function sp_global_css()
    {
        // Filter to conditionally load CSS for each block separately.
        add_filter('wp_theme_json_get_style_nodes', 'wp_filter_out_block_nodes');

        // Variable to hold the compiled CSS.
        $stylesheet = '';

        // Remove Customizer's inline CSS action to avoid duplication.
        remove_action('wp_head', 'wp_custom_css_cb', 101);

        // Retrieve Customizer's custom CSS.
        $custom_css = wp_get_custom_css();
        if (!empty($custom_css)) {
            $stylesheet .= $custom_css;
        }

        // Retrieve global styles custom CSS (including active theme variation).
        $global_styles_css = wp_get_global_stylesheet(array('custom-css'));
        if (!empty($global_styles_css)) {
            $stylesheet .= $global_styles_css;
        }

        // Always return a string, empty if no styles.
        return $stylesheet ?: '';
    }
}

if (!function_exists('sp_bootstrap_global_vars')) {
    /**
     * Get Bootstrap color vars by name as defined in theme json
     *
     * @return string $bs_vars Combined Bootstrap color variables
     */
    function sp_bootstrap_global_vars()
    {
        // Initialize the variable to collect all Bootstrap color variables
        $bs_vars = '';

        // Generate base and color variables from theme json
        $base_vars = [
            'base',
            'contrast',
            'bs-secondary-color',
            'bs-secondary-bg',
            'bs-tertiary-color',
            'bs-tertiary-bg',
            'bs-border-color'
        ];

        // Loop through each base variable and append to $bs_vars
        foreach ($base_vars as $var) {
            $bs_vars .= sp_generate_base_vars($var);
        }

        // Generate specific color variables
        $color_vars = [
            'bs-primary',
            'bs-secondary',
            'bs-success',
            'bs-info',
            'bs-warning',
            'bs-danger',
            'bs-light',
            'bs-dark',
            'bs-primary-bg-subtle',
            'bs-secondary-bg-subtle',
            'bs-success-bg-subtle',
            'bs-info-bg-subtle',
            'bs-warning-bg-subtle',
            'bs-danger-bg-subtle',
            'bs-light-bg-subtle',
            'bs-dark-bg-subtle'
        ];

        // Loop through each color variable and append to $bs_vars
        foreach ($color_vars as $var) {
            $bs_vars .= sp_generate_color_vars($var);
        }

        // If $bs_vars is populated, return it with filters applied
        if ($bs_vars !== '') {
            return apply_filters('sp_bootstrap_global_vars_output', $bs_vars);
        }

        // Return empty string if no variables were added
        return '';
    }
}

/* END Output Section */