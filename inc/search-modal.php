<?php

/**
 * SystemPress Search Modal
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_search_modal')) {

    add_filter('render_block_core/social-links', 'sp_search_modal', 10, 2);

    /**
     * Filter the blocks looking for search-modal class name, if exist load the css, scripts and svg's
     *
     * @param string $block_content The block content being filtered.
     * @param array  $block The block data array.
     *
     * @return string Filtered block content.
     */
    function sp_search_modal($block_content, $block)
    {
        $class_name = sp_get_class_name($block);
        if (!$class_name) {
            return $block_content;
        }

        // Check for 'search-modal-trigger' class.
        if (!str_contains($class_name, 'search-modal-trigger')) {
            return $block_content;
        }

        add_action('wp_enqueue_scripts', 'sp_enqueue_block_parts_search_modal');

        add_action('sp_hook_end_template', 'sp_do_search_modal_content', 25);

        return $block_content;
    }

    /**
     * Setup search modal part to include VIA hook.
     *
     * @since 1.0.0
     * @param string $template The template we're targeting.
     */
    function sp_do_search_modal_content()
    {
        block_template_part('part-search-modal');
    }
}

/**
 * Enqueues the search_modal script & styles.
 */
if (!function_exists('sp_enqueue_block_parts_search_modal')) {

    function sp_enqueue_block_parts_search_modal()
    {
        // Ensure scripts are only added once
        if (did_action('sp_enqueue_block_parts_search_modal')) {
            return;
        }

        ob_start(); ?>
        <script>
            (() => {
                'use strict';

                // Add 'form-control' class to all elements with the 'wp-block-search__input' class
                document.querySelectorAll('.wp-block-search__input').forEach((element) => {
                    element.classList.add('form-control');
                });
            })();
        </script>
<?php
        $search_modal_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());

        // Enqueue script inline
        $script_handle = 'sp-block-parts-search-modal';
        wp_register_script($script_handle, false, [], false, true); // Load in footer
        wp_add_inline_script($script_handle, $search_modal_script);
        wp_enqueue_script($script_handle);
    }
}
