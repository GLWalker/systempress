<?php

/**
 * SystemPress Dark Mode
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_dark_mode')) {

    add_filter('render_block_core/group', 'sp_dark_mode', 10, 2);

    /**
     * Filter the blocks looking for dark-mode class name, if exist load the css, scripts and svg's
     *
     * @param [type] $block_content
     * @param [type] $block
     *
     * @return void
     */
    function sp_dark_mode($block_content, $block)
    {
        if (!isset($block['attrs']['className'])) {
            return $block_content;
        }

        $class = $block['attrs']['className'];

        /* If no trigger class ( dark-mode ) exit */
        if (!str_contains($class, 'dark-mode')) {
            return $block_content;
        }

        add_action('wp_enqueue_scripts', 'sp_enqueue_block_parts_dark_mode');

        add_action('wp_body_open', 'sp_dark_mode_svg');

        return $block_content;
    }
}
if (!function_exists('sp_dark_mode_content')) {

    add_action('sp_hook_dark_mode', 'sp_dark_mode_content', 15);

    function sp_dark_mode_content()
    {
        echo '

    <a href="#" class="has-text-color has-current-color lead" id="darkmode" type="button" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (light)">
        <svg class="theme-icon-active">
            <use href="#sun-fill"></use>
        </svg>
        <span class="visually-hidden" id="darkmode-text"> Toggle theme</span>
    </a>
    <ul class="dropdown-menu wp-block-list" aria-labelledby="darkmode-text" data-bs-popper="static">
        <li class="mode-light">
            <button type="button" class="dropdown-item d-flex align-items-center active burger burger--negative" data-bs-theme-value="light" aria-pressed="true">
                <svg class="opacity-50">
                    <use href="#sun-fill"></use>
                </svg>
                Light
            </button>
        </li>
        <li class="mode-dark">
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                <svg class="opacity-50">
                    <use href="#moon-stars-fill"></use>
                </svg> Dark
            </button>
        </li>
        <li class="mode-auto">
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                <svg class="opacity-50">
                    <use href="#circle-half"></use>
                </svg> Auto
            </button>
        </li>
    </ul>';
    }
}
/**
 * Enqueues the dark-mode script & styles.
 *
 */
if (!function_exists('sp_enqueue_block_parts_dark_mode')) {

    function sp_enqueue_block_parts_dark_mode()
    {

        $css = new SystemPress_CSS();

        /*$css->set_selector('.dark-mode');
        $css->add_property('border-radius', '9999px');
        $css->add_property('display', 'block');
        $css->add_property('height', 'auto');
        $css->add_property('transition', 'transform .1s ease');
        $css->add_property('vertical-align', 'middle'); */

        /*
@media (prefers-reduced-motion:reduce){
  .wp-block-social-link{
    transition-delay:0s;
    transition-duration:0s;
  }
}
  */

        $css->set_selector('.dark-mode a');
        $css->add_property('align-items', 'center');
        $css->add_property('display', 'flex');
        $css->add_property('color', 'currentColor');
        $css->add_property('fill', 'currentColor');
        $css->add_property('margin-bottom', '0.33rem');

        $css->set_selector('.dark-mode a:hover');
        $css->add_property('transform', 'scale(1.1)');

        $css->set_selector('.dark-mode svg');
        $css->add_property('height', '24px');
        $css->add_property('width', '24px');

        $css->add_property('align-items', 'center');
        $css->add_property('box-sizing', 'border-box');
        $css->add_property('display', 'inline-flex');

        $css->set_selector('.dark-mode .dropdown-menu svg');
        $css->add_property('margin-right', 'var(--wp--preset--spacing--20) !important');
        $css->add_property('margin-bottom', '-0.33rem');

        $css->set_selector('.dark-mode .dropdown-menu');
        $css->add_property('padding', 'var(--wp--preset--spacing--20)');
        $css->add_property('box-shadow', 'var(--bs-box-shadow)');

        $css->set_selector('.dark-mode .dropdown-menu .dropdown-item');
        $css->add_property('border-radius', 'var(--bs-border-radius-sm)');

        $css->set_selector('.dark-mode .dropdown-menu li:not(:last-child)');
        $css->add_property('margin-bottom', 'var(--wp--preset--spacing--10)');

        $css->set_selector('.dark-mode .dropdown-menu .dropdown-item:hover');
        $css->add_property('background-color', 'rgba(var(--bs-emphasis-color-rgb), 0.25)');

        $css->set_selector('.dark-mode.btn');
        $css->add_property('margin-top', '-.5rem !important');
        $css->add_property('padding', '.33rem');

        $css->set_selector('.dark-mode.btn .theme-icon-active');
        $css->add_property('margin-top', '.25rem !important');
        $css->add_property('margin-left', '.33rem !important');

        /* fixed position */
        $css->set_selector('.dark-mode.position-fixed');
        $css->add_property('bottom', '1%');
        $css->set_selector('.dark-mode.position-fixed:not(.is-content-justification-center):not(.is-content-justification-right)');
        $css->add_property('left', '0.5%');

        $css->set_selector('.dark-mode.position-fixed.is-content-justification-center');
        $css->add_property('left', '47% !important');

        $css->set_selector('.dark-mode.position-fixed.is-content-justification-right');
        $css->add_property('right', '0.5%');

        $css->set_selector('.dark-mode.position-fixed .theme-icon-active');
        $css->add_property('margin-top', '.25rem  !important');
        $css->add_property('margin-left', '.25rem !important');

        $dark_mode_styles = $css->css_output();

        $handle = 'sp-block-parts-dark-mode';

        /**
         * Print the styles.
         */
        wp_register_style($handle, false);
        wp_add_inline_style($handle, $dark_mode_styles);
        wp_enqueue_style($handle);

        /**
         * Enqueue the dark-mode script.
         */
        ob_start(); ?>
        <script>
            (() => {
                'use strict'

                const getStoredTheme = () => localStorage.getItem('theme')
                const setStoredTheme = theme => localStorage.setItem('theme', theme)

                const getPreferredTheme = () => {
                    const storedTheme = getStoredTheme()
                    if (storedTheme) {
                        return storedTheme
                    }

                    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
                }

                const setTheme = theme => {
                    if (theme === 'auto') {
                        document.body.setAttribute('data-bs-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'))
                    } else {
                        document.body.setAttribute('data-bs-theme', theme)
                    }
                }

                setTheme(getPreferredTheme())

                const showActiveTheme = (theme, focus = false) => {
                    const themeSwitcher = document.querySelector('#darkmode')

                    if (!themeSwitcher) {
                        return
                    }

                    const themeSwitcherText = document.querySelector('#darkmode-text')
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                        element.setAttribute('aria-pressed', 'false')
                    })

                    btnToActive.classList.add('active')
                    btnToActive.setAttribute('aria-pressed', 'true')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                    const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
                    themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

                    if (focus) {
                        themeSwitcher.focus()
                    }
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    const storedTheme = getStoredTheme()
                    if (storedTheme !== 'light' && storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                window.addEventListener('DOMContentLoaded', () => {
                    showActiveTheme(getPreferredTheme())

                    document.querySelectorAll('[data-bs-theme-value]')
                        .forEach(toggle => {
                            toggle.addEventListener('click', () => {
                                const theme = toggle.getAttribute('data-bs-theme-value')
                                setStoredTheme(theme)
                                setTheme(theme)
                                showActiveTheme(theme, true)
                            })
                        })
                })
            })()
        </script>

<?php
        $dark_mode_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());
        $script_handle = 'sp-block-parts-dark-mode';
        wp_register_script($script_handle, false, array(), false, array('in_footer' => true));
        wp_add_inline_script($script_handle, $dark_mode_script);
        wp_enqueue_script($script_handle);
    }
}

/* SVG Output */
if (!function_exists('sp_dark_mode_svg')) {

    /**
     * Hook into wp_head to output svg icon markup
     *
     */
    function sp_dark_mode_svg()
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="circle-half" width="24" height="24" viewBox="0 0 24 24">
    <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
  </symbol>
  <symbol id="moon-stars-fill" width="24" height="24" viewBox="0 0 24 24">
    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
  </symbol>
  <symbol id="sun-fill" width="24" height="24" viewBox="0 0 24 24">
    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
  </symbol>
</svg>' . PHP_EOL;

        echo $svg;
    }
}

if (!function_exists('sp_editor_styles_dark_mode')) {

    add_action('sp_editor_styles', 'sp_editor_styles_dark_mode');

    function sp_editor_styles_dark_mode($css)
    {

        $css->set_selector('.block-editor-block-list__block.sp-action-hook.sp_hook_dark_mode');
        $css->add_property('display', 'none');

        $css->set_selector('.dark-mode');
        $css->add_property('align-items', 'center');
        $css->add_property('box-sizing', 'border-box');
        $css->add_property('display', 'inline-flex');
        $css->add_property('height', 'auto');

        $css->set_selector('.dark-mode:before');
        $css->add_property('content', '"\263C" !important');
        $css->add_property('font-size', '24px');
        $css->add_property('width', '24px');

        $css->set_selector('.dark-mode.btn');
        $css->add_property('margin-top', '-.3rem !important');
        $css->add_property('padding', '.25em .75rem !important');

        /* fixed position */
        $css->set_selector('.dark-mode.position-fixed');
        $css->add_property('bottom', '.5%');

        $css->set_selector('.dark-mode.position-fixed:not(.is-content-justification-center):not(.is-content-justification-right)');
        $css->add_property('left', '1%');

        $css->set_selector('.dark-mode.position-fixed.is-content-justification-center');
        $css->add_property('left', '47% !important');

        $css->set_selector('.dark-mode.position-fixed.is-content-justification-right');
        $css->add_property('right', '1%');

        return $css;
    }
}
