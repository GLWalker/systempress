<?php

/**
 * Title: Sidebar End Tertiary Content
 * Slug: systempress/content-sidebar-tertiary

 */
?>
<!-- wp:group {"style":{"position":{"type":""},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:search {"label":"<?php echo esc_html__('Search', 'systempress'); ?>","showLabel":false,"placeholder":"<?php echo esc_html__('Search...', 'systempress'); ?>","buttonText":"<?php echo esc_html__('Search', 'systempress'); ?>","buttonUseIcon":true } /-->

  <!-- wp:group {"className":"card","layout":{"type":"default"}} -->
  <div class="wp-block-group card"><!-- wp:heading {"level":4,"className":"card-header border"} -->
    <h4 class="wp-block-heading card-header border"><?php echo esc_html__('Latest Post', 'systempress'); ?></h4>
    <!-- /wp:heading -->
  </div>
  <!-- /wp:group -->

  <!-- wp:latest-posts {"excerptLength":11,"displayPostDate":true,"featuredImageSizeWidth":75,"featuredImageSizeHeight":75,"backgroundColor":"bs-primary-bg-subtle","className":"list-group list-group-flush list-group-item-action stretched-link px-1"} /-->

  <!-- wp:group {"className":"card","layout":{"type":"default"}} -->
  <div class="wp-block-group card"><!-- wp:heading {"level":4,"className":"card-header"} -->
    <h4 class="wp-block-heading card-header"><?php echo esc_html__('Archives', 'systempress'); ?></h4>
    <!-- /wp:heading -->

    <!-- wp:archives {"showPostCounts":true,"className":"list-group list-group-item-action stretched-link"} /-->
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"card","layout":{"type":"default"}} -->
  <div class="wp-block-group card"><!-- wp:heading {"level":4,"className":"card-header"} -->
    <h4 class="wp-block-heading card-header"><?php echo esc_html__('Categories', 'systempress'); ?></h4>
    <!-- /wp:heading -->

    <!-- wp:categories {"showPostCounts":true,"showOnlyTopLevel":true,"className":"list-group list-group-item-action stretched-link"} /-->
  </div>
  <!-- /wp:group -->

  <!-- wp:group {"className":"card","layout":{"type":"default"}} -->
  <div class="wp-block-group card"><!-- wp:heading {"level":4,"className":"card-header"} -->
    <h4 class="wp-block-heading card-header"><?php echo esc_html__('Tags', 'systempress'); ?></h4>
    <!-- /wp:heading -->
  </div>
  <!-- /wp:group -->

  <!-- wp:tag-cloud {"numberOfTags":30,"largestFontSize":"18pt","align":"center","className":"is-style-pill"} /-->
</div>
<!-- /wp:group -->