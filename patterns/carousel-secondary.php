<?php

/**
 * Title: Secondary Carousel
 * Slug: systempress/carousel-secondary
 * Categories: carousel
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Secondary Carousel Container', 'systempress'); ?>"},"className":"secondary-carousel my-0","align":"full","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull secondary-carousel my-0"><!-- wp:group {"lock":{"move":true,"remove":true},"className":"carousel slide","layout":{"type":"default"}} -->
    <div id="SecondaryCarousel" class="wp-block-group carousel slide"><!-- wp:group {"templateLock":"all","lock":{"move":true,"remove":true},"metadata":{"name":"carousel-indicators"},"className":"carousel-indicators","layout":{"type":"default"}} -->
        <div class="wp-block-group carousel-indicators"><!-- wp:paragraph {"metadata":{"name":"slide-0"},"className":"slide-indicator active"} -->
            <p class="slide-indicator active"></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"metadata":{"name":"slide-1"},"className":"slide-indicator"} -->
            <p class="slide-indicator"></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"metadata":{"name":"slide-2"},"className":"slide-indicator"} -->
            <p class="slide-indicator"></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-inner blocks"},"className":"carousel-inner carousel-inner wow animate__animated animate__fadeIn","backgroundColor":"bs-dark","layout":{"type":"default"}} -->
        <div class="wp-block-group carousel-inner carousel-inner wow animate__animated animate__fadeIn has-bs-dark-background-color has-background">
            <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-item"},"className":"carousel-item active","layout":{"type":"default"}} -->

            <div class="wp-block-group carousel-item active">
                <!-- wp:pattern {"slug":"systempress/slide-1"} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-item"},"className":"carousel-item","layout":{"type":"default"}} -->
            <div class="wp-block-group carousel-item">
                <!-- wp:pattern {"slug":"systempress/slide-2"} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-item"},"className":"carousel-item","layout":{"type":"default"}} -->
            <div class="wp-block-group carousel-item">
                <!-- wp:pattern {"slug":"systempress/slide-3"} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:pattern {"slug":"systempress/slide-menu"} /-->

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