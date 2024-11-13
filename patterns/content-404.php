<?php

/**
 * Title: Content 404
 * Slug: systempress/content-404
 * Block Types: core/template-part/uncategorized
 * Inserter: no
 */
?>

<!-- wp:group { "metadata":{"name":"<?php esc_attr_e('404 Content Pattern', 'systempress'); ?>"},"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull">

  <!-- wp:group {"tagName":"header","align":"wide","className":"py-4","layout":{"type":"constrained"}} -->
  <header class="wp-block-group alignwide py-4">
    <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"display-3"} -->
    <h1 class="wp-block-heading has-text-align-center has-display-3-font-size"><mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-bs-primary-color"><em>404:</em></mark> Page Not Found</h1>
    <!-- /wp:heading -->
  </header>
  <!-- /wp:group -->

  <!-- wp:pattern {"slug":"systempress/404"} /-->

</div>
<!-- /wp:group -->