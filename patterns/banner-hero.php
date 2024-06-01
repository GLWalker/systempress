<?php

/**
 * Title: Hero
 * Slug: systempress/banner-hero
 * Categories: banner, call-to-action, featured
 * Viewport width: 1400
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/building-exterior.webp","dimRatio":50,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"elements":{"link":{"color":{"text":"var:preset|color|bs-light"}}}},"textColor":"bs-light","className":"has-contrast-background-color","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span><img class="wp-block-cover__image-background" alt="<?php esc_attr_e('Building exterior in Toronto, Canada', 'systempress'); ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/building-exterior.webp" data-object-fit="cover" />
	<div class="wp-block-cover__inner-container"><!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"","wideSize":""}} -->
		<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"constrained","contentSize":"565px"}} -->
			<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"fontSize":"display-4"} -->
				<h1 class="wp-block-heading has-text-align-center has-display-4-font-size">A commitment to innovation and sustainability</h1>
				<!-- /wp:heading -->

				<!-- wp:spacer {"height":"1.25rem"} -->
				<div style="height:1.25rem" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->

				<!-- wp:paragraph {"align":"center","className":"lead"} -->
				<p class="has-text-align-center lead">Études is a pioneering firm that seamlessly merges creativity and functionality to redefine architectural excellence.</p>
				<!-- /wp:paragraph -->

				<!-- wp:spacer {"height":"1.25rem"} -->
				<div style="height:1.25rem" aria-hidden="true" class="wp-block-spacer"></div>
				<!-- /wp:spacer -->

				<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
				<div class="wp-block-buttons"><!-- wp:button {"className":"btn-lg"} -->
					<div class="wp-block-button btn-lg"><a class="wp-block-button__link wp-element-button">About us</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->

			<!-- wp:spacer {"height":"var:preset|spacing|30","style":{"layout":[]}} -->
			<div style="height:var(--wp--preset--spacing--30)" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
		</section>
		<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->