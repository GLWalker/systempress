<?php

/**
 * Title: List of posts, 3 columns
 * Slug: systempress/posts-3-col
 * Categories: query
 * Block Types: core/query
 */
?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide">
    <!-- wp:query-no-results -->
    <!-- wp:paragraph {"className":"alert"} -->
    <p class="alert">No posts were found.</p>
    <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->

    <!-- wp:group {"style":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
    <div class="wp-block-group"><!-- wp:post-template {"align":"full","layout":{"type":"grid","columnCount":3}} -->
        <!-- wp:group {"tagName":"article","className":"hentry card shadow-sm h-100","layout":{"type":"default"}} -->
        <article class="wp-block-group hentry card shadow-sm h-100">
            <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/4","style":{"spacing":{"margin":{"bottom":"0"},"padding":{"bottom":"0"}}},"className":"card-img-top"} /-->

            <!-- wp:group {"tagName":"header","className":"entry-header card-header","layout":{"type":"default"}} -->
            <header class="wp-block-group entry-header card-header">
                <!-- wp:post-title {"isLink":true,"rel":"bookmark"} /-->

                <!-- wp:pattern {"slug":"systempress/posts-meta"} /-->
            </header>
            <!-- /wp:group -->

            <!-- wp:group {"className":"card-body","layout":{"type":"default"}} -->
            <div class="wp-block-group card-body">

                <!-- wp:post-excerpt {"textAlign":"left","moreText":"Read More","style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}},"className":"card-text","fontSize":"small"} /-->

                <!-- wp:spacer {"height":"min(2.5rem, 3vw)","style":{"layout":{}}} -->
                <div style="height:min(2.5rem, 3vw)" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->
            </div>
            <!-- /wp:group -->
        </article>
        <!-- /wp:group -->
        <!-- /wp:post-template -->

        <!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
        <div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:query-pagination {"paginationArrow":"chevron","className":"pagination","layout":{"type":"flex","justifyContent":"space-between"}} -->
        <!-- wp:query-pagination-previous /-->

        <!-- wp:query-pagination-next /-->
        <!-- /wp:query-pagination -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:query -->