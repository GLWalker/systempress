<?php

/**
 * SystemPress Carousel functions
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_primary_carousel')) {

    add_filter('render_block_core/group', 'sp_primary_carousel', 10, 2);

    /**
     * Filter the blocks looking for primary-carousel class name, if exist load the css, scripts and svg's
     *
     * @param [type] $block_content
     * @param [type] $block
     *
     * @return void
     */
    function sp_primary_carousel($block_content, $block)
    {
        if (!isset($block['attrs']['className'])) {
            return $block_content;
        }

        $class = $block['attrs']['className'];

        /* If no trigger class ( dark-mode ) exit */
        if (!str_contains($class, 'primary-carousel')) {
            return $block_content;
        }

        add_action('wp_enqueue_scripts', 'sp_enqueue_pattern_primary_carousel');

        return $block_content;
    }
}
/**
 * Enqueues the primary carousel script & styles.
 *
 */
function sp_enqueue_pattern_primary_carousel()
{

    $handle = 'sp-block-pattern-primary-carousel';

    /**
     * Enqueue the dark-mode script.
     */
    ob_start(); ?>
    <script>
        (() => {
            'use strict'

            let counter = 0
            document
                .querySelectorAll("#PrimaryCarousel p.slide-indicator")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#PrimaryCarousel"),
                        element.setAttribute("data-bs-slide-to", counter),
                        element.setAttribute("data-label", "Slide " + (counter + 1)),
                        ++counter
                })

            document
                .querySelectorAll("#PrimaryCarousel.carousel-control-prev")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#PrimaryCarousel"),
                        element.setAttribute("data-bs-slide", "prev")
                })

            document
                .querySelectorAll("#PrimaryCarousel .carousel-control-next")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#PrimaryCarousel"),
                        element.setAttribute("data-bs-slide", "next")
                })

        })()
    </script>

<?php
    $primary_carousel_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());
    wp_register_script($handle, false, array(), false, array('in_footer' => true));
    wp_add_inline_script($handle, $primary_carousel_script);
    wp_enqueue_script($handle);
}

if (!function_exists('sp_secondary_carousel')) {

    add_filter('render_block_core/group', 'sp_secondary_carousel', 10, 2);

    /**
     * Filter the blocks looking for secondary-carousel class name, if exist load the css, scripts and svg's
     *
     * @param [type] $block_content
     * @param [type] $block
     *
     * @return void
     */
    function sp_secondary_carousel($block_content, $block)
    {
        if (!isset($block['attrs']['className'])) {
            return $block_content;
        }

        $class = $block['attrs']['className'];

        /* If no trigger class ( dark-mode ) exit */
        if (!str_contains($class, 'secondary-carousel')) {
            return $block_content;
        }

        add_action('wp_enqueue_scripts', 'sp_enqueue_pattern_secondary_carousel');

        return $block_content;
    }
}
/**
 * Enqueues the secondary carousel script & styles.
 *
 */
function sp_enqueue_pattern_secondary_carousel()
{

    $handle = 'sp-block-pattern-secondary-carousel';

    /**
     * Enqueue the dark-mode script.
     */
    ob_start(); ?>
    <script>
        (() => {
            'use strict'

            let counter = 0
            document
                .querySelectorAll("#SecondaryCarousel p.slide-indicator")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#SecondaryCarousel"),
                        element.setAttribute("data-bs-slide-to", counter),
                        element.setAttribute("data-label", "Slide " + (counter + 1)),
                        ++counter
                })

            document
                .querySelectorAll("#SecondaryCarousel .carousel-control-prev")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#SecondaryCarousel"),
                        element.setAttribute("data-bs-slide", "prev")
                })

            document
                .querySelectorAll("#SecondaryCarousel .carousel-control-next")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#SecondaryCarousel"),
                        element.setAttribute("data-bs-slide", "next")
                })

        })()
    </script>

<?php
    $secondary_carousel_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());
    wp_register_script($handle, false, array(), false, array('in_footer' => true));
    wp_add_inline_script($handle, $secondary_carousel_script);
    wp_enqueue_script($handle);
}

if (!function_exists('sp_comments_carousel')) {

    add_filter('render_block_core/group', 'sp_comments_carousel', 10, 2);

    /**
     * Filter the blocks looking for dark-mode class name, if exist load the css, scripts and svg's
     *
     * @param [type] $block_content
     * @param [type] $block
     *
     * @return void
     */
    function sp_comments_carousel($block_content, $block)
    {
        if (!isset($block['attrs']['className'])) {
            return $block_content;
        }

        $class = $block['attrs']['className'];

        /* If no trigger class ( dark-mode ) exit */
        if (!str_contains($class, 'comments-carousel')) {
            return $block_content;
        }

        add_action('wp_enqueue_scripts', 'sp_enqueue_pattern_comments_carousel');

        return $block_content;
    }
}
/**
 * Enqueues the carousel script & styles.
 *
 */
function sp_enqueue_pattern_comments_carousel()
{

    $css = new SystemPress_CSS();

    $css->set_selector('.comments-carousel .carousel-inner');
    $css->add_property('margin', '0 auto');

    $css->set_selector('.comments-carousel .carousel-inner .carousel-item');
    $css->add_property('width', '90%');
    $css->add_property('margin-bottom', '0');
    // $css->add_property('padding-left', '10% !important');

    $css->set_selector('.comments-carousel .carousel-inner .carousel-item article');
    $css->add_property('height', '11rem !important');

    $css->set_selector('.comments-carousel .wp-block-latest-comments__comment-excerpt p');
    $css->add_property('margin-bottom', '0.5em');
    $css->add_property('font-size', 'var(--wp--preset--font-size--small)');

    $comments_carousel_styles = $css->css_output();

    $handle = 'sp-block-pattern-comments-carousel';

    /**
     * Print the styles.
     */
    wp_register_style($handle, false);
    wp_add_inline_style($handle, $comments_carousel_styles);
    wp_enqueue_style($handle);

    /**
     * Enqueue the dark-mode script.
     */
    ob_start(); ?>
    <script>
        (() => {
            'use strict'

            document
                .querySelectorAll("#CommentsCarousel .carousel-control-prev")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#CommentsCarousel"),
                        element.setAttribute("data-bs-slide", "prev")
                })

            document
                .querySelectorAll("#CommentsCarousel .carousel-control-next")
                .forEach((element) => {
                    element.setAttribute("data-bs-target", "#CommentsCarousel"),
                        element.setAttribute("data-bs-slide", "next")
                })

            document
                .querySelectorAll("#CommentsCarousel .carousel-inner li")
                .forEach((element) => {
                    element.classList.add("carousel-item")
                })
            document
                .querySelectorAll("#CommentsCarousel .carousel-inner li:first-child")
                .forEach((element) => {
                    element.classList.add("active")
                })
        })()
    </script>

<?php
    $comments_carousel_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());
    wp_register_script($handle, false, array(), false, array('in_footer' => true));
    wp_add_inline_script($handle, $comments_carousel_script);
    wp_enqueue_script($handle);
}

if (!function_exists('sp_editor_styles_comments_carousel')) {

    add_action('sp_editor_styles', 'sp_editor_styles_comments_carousel');

    function sp_editor_styles_comments_carousel($css)
    {

        $css->set_selector('.block-editor-block-list__block.comments-carousel .carousel');
        $css->add_property('margin', '0 auto');
        $css->add_property('padding', '0');

        $css->set_selector('.block-editor-block-list__block.comments-carousel .carousel .carousel-inner');
        $css->add_property('margin', '0');
        $css->add_property('padding', '0 !important');

        $css->set_selector('.block-editor-block-list__block.comments-carousel .carousel .carousel-inner .wp-block-latest-comments__comment');
        $css->add_property('margin', '0');
        $css->add_property('min-height', '10rem');
        $css->add_property('padding-left', '10% !important');
        $css->add_property('width', '82% !important');
        $css->add_property('display', 'none');

        $css->set_selector('.block-editor-block-list__block.comments-carousel .carousel .carousel-inner .wp-block-latest-comments__comment:first-child');
        $css->add_property('display', 'block');

        return $css;
    }
}
