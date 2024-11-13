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
		$action = array();
		$action = explode('sp-action-hook ', $class)[1];

		/* one more check, don't have to have it, but as long as the process is not to intensive lets roll with it */
		if (isset($action) && 'sp-action-hook ' . $action === $block['attrs']['className']) {

			$block_content = sp_do_block_action($action);
		}

		return $block_content;
	}
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
		return array_reduce($needles, fn($a, $n) => $a || str_contains($haystack, $n), false);
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

if (!function_exists('sp_do_comments_template')) {

	//add_action
	add_action('sp_hook_end_single', 'sp_do_comments_template', 15);

	add_action('sp_hook_end_page', 'sp_do_comments_template', 15);

	/**
	 * Add the comments template to block based pages.
	 *
	 * @since 1.0.0
	 * @param string $template The template we're targeting.
	 */
	function sp_do_comments_template()
	{

		if (is_singular()) {
			// If comments are open or we have at least one comment, load up the comment template part
			if (comments_open() || '0' != get_comments_number()) :

				block_template_part('part-comments');

			endif;
		}
	}
}

if (!function_exists('sp_custom_logo_callback')) {

	/* custom logo */
	add_filter('get_custom_logo', 'sp_custom_logo_callback');

	function sp_custom_logo_callback($html)
	{

		if (!has_custom_logo()) {
			$aria_current = is_front_page() && !is_paged() ? ' aria-current="page"' : '';

			$src =  esc_url(get_template_directory_uri()) . '/assets/images/systempress-favicon.png';

			$image = '<img src=" ' . $src . ' " class="custom-logo-placeholder" alt="SystemPress" />';

			$html = sprintf(
				'<a href="%1$s" class="custom-logo-link" rel="home"%2$s>%3$s</a>',
				esc_url(home_url('/')),
				$aria_current,
				$image
			);
		}

		return $html;
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

		$published_data = '';
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

				$published_data = '<time class="entry-date published visually-hidden" datetime="' . esc_attr(get_the_date('c', $post_ID)) . '" itemprop="datePublished">' . get_the_date(empty($attributes['format']) ? '' : $attributes['format'], $post_ID) . '</time>';
			}
		}

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		if (isset($attributes['isLink']) && $attributes['isLink']) {
			$formatted_date = sprintf('<a href="%1s">%2s</a>', get_the_permalink($post_ID), $formatted_date);
		}

		return sprintf(
			'<div %1$s><time class="%2$s" datetime="%3$s" itemprop="%4$s">%5$s</time>%6$s</div>',
			$wrapper_attributes,
			$timeclass,
			$unformatted_date,
			$itemprop,
			$formatted_date,
			$published_data
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

		$tag_name = 'h2';
		if (isset($attributes['level'])) {
			$tag_name = 0 === $attributes['level'] ? 'p' : 'h' . (int) $attributes['level'];
		}

		if (isset($attributes['isLink']) && $attributes['isLink']) {

			$rel   = !empty($attributes['rel']) ? 'rel="' . esc_attr($attributes['rel']) . '"' : 'rel="bookmark"';

			$title = sprintf('<a href="%1$s" target="%2$s" %3$s>%4$s</a>', esc_url(get_the_permalink($block->context['postId'])), esc_attr($attributes['linkTarget']), $rel, $title);
		}

		$classes = array();
		$classes[] = 'entry-title';

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
	 * ReRenders the `core/comment-date` block on the server with addditional markup.
	 * First the core block is removed
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
			'<div %1$s><time class="entry-date published" datetime="%2$s" itemprop="datePublished">%3$s</time></div>',
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

if (!function_exists('sp_render_block_core_site_title')) {

	remove_action('init', 'register_block_core_site_title');

	add_action('init', 'sp_register_block_core_site_title');

	/**
	 * ReRenders the `core/site-title` block on the server with addditional markup.
	 * First the core block is removed
	 *
	 * @param array $attributes The block attributes.
	 *
	 * @return string The render.
	 */

	function sp_render_block_core_site_title($attributes)
	{
		$site_title = get_bloginfo('name');
		if (!$site_title) {
			return;
		}

		$classes = array();
		$classes[] = 'site-title';

		$tag_name = 'h1';
		$classes[]  = empty($attributes['textAlign']) ? '' : "has-text-align-{$attributes['textAlign']}";
		if (isset($attributes['style']['elements']['link']['color']['text'])) {
			$classes[] .= ' has-link-color';
		}

		if (isset($attributes['level'])) {
			$tag_name = 0 === $attributes['level'] ? 'p' : 'h' . (int) $attributes['level'];
		}

		if ($attributes['isLink']) {
			$aria_current = is_home() || (is_front_page() && 'page' === get_option('show_on_front')) ? ' aria-current="page"' : '';
			$link_target  = !empty($attributes['linkTarget']) ? $attributes['linkTarget'] : '_self';

			$site_title = sprintf(
				'<a href="%1$s" target="%2$s" rel="home" itemprop="url" %3$s title="%4$s">%4$s</a>',
				esc_url(home_url()),
				esc_attr($link_target),
				$aria_current,
				esc_html($site_title)
			);
		}
		//	$wrapper_attributes = get_block_wrapper_attributes(array('class' => trim($classes)));

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		return sprintf(
			'<%1$s %2$s itemprop="headline">%3$s</%1$s>',
			$tag_name,
			$wrapper_attributes,
			// already pre-escaped if it is a link.
			$attributes['isLink'] ? $site_title : esc_html($site_title)
		);
	}
	/**
	 * Registers the `core/site-title` block on the server.
	 */
	function sp_register_block_core_site_title()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/site-title',
			array(
				'render_callback' => 'sp_render_block_core_site_title',
			)
		);
	}
}

if (!function_exists('sp_render_block_core_site_tagline')) {

	remove_action('init', 'register_block_core_site_tagline');

	add_action('init', 'sp_register_block_core_site_tagline');

	/**
	 * ReRenders the `core/site-tagline` block on the server with addditional markup.
	 * First the core block is removed
	 *
	 * @param array $attributes The block attributes.
	 *
	 * @return string The render.
	 */

	function sp_render_block_core_site_tagline($attributes)
	{
		$site_tagline = get_bloginfo('description');
		if (!$site_tagline) {
			return;
		}

		$classes = array();
		$classes[] = 'site-description';

		$tag_name           = 'p';
		$classes[]   = empty($attributes['textAlign']) ? '' : "has-text-align-{$attributes['textAlign']}";
		//$wrapper_attributes = get_block_wrapper_attributes(array('class' => $align_class_name));

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		if (isset($attributes['level']) && 0 !== $attributes['level']) {
			$tag_name = 'h' . (int) $attributes['level'];
		}

		return sprintf(
			'<%1$s %2$s itemprop="description">%3$s</%1$s>',
			$tag_name,
			$wrapper_attributes,
			$site_tagline
		);
	}
	/**
	 * Registers the `core/site-tagline` block on the server.
	 */
	function sp_register_block_core_site_tagline()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/site-tagline',
			array(
				'render_callback' => 'sp_render_block_core_site_tagline',
			)
		);
	}
}

if (!function_exists('sp_render_block_core_latest_posts')) {

	remove_action('init', 'register_block_core_latest_posts');

	add_action('init', 'sp_register_block_core_latest_posts');

	/**
	 * ReRenders the `core/latest-posts` block on the server with addditional markup.
	 * First the core block is removed
	 *
	 * @param array $attributes The block attributes.
	 *
	 * @return string The render.
	 */

	function sp_render_block_core_latest_posts($attributes)
	{
		global $post, $block_core_latest_posts_excerpt_length;

		$args = array(
			'posts_per_page'      => $attributes['postsToShow'],
			'post_status'         => 'publish',
			'order'               => $attributes['order'],
			'orderby'             => $attributes['orderBy'],
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		$block_core_latest_posts_excerpt_length = $attributes['excerptLength'];
		add_filter('excerpt_length', 'block_core_latest_posts_get_excerpt_length', 20);

		if (!empty($attributes['categories'])) {
			$args['category__in'] = array_column($attributes['categories'], 'id');
		}
		if (isset($attributes['selectedAuthor'])) {
			$args['author'] = $attributes['selectedAuthor'];
		}

		$query        = new WP_Query();
		$recent_posts = $query->query($args);

		if (isset($attributes['displayFeaturedImage']) && $attributes['displayFeaturedImage']) {
			update_post_thumbnail_cache($query);
		}

		$list_items_markup = '';

		foreach ($recent_posts as $post) {
			$post_link = esc_url(get_permalink($post));
			$title     = get_the_title($post);

			if (!$title) {
				$title = __('(no title)');
			}

			$list_items_markup .= '<li role="menuitem">';

			if ($attributes['displayFeaturedImage'] && has_post_thumbnail($post)) {
				$image_style = '';
				if (isset($attributes['featuredImageSizeWidth'])) {
					$image_style .= sprintf('max-width:%spx;', $attributes['featuredImageSizeWidth']);
				}
				if (isset($attributes['featuredImageSizeHeight'])) {
					$image_style .= sprintf('max-height:%spx;', $attributes['featuredImageSizeHeight']);
				}

				$image_classes = 'wp-block-latest-posts__featured-image';
				if (isset($attributes['featuredImageAlign'])) {
					$image_classes .= ' align' . $attributes['featuredImageAlign'];
				}

				$featured_image = get_the_post_thumbnail(
					$post,
					$attributes['featuredImageSizeSlug'],
					array(
						'itemprop' => 'image',
						'style' => esc_attr($image_style),
					)
				);

				if ($attributes['addLinkToFeaturedImage']) {
					$featured_image = sprintf(
						'<a href="%1$s" aria-label="%2$s">%3$s</a>',
						esc_url($post_link),
						esc_attr($title),
						$featured_image
					);
				}
				$list_items_markup .= sprintf(
					'<figure class="%1$s">%2$s</figure>',
					esc_attr($image_classes),
					$featured_image
				);
			}

			$list_items_markup .= sprintf(
				'<a itemprop="url" class="wp-block-latest-posts__post-title" href="%1$s"><span class="title" itemprop="headline name">%2$s</span></a>',
				esc_url($post_link),
				$title
			);

			if (isset($attributes['displayAuthor']) && $attributes['displayAuthor']) {
				$author_display_name = get_the_author_meta('display_name', $post->post_author);

				/* translators: byline. %s: current author. */
				$byline = sprintf(__('by <span class="author-name" itemprop="name"> %s</span>'), $author_display_name);

				if (!empty($author_display_name)) {
					$list_items_markup .= sprintf(
						'<div class="wp-block-latest-posts__post-author author vcard" itemprop="author" itemtype="https://schema.org/Person" itemscope>%1$s</div>',
						$byline
					);
				}
			}

			if (isset($attributes['displayPostDate']) && $attributes['displayPostDate']) {
				$list_items_markup .= sprintf(
					'<time itemprop="datePublished" datetime="%1$s" class="wp-block-latest-posts__post-date">%2$s</time>',
					esc_attr(get_the_date('c', $post)),
					get_the_date('', $post)
				);
			}

			if (
				isset($attributes['displayPostContent']) && $attributes['displayPostContent']
				&& isset($attributes['displayPostContentRadio']) && 'excerpt' === $attributes['displayPostContentRadio']
			) {

				$trimmed_excerpt = get_the_excerpt($post);

				/*
			 * Adds a "Read more" link with screen reader text.
			 * [&hellip;] is the default excerpt ending from wp_trim_excerpt() in Core.
			 */
				if (str_ends_with($trimmed_excerpt, ' [&hellip;]')) {
					/** This filter is documented in wp-includes/formatting.php */
					$excerpt_length = (int) apply_filters('excerpt_length', $block_core_latest_posts_excerpt_length);
					if ($excerpt_length <= $block_core_latest_posts_excerpt_length) {
						$trimmed_excerpt  = substr($trimmed_excerpt, 0, -11);
						$trimmed_excerpt .= sprintf(
							/* translators: 1: A URL to a post, 2: Hidden accessibility text: Post title */
							__('… <a class="wp-block-latest-posts__read-more" href="%1$s" rel="noopener noreferrer">Read more<span class="screen-reader-text">: %2$s</span></a>'),
							esc_url($post_link),
							esc_html($title)
						);
					}
				}

				if (post_password_required($post)) {
					$trimmed_excerpt = __('This content is password protected.');
				}

				$list_items_markup .= sprintf(
					'<div class="wp-block-latest-posts__post-excerpt" itemprop="text">%1$s</div>',
					$trimmed_excerpt
				);
			}

			if (
				isset($attributes['displayPostContent']) && $attributes['displayPostContent']
				&& isset($attributes['displayPostContentRadio']) && 'full_post' === $attributes['displayPostContentRadio']
			) {

				$post_content = html_entity_decode($post->post_content, ENT_QUOTES, get_option('blog_charset'));

				if (post_password_required($post)) {
					$post_content = __('This content is password protected.');
				}

				$list_items_markup .= sprintf(
					'<div class="wp-block-latest-posts__post-full-content">%1$s</div>',
					wp_kses_post($post_content)
				);
			}

			$list_items_markup .= "</li>\n";
		}

		remove_filter('excerpt_length', 'block_core_latest_posts_get_excerpt_length', 20);

		$classes = array('wp-block-latest-posts__list');
		if (isset($attributes['postLayout']) && 'grid' === $attributes['postLayout']) {
			$classes[] = 'is-grid';
		}
		if (isset($attributes['columns']) && 'grid' === $attributes['postLayout']) {
			$classes[] = 'columns-' . $attributes['columns'];
		}
		if (isset($attributes['displayPostDate']) && $attributes['displayPostDate']) {
			$classes[] = 'has-dates';
		}
		if (isset($attributes['displayAuthor']) && $attributes['displayAuthor']) {
			$classes[] = 'has-author';
		}
		if (isset($attributes['style']['elements']['link']['color']['text'])) {
			$classes[] = 'has-link-color';
		}

		$wrapper_attributes = get_block_wrapper_attributes(array('class' => implode(' ', $classes)));

		return sprintf(
			'<ul role="menu" itemtype="https://schema.org/SiteNavigationElement" itemscope %1$s>%2$s</ul>',
			$wrapper_attributes,
			$list_items_markup
		);
	}

	/**
	 * Registers the `core/latest-posts` block on the server.
	 */
	function sp_register_block_core_latest_posts()
	{
		register_block_type_from_metadata(
			ABSPATH . WPINC . '/blocks/latest-posts',
			array(
				'render_callback' => 'sp_render_block_core_latest_posts',
			)
		);
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
			'carousel',
			array(
				'label'       => _x('Carousels', 'Block pattern category', 'systempress'),
				'description' => __('A collection of carousel items.', 'systempress'),
			)
		);
	}
}

if (!function_exists('sp_block_category')) {
	/**
	 * Register block variation categories
	 *
	 * @since 1.0
	 * @return void
	 */
	add_filter('block_categories_all', 'sp_block_category', 10, 2);

	function sp_block_category($categories, $post)
	{

		$category = array(
			'slug'  => 'systempress-blocks',
			'title' => 'SystemPress Blocks',
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
