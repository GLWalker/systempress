<?php

/**
 * Title: Comments Carousel
 * Slug: systempress/carousel-comments
 * Categories: carousel
 */
?>
<!-- wp:group {"metadata":{"name":"Carousel Comments","categories":["carousel"],"patternName":"systempress/carousel-comments"},"align":"full","className":"my-0","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
    <!-- wp:group {"className":"comments-carousel","layout":{"type":"constrained"}} -->
    <div class="wp-block-group comments-carousel"><!-- wp:group {"lock":{"move":false,"remove":false},"align":"full","className":"carousel slide carousel-dark","layout":{"type":"default"}} -->
        <div class="wp-block-group alignfull carousel slide carousel-dark" id="CommentsCarousel"><!-- wp:group {"align":"full","className":"card","layout":{"type":"default"}} -->
            <div class="wp-block-group alignfull card"><!-- wp:group {"align":"full","className":"card-body","layout":{"type":"default"}} -->
                <div class="wp-block-group alignfull card-body"><!-- wp:latest-comments {"align":"full","className":"carousel-inner"} /--></div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->

            <!-- wp:paragraph {"lock":{"move":true,"remove":true},"metadata":{"name":"carousel-control-prev"},"className":"carousel-control-prev"} -->
            <p class="carousel-control-prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"lock":{"move":true,"remove":true},"metadata":{"name":"carousel-control-next"},"className":"carousel-control-next"} -->
            <p class="carousel-control-next"><span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->