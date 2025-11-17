<?php

/**
 * Title: Content Offcanvas
 * Slug: systempress/content-offcanvas
 */
?>

<!-- wp:group {"className":"offcanvas-header","layout":{"type":"default"}} -->
<div class="wp-block-group offcanvas-header"><!-- wp:heading {"level":5,"className":"offcanvas-title"} -->
    <h5 class="wp-block-heading offcanvas-title" id="offcanvasContentLabel">Categories</h5>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"className":"btn-close"} -->
    <p class="btn-close"> </p>
    <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"className":"offcanvas-body","layout":{"type":"default"}} -->
<div class="wp-block-group offcanvas-body">
    <!-- wp:categories {"showPostCounts":true,"showOnlyTopLevel":true,"className":"list-group list-group-item-action stretched-link list-group-flush"} /-->

    <!-- wp:tag-cloud {"className":"is-style-pill"} /-->
</div>
<!-- /wp:group -->