<?php
/**
 * Title: Header with nav pills and night mode
 * Slug: systempress/header-navpills-nightmode
 * Categories: header
 * Block Types: core/template-part/header
 */
?>
<!-- wp:separator {"lock":{"move":true,"remove":true},"className":"sp-action-hook sp_hook_start_header"} -->
<hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_start_header" id="sp_hook_start_header"/>
<!-- /wp:separator -->

<!-- wp:group {"templateLock":"all","lock":{"move":true,"remove":true},"style":{"position":{"type":""},"spacing":{"padding":{"top":"20px","bottom":"20px","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"bs-primary","className":"site-header","layout":{"type":"constrained","justifyContent":"center"}} -->
<div id="masthead" class="wp-block-group site-header has-bs-primary-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:20px;padding-right:0;padding-bottom:20px;padding-left:0"><!-- wp:group {"className":"justify-content-lg-between","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group justify-content-lg-between"><!-- wp:group {"templateLock":false,"lock":{"move":false,"remove":false},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"site-branding link-body-emphasis text-decoration-none","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
<div class="wp-block-group site-branding link-body-emphasis text-decoration-none"><!-- wp:site-logo {"width":60,"shouldSyncIcon":false,"className":"site-logo","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:site-title {"level":0,"className":"main-title"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:navigation {"overlayMenu":"never","lock":{"move":false,"remove":false,"edit":false},"className":"nav nav-pills justify-content-lg-end","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} /-->

<!--
     {"slug":"dark-mode", "area":"uncategorized","lock":{"move":false,"remove":false},"align":"full","className":"dark-mod-container"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:separator {"lock":{"move":true,"remove":true},"className":"sp-action-hook sp_hook_end_header"} -->
<hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_end_header" id="sp_hook_end_header"/>
<!-- /wp:separator -->