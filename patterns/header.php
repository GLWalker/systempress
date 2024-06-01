<?php

/**
 * Title: Header with nav pills
 * Slug: systempress/header
 * Categories: header
 * Block Types: core/template-part/header
 */
?>

<!-- wp:separator {"lock":{"move":true,"remove":true},"className":"sp-action-hook sp_hook_start_header"} -->
<hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_start_header" id="sp_hook_start_header" />
<!-- /wp:separator -->

<!-- wp:group {"style":{"position":{"type":""},"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|40","top":"var:preset|spacing|10","bottom":"var:preset|spacing|10"}}},"backgroundColor":"base","className":"site-header navbar-transparent shadow-sm","layout":{"type":"default"}} -->
<div id="masthead" class="wp-block-group site-header navbar-transparent shadow-sm has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--40)">

    <!-- wp:group {"className":"justify-content-lg-between","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center","verticalAlignment":"stretch"}} -->
    <div class="wp-block-group justify-content-lg-between">

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"site-branding","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
        <div class="wp-block-group site-branding"><!-- wp:site-logo {"width":80,"shouldSyncIcon":false,"className":"site-logo","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

            <!-- wp:group {"style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"default"}} -->
            <div class="wp-block-group">
                <!-- wp:site-title {"level":0,"style":{"typography":{"lineHeight":"1.3"}},"className":"main-title","fontSize":"xx-large"} /-->
                <!-- wp:site-tagline {"textAlign":"left","fontSize":"large"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|10","left":"var:preset|spacing|10","right":"var:preset|spacing|10"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"layout":{"selfStretch":"fit","flexSize":null}},"className":"d-none d-md-block","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
        <div class="wp-block-group d-none d-md-block" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--10);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--10)"><!-- wp:navigation {"overlayMenu":"never","className":"nav nav-pills justify-content-lg-end","layout":{"type":"flex","justifyContent":"space-between"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
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

<!-- wp:separator {"lock":{"move":true,"remove":true},"className":"sp-action-hook sp_hook_end_header"} -->
<hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_end_header" id="sp_hook_end_header" />
<!-- /wp:separator -->