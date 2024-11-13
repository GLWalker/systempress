<?php

/**
 * Title: Posts Meta
 * Slug: systempress/posts-meta
 * Categories: query
 */
?>

<!-- wp:group {"metadata":{"name":"Posts Meta"},"className":"entry-meta","style":{"elements":{"link":{"color":{"text":"var:preset|color|inherit"}}}},"textColor":"inherit","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"},"fontSize":"small"} -->
<div class="wp-block-group entry-meta has-inherit-color has-text-color has-link-color has-small-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group"><!-- wp:social-links {"size":"has-small-icon-size","className":"sp-dashicon is-style-logos-only"} -->
		<ul class="wp-block-social-links has-small-icon-size sp-dashicon is-style-logos-only"><!-- wp:social-link {"url":"#","service":"calendar-alt"} /--></ul>
		<!-- /wp:social-links -->
		<!-- wp:post-date {"format":"n/j/Y"} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group"><!-- wp:social-links {"size":"has-small-icon-size","className":"is-style-logos-only sp-dashicon"} -->
		<ul class="wp-block-social-links has-small-icon-size is-style-logos-only sp-dashicon"><!-- wp:social-link {"url":"#","service":"book"} /--></ul>
		<!-- /wp:social-links -->

		<!-- wp:post-author-name {"isLink":true} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group"><!-- wp:social-links {"size":"has-small-icon-size","className":"is-style-logos-only sp-dashicon"} -->
		<ul class="wp-block-social-links has-small-icon-size is-style-logos-only sp-dashicon"><!-- wp:social-link {"url":"#","service":"portfolio"} /--></ul>
		<!-- /wp:social-links -->

		<!-- wp:post-terms {"term":"category"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->