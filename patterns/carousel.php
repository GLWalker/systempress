<?php

/**
 * Title: Carousel
 * Slug: systempress/carousel
 * Categories: carousel
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Primary Carousel Container', 'systempress'); ?>"},"className":"primary-carousel my-0","align":"full","layout":{"type":"default"}} -->
<div class="wp-block-group primary-carousel my-0 alignfull"><!-- wp:group {"lock":{"move":true,"remove":true},"className":"carousel slide","layout":{"type":"default"}} -->
    <div id="PrimaryCarousel" class="wp-block-group carousel slide"><!-- wp:group {"templateLock":"all","lock":{"move":true,"remove":true},"metadata":{"name":"carousel-indicators"},"className":"carousel-indicators","layout":{"type":"default"}} -->
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

        <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-inner blocks"},"className":"carousel-inner","layout":{"type":"default"}} -->
        <div class="wp-block-group carousel-inner"><!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-item"},"className":"carousel-item active","layout":{"type":"default"}} -->
            <div class="wp-block-group carousel-item active"><!-- wp:cover {"url":"<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog-1200x800.webp","dimRatio":0,"isUserOverlayColor":true,"isDark":false,"style":{"color":{"duotone":"var:preset|duotone|duotone-13"}}} -->
                <div class="wp-block-cover is-light"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" alt="<?php esc_attr_e('Placeholder Image', 'systempress'); ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog-1200x800.webp" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"center"}} -->
                        <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|bs-primary"}}}},"textColor":"bs-primary"} -->
                            <h2 class="wp-block-heading has-text-align-left has-bs-primary-color has-text-color has-link-color">Carousel Primary Duotone</h2>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|bs-primary"}}}},"textColor":"bs-primary","gradient":"light","className":"rounded"} -->
                            <p class="has-text-align-left rounded has-bs-primary-color has-light-gradient-background has-text-color has-background has-link-color">I'm a bootstrap carousel. I'm wearing a duotone for the purpose of this example. You can find me in the patterns. I am made from blocks and a bit of javascript. <br><br>To edit me, find my blocks labeled carousel-item. Remove the class "carousel-item" then you can see my item and edit it, otherwise additional slides are hidden in the admin, just like the front end! <br><br>When done editing, replace the carousel-item class. </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"bs-primary-bg-subtle","className":"btn-lg is-style-outline btn-primary"} -->
                                <div class="wp-block-button btn-lg is-style-outline btn-primary"><a class="wp-block-button__link has-bs-primary-bg-subtle-background-color has-background wp-element-button" rel="#">Primary Button</a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                </div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-item"},"className":"carousel-item","layout":{"type":"default"}} -->
            <div class="wp-block-group carousel-item"><!-- wp:cover {"url":"<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog-1200x800.webp","dimRatio":0,"isUserOverlayColor":true,"isDark":false,"style":{"color":{"duotone":"var:preset|duotone|duotone-14"}}} -->
                <div class="wp-block-cover is-light"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" alt="<?php esc_attr_e('Placeholder Image', 'systempress'); ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog-1200x800.webp" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"center"}} -->
                        <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|bs-secondary"}}}},"textColor":"bs-secondary"} -->
                            <h2 class="wp-block-heading has-text-align-left has-bs-secondary-color has-text-color has-link-color">Carousel Secondary Duotone</h2>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|bs-secondary"}}}},"textColor":"bs-secondary","gradient":"light","className":"rounded"} -->
                            <p class="has-text-align-left rounded has-bs-secondary-color has-light-gradient-background has-text-color has-background has-link-color">I'm a bootstrap carousel. I'm wearing a duotone for the purpose of this example. You can find me in the patterns. I am made from blocks and a bit of javascript. <br><br>To edit me, find my blocks labeled carousel-item. Remove the class "carousel-item" then you can see my item and edit it, otherwise additional slides are hidden in the admin, just like the front end! <br><br>When done editing, replace the carousel-item class. </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"bs-secondary-bg-subtle","className":"btn-lg is-style-outline btn-secondary"} -->
                                <div class="wp-block-button btn-lg is-style-outline btn-secondary"><a class="wp-block-button__link has-bs-secondary-bg-subtle-background-color has-background wp-element-button" rel="#">Secondary Button</a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                </div>
                <!-- /wp:cover -->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"carousel-item"},"className":"carousel-item","layout":{"type":"default"}} -->
            <div class="wp-block-group carousel-item"><!-- wp:cover {"url":"<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog-1200x800.webp","dimRatio":0,"isUserOverlayColor":true,"isDark":false,"style":{"color":{"duotone":"var:preset|duotone|duotone-15"}}} -->
                <div class="wp-block-cover is-light"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background" alt="<?php esc_attr_e('Placeholder Image', 'systempress'); ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blog-1200x800.webp" data-object-fit="cover" />
                    <div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"center"}} -->
                        <div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|bs-success"}}}},"textColor":"bs-success"} -->
                            <h2 class="wp-block-heading has-text-align-left has-bs-success-color has-text-color has-link-color">Carousel Success Duotone</h2>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"align":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|bs-success"}}}},"textColor":"bs-success","gradient":"light","className":"rounded"} -->
                            <p class="has-text-align-left rounded has-bs-success-color has-light-gradient-background has-text-color has-background has-link-color">I'm a bootstrap carousel. I'm wearing a duotone for the purpose of this example. You can find me in the patterns. I am made from blocks and a bit of javascript. <br><br>To edit me, find my blocks labeled carousel-item. Remove the class "carousel-item" then you can see my item and edit it, otherwise additional slides are hidden in the admin, just like the front end! <br><br>When done editing, replace the carousel-item class. </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"bs-success-bg-subtle","className":"btn-lg is-style-outline btn-success"} -->
                                <div class="wp-block-button btn-lg is-style-outline btn-success"><a class="wp-block-button__link has-bs-success-bg-subtle-background-color has-background wp-element-button" rel="#">Success Button</a></div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->
                        </div>
                        <!-- /wp:group -->
                    </div>
                </div>
                <!-- /wp:cover -->
            </div>
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