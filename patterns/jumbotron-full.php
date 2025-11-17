<?php

/**
 * Title: Full Width Jumbotron
 * Slug: systempress/jumbotron-full
 * Categories: call-to-action
 */
?>

<!-- wp:group {"metadata":{"name":"<?php echo esc_html__('Full Width Jumbotron', 'systempress'); ?>"},"className":"jumbotron-full my-5","layout":{"type":"default"}} -->
<div class="wp-block-group jumbotron-full my-5"><!-- wp:group {"align":"wide","backgroundColor":"bs-secondary-bg","className":"p-4 text-center","layout":{"type":"default"}} -->
    <div class="wp-block-group alignwide p-4 text-center has-bs-secondary-bg-background-color has-background"><!-- wp:group {"className":"container","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group container" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
            <!-- wp:heading {"textAlign":"center","className":"text-body-emphasis","fontSize":"display-3"} -->
            <h2 class="wp-block-heading has-text-align-center text-body-emphasis has-display-3-font-size"><?php echo esc_html__('Full Width Jumbotron', 'systempress'); ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"className":"mx-auto lead"} -->
            <p class="mx-auto lead"><?php echo esc_html__('This faded back jumbotron is useful for placeholder content. It\'s also a great way to add a bit of context to a page or section when no content is available and to encourage visitors to take a specific action.', 'systempress'); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->