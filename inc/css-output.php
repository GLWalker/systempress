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

if (!function_exists('sp_editor_styles')) {
    /**
     * Add styles to the block editor. Can be
     * exteded or filtered.
     * Check the example under sp_shared_styles
     *
     * @since 0.1
     *
     */
    function sp_editor_styles()
    {
        $css = new SystemPress_CSS();

        $css->set_selector('.editor-styles-wrapper');
        $css->add_property('margin', '0.15rem !important');

        $css->set_selector('.edit-post-visual-editor__post-title-wrapper');
        $css->add_property('margin-top', '0 !important');
        $css->add_property('padding', 'var(--wp--preset--spacing--10) var(--wp--preset--spacing--20)');
        $css->add_property('margin-bottom', '0');

        $css->set_selector('.is-root-container');
        $css->add_property('flex', '1 1 auto');
        $css->add_property('padding', 'var(--wp--preset--spacing--10) var(--wp--preset--spacing--20)');

        $css->set_selector('.block-editor-block-list__block.alert');
        $css->add_property('display', 'inline-flex !important');

        $css->set_selector(':where( .wp-block-button__link )');
        $css->add_property('padding', 'var(--bs-btn-padding-y) var(--bs-btn-padding-x) !important');

        $css->set_selector('.block-editor-block-list__block.btn-group .wp-element-button');
        $css->add_property('margin-right', '0 !important');

        $css->set_selector('.block-editor-block-list__block.card');
        $css->add_property('overflow', 'hidden !important');

        $css->set_selector('.wp-block-navigation.nav-pills .block-editor-rich-text__editable');
        $css->add_property(' display', 'block');
        $css->add_property('padding', 'var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x)');
        $css->add_property('font-weight', 'var(--bs-nav-link-font-weight)');
        $css->add_property('color', 'var(--bs-nav-link-color)');

        $css->set_selector('.wp-block-navigation.nav-pills .wp-block-navigation__container div:first-child a');
        $css->add_property('color', 'var(--bs-nav-pills-link-active-color)');
        $css->add_property('background-color', 'var(--bs-nav-pills-link-active-bg)');
        $css->add_property('border-radius', 'var(--bs-nav-pills-border-radius)');

        /* fixed position */
        $css->set_selector('.dark-mode.position-fixed');
        $css->add_property('bottom', '.5%');

        $css->set_selector('.dark-mode.position-fixed:not(.is-content-justification-center):not(.is-content-justification-right)');
        $css->add_property('left', '1%');

        $css->set_selector('.dark-mode.position-fixed.is-content-justification-center');
        $css->add_property('left', '47% !important');

        $css->set_selector('.dark-mode.position-fixed.is-content-justification-right');
        $css->add_property('right', '1%');

        $css->set_selector('.dark-mode.position-fixed p');
        $css->add_property('padding', 'calc(var(--wp--preset--spacing--10 / 2)) !important');

        do_action('sp_editor_styles', $css);

        if ($css->css_output()) {
            return apply_filters('sp_editor_styles_output', $css->css_output());
        }
    }
}

if (!function_exists('sp_shared_styles')) {
    /**
     * Use the shared styles function to add css
     * to the global-styles custom css output
     *
     * @since 0.1
     *
     * Below is example funtion to add css using SystemPress_CSS
     * // DO NOT USE new SystemPress_CSS() for adding action to sp_shared_styles hook//
     */
    /*
    function sp_extend_shared_styles($css)
    {
        $css->set_selector('body');
        $css->add_property('padding', '.1rem');

        $css->start_media_query(sp_get_media_query('sm'));
        $css->set_selector('body');
        $css->add_property('padding', '.25rem');
        $css->stop_media_query();

        return $css;
    }
    add_action( 'sp_shared_styles', 'sp_extend_shared_styles' );
    */
    function sp_shared_styles()
    {
        $css = new SystemPress_CSS();

        do_action('sp_shared_styles', $css);

        $css = $css->css_output();

        return apply_filters('sp_shared_styles_output', $css);
    }
}

if (!function_exists('sp_navigation_styles')) {
    /**
     * sp_navigation_styles
     *
     * Add some bootstrap markup to block navigation menus
     * @return void
     *
     */

    function sp_navigation_styles()
    {
        $css = new SystemPress_CSS();

        $css->set_selector('.wp-block-navigation .wp-block-navigation__responsive-container:not(.is-menu-open) .wp-block-navigation__submenu-container,
        .wp-block-navigation .wp-block-navigation__responsive-container:not(.is-menu-open) wp-block-navigation__submenu-container .has-child .wp-block-navigation-submenu__toggle[aria-expanded=true]~.wp-block-navigation__submenu-container');
        $css->add_property('position', 'absolute');
        $css->add_property('z-index', '1000');
        $css->add_property('min-width', '10rem');
        $css->add_property('padding', '0.5rem 0');
        $css->add_property('margin', '0');
        $css->add_property('font-size', 'var(--wp--preset--font-size--small)');

        $css->add_property('color', 'var(--bs-dropdown-color)');
        $css->add_property('background-color', 'var(--bs-dropdown-bg)!important');
        $css->add_property('border', 'var(--bs-border-width) solid var(--bs-dropdown-border-color)');

        $css->add_property('border-radius', 'var(--bs-border-radius)');
        $css->add_property('box-shadow', 'var(--bs-dropdown-box-shadow)');
        $css->add_property('background-image', 'var(--bs-dropdown-background-image)');

        $css->set_selector('.wp-block-navigation .wp-block-navigation__responsive-container:not(.is-menu-open) .wp-block-navigation__submenu-container > .wp-block-navigation-item > .wp-block-navigation-item');
        $css->add_property('display', 'block');
        $css->add_property('width', '100%');
        $css->add_property('padding', '0.25rem 1rem');
        $css->add_property('text-decoration', 'none');
        $css->add_property('border-radius', '0');

        $css->set_selector('.wp-block-navigation .wp-block-navigation__responsive-container:not(.is-menu-open) .wp-block-navigation__submenu-container > .wp-block-navigation-item:not(.open-on-click) > .wp-block-navigation-submenu__toggle');
        $css->add_property('display', 'none');

        $css->set_selector('.wp-block-navigation .wp-block-navigation__responsive-container:not(.is-menu-open) .wp-block-navigation__submenu-container > .wp-block-navigation-item.has-child > a::after');
        $css->add_property('display', 'inline-block');
        $css->add_property('margin-left', '1em');

        $css->add_property('content', '""');
        $css->add_property('width', '0');
        $css->add_property('height', '0');
        $css->add_property('border-top', '0.3em solid transparent');
        $css->add_property('border-right', '0');
        $css->add_property('border-bottom', '0.3em solid transparent');
        $css->add_property('border-left', '0.3em solid');

        $css->set_selector('.wp-block-navigation .wp-block-navigation__responsive-container:not(.is-menu-open) .wp-block-navigation__submenu-container:not( .has-text-color ) > .wp-block-navigation-item > .wp-block-navigation-item');
        $css->add_property('color', 'var(--bs-dropdown-link-color)');

        $css->set_selector('.wp-block-navigation .wp-block-navigation__responsive-container:not(.is-menu-open) .wp-block-navigation__submenu-container:not( .has-background ) > .wp-block-navigation-item > .wp-block-navigation-item');
        $css->add_property('background-color', ' transparent');

        $css->set_selector('.wp-block-navigation .wp-block-navigation__submenu-container .wp-block-navigation-item:hover,
            .wp-block-navigation .wp-block-navigation__submenu-container .wp-block-navigation-item:focus');
        $css->add_property('color', 'var(--bs-dropdown-link-hover-color ) !important');
        $css->add_property('background-color', 'var(--bs-dropdown-link-hover-bg) !important');
        $css->add_property('text-decoration', 'none');

        $css->set_selector('.wp-block-navigation .wp-block-navigation__submenu-container .wp-block-navigation-item__content.active,

            .wp-block-navigation .wp-block-navigation__submenu-container .wp-block-navigation-item__content:active,

            .wp-block-navigation .wp-block-navigation__submenu-container .wp-block-navigation-item__content[aria-current="page"]
            ');
        $css->add_property('color', 'var(--bs-dropdown-link-active-color) !important');
        $css->add_property('background-color', 'var(--bs-dropdown-link-active-bg) !important');

        /*
            .wp-block-navigation .wp-block-navigation__submenu-container .wp-block-navigation-item__content[aria-current="page"] + button
*/
        $css->start_media_query(sp_get_media_query('md'));
        $css->set_selector('.wp-block-navigation__responsive-container.is-menu-open .wp-block-navigation__responsive-container-content .has-child .wp-block-navigation__submenu-container');
        $css->add_property('min-width', '560px');
        $css->add_property('padding-left', '0');
        $css->add_property('padding-right', '0');
        $css->add_property('margin-left', '-1rem');
        $css->stop_media_query();

        return apply_filters('sp_navigation_styles_output', $css->css_output());
    }
}

if (!function_exists('sp_global_vars')) {
    /**
     * Add Bootstrap variables and replace text where need for global stylesheet
     * Outputs a new global-styles which is always updated with any changes made VIA admin editor or theme.json
     */
    function sp_global_vars()
    {
        $style = '';
        $style = wp_get_global_stylesheet(array('variables'));

        /** @var string $bs_vars */
        $bs_vars = sp_bootstrap_global_vars();

        $style = sp_replace_it('has-custom-bs', 'has-bs', $style);
        $style = sp_replace_it('--wp--preset--color--custom-bs',   '--wp--preset--color--bs', $style);

        /* switch body to root and enable light mode */
        $style = sp_replace_it('body{-', ':root,[data-bs-theme=light]{-', $style);

        /* inject BS Vars by placing a placeholder in the theme json custom attributtes */
        $style = sp_replace_it('--wp--custom--sp-replace-string: all;',  $bs_vars, $style);
        $style = sp_replace_it('--wp--custom--bs-', '--bs-', $style);

        /* Redefine wp preset font vars */
        $style = sp_replace_it('--wp--custom--wp-preset-font-family-', '--wp--preset--font-family--', $style);

        /* shadows */
        $style = sp_replace_it('--wp--preset--shadow--md',   '--bs-box-shadow', $style);
        $style = sp_replace_it('--wp--preset--shadow--sm',   '--bs-box-shadow-sm', $style);
        $style = sp_replace_it('--wp--preset--shadow--lg',   '--bs-box-shadow-lg', $style);
        $style = sp_replace_it('--wp--preset--shadow--inset',   '--bs-box-shadow-inset', $style);
        $style = sp_replace_it('--wp--preset--shadow--form-focus',   '--bs-box-shadow-form-focus', $style);
        $style = sp_replace_it('--wp--preset--shadow--button',   '--bs-box-shadow-button', $style);
        $style = sp_replace_it('--wp--preset--shadow--button-focus',   '--bs-box-shadow-button-focus', $style);
        $style = sp_replace_it('--wp--preset--shadow-button-active',   '--bs-box-shadow-button-active', $style);

        return $style;
    }
}

function sp_preset_styles_css()
{

    $style = wp_get_global_stylesheet(array('presets', 'styles'));

    /* remove css that we dont want */
    //$style = sp_remove_color_css(  'bs-secondary-bg', $style  );
    // $style = sp_remove_color_css(  'bs-tertiary-bg', $style  );

    // $style = sp_remove_color_css( 'bs-border-color', $style );
    $style = sp_remove_color_css('bs-highlight-bg', $style);

    //$style = sp_remove_background_css(  'bs-secondary-color', $style  );
    //$style = sp_remove_background_css(  'bs-tertiary-color', $style  );

    //$style = sp_remove_background_css('bs-heading-color', $style);
    // $style = sp_remove_background_css( 'bs-border-color', $style );
    $style = sp_remove_background_css('bs-code-color', $style);
    $style = sp_remove_background_css('bs-highlight-color', $style);
    $style = sp_remove_border_css('bs-secondary-bg', $style);
    $style = sp_remove_border_css('bs-secondary-color', $style);
    $style = sp_remove_border_css('bs-tertiary-bg', $style);
    $style = sp_remove_border_css('bs-tertiary-color', $style);
    // $style = sp_remove_border_css('bs-heading-color', $style);
    $style = sp_remove_border_css('bs-code-color', $style);
    $style = sp_remove_border_css('bs-highlight-color', $style);
    $style = sp_remove_border_css('bs-highlight-bg', $style);

    /* headings */
    $style = sp_replace_it('h1', '.h1,h1', $style);
    $style = sp_replace_it('h2', '.h2,h2', $style);
    $style = sp_replace_it('h3', '.h3,h3', $style);
    $style = sp_replace_it('h4', '.h4,h4', $style);
    $style = sp_replace_it('h5', '.h5,h5', $style);
    $style = sp_replace_it('h6', '.h6,h6', $style);

    /* font sizes */
    $style = sp_font_size_css('x-small', $style);
    $style = sp_font_size_css('small', $style);
    $style = sp_font_size_css('medium', $style);
    $style = sp_font_size_css('large', $style);
    $style = sp_font_size_css('x-large', $style);
    $style = sp_font_size_css('xx-large', $style);
    $style = sp_font_size_css('xxx-large', $style);
    $style = sp_font_size_css('huge', $style);
    $style = sp_font_size_css('display-6', $style);
    $style = sp_font_size_css('display-5', $style);
    $style = sp_font_size_css('display-4', $style);
    $style = sp_font_size_css('display-3', $style);
    $style = sp_font_size_css('display-2', $style);
    $style = sp_font_size_css('display-1', $style);

    //$style = sp_replace_it(  'font-size: var(--wp--preset--font-size--display-', 'font-weight: 300; line-height: 1.2; font-size: var(--wp--preset--font-size--display-', $style  );

    $style = sp_replace_it('.display-6,', '.display-1, .display-2, .display-3, .display-4, .display-5, .display-6, .has-display-1-font-size, .has-display-2-font-size, .has-display-3-font-size, .has-display-4-font-size, .has-display-5-font-size, .has-display-6-font-size {
        font-family: var(--wp--preset--font-family--display);
        font-weight: var(--bs-display-font-weight);
        line-height: 1.2;
        text-shadow: var(--bs-display-text-shadow);
    }    .display-6,', $style);

    /* base styles */
    $style = sp_replace_it('.has-base-background-color', '.bg-body,.has-base-background-color', $style);

    $style = sp_replace_it('.has-contrast-color', '.text-body,.has-contrast-color', $style);

    $style = sp_replace_it('.has-bs-secondary-bg-background-color', '.bg-body-secondary,.has-bs-secondary-bg-background-color', $style);
    $style = sp_replace_it('.has-bs-secondary-color-color', '.text-body-secondary,.has-bs-secondary-color-color', $style);

    $style = sp_replace_it('.has-bs-tertiary-bg-background-color', '.bg-body-tertiary,.has-bs-tertiary-bg-background-color', $style);
    $style = sp_replace_it('.has-bs-tertiary-color-color', '.text-body-tertiary,.has-bs-tertiary-color-color', $style);

    /* Navigation */
    $style = sp_replace_it('.wp-block-navigation{',   '.nav, .nav-bar, .wp-block-navigation{', $style);
    /* WP Colors */
    $style = sp_color_css('accent', $style);

    /* BS Colors */
    $style = sp_color_css('bs-primary', $style);
    $style = sp_color_css('bs-secondary', $style);
    $style = sp_color_css('bs-success', $style);
    $style = sp_color_css('bs-info', $style);
    $style = sp_color_css('bs-warning', $style);
    $style = sp_color_css('bs-danger', $style);
    $style = sp_color_css('bs-light', $style);
    $style = sp_color_css('bs-dark', $style);

    $style = sp_background_css('accent', $style);
    $style = sp_replace_it('var(--accent-text)', 'var(--wp--preset--color--accent-text)', $style);

    //  $style = sp_replace_it(  'var(--accent-text-shadow)', 'var(--wp--preset--color--accent-text-shadow)', $style  );

    $style = sp_background_css('bs-primary', $style);
    $style = sp_background_css('bs-secondary', $style);
    $style = sp_background_css('bs-success', $style);
    $style = sp_background_css('bs-info', $style);
    $style = sp_background_css('bs-warning', $style);
    $style = sp_background_css('bs-danger', $style);
    $style = sp_background_css('bs-light', $style);
    $style = sp_background_css('bs-dark', $style);

    $style = sp_border_css('accent', $style);
    $style = sp_replace_it('var(--accent-border-color)', 'var(--wp--preset--color--accent-border-color)', $style);

    $style = sp_border_css('bs-primary', $style);
    $style = sp_border_css('bs-secondary', $style);
    $style = sp_border_css('bs-success', $style);
    $style = sp_border_css('bs-info', $style);
    $style = sp_border_css('bs-warning', $style);
    $style = sp_border_css('bs-danger', $style);
    $style = sp_border_css('bs-light', $style);
    $style = sp_border_css('bs-dark', $style);

    $style = sp_color_css('bs-primary-bg-subtle', $style);
    $style = sp_color_css('bs-secondary-bg-subtle', $style);
    $style = sp_color_css('bs-success-bg-subtle', $style);
    $style = sp_color_css('bs-info-bg-subtle', $style);
    $style = sp_color_css('bs-warning-bg-subtle', $style);
    $style = sp_color_css('bs-danger-bg-subtle', $style);
    $style = sp_color_css('bs-light-bg-subtle', $style);
    $style = sp_color_css('bs-dark-bg-subtle', $style);

    $style = sp_background_css('bs-primary-bg-subtle', $style);
    $style = sp_background_css('bs-secondary-bg-subtle', $style);
    $style = sp_background_css('bs-success-bg-subtle', $style);
    $style = sp_background_css('bs-info-bg-subtle', $style);
    $style = sp_background_css('bs-warning-bg-subtle', $style);
    $style = sp_background_css('bs-danger-bg-subtle', $style);
    $style = sp_background_css('bs-light-bg-subtle', $style);
    $style = sp_background_css('bs-dark-bg-subtle', $style);

    $style = sp_border_css('bs-primary-bg-subtle', $style);
    $style = sp_border_css('bs-secondary-bg-subtle', $style);
    $style = sp_border_css('bs-success-bg-subtle', $style);
    $style = sp_border_css('bs-info-bg-subtle', $style);
    $style = sp_border_css('bs-warning-bg-subtle', $style);
    $style = sp_border_css('bs-danger-bg-subtle', $style);
    $style = sp_border_css('bs-light-bg-subtle', $style);
    $style = sp_border_css('bs-dark-bg-subtle', $style);

    return $style;
}

function sp_custom_css()
{

    $custom_css = '';
    $custom_css = sp_shared_styles();
    $custom_css .= wp_get_global_styles_custom_css();
    // $custom_css  .= wp_get_custom_css();
    $css = str_replace(array("\r", "\n", "\t"), ' ', $custom_css);

    return $css;
}

if (!function_exists('sp_bootstrap_global_vars')) {
    /**
     * Get Bootstrap color vars by name as defined in theme json
     *
     * @return $bs_vars
     */
    function sp_bootstrap_global_vars()
    {
        $bs_vars = '';
        $bs_vars .= sp_generate_base_vars('base');
        $bs_vars .= sp_generate_base_vars('contrast');
        $bs_vars .= sp_generate_base_vars('accent');
        $bs_vars .= sp_generate_base_vars('bs-secondary-color');
        //$bs_vars .= sp_generate_text_shadow_vars('bs-secondary-color');
        $bs_vars .= sp_generate_base_vars('bs-secondary-bg');
        $bs_vars .= sp_generate_base_vars('bs-tertiary-color');
        //$bs_vars .= sp_generate_text_shadow_vars('bs-tertiary-color');
        $bs_vars .= sp_generate_base_vars('bs-tertiary-bg');

        $bs_vars .= sp_generate_base_vars('bs-border-color');
        $bs_vars .= sp_generate_color_vars('accent');
        $bs_vars .= sp_generate_color_vars('bs-primary');
        $bs_vars .= sp_generate_color_vars('bs-secondary');
        $bs_vars .= sp_generate_color_vars('bs-success');
        $bs_vars .= sp_generate_color_vars('bs-info');
        $bs_vars .= sp_generate_color_vars('bs-warning');
        $bs_vars .= sp_generate_color_vars('bs-danger');
        $bs_vars .= sp_generate_color_vars('bs-light');
        $bs_vars .= sp_generate_color_vars('bs-dark');
        $bs_vars .= sp_generate_color_vars('bs-primary-bg-subtle');
        $bs_vars .= sp_generate_color_vars('bs-secondary-bg-subtle');
        $bs_vars .= sp_generate_color_vars('bs-success-bg-subtle');
        $bs_vars .= sp_generate_color_vars('bs-info-bg-subtle');
        $bs_vars .= sp_generate_color_vars('bs-warning-bg-subtle');
        $bs_vars .= sp_generate_color_vars('bs-danger-bg-subtle');
        $bs_vars .= sp_generate_color_vars('bs-light-bg-subtle');
        $bs_vars .= sp_generate_color_vars('bs-dark-bg-subtle');

        if ('' !== $bs_vars) {
            return apply_filters('sp_bootstrap_global_vars_output', $bs_vars);
        }
    }
}
