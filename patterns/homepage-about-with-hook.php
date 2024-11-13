<?php

/**
 * Title: About with Hook
 * Slug: systempress/homepage-about-with-hook
 * Categories: text, about, featured
 */
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"<?php esc_attr_e('About with Hook', 'systempress'); ?>"},"align":"full","className":"py-4 m-0","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull py-4 m-0">

    <!-- wp:group {"style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
    <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","fontSize":"display-5"} -->
        <h2 class="wp-block-heading has-text-align-center has-display-5-font-size">Built for Development</h2>
        <!-- /wp:heading -->

        <!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"1.25rem","selfStretch":"fixed"}}} -->
        <div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->

        <!-- wp:paragraph {"align":"center","className":"lead"} -->
        <p class="has-text-align-center lead">Not just a theme with a stylesheet added, SystemPress was built from the ground up to be one of the most advanced Bootstrap themes for WordPress.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"1.25rem"} -->
    <div style="height:1.25rem" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide"><!-- wp:column {"layout":{"type":"default"}} -->
        <div class="wp-block-column"><!-- wp:group {"backgroundColor":"bs-secondary","className":"card h-100"} -->
            <div class="wp-block-group card h-100 has-bs-secondary-background-color has-background"><!-- wp:group {"className":"card-body"} -->
                <div class="wp-block-group card-body"><!-- wp:heading {"level":3,"className":"h5 card-title"} -->
                    <h3 class="wp-block-heading h5 card-title">Conditional Loading</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"className":"card-text"} -->
                    <p class="card-text">WordPress already loads styles conditionally for blocks, SystemPress follows the same concept for loading Bootstrap styles.</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph -->
                    <p>If it's not needed, it's not loaded. This keeps your site smaller and helps it load faster. </p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:separator {"className":"sp-action-hook sp_hook_example"} -->
            <hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_example" id="sp_hook_example" />
            <!-- /wp:separator -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"backgroundColor":"bs-secondary","className":"card h-100"} -->
            <div class="wp-block-group card h-100 has-bs-secondary-background-color has-background"><!-- wp:group {"className":"card-body"} -->
                <div class="wp-block-group card-body"><!-- wp:heading {"level":3,"className":"h5 card-title"} -->
                    <h3 class="wp-block-heading h5 card-title">System Compatibility</h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"className":"card-text"} -->
                    <p class="card-text">Port over a Bootstrap or WP design with ease. SystemPress seamlessly combines WordPress and Bootstrap styles. </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"className":"card-text"} -->
                    <p class="card-text">The theme recognizes Bootstrap color pallets by class name as well as the block editor. </p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:spacer {"height":"var:preset|spacing|20"} -->
    <div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
</section>
<!-- /wp:group -->