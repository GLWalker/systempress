<?php

/**
 * Title: Content Archive
 * Slug: systempress/content-archive
 * Block Types: core/template-part/uncategorized
 * Inserter: no
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Archive Content Pattern', 'systempress'); ?>"},"align":"full","className":"py-4 m-0","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull py-4 m-0">

  <!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignfull">

    <!-- wp:group {"tagName":"header","layout":{"type":"constrained"}} -->
    <header class="wp-block-group">
      <!-- wp:query-title {"type":"archive","fontSize":"display-3"} /-->

      <!-- wp:term-description {"className":"lead"} /-->
    </header>
    <!-- /wp:group -->

    <!-- wp:pattern {"slug":"systempress/posts-1-col"} /-->

  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->