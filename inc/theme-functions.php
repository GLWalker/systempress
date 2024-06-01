<?php

/**
 * SystemPress The Functions
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_id')) {
    /**
     * In case block doesnt render Id
     * Attempt to grab actual post Id.
     * Fallback post Id from url.
     *
     * @return post_id
     */
    function sp_id()
    {
        global $post;
        global $wp_query;

        $post_id = get_the_ID();

        if (!$post_id) {
            $sp_id = str_replace(array('/', '.php', '?pg='), '', $_SERVER['REQUEST_URI']);
            $post_id = url_to_postid($sp_id);
        }

        return $post_id;
    }
}

/**
 * do_action inside block vars
 *
 * @param [type] $hook
 * @return void
 */
function sp_do_block_action($hook = '')
{
    ob_start();
    do_action($hook);
    $block_action = ob_get_contents();
    ob_end_clean();

    return $block_action;
}

if (!function_exists('str_contains')) {
    // Polyfill for PHP 4 - PHP 7, safe to utilize with PHP 8
    function str_contains(string $haystack, string $needle)
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('str_contains_any')) {
    //Helper function for reading arrays with str_contains
    function str_contains_any($haystack, array $needles)
    {
        return array_reduce($needles, fn ($a, $n) => $a || str_contains($haystack, $n), false);
    }
}
if (!function_exists('sp_replace_it')) {
    /**
     * Check if string exist and sanitize replacement
     *
     * @param [type] $value
     * @param [type] $newval
     * @param [type] $string
     *
     * @return void
     */
    function sp_replace_it($value, $newval, $string)
    {
        if (!$value || '' === $value) {
            return;
        }

        $find = $value;
        $replace = $newval;

        $css = ($find) ?  sanitize_text_field(str_replace($find, $replace, $string)) : '';

        return $css;
    }
}

if (!function_exists('sp_pattern_categories')) {
    /**
     * Register pattern categories
     *
     * @since 1.0
     * @return void
     */
    add_action('init', 'sp_pattern_categories');

    function sp_pattern_categories()
    {

        register_block_pattern_category(
            'page',
            array(
                'label'       => _x('Pages', 'Block pattern category', 'systempress'),
                'description' => __('A collection of full page layouts.', 'systempress'),
            )
        );
    }
}
