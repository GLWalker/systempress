<?php

/**
 * Title: Content Index
 * Slug: systempress/content-index
 * Block Types: core/template-part/uncategorized
 * Inserter: no
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Index Content Pattern', 'systempress'); ?>"},"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull">

  <!-- wp:group {"tagName":"header","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
  <header class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
    <!-- wp:query-title {"type":"archive","fontSize":"display-3"} /-->

    <!-- wp:term-description {"className":"lead"} /-->
  </header>
  <!-- /wp:group -->

  <!-- wp:pattern {"slug":"systempress/query-media-object"} /-->

</div>
<!-- /wp:group -->