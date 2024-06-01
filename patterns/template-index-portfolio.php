<?php
/**
 * Title: Portfolio index template
 * Slug: systempress/template-index-portfolio
 * Template Types: index
 * Viewport width: 1400
 * Inserter: no
 */
?>

<!-- wp:template-part {"slug":"header","tagName":"div","area":"header"} /-->

<!-- wp:group {"tagName":"main","align":"full","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull">
	<!-- wp:heading {"level":1,"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50"}}}} -->
	<h1 class="wp-block-heading alignwide" style="padding-top:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Posts', 'systempress' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:pattern {"slug":"systempress/posts-images-only-offset-4-col"} /-->

</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","area":"footer","tagName":"footer"} /-->