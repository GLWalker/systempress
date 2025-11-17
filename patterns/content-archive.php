<?php

/**
 * Title: Content Archive
 * Slug: systempress/content-archive
 * Block Types: core/template-part/uncategorized
 * Inserter: no
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Archive Content Pattern', 'systempress'); ?>"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">

  <!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignfull">

    <!-- wp:group {"tagName":"header","layout":{"type":"constrained"}} -->
    <header class="wp-block-group">
      <!-- wp:query-title {"type":"archive","fontSize":"display-3"} /-->

      <!-- wp:term-description {"className":"lead"} /-->
    </header>
    <!-- /wp:group -->

    <!-- wp:pattern {"slug":"systempress/query-media-object"} /-->

  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->