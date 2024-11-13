<?php

/**
 * Title: List of posts, 1 column
 * Slug: systempress/posts-1-col
 * Categories: query
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">

	<!-- wp:query {"queryId":0,"query":{"perPage":6,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","layout":{"type":"constrained"}} -->
	<div class="wp-block-query alignwide">

		<!-- wp:query-no-results -->
		<!-- wp:group {"className":"alert w-100"} -->
		<div class="wp-block-group alert w-100"><!-- wp:paragraph -->
			<p>No posts were found.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search"} /-->
		<!-- /wp:query-no-results -->

		<!-- wp:post-template {"layout":{"type":"default"}} -->

		<!-- wp:group {"className":"card","backgroundColor":"bs-secondary-bg","layout":{"type":"default"}} -->
		<div class="wp-block-group card has-bs-secondary-bg-background-color has-background">

			<!-- wp:group {"className":"card-body","layout":{"type":"default"}} -->
			<div class="wp-block-group card-body">

				<!-- wp:group {"className":"media-object d-flex","layout":{"type":"default"}} -->
				<div class="wp-block-group media-object d-flex"><!-- wp:group {"className":"flex-shrink-0","layout":{"type":"default"}} -->
					<div class="wp-block-group flex-grow-1flex-shrink-0"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","width":"10rem","height":"10rem"} /--></div>
					<!-- /wp:group -->

					<!-- wp:group {"className":"flex-grow-1 ms-3","layout":{"type":"default"}} -->
					<div class="wp-block-group flex-grow-1 ms-3">

						<!-- wp:post-title {"isLink":true,"className":"card-title pb-2","style":{"spacing":{"margin":{"bottom":"0"}},"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"x-large"} /-->

						<!-- wp:pattern {"slug":"systempress/posts-meta"} /-->

						<!-- wp:post-excerpt {"moreText":"","fontSize":"small","className":"entry-summary mb-0"} /-->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
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