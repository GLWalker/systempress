<?php

/**
 * Title: Portfolio
 * Slug: systempress/portfolio
 * Keywords: portfolio
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/patterns.webp","id":6,"dimRatio":90,"overlayColor":"contrast","isUserOverlayColor":true,"contentPosition":"center center","metadata":{"name":"Portfolio"},"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"0","right":"0"}}},"className":"wow animate__animated animate__fadeInUp","layout":{"type":"constrained"}} -->
<div class="wp-block-cover wow animate__animated animate__fadeInUp" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:0;padding-bottom:var(--wp--preset--spacing--50);padding-left:0"><span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-90 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-6" alt="" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/patterns.webp" data-object-fit="cover" />
    <div class="wp-block-cover__inner-container"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
        <div class="wp-block-columns"><!-- wp:column {"className":"wow animate__animated animate__fadeInUp"} -->
            <div class="wp-block-column wow animate__animated animate__fadeInUp"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:paragraph {"align":"left","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
                    <p class="has-text-align-left" style="margin-top:0;margin-bottom:0"><mark style="background-color:rgba(0, 0, 0, 0);color:#01a4ef" class="has-inline-color"><?php echo esc_html__('Portfolio', 'systempress'); ?></mark></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:heading {"textAlign":"left","style":{"typography":{"fontSize":"32px","lineHeight":"1.2","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0"}}},"fontFamily":"body"} -->
                    <h2 class="wp-block-heading has-text-align-left has-body-font-family" style="margin-top:0;font-size:32px;font-style:normal;font-weight:600;line-height:1.2"><?php echo esc_html__("We Have Done Lot's Of", 'systempress'); ?> <mark style="background-color:rgba(0, 0, 0, 0);color:#01a4ef" class="has-inline-color"><?php echo esc_html__("Project's", 'systempress'); ?></mark></h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p><?php echo esc_html__('In auctor lobortis lacus. Donec vitae sapien ut libero venenatis faucibus. Curabitur at lacus ac velit ornare lobortis. In consectetuer turpis ut velit. Nunc nonummy metus.', 'systempress'); ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph -->
                    <p><?php echo esc_html__('Praesent nonummy mi in odio. Morbi mollis tellus ac sapien. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Nullam dictum felis eu pede mollis pretium. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.', 'systempress'); ?></p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"},"blockGap":"0"}}} -->
                    <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40","top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}},"border":{"color":"#01a4ef","radius":"8px"}},"className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-border-color wp-element-button" style="border-color:#01a4ef;border-radius:8px;padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--40)"><?php echo esc_html__("Read More", 'systempress'); ?></a></div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}},"color":{"background":"#ffffff70"}},"className":"column-has-radius wow animate__animated animate__fadeInUp"} -->
            <div class="wp-block-column is-vertically-aligned-center column-has-radius wow animate__animated animate__fadeInUp has-background" style="background-color:#ffffff70;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:gallery {"randomOrder":true,"linkTarget":"_blank","linkTo":"attachment","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|10","left":"var:preset|spacing|10"}}}} -->
                <figure class="wp-block-gallery has-nested-images columns-default is-cropped"><!-- wp:image {"id":101,"sizeSlug":"large","linkDestination":"attachment","style":{"border":{"radius":"6px"}}} -->
                    <figure class="wp-block-image size-large has-custom-border"><a href="#" target="_blank" rel="noopener"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/banner.jpg" alt="" class="wp-image-101" style="border-radius:6px" /></a></figure>
                    <!-- /wp:image -->

                    <!-- wp:image {"id":102,"sizeSlug":"large","linkDestination":"attachment","style":{"border":{"radius":"6px"}}} -->
                    <figure class="wp-block-image size-large has-custom-border"><a href="#" target="_blank" rel="noopener"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/about.jpg" alt="" class="wp-image-102" style="border-radius:6px" /></a></figure>
                    <!-- /wp:image -->

                    <!-- wp:image {"id":82,"sizeSlug":"large","linkDestination":"attachment","style":{"border":{"radius":"6px"}}} -->
                    <figure class="wp-block-image size-large has-custom-border"><a href="#" target="_blank" rel="noopener"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/banner.jpg" alt="" class="wp-image-82" style="border-radius:6px" /></a></figure>
                    <!-- /wp:image -->

                    <!-- wp:image {"id":104,"sizeSlug":"large","linkDestination":"attachment","style":{"border":{"radius":"6px"}}} -->
                    <figure class="wp-block-image size-large has-custom-border"><a href="#" target="_blank" rel="noopener"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/about.jpg" alt="" class="wp-image-104" style="border-radius:6px" /></a></figure>
                    <!-- /wp:image -->

                    <!-- wp:image {"id":23,"sizeSlug":"large","linkDestination":"attachment","style":{"border":{"radius":"6px"}}} -->
                    <figure class="wp-block-image size-large has-custom-border"><a href="#" target="_blank" rel="noopener"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/banner.jpg" alt="" class="wp-image-23" style="border-radius:6px" /></a></figure>
                    <!-- /wp:image -->
                </figure>
                <!-- /wp:gallery -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
</div>
<!-- /wp:cover -->