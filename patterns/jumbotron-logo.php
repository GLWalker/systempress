<?php

/**
 * Title: Jumbotron with Logo
 * Slug: systempress/jumbotron-logo
 * Categories: call-to-action
 */
?>

<!-- wp:group {"metadata":{"name":"<?php echo esc_html__('Jumbotron with Logo', 'systempress'); ?>"},"className":"jumbotron-logo container my-5","layout":{"type":"default"}} -->
<div class="wp-block-group jumbotron-logo container my-5"><!-- wp:group {"align":"wide","backgroundColor":"bs-tertiary-bg","className":"p-4 text-center rounded-3","layout":{"type":"default"}} -->
    <div class="wp-block-group alignwide p-4 text-center rounded-3 has-bs-tertiary-bg-background-color has-background"><!-- wp:site-logo {"width":100,"isLink":false,"align":"center","className":"mt-3 mb-3"} /-->

        <!-- wp:heading {"textAlign":"center","level":2,"className":"text-body-emphasis","fontSize":"display-3"} -->
        <h2 class="wp-block-heading has-text-align-center text-body-emphasis has-display-3-font-size"><?php echo esc_html__('Start Your Next Project With ', 'systempress'); ?><mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-bs-primary-color"><?php echo esc_html__('SystemPress ', 'systempress'); ?></mark></h2>
        <!-- /wp:heading -->

        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group"><!-- wp:paragraph {"className":"mx-auto fs-5 text-muted"} -->
            <p class="mx-auto fs-5 text-muted"><?php echo esc_html__('SystemPress is a full site editing theme that integrates WordPress together with Bootstrap 5.', 'systempress'); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:buttons {"align":"full","className":"gap-2","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
        <div class="wp-block-buttons alignfull gap-2"><!-- wp:button {"className":"btn-lg rounded-pill"} -->
            <div class="wp-block-button btn-lg rounded-pill"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__('Call to Action', 'systempress'); ?> <img style="width: calc(var(--bs-btn-font-size) * 1.33)" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iI2ZmZmZmZiIgY2xhc3M9ImJpIGJpLWFycm93LXJpZ2h0LXNob3J0IiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgZD0iTTQgOGEuNS41IDAgMCAxIC41LS41aDUuNzkzTDguMTQ2IDUuMzU0YS41LjUgMCAxIDEgLjcwOC0uNzA4bDMgM2EuNS41IDAgMCAxIDAgLjcwOGwtMyAzYS41LjUgMCAwIDEtLjcwOC0uNzA4TDEwLjI5MyA4LjVINC41QS41LjUgMCAwIDEgNCA4Ii8+Cjwvc3ZnPg=="></a></div>
            <!-- /wp:button -->

            <!-- wp:button {"backgroundColor":"bs-secondary","className":"is-style-outline btn-lg rounded-pill"} -->
            <div class="wp-block-button is-style-outline btn-lg rounded-pill"><a class="wp-block-button__link has-bs-secondary-background-color has-background wp-element-button"><?php echo esc_html__('Secondary Link', 'systempress'); ?></a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->