<?php

/**
 * Title: Header Alt
 * Slug: systempress/header-alt
 * Categories: header
 * Block Types: core/template-part/header
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}},"backgroundColor":"bs-primary","className":"shadow-sm my-0","layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group shadow-sm my-0 alignwide has-bs-primary-background-color has-background" style="padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--30)">

    <!-- wp:group {"className":"justify-content-lg-between","align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->

    <div class="wp-block-group justify-content-lg-between alignwide">

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"site-branding","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
        <div class="wp-block-group site-branding"><!-- wp:site-logo {"width":60,"shouldSyncIcon":false,"className":"site-logo","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

            <!-- wp:group {"style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"default"}} -->
            <div class="wp-block-group">
                <!-- wp:site-title {"level":0,"textAlign":"left","style":{"layout":{"selfStretch":"fill","flexSize":null}}} /-->
                <!-- wp:site-tagline {"textAlign":"left"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
        <div class="wp-block-group">

            <!-- wp:group {"className":"mt-2","style":{"layout":{"selfStretch":"fixed","flexSize":"80px"},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left","orientation":"horizontal"}} -->

            <div class="wp-block-group mt-2">
                <!-- wp:social-links {"iconColor":"current","iconColorValue":"currentcolor","metadata":{"name":"Offcanvas Trigger"},"className":"is-style-logos-only off-canvas-trigger sp-icon-group"} -->
                <ul class="wp-block-social-links has-icon-color is-style-logos-only off-canvas-trigger sp-icon-group"><!-- wp:social-link {"url":"#","service":"off-canvas","label":"Toggle Off Canvas Menu"} /--></ul>
                <!-- /wp:social-links -->

                <!-- wp:social-links {"iconColor":"current","iconColorValue":"currentcolor","metadata":{"name":"Search Modal Trigger"},"className":"is-style-logos-only search-modal-trigger sp-icon-group"} -->
                <ul class="wp-block-social-links has-icon-color is-style-logos-only search-modal-trigger sp-icon-group"><!-- wp:social-link {"url":"#","service":"search-modal","label":"Toggle Search Form"} /--></ul>
                <!-- /wp:social-links -->

                <!-- wp:group {"className":"dropdown dark-mode","layout":{"type":"flex","orientation":"horizontal"}} -->
                <div class="wp-block-group dropdown dark-mode">
                    <!-- wp:separator {"className":"sp-action-hook sp_hook_dark_mode"} -->
                    <hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_dark_mode"/>
                    <!-- /wp:separator --></div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

            <!-- wp:navigation {"overlayMenu":"never","layout":{"type":"flex","justifyContent":"right"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
            <!-- wp:home-link {"label":"Home"} /-->
            <!-- wp:navigation-link {"label":"Services","url":"#","kind":"custom","isTopLevelLink":true} /-->
            <!-- wp:navigation-link {"label":"About","url":"#","kind":"custom","isTopLevelLink":true} /-->
            <!-- wp:navigation-link {"label":"Contact","url":"#","kind":"custom","isTopLevelLink":true} /-->
            <!-- /wp:navigation -->

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->