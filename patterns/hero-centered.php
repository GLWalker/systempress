<?php

/**
 * Title: Centered Hero
 * Slug: systempress/hero-centered
 * Categories: call-to-action
 */
?>

<!-- wp:group {"metadata":{"name":"Centered Hero"},"className":"hero-centered px-4 py-4 my-5 text-center","layout":{"type":"default"}} -->
<div class="wp-block-group hero-centered px-4 py-4 my-5 text-center"><!-- wp:image {"id":2274,"sizeSlug":"full","linkDestination":"none","style":{"color":{}}} -->
    <figure class="wp-block-image size-full"><img src="http://corner.local/wp-content/uploads/2024/06/logo-100x100-1.webp" alt="logo placeholder" class="wp-image-2274" /></figure>
    <!-- /wp:image -->

    <!-- wp:heading {"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"className":"text-body-emphasis","fontSize":"display-5"} -->
    <h2 class="wp-block-heading text-body-emphasis has-display-5-font-size" style="font-style:normal;font-weight:700">Centered Hero</h2>
    <!-- /wp:heading -->

    <!-- wp:group {"className":"mx-auto px-4","layout":{"type":"constrained","contentSize":"66%"}} -->
    <div class="wp-block-group mx-auto px-4"><!-- wp:paragraph {"className":"lead mb-4"} -->
        <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"align":"full","className":"d-grid gap-2 col-6 mx-auto","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
        <div class="wp-block-buttons alignfull d-grid gap-2 col-6 mx-auto"><!-- wp:button {"className":"btn btn-lg rounded-pill"} -->
            <div class="wp-block-button btn btn-lg rounded-pill"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__('Call to Action', 'systempress'); ?> <img style="width: calc(var(--bs-btn-font-size) * 1.33)" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iI2ZmZmZmZiIgY2xhc3M9ImJpIGJpLWFycm93LXJpZ2h0LXNob3J0IiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgZD0iTTQgOGEuNS41IDAgMCAxIC41LS41aDUuNzkzTDguMTQ2IDUuMzU0YS41LjUgMCAxIDEgLjcwOC0uNzA4bDMgM2EuNS41IDAgMCAxIDAgLjcwOGwtMyAzYS41LjUgMCAwIDEtLjcwOC0uNzA4TDEwLjI5MyA4LjVINC41QS41LjUgMCAwIDEgNCA4Ii8+Cjwvc3ZnPg=="></a></div>
            <!-- /wp:button -->

            <!-- wp:button {"backgroundColor":"bs-secondary","className":"is-style-outline btn btn-lg rounded-pill"} -->
            <div class="wp-block-button is-style-outline btn btn-lg rounded-pill"><a class="wp-block-button__link has-bs-secondary-background-color has-background wp-element-button"><?php echo esc_html__('Secondary Link', 'systempress'); ?></a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->