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
/**
 * Comments Carousel Block Handler
 *
 * Enqueues the necessary scripts and styles for the comments carousel.
 */
if (!function_exists('sp_comments_carousel')) {

    add_filter('render_block_core/group', 'sp_comments_carousel', 10, 2);

    function sp_comments_carousel($block_content, $block)
    {
        $class_name = sp_get_class_name($block);
        if (!$class_name) {
            return $block_content;
        }

        // Only load for blocks containing the 'comments-carousel' class
        if (!str_contains($class_name, 'comments-carousel')) {
            return $block_content;
        }

        add_action('wp_enqueue_scripts', 'sp_enqueue_pattern_comments_carousel');

        return $block_content;
    }
}

/**
 * Enqueue the comments carousel styles and scripts.
 */
function sp_enqueue_pattern_comments_carousel()
{
    $css = new SystemPress_CSS();

    // Style adjustments for comments carousel
    $css->set_selector('.comments-carousel .carousel-inner');
    $css->add_property('margin', '0 auto');

    $css->set_selector('.comments-carousel .carousel-inner .carousel-item');
    $css->add_property('width', '90%');
    $css->add_property('margin-bottom', '0');

    $css->set_selector('.comments-carousel .carousel-inner .carousel-item article');
    $css->add_property('height', '11rem !important');

    $css->set_selector('.comments-carousel .wp-block-latest-comments__comment-excerpt p');
    $css->add_property('margin-bottom', '0.5em');
    $css->add_property('font-size', 'var(--wp--preset--font-size--small)');

    $comments_carousel_styles = $css->css_output();

    // Enqueue styles
    $handle = 'sp-block-pattern-comments-carousel';
    wp_register_style($handle, false);
    wp_add_inline_style($handle, $comments_carousel_styles);
    wp_enqueue_style($handle);

    ob_start();
?>
    <script>
        (() => {
            'use strict';

            // Ensure Comments Carousel exists
            const carousel = document.querySelector("#CommentsCarousel .carousel-inner");
            if (!carousel) return;

            // Mark items as carousel items
            carousel.querySelectorAll("li").forEach((item, index) => {
                item.classList.add("carousel-item");
                if (index === 0) item.classList.add("active");
            });
        })();
    </script>
<?php

    $comments_carousel_script = wp_remove_surrounding_empty_script_tags(ob_get_clean());

    wp_register_script($handle, false, array(), false, array('in_footer' => true));
    wp_add_inline_script($handle, $comments_carousel_script);
    wp_enqueue_script($handle);
}

/**
 * Editor Styles for Comments Carousel
 *
 * Applies styles to the block editor for comments carousel blocks.
 */
if (!function_exists('sp_editor_styles_comments_carousel')) {

    add_action('sp_editor_styles', 'sp_editor_styles_comments_carousel');

    function sp_editor_styles_comments_carousel($css)
    {
        // General carousel styling in the block editor
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

        // Make the first comment visible
        $css->set_selector('.block-editor-block-list__block.comments-carousel .carousel .carousel-inner .wp-block-latest-comments__comment:first-child');
        $css->add_property('display', 'block');

        return $css;
    }
}
