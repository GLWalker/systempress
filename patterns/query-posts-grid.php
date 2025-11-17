<?php

/**
 * Title: List of posts in media-object like grid
 * Slug: systempress/query-post-grid
 * Categories: query
 */
?>
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">

	<!-- wp:query {"queryId":0,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide","layout":{"type":"constrained"}} -->
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

		<!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
		<!-- wp:group {"className":"card h-100","layout":{"type":"default"}} -->
		<div class="wp-block-group card h-100"><!-- wp:group {"className":"card-body ","layout":{"type":"default"}} -->
			<div class="wp-block-group card-body"><!-- wp:group {"className":"media-object","layout":{"type":"default"}} -->
				<div class="wp-block-group media-object"><!-- wp:group {"className":"flex-grow-1","layout":{"type":"default"}} -->
					<div class="wp-block-group flex-grow-1"><!-- wp:post-title {"isLink":true,"className":"entry-title card-title","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"}},"layout":{"selfStretch":"fill","flexSize":null}},"fontSize":"x-large"} /-->

						<!-- wp:pattern {"slug":"systempress/posts-meta"} /-->

						<!-- wp:post-excerpt {"moreText":"","className":"entry-summary","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"fontSize":"small"} /-->
					</div>
					<!-- /wp:group -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignwide">

			<!-- wp:query-pagination {"paginationArrow":"chevron","showLabel":false,"className":"pagination pagination-sm","backgroundColor":"transparent","layout":{"type":"flex","justifyContent":"right","flexWrap":"nowrap"}} -->

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