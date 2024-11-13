<?php

/**
 * Title: Placeholder Jumbotron
 * Slug: systempress/jumbotron-placeholder
 * Categories: call-to-action
 */
?>

<!-- wp:group {"metadata":{"name":"<?php echo esc_html__('Jumbotron Placeholder', 'systempress'); ?>"},"className":"jumbotron-place-holder container my-5","layout":{"type":"default"}} -->
<div class="wp-block-group jumbotron-place-holder container my-5">

    <!-- wp:group {"align":"wide","backgroundColor":"base","className":"position-relative alert p-4 text-center text-muted border border-dashed rounded-5","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
    <div class="wp-block-group alignwide position-relative alert p-4 text-center text-muted border border-dashed rounded-5 has-base-background-color has-background">

        <!-- wp:paragraph {"className":"position-absolute top-0 end-0 p-3 m-3 btn-close bg-gray bg-opacity-50 rounded-pill"} -->
        <p class="position-absolute top-0 end-0 p-3 m-3 btn-close bg-gray bg-opacity-50 rounded-pill"><img style="width: 30px;" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/transparent-bg.png" alt="<?php esc_attr_e('Close Button Background', 'systempress'); ?>"></p>
        <!-- /wp:paragraph -->

        <!-- wp:spacer {"style":{"layout":{"flexSize":null,"selfStretch":"fill"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
        <div style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:heading {"textAlign":"center","level":2,"className":"text-body-emphasis pt-1","fontSize":"display-3"} -->
        <h2 class="wp-block-heading has-text-align-center text-body-emphasis pt-1 has-display-3-font-size"><?php echo esc_html__('Placeholder jumbotron', 'systempress'); ?></h2>
        <!-- /wp:heading -->

        <!-- wp:group {"layout":{"type":"constrained","contentSize":"60%"}} -->
        <div class="wp-block-group"><!-- wp:paragraph {"className":"mx-auto lead mb-4"} -->
            <p class="mx-auto lead mb-4"><?php echo esc_html__('This faded back jumbotron is useful for placeholder content. It\'s also a great way to add a bit of context to a page or section when no content is available and to encourage visitors to take a specific action.', 'systempress'); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:buttons {"align":"full","className":"btn-group mb-4","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
        <div class="wp-block-buttons alignfull btn-group mb-4"><!-- wp:button {"backgroundColor":"bs-success","className":"is-style-outline btn-lg bg-success-bg-subtle"} -->
            <div class="wp-block-button is-style-outline btn-lg bg-success-bg-subtle"><a class="wp-block-button__link has-bs-success-background-color has-background wp-element-button"><?php echo esc_html__('Action 1', 'systempress'); ?></a></div>
            <!-- /wp:button -->

            <!-- wp:button {"backgroundColor":"bs-success","className":"is-style-outline btn-lg bg-success-bg-subtle"} -->
            <div class="wp-block-button is-style-outline btn-lg bg-success-bg-subtle"><a class="wp-block-button__link has-bs-success-background-color has-background wp-element-button"><?php echo esc_html__('Action 2', 'systempress'); ?></a></div>
            <!-- /wp:button -->

            <!-- wp:button {"backgroundColor":"bs-success","className":"is-style-outline btn-lg bg-success-bg-subtle"} -->
            <div class="wp-block-button is-style-outline btn-lg bg-success-bg-subtle"><a class="wp-block-button__link has-bs-success-background-color has-background wp-element-button"><?php echo esc_html__('Action 3', 'systempress'); ?></a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->

    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->