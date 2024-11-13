<?php

/**
 * Title: Media Splash
 * Slug: systempress/media-splash
 * Categories: featured,call-to-action
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Media Splash', 'systempress'); ?>"},"align":"full","className":"py-4 m-0","backgroundColor":"bs-tertiary-bg","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull py-4 m-0 has-bs-tertiary-bg-background-color has-background">

    <!-- wp:heading {"textAlign":"center","className":"wow animate__animated animate__backInUp","fontSize":"display-3"} -->
    <h2 class="wp-block-heading has-text-align-center wow animate__animated animate__backInUp has-display-3-font-size">Get into the action <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-bs-primary-color p-0"><em>OnDemand</em></mark><em>!</em></h2>
    <!-- /wp:heading -->

    <!-- wp:media-text {"align":"","mediaLink":"<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pexels-jeshoots-com-147458-1040160.jpg","mediaType":"image","imageFill":true,"className":"wow animate__animated animate__slideInUp"} -->
    <div class="wp-block-media-text is-stacked-on-mobile is-image-fill wow animate__animated animate__slideInUp">
        <figure class="wp-block-media-text__media" style="background-image:url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pexels-jeshoots-com-147458-1040160.jpg);background-position:50% 50%"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pexels-jeshoots-com-147458-1040160.jpg" alt="Watch Party" /></figure>

        <div class="wp-block-media-text__content">

            <!-- wp:heading {"level":3} -->
            <h3 class="wp-block-heading"><strong><mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-contrast-color has-medium-font-size p-0">Everyone's Talking!</mark></strong><br>You Can <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-bs-primary-color">Join in</mark> Too</h3>
            <!-- /wp:heading -->

            <!-- wp:group {"metadata":{"name":"Comments Carousel Wrapper"},"align":"full","className":"m-0 wow animate__animated animate__slideInRight","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull m-0 wow animate__animated animate__slideInRight">

                <!-- wp:group {"metadata":{"name":"Comments Carousel","categories":["carousel"],"patternName":"systempress/comments-carousel"},"align":"full","className":"my-0 py-4","layout":{"type":"default"}} -->
                <div class="wp-block-group alignfull my-0 py-4"><!-- wp:group {"className":"comments-carousel","layout":{"type":"constrained"}} -->
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

            </div>
            <!-- /wp:group -->

            <!-- wp:spacer {"height":"1em"} -->
            <div style="height:1em" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons"><!-- wp:button {"width":100} -->
                <div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button">Sign Up Now!</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
    </div>
    <!-- /wp:media-text -->

</div>
<!-- /wp:group -->