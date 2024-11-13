<?php

/**
 * SystemPress Offcanvas Functions
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_offcanvas')) {

    add_filter('render_block_core/social-links', 'sp_offcanvas', 10, 2);

    /**
     * Filter the blocks looking for offcanvas-menu class name, if exist load the css, scripts and svg's
     *
     * @param [type] $block_content
     * @param [type] $block
     *
     * @return void
     */
    function sp_offcanvas($block_content, $block)
    {
        if (!isset($block['attrs']['className'])) {
            return $block_content;
        }

        $class = $block['attrs']['className'];

        /* If no trigger class ( .offcanvas-menu ) exit */
        if (!str_contains($class, 'off-canvas-trigger')) {
            return $block_content;
        }

        add_action('wp_enqueue_scripts', 'sp_enqueue_block_parts_offcanvas');

        add_action('sp_hook_end_template', 'sp_do_offcanvas_content', 15);

        return $block_content;
    }
}

/**
 * Setup offcanvas_content part to include VIA hook.
 *
 * @since 1.0.0
 * @param string $template The template we're targeting.
 */
function sp_do_offcanvas_content()
{

    block_template_part('part-offcanvas');
}
/**
 * Enqueues the offcanvas script & styles.
 *
 */
if (!function_exists('sp_enqueue_block_parts_offcanvas')) {

    function sp_enqueue_block_parts_offcanvas()
    {

        /**
         * Enqueue the offcanvas script.
         */
        ob_start(); ?>
        <script>
            (() => {
                'use strict'

                const currentUrl = window.location.href;

                    document.querySelectorAll(".wp-block-group.offcanvas").forEach((element) => {
                    element.classList.remove("wp-block-group-is-layout-flow"),
                        element.classList.remove("is-layout-flow"),
                        element.classList.remove("wp-block-group"),
                        element.setAttribute("tabindex", "-1"),
                        element.setAttribute("aria-labelledby", "offcanvasContentLabel")
                })

                document.querySelectorAll(".offcanvas.static").forEach((element) => {
                    element.setAttribute("data-bs-backdrop", "static")
                })

                document.querySelectorAll(".wp-block-group.offcanvas-header").forEach((element) => {
                    element.classList.remove("wp-block-group-is-layout-flow"),
                        element.classList.remove("is-layout-flow"),
                        element.classList.remove("wp-block-group")
                })

                document.querySelectorAll(".wp-block-group.offcanvas-body").forEach((element) => {
                    element.classList.remove("wp-block-group-is-layout-flow"),
                        element.classList.remove("is-layout-flow"),
                        element.classList.remove("wp-block-group")
                })

                document.querySelectorAll(".offcanvas p.btn-close").forEach((element) => {
                    element.setAttribute("data-bs-dismiss", "offcanvas"),
                        element.setAttribute("aria-label", "Close")
                })

            })()
        </script>

<?php
        $offcanvas_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());
        $script_handle = 'sp-block-parts-offcanvas';
        wp_register_script($script_handle, false, array(), false, array('in_footer' => true));
        wp_add_inline_script($script_handle, $offcanvas_script);
        wp_enqueue_script($script_handle);
    }
}
