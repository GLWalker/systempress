<?php

/**
 * Title: Simple Jumbotron
 * Slug: systempress/jumbotron-simple
 * Categories: call-to-action
 */
?>

<!-- wp:group {"metadata":{"name":"<?php echo esc_html__('Simple Jumbotron', 'systempress'); ?>"},"className":"jumbotron-simple container my-5","layout":{"type":"default"}} -->
<div class="wp-block-group jumbotron-simple container my-5"><!-- wp:group {"align":"wide","backgroundColor":"bs-tertiary-bg","className":"p-4 text-center rounded-3","layout":{"type":"default"}} -->
    <div class="wp-block-group alignwide p-4 text-center rounded-3 has-bs-tertiary-bg-background-color has-background"><!-- wp:heading {"textAlign":"center","level":2,"className":"text-body-emphasis","fontSize":"display-3"} -->
        <h2 class="wp-block-heading has-text-align-center text-body-emphasis has-display-3-font-size"><?php echo esc_html__('Basic jumbotron', 'systempress'); ?></h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","className":"lead text-muted"} -->
        <p class="has-text-align-center lead text-muted"><?php echo esc_html__('This is a simple Bootstrap jumbotron that sits within a .container, recreated with built-in utility classes.', 'systempress'); ?></p>
        <!-- /wp:paragraph -->

    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->