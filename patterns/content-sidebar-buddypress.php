<?php

/**
 * Title: Sidebar Buddypress Content
 * Slug: systempress/content-sidebar-buddypress
 */
?>

<!-- wp:group {"metadata":{"name":"Buddypress Sidebar Pattern"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"backgroundColor":"bs-secondary-bg","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-bs-secondary-bg-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignfull"><!-- wp:bp/sitewide-notices /-->

    <!-- wp:group {"className":"card","layout":{"type":"default"}} -->
    <div class="wp-block-group card"><!-- wp:bp/dynamic-groups {"linkTitle":true,"className":"card-body"} /--></div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"card","layout":{"type":"default"}} -->
    <div class="wp-block-group card"><!-- wp:bp/dynamic-members {"className":"card-body"} /--></div>
    <!-- /wp:group -->

    <!-- wp:group {"className":"card","style":{"spacing":{"blockGap":"0"}},"backgroundColor":"bs-primary-bg-subtle","layout":{"type":"default"}} -->
    <div class="wp-block-group card has-bs-primary-bg-subtle-background-color has-background"><!-- wp:heading {"level":4,"className":"card-header"} -->
      <h4 class="wp-block-heading card-header">Latest Post</h4>
      <!-- /wp:heading -->

      <!-- wp:latest-posts {"excerptLength":11,"displayPostDate":true,"featuredImageSizeWidth":75,"featuredImageSizeHeight":75,"className":"list-group list-group-flush list-group-item-action stretched-link list-group-item-primary"} /-->
    </div>
    <!-- /wp:group -->
  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->