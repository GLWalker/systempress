<?php

/**
 * Title: Content Single
 * Slug: systempress/content-single
 * Inserter: no
 */
?>
<!-- wp:group {"tagName":"article","metadata":{"name":"<?php esc_attr_e(' Content Single Pattern', 'systempress'); ?>"},"align":"full","className":"hentry py-4 m-0","layout":{"type":"constrained"}} -->
<article class="wp-block-group alignfull hentry py-4 m-0">
  <!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignfull">

    <!-- wp:group {"tagName":"header","metadata":{"name":"Entry Header"},"className":"entry-header","layout":{"type":"constrained"}} -->
    <header class="wp-block-group entry-header">
      <!-- wp:post-featured-image /-->

      <!-- wp:post-title {"level":1,"className":"entry-title","fontSize":"display-6"} /-->

      <!-- wp:pattern {"slug":"systempress/posts-meta"} /-->

    </header>
    <!-- /wp:group -->

    <!-- wp:post-content {"align":"full","className":"entry-content","layout":{"type":"constrained"}} /-->

    <!-- wp:group {"tagName":"footer","metadata":{"name":"Entry Footer"},"className":"entry-meta","layout":{"type":"constrained"}} -->
    <footer class="wp-block-group entry-meta"><!-- wp:post-terms {"term":"post_tag","textAlign":"left","separator":"  ","className":"is-style-pill"} /-->

      <!-- wp:group {"tagName":"nav","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
      <nav aria-label="Posts" class="wp-block-group"><!-- wp:post-navigation-link {"type":"previous","label":"Previous: ","showTitle":true,"linkLabel":true,"arrow":"chevron"} /-->

        <!-- wp:post-navigation-link {"label":"Next: ","showTitle":true,"linkLabel":true,"arrow":"chevron"} /-->
      </nav>
      <!-- /wp:group -->
    </footer>
    <!-- /wp:group -->
  </div>
  <!-- /wp:group -->
</article>
<!-- /wp:group -->