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
		'carousel',
		'class-css',
		'class-color-palette',
		'color-functions',
		'css-output',
		'dark-mode',
		'off-canvas',
		'search-modal',
		'social-icon-filters',
	);

	foreach ($files as $file) {
		require_once $theme_dir . "$file.php";
	}
}

add_action('sp_hook_example', 'sp_hook_exaple_content', 10);

function sp_hook_example_content()
{
	echo '<div class="card h-100 bg-primary">
			<div class="card-body">
				<h3 class="h5 card-title">Template Hooks</h3>
				<p class="card-text">SystemPress comes loaded with several action hooks strategically placed throughout the theme.</p>
				<p class="card-text">Use the block editor to add new hooks where you need by selecting the SP Action Hook block.<br><strong>In fact</strong>, this card was added with a hook</p>
			</div>
		</div>';
}
