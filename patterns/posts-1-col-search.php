<?php

/**
 * Title: List of search posts, 1 column
 * Slug: systempress/posts-1-col-search
 * Categories: query
 */
?>

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">

	<!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"taxQuery":null},"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-query alignwide">

		<!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search"} /-->

		<!-- wp:query-no-results -->
		<!-- wp:group {"className":"alert w-100"} -->
		<div class="wp-block-group alert w-100"><!-- wp:paragraph -->
			<p>No posts were found.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- /wp:query-no-results -->

		<!-- wp:post-template {"layout":{"type":"default"}} -->

		<!-- wp:group {"className":"card","backgroundColor":"bs-secondary-bg","layout":{"type":"default"}} -->
		<div class="wp-block-group card has-bs-secondary-bg-background-color has-background">

			<!-- wp:group {"className":"card-body","layout":{"type":"default"}} -->
			<div class="wp-block-group card-body">

				<!-- wp:post-title {"isLink":true,"className":"card-title pb-2","style":{"spacing":{"margin":{"bottom":"0"}},"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"x-large"} /-->

				<!-- wp:pattern {"slug":"systempress/posts-meta"} /-->

				<!-- wp:group {"className":"my-2","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group my-2"><!-- wp:social-links {"className":"is-style-logos-only sp-icon-group"} -->
					<ul class="wp-block-social-links is-style-logos-only sp-icon-group"><!-- wp:social-link {"url":"#","service":"tag"} /--></ul>
					<!-- /wp:social-links -->

					<!-- wp:post-terms {"term":"post_tag","className":"is-style-default"} /-->
				</div>
				<!-- /wp:group -->

				<!-- wp:read-more {"className":"wp-element-button","backgroundColor":"bs-light"} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:group {"align":"wide","className":"py-4","layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide py-4"><!-- wp:query-pagination {"paginationArrow":"chevron","showLabel":false,"className":"pagination","layout":{"type":"flex","justifyContent":"right","flexWrap":"nowrap"}} -->
			<!-- wp:query-pagination-previous /-->

			<!-- wp:query-pagination-numbers /-->

			<!-- wp:query-pagination-next /-->
			<!-- /wp:query-pagination -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->