<?php

/**
 * SystemPress Block Filters
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 *
 */
// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('sp_block_category')) {
	add_filter('block_categories_all', 'sp_block_category', 10, 2);

	function sp_block_category($categories, $post)
	{

		$category = array(
			'slug'  => 'bootstrap-blocks',
			'title' => 'BootStrapped Blocks',
		);

		if (is_array($categories)) {
			$existingSlugs = array_column($categories, 'slug');

			if (is_array($existingSlugs)) {
				if (in_array($category['slug'],   $existingSlugs)) {
					return $categories; // Bail early if    category exists
				}
			}
		}

		array_unshift($categories, $category); // Add category on top of pile

		return $categories;
	}
}

if (!function_exists('sp_inner_html_style_loader')) {
	add_action('init', 'sp_inner_html_style_loader');
	/**
	 * Check for classnames inside the HTML core block
	 *
	 * @return void
	 */
	function sp_inner_html_style_loader()
	{
		$post_id = sp_id();
		if (!$post_id) {
			return;
		}
		$post = get_post($post_id);
		$blocks = parse_blocks($post->post_content);
		$content = '';
		foreach ($blocks as $block) {

			if ('core/html' === $block['blockName']) {
				$content =  $block['innerHTML'];
				sp_bs_stylesheets($content);
			}
		}

		return;
	}
}

if (!function_exists('sp_block_style_loader')) {
	/* check block content for BS classes */
	add_filter('render_block', function ($block_content, $block) {

		$content = $block_content;
		sp_bs_stylesheets($content);

		return $block_content;
	}, 10, 999);
}

/* start older addons */

if (!function_exists('sp_action_hook')) {

	add_filter('render_block_core/separator', 'sp_action_hook', null, 2);
	/**
	 * sp_action_hook
	 *
	 * Method to add hooks using core/separator block
	 * seperator block must have a trigger class name of sp-action-hook
	 * followed by the desired hook name.
	 * If hyphonating use underscores not dashes
	 * Example class="sp-action-hook entry_content_hook"
	 *
	 * Works in conjunction with sp_do_block_action() function.
	 *
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_content
	 */

	function sp_action_hook($block_content, $block)
	{
		/* exit if no class set */
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		/* Class is there, lets grab it */
		$class = $block['attrs']['className'];

		/* If no trigger class (sp-action-hook) exit */
		if (!str_contains($class, 'sp-action-hook')) {
			return $block_content;
		}

		/* we have our trigger class, so get the hook name, [1] */
		$action = explode('sp-action-hook ', $class)[1];

		/* one more check, don't have to have it, but as long as the process is not to intensive lets roll with it */
		if (isset($action) && 'sp-action-hook ' . $action === $block['attrs']['className']) {

			$block_content = sp_do_block_action($action);
		}

		return $block_content;
	}
}

if (!function_exists('sp_render_block_core_post_date')) {

	remove_action('init', 'register_block_core_post_date');

	add_action('init', 'sp_register_block_core_post_date');
	/**
	 * ReRenders the `core/post-date` block on the server with addditional markup.
	 * First the core block is removed
	 *
	 * @param array    $attributes Block attributes.
	 * @param string   $content    Block default content.
	 * @param WP_Block $block      Block instance.
	 * @return string Returns the filtered post date for the current post wrapped inside "time" tags.
	 */

	function sp_render_block_core_post_date($attributes, $content, $block)
	{

		if (!isset($block->context['postId'])) {
			return '';
		}

		$post_ID = $block->context['postId'];

		$classes = array();
		$classes[] = 'posted-on';

		if (isset($attributes['textAlign'])) {
			$classes[] = 'has-text-align-' . $attributes['textAlign'];
		}
		if (isset($attributes['style']['elements']['link']['color']['text'])) {
			$classes[] = 'has-link-color';
		}

		$formatted_date   = get_the_date(empty($attributes['format']) ? '' : $attributes['format'], $post_ID);
		$unformatted_date = esc_attr(get_the_date('c', $post_ID));

		$timeclass = 'entry-date published';
		$itemprop = 'datePublished';
		/*
	 * If the "Display last modified date" setting is enabled,
	 * only display the modified date if it is later than the publishing date.
     * Removed return line so entries with only publish date will display as well
	 */
		if (isset($attributes['displayType']) && 'modified' === $attributes['displayType']) {

			if (get_the_modified_date('Ymdhi', $post_ID) > get_the_date('Ymdhi', $post_ID)) {

				$timeclass = 'updated';
				$itemprop = 'dateModified';
				$formatted_date   = get_the_modified_date(empty($attributes['format']) ? '' : $attributes['format'], $post_ID);
				$unformatted_date = esc_attr(get_the_modified_date('c', $post_ID));
				$classes[] = 'wp-block-post-date__modified-date';
			}
		}

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		if (isset($attributes['isLink']) && $attributes['isLink']) {
			$formatted_date = sprintf('<a href="%1s">%2s</a>', get_the_permalink($post_ID), $formatted_date);
		}

		return sprintf(
			'<div %1$s><time class="%2$s" datetime="%3$s" itemprop="%4$s">%5$s</time></div>',
			$wrapper_attributes,
			$timeclass,
			$unformatted_date,
			$itemprop,
			$formatted_date
		);
	}

	/**
	 * Registers the `core/post-date` block on the server.
	 */
	function sp_register_block_core_post_date()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/post-date',
			array(
				'render_callback' => 'sp_render_block_core_post_date',
			)
		);
	}
}

if (!function_exists('sp_render_block_core_post_title')) {

	remove_action('init', 'register_block_core_post_title');
	add_action('init', 'sp_register_block_core_post_title');
	/**
	 * ReRenders the core/post-title block on the server with addditional markup.
	 * First the core block is removed
	 *
	 * @since 6.3.0 Omitting the $post argument from the `get_the_title`.
	 *
	 * @param array    $attributes Block attributes.
	 * @param string   $content    Block default content.
	 * @param WP_Block $block      Block instance.
	 *
	 * @return string Returns the filtered post title for the current post wrapped inside "h1" tags.
	 */
	function sp_render_block_core_post_title($attributes, $content, $block)
	{
		if (!isset($block->context['postId'])) {
			return '';
		}

		/**
		 * The `$post` argument is intentionally omitted so that changes are reflected when previewing a post.
		 * See: https://github.com/WordPress/gutenberg/pull/37622#issuecomment-1000932816.
		 */
		$title = sp_do_block_action('sp_hook_start_title') .  get_the_title() . sp_do_block_action('sp_hook_end_title');

		if (!$title) {
			return '';
		}
		$classes = array();

		$tag_name = 'h2';
		if (isset($attributes['level'])) {
			$tag_name = 'h' . $attributes['level'];
		}

		//$classes[] = 'entry-title';

		if (isset($attributes['isLink']) && $attributes['isLink']) {
			$alt   = !empty($attributes['rel']) ? 'alt="' . esc_attr($attributes['rel']) . '"' : 'home link';
			$rel   = !empty($attributes['rel']) ? 'rel="' . esc_attr($attributes['rel']) . '"' : '';
			$title = sprintf('<a href="%1$s", "%2$s" target="%3$s" %4$s>%5$s</a>', get_the_permalink($block->context['postId']), esc_attr($attributes['linkTarget']), $alt, $rel, $title);
		}

		if (isset($attributes['textAlign'])) {
			$classes[] = 'has-text-align-' . $attributes['textAlign'];
		}
		if (isset($attributes['style']['elements']['link']['color']['text'])) {
			$classes[] = 'has-link-color';
		}
		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		return sprintf(
			'<%1$s %2$s itemprop="headline">%3$s</%1$s>',
			$tag_name,
			$wrapper_attributes,
			$title
		);
	}

	/**
	 * Registers the `core/post-title` block on the server.
	 */
	function sp_register_block_core_post_title()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/post-title',
			array(
				'render_callback' => 'sp_render_block_core_post_title',
			)
		);
	}
}
if (!function_exists('sp_render_block_core_post_author_name')) {

	remove_action('init', 'register_block_core_post_author_name');
	add_action('init', 'sp_register_block_core_post_author_name');

	/**
	 * ReRenders the core/post-author-name block on the server with addditional markup.
	 * First the core block is removed
	 *
	 * @param  array    $attributes Block attributes.
	 * @param  string   $content    Block default content.
	 * @param  WP_Block $block      Block instance.
	 * @return string Returns the rendered post author name block.
	 */

	function sp_render_block_core_post_author_name($attributes, $content, $block)
	{
		if (!isset($block->context['postId'])) {
			return '';
		}

		$author_id = get_post_field('post_author', $block->context['postId']);
		if (empty($author_id)) {
			return '';
		}

		$author_name = get_the_author_meta('display_name', $author_id);

		if (isset($attributes['isLink']) && $attributes['isLink']) {

			$author_name = sprintf('<a href="%1$s" target="%2$s" class="wp-block-post-author-name__link url fn n" title="View all posts by ' . $author_name . ' " rel="author" itemprop="url">%3$s</a>', get_author_posts_url($author_id), esc_attr($attributes['linkTarget']), '<span class="author-name" itemprop="name">' . $author_name . '</span>');
		} else {
			$author_name = '<span class="author-name" itemprop="name">' . get_the_author_meta('display_name', $author_id) . '</span>';
		}

		$classes = array();
		$classes[] = 'author vcard';
		if (isset($attributes['textAlign'])) {
			$classes[] = 'has-text-align-' . $attributes['textAlign'];
		}
		if (isset($attributes['style']['elements']['link']['color']['text'])) {
			$classes[] = 'has-link-color';
		}

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		return sprintf('<div %1$s itemprop="author" itemtype="https://schema.org/Person" itemscope="">%2$s</div>', $wrapper_attributes, $author_name);
	}

	/**
	 * Registers the `core/post-author-name` block on the server.
	 */
	function sp_register_block_core_post_author_name()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/post-author-name',
			array(
				'render_callback' => 'sp_render_block_core_post_author_name',
			)
		);
	}
}

if (!function_exists('sp_render_block_core_comment_author_name')) {

	remove_action('init', 'register_block_core_comment_author_name');
	add_action('init', 'sp_register_block_core_comment_author_name');

	/**
	 * ReRenders the core/omment-author-name block on the server with addditional markup.
	 * First the core block is removed
	 *
	 * @param array    $attributes Block attributes.
	 * @param string   $content    Block default content.
	 * @param WP_Block $block      Block instance.
	 * @return string Return the post comment's author.
	 */
	function sp_render_block_core_comment_author_name($attributes, $content, $block)
	{
		if (!isset($block->context['commentId'])) {
			return '';
		}

		$comment            = get_comment($block->context['commentId']);
		$commenter          = wp_get_current_commenter();
		$show_pending_links = isset($commenter['comment_author']) && $commenter['comment_author'];
		if (empty($comment)) {
			return '';
		}

		$classes = array();
		$classes[] = 'comment-author vcard';

		if (isset($attributes['textAlign'])) {
			$classes[] = 'has-text-align-' . $attributes['textAlign'];
		}
		if (isset($attributes['style']['elements']['link']['color']['text'])) {
			$classes[] = 'has-link-color';
		}

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));
		$comment_author     = get_comment_author($comment);
		$link               = get_comment_author_url($comment);

		if (!empty($link) && !empty($attributes['isLink']) && !empty($attributes['linkTarget'])) {
			$comment_author = sprintf('<a rel="external nofollow ugc" href="%1s" target="%2s" >%3s</a>', esc_url($link), esc_attr($attributes['linkTarget']), $comment_author);
		}
		if ('0' === $comment->comment_approved && !$show_pending_links) {
			$comment_author = wp_kses($comment_author, array());
		}

		return sprintf(
			'<div %1$s itemprop="author" itemtype="https://schema.org/Person" itemscope><cite itemprop="name" class="fn">%2$s</cite></div>',
			$wrapper_attributes,
			$comment_author
		);
	}

	/**
	 * Registers the `core/comment-author-name` block on the server.
	 */
	function sp_register_block_core_comment_author_name()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/comment-author-name',
			array(
				'render_callback' => 'sp_render_block_core_comment_author_name',
			)
		);
	}
}

if (!function_exists('sp_render_block_core_comment_date')) {

	remove_action('init', 'register_block_core_comment_date');

	add_action('init', 'sp_register_block_core_comment_date');
	/**
	 * ReRenders the `core/post-date` block on the server with addditional markup.
	 * First the core block is removed

/**
	 * Renders the `core/comment-date` block on the server.
	 *
	 * @param array    $attributes Block attributes.
	 * @param string   $content    Block default content.
	 * @param WP_Block $block      Block instance.
	 * @return string Return the post comment's date.
	 */
	function sp_render_block_core_comment_date($attributes, $content, $block)
	{
		if (!isset($block->context['commentId'])) {
			return '';
		}

		$comment = get_comment($block->context['commentId']);
		if (empty($comment)) {
			return '';
		}

		$classes = array();
		$classes[] = 'entry-meta';
		$classes[] = 'comment-metadata';

		if (isset($attributes['style']['elements']['link']['color']['text'])) {
			$classes[] = 'has-link-color';
		}

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		$formatted_date     = get_comment_date(
			isset($attributes['format']) ? $attributes['format'] : '',
			$comment
		);
		$link               = get_comment_link($comment);

		if (!empty($attributes['isLink'])) {
			$formatted_date = sprintf('<a href="%1s">%2s</a>', esc_url($link), $formatted_date);
		}

		return sprintf(
			'<div %1$s><time datetime="%2$s" itemprop="datePublished">%3$s</time></div>',
			$wrapper_attributes,
			esc_attr(get_comment_date('c', $comment)),
			$formatted_date
		);
	}

	/**
	 * Registers the `core/comment-date` block on the server.
	 */
	function sp_register_block_core_comment_date()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/comment-date',
			array(
				'render_callback' => 'sp_render_block_core_comment_date',
			)
		);
	}
}

if (!function_exists('bs_card_content_block_filter')) {

	//add_filter('render_block_core/group', 'bs_card_content_block_filter', 10, 2);
	/**
	 * block content filter to check if card class exist and load styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function bs_card_content_block_filter($block_content, $block)
	{
		/* exit if no class set */
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		/* Class is there, lets grab it */
		$class = $block['attrs']['className'];

		/* If no trigger class (sp-action-hook) exit */
		if (!str_contains($class, 'card')) {
			return $block_content;
		}

		if (str_contains($class, 'card')) {
			add_action('enqueue_block_assets', 'sp_add_style_bs_card');
		}

		return $block_content;
	}
}

if (!function_exists('sp_columns_block_filter')) {

	add_filter('render_block_core/columns', 'sp_columns_block_filter', 10, 2);
	/**
	 * block content filter to load our own styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function sp_columns_block_filter($block_content, $block)
	{
		wp_enqueue_style('columns');

		return $block_content;
	}
}

if (!function_exists('sp_gallery_block_filter')) {

	add_filter('render_block_core/gallery', 'sp_gallery_block_filter', 10, 2);
	/**
	 * block content filter to load our own styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function sp_gallery_block_filter($block_content, $block)
	{
		wp_enqueue_style('gallery');

		return $block_content;
	}
}

if (!function_exists('sp_latest_post_block_filter')) {

	add_filter('render_block_core/latest-post', 'sp_latest_post_block_filter', 10, 2);
	/**
	 * block content filter to load our own styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function sp_latest_post_block_filter($block_content, $block)
	{
		wp_enqueue_style('latest-post');

		return $block_content;
	}
}

if (!function_exists('sp_media_text_block_filter')) {

	add_filter('render_block_core/media-text', 'sp_media_text_block_filter', 10, 2);
	/**
	 * block content filter to load our own styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function sp_media_text_block_filter($block_content, $block)
	{
		wp_enqueue_style('media-text');

		return $block_content;
	}
}

if (!function_exists('sp_navigation_block_filter')) {

	add_filter('render_block_core/navigation', 'sp_navigation_block_filter', 10, 2);
	/**
	 * block content filter to load our own styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function sp_navigation_block_filter($block_content, $block)
	{
		wp_enqueue_style('navigation');

		return $block_content;
	}
}

if (!function_exists('sp_post_template_block_filter')) {

	add_filter('render_block_core/post-template', 'sp_post_template_block_filter', 10, 2);
	/**
	 * block content filter to load our own styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function sp_post_template_block_filter($block_content, $block)
	{
		wp_enqueue_style('post-template');

		return $block_content;
	}
}

if (!function_exists('sp_rss_block_filter')) {

	add_filter('render_block_core/rss', 'sp_rss_block_filter', 10, 2);
	/**
	 * block content filter to load our own styles
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function sp_rss_block_filter($block_content, $block)
	{
		wp_enqueue_style('rss');

		return $block_content;
	}
}
