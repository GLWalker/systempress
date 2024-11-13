<?php

/**
 * Title: 404
 * Slug: systempress/404
 */
?>

<!-- wp:group {"align":"wide","className":"py-4","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide py-4">

    <!-- wp:media-text {"align":"","mediaLink":"<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pexels-ann-h-45017-3482442.jpg","mediaType":"image","imageFill":true} -->
    <div class="wp-block-media-text is-stacked-on-mobile is-image-fill">
        <figure class="wp-block-media-text__media" style="background-image:url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pexels-ann-h-45017-3482442.jpg);background-position:50% 50%"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pexels-ann-h-45017-3482442.jpg" alt="Watch Party" /></figure>

        <div class="wp-block-media-text__content">

            <!-- wp:heading {"level":2,"className":"py-3","fontSize":"x-large"} -->
            <h2 class="wp-block-heading py-3 has-x-large-font-size">Well this is puzzling, try searching or browsing the archives.</h2>
            <!-- /wp:heading -->

            <!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search","className":"pb-3"} /-->

            <!-- wp:archives {"showPostCounts":true,"type":"yearly","className":"list-group list-group-flush list-group-item-action stretched-link"} /-->

        </div>
    </div>
    <!-- /wp:media-text -->

</div>
<!-- /wp:group -->