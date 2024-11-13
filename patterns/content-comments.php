<?php

/**
 * Title: Content Comments
 * Slug: systempress/content-comments
 * Block Types: core/template-part/uncategorized
 * Inserter: no
 */
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"Content Comments Pattern"},"align":"full","className":"py-4 m-0","backgroundColor":"bs-tertiary-bg","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull py-4 m-0 has-bs-tertiary-bg-background-color has-background">

  <!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
  <div class="wp-block-group alignfull">

    <!-- wp:group {"tagName":"header","align":"full","className":"comments-header","layout":{"type":"constrained"}} -->
    <header class="wp-block-group alignfull comments-header">

      <!-- wp:comments-title {"level":3,"className":"comment-title"} /-->

      <!-- wp:separator {"lock":{"move":true,"remove":true},"className":"sp-action-hook sp_hook_end_comments_header"} -->
      <hr class="wp-block-separator has-alpha-channel-opacity sp-action-hook sp_hook_end_comments_header" id="sp_hook_end_comments_header" />
      <!-- /wp:separator -->
    </header>
    <!-- /wp:group -->

    <!-- wp:group {"className":"comments-container","layout":{"type":"constrained"}} -->
    <div class="wp-block-group comments-container"><!-- wp:comments {"className":"comments"} -->
      <div class="wp-block-comments comments"><!-- wp:comment-template -->
        <!-- wp:group {"tagName":"article","metadata":{"name":"Comment Body"},"className":"comment-body card shadow-none","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|30"}},"backgroundColor":"base","layout":{"type":"default"}} -->
        <article class="wp-block-group comment-body card shadow-none has-base-background-color has-background" style="margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"className":"card-body","layout":{"type":"flex","orientation":"vertical"}} -->
          <div class="wp-block-group card-body"><!-- wp:group {"tagName":"footer","className":"comment-meta","style":{"spacing":{"blockGap":"0.5em"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <footer class="wp-block-group comment-meta"><!-- wp:avatar {"size":60} /-->

              <!-- wp:group {"className":"comment-author-info ms-1 ","style":{"spacing":{"blockGap":"var:preset|spacing|10"},"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"flex","orientation":"vertical"}} -->
              <div class="wp-block-group comment-author-info ms-1"><!-- wp:comment-author-name {"className":"mb-1","style":{"elements":{"link":{"color":{"text":"var:preset|color|current"}}}},"backgroundColor":"base","fontSize":"large"} /-->

                <!-- wp:comment-date {"className":"mb-1","style":{"elements":{"link":{"color":{"text":"var:preset|color|current"}}}}} /-->
              </div>
              <!-- /wp:group -->
            </footer>
            <!-- /wp:group -->

            <!-- wp:comment-content /-->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center","justifyContent":"space-between"}} -->
            <div class="wp-block-group">
              <!-- wp:comment-edit-link {"className":"is-style-pill"} /-->
              <!-- wp:comment-reply-link {"className":"is-style-pill"} /-->
            </div>
            <!-- /wp:group -->
          </div>
          <!-- /wp:group -->
        </article>
        <!-- /wp:group -->
        <!-- /wp:comment-template -->

        <!-- wp:comments-pagination {"paginationArrow":"chevron","className":"pb-2","fontSize":"small","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
        <!-- wp:comments-pagination-previous /-->

        <!-- wp:comments-pagination-next /-->
        <!-- /wp:comments-pagination -->

        <!-- wp:post-comments-form /-->
      </div>
      <!-- /wp:comments -->
    </div>
    <!-- /wp:group -->
  </div>
  <!-- /wp:group -->
</section>
<!-- /wp:group -->