<?php

/**
 * Title: Content Pattern
 * Slug: systempress/content-pattern
 * Block Types: core/template-part/uncategorized
 * Inserter: no
 */
?>

<!-- wp:group {"metadata":{"name":"<?php esc_attr_e('Pattern', 'systempress'); ?>"},"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull">

  <!-- wp:group {"tagName":"header","align":"wide","className":"py-4","layout":{"type":"constrained"}} -->
  <header class="wp-block-group alignwide py-4">
    <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"display-3"} -->
    <h1 class="wp-block-heading has-text-align-center has-display-3-font-size">Pattern Title</h1>
    <!-- /wp:heading -->
  </header>
  <!-- /wp:group -->

  <!-- wp:pattern {"slug":"systempress/pattern-inner-pattern"} /-->

</div>
<!-- /wp:group -->