<?php

/**
 * Title: 2 Column layout of posts in card like format
 * Slug: systempress/posts-grid
 * Categories: query, posts
 * Block Types: core/query
 */
?>

<!-- wp:query {"queryId":0,"query":{"perPage":4,"pages":0,"offset":1,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"tagName":"section","layout":{"type":"default"}} -->
<section class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":"2","minimumColumnWidth":null}} -->
    <!-- wp:cover {"useFeaturedImage":true,"alt":"Placeholder Image","dimRatio":50,"isUserOverlayColor":true,"minHeight":12,"minHeightUnit":"rem","isDark":false,"tagName":"article","metadata":{"categories":["carousel"],"patternName":"systempress/slide-3","name":"Slide 3"},"className":"bg-dark h-100 rounded overflow-hidden wow animate__ animate__zoomIn animate__delay-1s","style":{"color":[]},"layout":{"type":"default"}} -->
    <article class="wp-block-cover is-light bg-dark h-100 rounded overflow-hidden wow animate__ animate__zoomIn animate__delay-1s" style="min-height:12rem"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span>
        <div class="wp-block-cover__inner-container"><!-- wp:group {"className":"px-3","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"top"}} -->
            <div class="wp-block-group px-3"><!-- wp:post-title {"textAlign":"left","level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|bs-light"},":hover":{"color":{"text":"var:preset|color|bs-border-color"}}}}},"fontSize":"large"} /-->

                <!-- wp:post-excerpt {"excerptLength":26,"className":"entry-summary p-1 rounded","style":{"layout":{"selfStretch":"fixed","flexSize":"6rem"}},"gradient":"dark","fontSize":"small"} /-->

                <!-- wp:pattern {"slug":"systempress/posts-meta"} /-->

                <!-- wp:read-more {"content":"Read more","className":"btn btn-sm btn-outline-light mt-0"} /-->
            </div>
            <!-- /wp:group -->
        </div>
    </article>
    <!-- /wp:cover -->
    <!-- /wp:post-template -->

    <!-- wp:group {"layout":{"inherit":true,"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:query-pagination {"paginationArrow":"chevron","showLabel":false,"className":"pagination","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
        <!-- wp:query-pagination-previous /-->
        <!-- wp:query-pagination-numbers {"midSize":2} /-->
        <!-- wp:query-pagination-next /-->
        <!-- /wp:query-pagination -->
    </div>
    <!-- /wp:group -->
</section>
<!-- /wp:query -->