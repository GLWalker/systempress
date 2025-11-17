<?php

/**
 * Title: Sidebar Secondary Content
 * Slug: systempress/content-sidebar-secondary
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Secondary Content Pattern', 'systempress'); ?>"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"backgroundColor":"bs-secondary-bg","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-bs-secondary-bg-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
  <!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignfull">

    <!-- wp:search {"className":"is-layout-flex","label":"Search","showLabel":false,"placeholder":"Search Anything","buttonText":"Search","buttonUseIcon":true} /-->

    <!-- wp:group {"className":"card","style":{"spacing":{"blockGap":"0"}},"backgroundColor":"bs-primary-bg-subtle","layout":{"type":"default"}} -->
    <div class="wp-block-group card has-bs-primary-bg-subtle-background-color has-background"><!-- wp:heading {"level":4,"className":"card-header"} -->
      <h4 class="wp-block-heading card-header">Latest Post</h4>
      <!-- /wp:heading -->

      <!-- wp:latest-posts {"excerptLength":11,"displayPostDate":true,"featuredImageSizeWidth":75,"featuredImageSizeHeight":75,"className":"list-group list-group-flush list-group-item-action stretched-link list-group-item-primary"} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:archives {"showPostCounts":true,"type":"yearly","className":"list-group list-group-item-action stretched-link list-group-item-success wow animate__animated animate__fadeInRight"} /-->

    <!-- wp:group {"className":"card","backgroundColor":"base","layout":{"type":"default"}} -->
    <div class="wp-block-group card has-base-background-color has-background">

      <!-- wp:heading {"level":4,"className":"card-header"} -->
      <h4 class="wp-block-heading card-header bg-transparent mb-2">Tags</h4>
      <!-- /wp:heading -->

      <!-- wp:tag-cloud {"numberOfTags":20,"largestFontSize":"14pt","align":"center","className":"is-style-pill"} /-->
    </div>
    <!-- /wp:group -->

  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->