<?php

/**
 * SystemPress Functions File
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Load SystemPress files.
 */
add_action('after_setup_theme', 'sp_load_files', 0);

function sp_load_files()
{
	//	require_once get_template_directory() . '/blocks/button-mods/button-mods.php';

	$theme_dir = get_template_directory() . '/inc/';

	$files = array(
		'theme-functions',
		'enqueue-assets',
		'block-filters',
		'block-styles',
		'bootstrap-styles',
		'class-css',
		'class-color-palette',
		'color-functions',
		'css-output',
		'dark-mode',
	);

	foreach ($files as $file) {
		require_once $theme_dir . "$file.php";
	}
}
