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

# Header Container
if (!function_exists('structured_data_parts_block_filter')) {

	add_filter('render_block_core/template-part', 'structured_data_parts_block_filter', 10, 2);
	/**
	 * add structured data to template parts
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 *
	 */
	/*
	page = WebPage
	single = Blog
	archive = Blog
	index = Blog
	AboutPage
	CheckoutPage
	CollectionPage
	ContactPage
	FAQPage
	ItemPage
	MedicalWebPage
	ProfilePage
	QAPage
	RealEstateListing
	SearchResultsPage
			*/
	function structured_data_parts_block_filter($block_content, $block)
	{
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		$itemtype = '';
		$itemtypelabel = '';
		$block_output = '';

		/* determine page types */
		$itemtype = 'WebPage';

		if (str_contains($block['attrs']['className'], 'main-search')) {
			$itemtype = 'SearchResultsPage';
		}

		if (str_contains($block['attrs']['className'], 'main-index') || str_contains($block['attrs']['className'], 'main-single') || str_contains($block['attrs']['className'], 'main-archive')) {
			$itemtype = 'Blog';
		}

		if (isset($itemtype) && ('' !== $itemtype)) {
			$itemtypelabel = ' itemtype="https://schema.org/' . $itemtype . '"  itemscope ';
		}

		/* Header markup */
		if (str_contains($block['attrs']['className'], 'site-header')) {
			$block_output .= str_replace('class="site-header', 'id="masthead" aria-label="Site" itemtype="https://schema.org/WPHeader" itemscope role="banner" class="site-header', $block_content);
		}

		/* Main content of page markup */
		if (str_contains($block['attrs']['className'], 'site-main')) {
			$block_output .= str_replace('<main class="site-main', '<main' . $itemtypelabel . ' role="main" class="site-main', $block_content);
		}

		/* Secondary content of page markup */
		if (str_contains($block['attrs']['className'], 'secondary-content')) {

			$block_output .= str_replace('<aside', '<aside aria-label="secondary content area"', $block_content);
		}

		/* Tertiary content of page markup */
		if (str_contains($block['attrs']['className'], 'tertiary-content')) {
			$block_output .= str_replace('<aside', '<aside aria-label="tertiary content area"', $block_content);
		}

		/* Footer markup */
		if (str_contains($block['attrs']['className'], 'site-footer')) {
			$block_output .= str_replace('class="site-footer', 'id="colophon" aria-label="Site" itemtype="https://schema.org/WPFooter" itemscope role="contentinfo" class="site-footer', $block_content);
		}

		return $block_output;
	}
}

# Single Article Container - hentry
if (!function_exists('single_content_block_filter')) {

	add_filter('render_block_core/group', 'single_content_block_filter', 10, 2);
	/**
	 * single area wrapper block content filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function single_content_block_filter($block_content, $block)
	{

		/* exit if no class set */
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		/* Class is there, lets grab it */
		$class = $block['attrs']['className'];

		/* If no trigger class (hentry) exit */
		if (!str_contains($class, 'hentry')) {
			return $block_content;
		}

		$block_output = '';

		$block_output .= str_replace('<article class="wp-block-group', '<article itemtype="https://schema.org/CreativeWork" itemscope class="wp-block-group', $block_content);

		return $block_output;
	}
}

# Block Post Container - hentry
if (!function_exists('post_template_content_block_filter')) {

	add_filter('render_block_core/post-template', 'post_template_content_block_filter', 10, 2);
	/**
	 * page area wrapper block content filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function post_template_content_block_filter($block_content, $block)
	{

		$block_output = '';

		$block_output .= str_replace('class="wp-block-post ', 'itemtype="https://schema.org/CreativeWork" itemscope class="wp-block-post ', $block_content);

		return $block_output;
	}
}

# Block Post Excerpt
if (!function_exists('post_excerpt_content_block_filter')) {

	add_filter('render_block_core/post-excerpt', 'post_excerpt_content_block_filter', 10, 2);
	/**
	 * page area wrapper block content filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function post_excerpt_content_block_filter($block_content, $block)
	{

		/* exit if no class set */
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		/* Class is there, lets grab it */
		$class = $block['attrs']['className'];

		/* If no trigger class (sp-action-hook) exit */
		if (!str_contains($class, 'entry-summary')) {
			return $block_content;
		}

		$block_output = '';

		$block_output .= str_replace('class="entry-summary', 'itemprop="text" class="entry-summary ', $block_content);

		return $block_output;
	}
}

# Entry meta markup
if (!function_exists('entry_meta_content_block_filter')) {

	add_filter('render_block_core/group', 'entry_meta_content_block_filter', 10, 2);
	/**
	 * entry meta wrapper block content filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function entry_meta_content_block_filter($block_content, $block)
	{

		/* exit if no class set */
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		/* Class is there, lets grab it */
		$class = $block['attrs']['className'];

		/* If no trigger class (entry-meta) exit */
		if (!str_contains($class, 'entry-meta')) {
			return $block_content;
		}

		$block_output = '';

		$block_output .= str_replace('class="wp-block-group', 'aria-label="Entry meta" class="wp-block-group', $block_content);

		return $block_output;
	}
}

# Block Post Content
if (!function_exists('post_content_content_block_filter')) {

	add_filter('render_block_core/post-content', 'post_content_content_block_filter', 10, 2);
	/**
	 * page area wrapper block content filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function post_content_content_block_filter($block_content, $block)
	{

		/* exit if no class set */
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		/* Class is there, lets grab it */
		$class = $block['attrs']['className'];

		/* If no trigger class (sp-action-hook) exit */
		if (!str_contains($class, 'entry-content')) {
			return $block_content;
		}

		$block_output = '';

		$block_output .= str_replace('class="entry-content ', 'itemprop="text" class="entry-content ', $block_content);

		return $block_output;
	}
}

# Comments Content
if (!function_exists('comment_content_content_block_filter')) {

	add_filter('render_block_core/comment-template', 'comment_content_content_block_filter', 10, 2);
	/**
	 * page area wrapper block content filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function comment_content_content_block_filter($block_content, $block)
	{

		/* exit if no class set *
		if (!isset($block['attrs']['className'])) {
			return $block_content;
		}

		/* Class is there, lets grab it *
		$class = $block['attrs']['className'];

		/* If no trigger class (sp-action-hook) exit *
		if (!str_contains($class, 'entry-content')) {
			return $block_content;
		}
*/
		$block_output = '';
		$block_output = $block_content;

		$block_output = str_replace('class="wp-block-group', 'itemtype="https://schema.org/Comment" itemscope class="wp-block-group', $block_output);

		$block_output = str_replace('class="wp-block-group comment-meta', 'aria-label="Comment meta" class="wp-block-group comment-meta', $block_output);

		$block_output = str_replace('class="wp-block-comment-content', 'itemprop="text" class="wp-block-comment-content comment-content', $block_output);

		return $block_output;
	}
}

# Navigation
if (!function_exists('navigation_content_block_filter')) {

	add_filter('render_block_core/navigation', 'navigation_content_block_filter', 10, 2);
	/**
	 * page area wrapper block content filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function navigation_content_block_filter($block_content, $block)
	{

		$block_output = '';
		$block_output = $block_content;

		$block_output = str_replace('<nav', '<nav role="navigation"', $block_output);

		$block_output = str_replace('<ul class="wp-block-navigation__container', '<ul role="menu" itemtype="https://schema.org/SiteNavigationElement" itemscope class="wp-block-navigation__container', $block_output);

		$block_output = str_replace('<li', '<li itemprop="name" role="menuitem"', $block_output);

		$block_output = str_replace('<a', '<a itemprop="url"', $block_output);

		return $block_output;
	}
}

#Categories List
if (!function_exists('categories_content_block_filter')) {

	add_filter('render_block_core/categories', 'categories_content_block_filter', 10, 2);
	/**
	 * categories list filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function categories_content_block_filter($block_content, $block)
	{
		$block_output = '';
		$block_output = $block_content;

		$block_output = str_replace('<ul', '<ul role="menu" itemtype="https://schema.org/SiteNavigationElement" itemscope', $block_output);

		$block_output = str_replace('<li', '<li itemprop="name" role="menuitem"', $block_output);

		$block_output = str_replace('<a', '<a itemprop="url"', $block_output);

		return $block_output;
	}
}

#Archives List
if (!function_exists('archives_content_block_filter')) {

	add_filter('render_block_core/archives', 'archives_content_block_filter', 10, 2);
	/**
	 * archives list filter
	 * @param [type] $block_content
	 * @param [type] $block
	 * @return $block_output with modified $block_content
	 */

	function archives_content_block_filter($block_content, $block)
	{
		$block_output = '';
		$block_output = $block_content;

		$block_output = str_replace('<ul', '<ul role="menu" itemtype="https://schema.org/SiteNavigationElement" itemscope', $block_output);

		$block_output = str_replace('<li', '<li itemprop="name" role="menuitem"', $block_output);

		$block_output = str_replace('<a', '<a itemprop="url"', $block_output);

		return $block_output;
	}
}
