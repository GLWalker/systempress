<?php

/**
 * Title: Header
 * Slug: systempress/header
 * Categories: header
 * Block Types: core/template-part/header
 */
?>

<!-- wp:group {"align":"wide","className":"shadow-sm py-2 my-0","style":{"position":{"type":"sticky","top":"0px"} },"backgroundColor":"bs-secondary-bg","layout":{"type":"constrained"}} -->

<div class="wp-block-group alignwide shadow-sm py-2 my-0 has-bs-secondary-bg-background-color has-background"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
    <div class="wp-block-group alignwide"><!-- wp:site-logo {"style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

        <!-- wp:site-title {"level":0,"textAlign":"left","style":{"layout":{"selfStretch":"fill","flexSize":null}}} /-->

        <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group alignwide">

            <!-- wp:navigation {"overlayMenu":"mobile","layout":{"type":"flex","justifyContent":"left","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
            <!-- wp:home-link {"label":"Home"} /-->
            <!-- wp:navigation-link {"label":"Services","url":"#","kind":"custom","isTopLevelLink":true} /-->
            <!-- wp:navigation-link {"label":"About","url":"#","kind":"custom","isTopLevelLink":true} /-->
            <!-- wp:navigation-link {"label":"Contact","url":"#","kind":"custom","isTopLevelLink":true} /-->
            <!-- /wp:navigation -->

            <!-- wp:group {"className":"mt-2","style":{"layout":{"selfStretch":"fixed","flexSize":"80px"},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left","orientation":"horizontal"}} -->

            <div class="wp-block-group mt-2">

                <!-- wp:social-links {"iconColor":"current","iconColorValue":"currentcolor","metadata":{"name":"Offcanvas Trigger"},"className":"is-style-logos-only off-canvas-trigger sp-icon-group"} -->
                <ul class="wp-block-social-links has-icon-color is-style-logos-only off-canvas-trigger sp-icon-group"><!-- wp:social-link {"url":"#","service":"off-canvas","label":"Toggle Off Canvas Menu"} /--></ul>
                <!-- /wp:social-links -->

                <!-- wp:social-links {"iconColor":"current","iconColorValue":"currentcolor","metadata":{"name":"Search Modal Trigger"},"className":"is-style-logos-only search-modal-trigger sp-icon-group"} -->
                <ul class="wp-block-social-links has-icon-color is-style-logos-only search-modal-trigger sp-icon-group"><!-- wp:social-link {"url":"#","service":"search-modal","label":"Toggle Search Form"} /--></ul>
                <!-- /wp:social-links -->

                <!-- wp:group {"className":"dark-mode dropdown dropstart","layout":{"type":"flex","orientation":"horizontal"}} -->
                <div class="wp-block-group dark-mode dropdown dropstart">
                    <!-- wp:separator {"className":"sp-action-hook sp_hook_dark_mode"} -->
                    <hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_dark_mode"/>
                    <!-- /wp:separator --></div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->