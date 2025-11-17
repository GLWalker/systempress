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

    //add_filter('render_block_core/social-links', 'sp_offcanvas', 10, 2);

    add_filter('render_block', 'sp_offcanvas', 10, 2);

    /**
     * Filter the blocks looking for offcanvas-menu class name, if exist load the css, scripts and svg's
     *
     * @param string $block_content
     * @param array $block
     *
     * @return string
     */
    function sp_offcanvas($block_content, $block)
    {
        $class_name = sp_get_class_name($block);
        if (!$class_name) {
            return $block_content;
        }

        // If no trigger class ( .offcanvas-menu ) exit
        if (!str_contains($class_name, 'off-canvas-trigger')) {
            return $block_content;
        }

        $block_content = str_replace(
            'class="wp-block-social-link-anchor"',
            'data-bs-toggle="offcanvas" data-bs-target="#offcanvasContent" aria-controls="offcanvasContent"
                role="button" class="wp-block-social-link-anchor"',
            $block_content
        );

        // Add offcanvas content to template
        add_action('sp_hook_end_template', 'sp_do_offcanvas_content', 15);

        add_action('wp_enqueue_scripts', 'sp_enqueue_block_parts_offcanvas');

        return $block_content;
    }
}

/**
 * Setup offcanvas_content part to include via hook.
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
 */
if (!function_exists('sp_enqueue_block_parts_offcanvas')) {

    function sp_enqueue_block_parts_offcanvas()
    {
        // Ensure scripts are only added once
        if (did_action('sp_enqueue_block_parts_offcanvas')) {
            return;
        }

        ob_start(); ?>
        <script>
            (() => {
                'use strict';

                const currentUrl = window.location.href;

                // Clean up class names and attributes for offcanvas elements
                document.querySelectorAll(".offcanvas").forEach((element) => {
                    element.setAttribute("tabindex", "-1");
                    element.setAttribute("aria-labelledby", "offcanvasContentLabel");
                });

                document.querySelectorAll(".offcanvas.static").forEach((element) => {
                    element.setAttribute("data-bs-backdrop", "static");
                });

            })();
        </script>
<?php
        $offcanvas_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());

        // Enqueue script inline
        $script_handle = 'sp-block-parts-offcanvas';
        wp_register_script($script_handle, false, [], false, true); // Load in footer
        wp_add_inline_script($script_handle, $offcanvas_script);
        wp_enqueue_script($script_handle);
    }
}
