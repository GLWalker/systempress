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
     * @param [type] $block_content
     * @param [type] $block
     *
     * @return void
     */
    function sp_search_modal($block_content, $block)
    {
        if (!isset($block['attrs']['className'])) {
            return $block_content;
        }

        $class = $block['attrs']['className'];

        /* If no trigger class ( search-modal ) exit */
        if (!str_contains($class, 'search-modal-trigger')) {
            return $block_content;
        }

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
