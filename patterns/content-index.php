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

  <!-- wp:group {"tagName":"header","align":"wide","className":"py-4","layout":{"type":"constrained"}} -->
  <header class="wp-block-group alignwide py-4"><!-- wp:query-title {"type":"archive","fontSize":"display-3"} /-->

    <!-- wp:term-description {"className":"lead"} /-->
  </header>
  <!-- /wp:group -->

  <!-- wp:pattern {"slug":"systempress/posts-1-col"} /-->

</div>
<!-- /wp:group -->