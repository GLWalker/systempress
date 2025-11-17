<?php

/**
 * SystemPress Block Filters
 * @package SystemPress
 * @author G.L. Walker
 * @since 0.0.1
 */

/* custom logo */
function get_custom_logo_callback($html)
{

	if (!has_custom_logo()) {
		$aria_current = is_front_page() && !is_paged() ? ' aria-current="page"' : '';

		//	$image = '<img class="%1$s" src="' . get_stylesheet_directory_uri() . '/assets/images/systempress-favicon.png" />';

		$image = '<img width="100" height="100" src="' . get_stylesheet_directory_uri() . '/assets/images/systempress-favicon.png" class="custom-logo placeholder-logo" alt="systempress logo" decoding="async" fetchpriority="high" srcset="' . get_stylesheet_directory_uri() . '/assets/images/systempress-favicon.png">';

		//$image =  sprintf('<span class="%1$s fs-1" /></span>', 'bi-arrow-up-right-circle-fill');

		$html = sprintf(
			'<a href="%1$s" class="custom-logo-link" rel="home" aria-label="%2$s Home"%3$s>%4$s</a>',
			esc_url(home_url('/')),
			esc_attr(get_bloginfo('name')),
			$aria_current,
			$image
		);
	}

	return $html;
}
add_filter('get_custom_logo', 'get_custom_logo_callback');

/**
 * Filter: Adds structured data to core/template-part blocks.
 */
add_filter('render_block_core/template-part', 'structured_data_parts_block_filter', 10, 2);

function structured_data_parts_block_filter(string $block_content, array $block): string
{
	$class_name = sp_get_class_name($block);
	if (!$class_name) {
		return $block_content;
	}

	$itemtype = match (true) {
		str_contains($class_name, 'main-search') => 'SearchResultsPage',
		str_contains($class_name, 'main-index') ||
			str_contains($class_name, 'main-single') ||
			str_contains($class_name, 'main-archive') => 'Blog',
		default => 'WebPage'
	};

	$itemtype_label = ' itemtype="https://schema.org/' . esc_html($itemtype) . '" itemscope ';

	if (str_contains($class_name, 'site-header')) {
		return sp_replace_block_content(
			$block_content,
			'<header',
			'<header id="masthead" aria-label="Site header" itemtype="https://schema.org/WPHeader" itemscope role="banner"'
		);
	}

	if (str_contains($class_name, 'site-main')) {
		$page_title = esc_attr(wp_get_document_title());
		return sp_replace_block_content(
			$block_content,
			'<main',
			'<main' . $itemtype_label . 'role="main" aria-label="Main content: ' . $page_title . '"'
		);
	}

	if (str_contains($class_name, 'site-footer')) {
		return sp_replace_block_content(
			$block_content,
			'<footer',
			'<footer id="colophon" aria-label="Site footer" itemtype="https://schema.org/Organization" itemscope role="contentinfo"'
		);
	}

	if (str_contains($class_name, 'secondary-content')) {
		return sp_replace_block_content(
			$block_content,
			'<aside',
			'<aside role="complementary" aria-label="Sidebar"'
		);
	}

	if (str_contains($class_name, 'tertiary-content')) {
		return sp_replace_block_content(
			$block_content,
			'<aside',
			'<aside role="complementary" aria-label="Sidebar"'
		);
	}

	return $block_content;
}

/**
 * Filter: Adds schema.org markup to single articles.
 */
add_filter('render_block_core/group', 'single_content_block_filter', 10, 2);
function single_content_block_filter(string $block_content, array $block): string
{
	$class_name = sp_get_class_name($block);

	if (str_contains($class_name, 'hentry')) {
		return sp_replace_block_content(
			$block_content,
			'class',
			'itemtype="https://schema.org/CreativeWork" itemscope class'
		);
	}

	return $block_content;
}

/**
 * Filter: Adds structured data to core/post-template blocks.
 */
//add_filter('render_block_core/post-template', 'post_template_content_block_filter', 10, 2);
function post_template_content_block_filter(string $block_content, array $block): string
{
	// Use preg_replace_callback to process each <article> individually
	$block_content = preg_replace_callback(
		'/<article\b([^>]*)>/i',
		function ($matches) {
			// Reconstruct the <article> tag with the additional attributes
			$updated_tag = '<article itemtype="https://schema.org/CreativeWork" itemscope' . $matches[1] . '>';
			return $updated_tag;
		},
		$block_content
	);

	return $block_content;
}
/**
 * Filter: Adds itemprop to post excerpt blocks.
 */
add_filter('render_block_core/post-excerpt', 'post_excerpt_content_block_filter', 10, 2);
function post_excerpt_content_block_filter(string $block_content, array $block): string
{
	$class_name = sp_get_class_name($block);

	if (str_contains($class_name, 'entry-summary')) {
		return sp_replace_block_content(
			$block_content,
			'class',
			'itemprop="text" class'
		);
	}

	return $block_content;
}
/**
 * Filter: Adds aria-label to entry meta blocks.
 */
add_filter('render_block_core/group', 'entry_meta_content_block_filter', 10, 2);
function entry_meta_content_block_filter(string $block_content, array $block): string
{
	$class_name = sp_get_class_name($block);

	if (str_contains($class_name, 'entry-meta')) {
		return sp_replace_block_content(
			$block_content,
			'class',
			'aria-label="Entry meta" class'
		);
	}

	return $block_content;
}

/**
 * Filter: Adds aria-label to post navigation block.
 */
add_filter('render_block_core/group', 'post_nav_content_block_filter', 10, 2);
function post_nav_content_block_filter(string $block_content, array $block): string
{
	$class_name = sp_get_class_name($block);

	if (str_contains($class_name, 'post-navigation')) {
		return sp_replace_block_content(
			$block_content,
			'class',
			'aria-label="Posts" class'
		);
	}

	return $block_content;
}

/**
 * Filter: Adds itemprop to post content blocks.
 */

add_filter('render_block_core/post-content', 'post_content_content_block_filter', 10, 2);

function post_content_content_block_filter(string $block_content, array $block): string
{
	$class_name = sp_get_class_name($block);

	if (str_contains($class_name, 'entry-content')) {
		return sp_replace_block_content(
			$block_content,
			'class',
			'itemprop="text" class'
		);
	}

	return $block_content;
}

/**
 * Filter: Adds schema.org markup to navigation blocks.
 */
add_filter('render_block_core/navigation', 'navigation_content_block_filter', 10, 2);
function navigation_content_block_filter(string $block_content, array $block): string
{
	return str_replace(
		['<nav', '<ul class="wp-block-navigation__container', '<li', '<a'],
		[
			'<nav role="navigation"',
			'<ul role="list" itemtype="https://schema.org/SiteNavigationElement" itemscope class="wp-block-navigation__container',
			'<li itemprop="name" role="listitem"',
			'<a itemprop="url"'
		],
		$block_content
	);
}

/**
 * Filter: Adds schema.org markup to categories blocks.
 */
add_filter('render_block_core/categories', 'categories_content_block_filter', 10, 2);
function categories_content_block_filter(string $block_content, array $block): string
{
	return str_replace(
		['<ul', '<li', '<a'],
		[
			'<ul aria-label="Category navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope',
			'<li itemprop="name"',
			'<a itemprop="url"'
		],
		$block_content
	);
}

/**
 * Filter: Adds schema.org markup to archives blocks.
 */
add_filter('render_block_core/archives', 'archives_content_block_filter', 10, 2);
function archives_content_block_filter(string $block_content, array $block): string
{
	return str_replace(
		['<ul', '<li', '<a'],
		[
			'<ul aria-label="Archive navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope',
			'<li itemprop="name"',
			'<a itemprop="url"'
		],
		$block_content
	);
}

/**
 * Filter: Adds schema.org markup to categories blocks.
 */
//add_filter('render_block_core/latest-posts', 'latest_posts_content_block_filter', 10, 2);

function latest_posts_content_block_filter(string $block_content, array $block): string
{
	// Add schema attributes to <ul> and <li>/<a> tags
	return str_replace(
		['<ul', '<li', '<a'],
		[
			'<ul aria-label="Latest Posts navigation" itemtype="https://schema.org/ItemList" itemscope',
			'<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"',
			'<a itemprop="url"'
		],
		$block_content
	);
}

/**
 * Adds role="alert" to .alert elements in core/group blocks.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content) || $block['blockName'] !== 'core/group') {
		return $block_content;
	}

	// Ensure .alert has role="alert"
	if (strpos($block_content, 'alert') !== false && !preg_match('/role=["\']alert["\']/i', $block_content)) {
		$block_content = preg_replace(
			'/(<[^>]*class=["\'][^"\']*alert[^"\']*["\'][^>]*)(>)/i',
			'$1 role="alert" itemtype="https://schema.org/CommunicateAction" itemscope $2',
			$block_content
		);
	}

	return $block_content;
}, 10, 2);

/**
 * Adds role="toolbar" and an aria-label to .btn-toolbar elements in core/group blocks.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content) || ($block['blockName'] ?? '') !== 'core/group') {
		return $block_content;
	}

	if (strpos($block_content, 'btn-toolbar') !== false) {
		$block_content = preg_replace(
			'/(<[^>]*class=["\'][^"\']*btn-toolbar[^"\']*["\'][^>]*)(>)/i',
			'$1 role="toolbar" aria-label="Toolbar with button groups"$2',
			$block_content
		);
	}

	return $block_content;
}, 10, 2);

/**
 * Adds role="group" and an aria-label to .btn-group elements in core/buttons blocks.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content) || ($block['blockName'] ?? '') !== 'core/buttons') {
		return $block_content;
	}

	if (strpos($block_content, 'btn-group') !== false) {
		$block_content = preg_replace(
			'/(<[^>]*class=["\'][^"\']*btn-group[^"\']*["\'][^>]*)(>)/i',
			'$1 role="group" aria-label="Button Group"$2',
			$block_content
		);
	}

	return $block_content;
}, 10, 2);

/**
 * Adds role="button" to anchor elements inside core/button blocks.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content) || ($block['blockName'] ?? '') !== 'core/button') {
		return $block_content;
	}

	if (strpos($block_content, '<a ') !== false && strpos($block_content, 'role="button"') === false) {
		$block_content = preg_replace(
			'/(<a\s+[^>]*class=["\'][^"\']*wp-block-button__link[^"\']*["\'][^>]*)(>)/i',
			'$1 role="button"$2',
			$block_content
		);
	}

	return $block_content;
}, 10, 2);

/**
 * Adds role="button" to .btn elements, excluding .wp-block-button.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content)) {
		return $block_content;
	}

	// Ensure `.btn` (excluding `.wp-block-button`) has role="button"
	if (strpos($block_content, 'class="') !== false && strpos($block_content, 'btn') !== false) {
		$block_content = preg_replace_callback(
			'/<([a-z]+)([^>]*class=["\'][^"\']*\bbtn\b[^"\']*["\'][^>]*)>/i',
			function ($matches) {
				// Prevents adding role="button" if it's inside wp-block-button
				if (strpos($matches[2], 'wp-block-button') === false && strpos($matches[2], 'role=') === false) {
					return "<{$matches[1]}{$matches[2]} role=\"button\">";
				}
				return $matches[0];
			},
			$block_content
		);
	}

	return $block_content;
}, 10, 2);

/**
 * Adds aria-disabled="true" to disabled core/button elements.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content) || $block['blockName'] !== 'core/button') {
		return $block_content;
	}

	// Add aria-disabled="true" to elements with class="disabled"
	if (strpos($block_content, 'class="') !== false && strpos($block_content, 'disabled') !== false) {
		$block_content = preg_replace(
			'/(<[^>]*class=["\'][^"\']*\bdisabled\b[^"\']*["\'][^>]*)>/i',
			'$1 aria-disabled="true" tabindex="-1">',
			$block_content
		);
	}

	// Add aria-disabled="true" to <button disabled>
	if (strpos($block_content, '<button') !== false && strpos($block_content, 'disabled') !== false) {
		$block_content = preg_replace(
			'/(<button[^>]*\bdisabled\b[^>]*)>/i',
			'$1 aria-disabled="true" tabindex="-1">',
			$block_content
		);
	}

	return $block_content;
}, 10, 2);

/**
 * Adds aria-label="breadcrumb" to core/group blocks with class bs-breadcrumbs.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content) || ($block['blockName'] ?? '') !== 'core/group') {
		return $block_content;
	}

	// Ensure .bs-breadcrumbs has aria-label="breadcrumb"
	if (strpos($block_content, 'bs-breadcrumbs') !== false && !preg_match('/aria-label=["\']breadcrumb["\']/i', $block_content)) {
		$block_content = preg_replace(
			'/(<[^>]*class=["\'][^"\']*\bbs-breadcrumbs\b[^"\']*["\'][^>]*)(>)/i',
			'$1 aria-label="breadcrumb"$2',
			$block_content
		);
	}

	return $block_content;
}, 10, 2);

/**
 * Scans core/group blocks for specific classes and replaces <p class="btn-close"> elements inside with <button> elements.
 *
 * @param string $block_content The rendered block content.
 * @param array  $block The block being processed.
 * @return string Modified block content with correct button structure.
 */
add_filter('render_block', function ($block_content, $block) {
	if (empty($block_content) || ($block['blockName'] ?? '') !== 'core/group') {
		return $block_content;
	}

	$contexts = ['alert', 'modal', 'offcanvas', 'toast'];

	foreach ($contexts as $context) {
		if (strpos($block_content, $context) !== false) {
			$block_content = preg_replace_callback(
				'/<([a-z1-6]+)([^>]*)class=["\']([^"\']*\bbtn-close\b[^"\']*)["\']([^>]*)>(.*?)<\/\1>/i',
				function ($matches) use ($context) {
					$classes = esc_attr($matches[3]);
					return sprintf(
						'<button class="%s" type="button" data-bs-dismiss="%s" aria-label="Close"></button>',
						$classes,
						esc_attr($context)
					);
				},
				$block_content
			);
			break;
		}
	}

	return $block_content;
}, 10, 2);

//add_filter('render_block', 'sp_microformat_markup_filter', 10, 2);

function sp_microformat_markup_filter($block_content, $block)
{
	if (is_admin()) return $block_content;

	// Skip BuddyPress avatar cropper pages (user profile -> change avatar)
	if (function_exists('bp_is_my_profile') && bp_is_my_profile() && bp_is_user_change_avatar()) {
		return $block_content;
	}

	// Skip Group avatar change screen if needed
	if (function_exists('bp_is_group') && bp_is_group() && bp_is_group_admin_screen('group-avatar')) {
		return $block_content;
	}

	libxml_use_internal_errors(true);

	$dom = new DOMDocument();
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
	$xpath = new DOMXPath($dom);

	// 1. Add schema to core/group with *-markup
	if ($block['blockName'] === 'core/group' && !empty($block['attrs']['className'])) {
		foreach (explode(' ', $block['attrs']['className']) as $class) {
			if (str_ends_with($class, '-markup')) {
				$type = substr($class, 0, -7);
				if ($type) {
					$divs = $xpath->query('//div[contains(@class, "' . $class . '")]');
					foreach ($divs as $div) {
						$div->setAttribute('itemscope', '');
						$div->setAttribute('itemtype', 'http://schema.org/' . $type);
					}
					break;
				}
			}
		}
	}

	// 2. Add itemprop="name" to core/paragraph with class "name"
	if ($block['blockName'] === 'core/paragraph' && !empty($block['attrs']['className']) && str_contains($block['attrs']['className'], 'name')) {
		$ps = $xpath->query('//p[contains(@class, "name")]');
		foreach ($ps as $p) {
			$p->setAttribute('itemprop', 'name');
		}
	}

	// 3. Add schema logo treatment to core/image with class "logo"
	if ($block['blockName'] === 'core/image' && !empty($block['attrs']['className']) && str_contains($block['attrs']['className'], 'logo')) {
		$figures = $xpath->query('//figure[contains(@class, "logo")]');
		foreach ($figures as $figure) {
			$figure->setAttribute('itemprop', 'logo');
			$figure->setAttribute('itemscope', '');
			$figure->setAttribute('itemtype', 'http://schema.org/ImageObject');

			// Add <meta itemprop="url"> if <img> src is present
			$img = $xpath->query('.//img', $figure)->item(0);
			if ($img && $img->hasAttribute('src')) {
				$meta = $dom->createElement('meta');
				$meta->setAttribute('itemprop', 'url');
				$meta->setAttribute('content', $img->getAttribute('src'));
				$figure->appendChild($meta);
			}
		}

		$imgs = $xpath->query('//figure[contains(@class, "logo")]//img');
		foreach ($imgs as $img) {
			$img->setAttribute('itemprop', 'url');
		}
	}
	// 4. Convert group block with class "address" into <address> with schema.org PostalAddress
	if ($block['blockName'] === 'core/group' && !empty($block['attrs']['className']) && str_contains($block['attrs']['className'], 'address')) {
		$groups = $xpath->query('//div[contains(@class, "address")]');
		foreach ($groups as $group) {
			$address = $dom->createElement('address');
			$address->setAttribute('itemprop', 'address');
			$address->setAttribute('itemscope', '');
			$address->setAttribute('itemtype', 'http://schema.org/PostalAddress');

			$children = [];
			foreach ($group->childNodes as $child) {
				if ($child->nodeType === XML_ELEMENT_NODE && $child->nodeName === 'p') {
					$classList = explode(' ', $child->getAttribute('class'));
					foreach ($classList as $class) {
						switch ($class) {
							case 'streetAddress':
								$div = $dom->createElement('div', $child->textContent);
								$div->setAttribute('itemprop', 'streetAddress');
								$children[] = $div;
								break;
							case 'addressLocality':
								$span = $dom->createElement('span', $child->textContent);
								$span->setAttribute('itemprop', 'addressLocality');
								$children[] = $span;
								// Add comma after locality
								$children[] = $dom->createTextNode(', ');
								break;
							case 'addressRegion':
								$span = $dom->createElement('span', $child->textContent);
								$span->setAttribute('itemprop', 'addressRegion');
								$children[] = $span;
								$children[] = $dom->createTextNode(' ');
								break;
							case 'postalCode':
								$span = $dom->createElement('span', $child->textContent);
								$span->setAttribute('itemprop', 'postalCode');
								$children[] = $span;
								break;
						}
					}
				}
			}

			foreach ($children as $childNode) {
				$address->appendChild($childNode);
			}

			$group->parentNode->replaceChild($address, $group);
		}
	}

	// 5. Add itemprop="telephone" to <p class="telephone"> blocks
	if ($block['blockName'] === 'core/paragraph' && !empty($block['attrs']['className']) && str_contains($block['attrs']['className'], 'telephone')) {
		$ps = $xpath->query('//p[contains(@class, "telephone")]');
		foreach ($ps as $p) {
			$p->setAttribute('itemprop', 'telephone');
		}
	}

	// 6. Add itemprop="email" to <p class="email"> blocks
	if ($block['blockName'] === 'core/paragraph' && !empty($block['attrs']['className']) && str_contains($block['attrs']['className'], 'email')) {
		$ps = $xpath->query('//p[contains(@class, "email")]');
		foreach ($ps as $p) {
			$p->setAttribute('itemprop', 'email');
		}
	}

	// 6. Add itemprop="url" to <p class="url"> blocks
	if ($block['blockName'] === 'core/paragraph' && !empty($block['attrs']['className']) && str_contains($block['attrs']['className'], 'url')) {
		$ps = $xpath->query('//p[contains(@class, "url")]');
		foreach ($ps as $p) {
			$p->setAttribute('itemprop', 'url');
		}
	}

	return $dom->saveHTML($dom->documentElement);
}
