<?php
/**
 * Title: Centered call to action
 * Slug: systempress/cta-subscribe-centered
 * Categories: call-to-action
 * Keywords: newsletter, subscribe, button
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"bs-secondary-bg","className":"rounded","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide rounded has-bs-secondary-bg-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50)">
		<!-- wp:spacer {"height":"var:preset|spacing|10"} -->
		<div style="height:var(--wp--preset--spacing--10)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->
		<!-- wp:heading {"textAlign":"center","level":6,"fontSize":"display-5"} -->
			<h6 class="wp-block-heading has-text-align-center has-display-5-font-size">
		<?php echo esc_html_x( 'Join 900+ subscribers', 'Sample text for Subscriber Heading with numbers', 'systempress' ); ?></h6>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","className":"lead"} -->
		<p class="has-text-align-center lead"><?php echo esc_html_x( 'Stay in the loop with everything you need to know.', 'Sample text for Subscriber Description', 'systempress' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"btn-lg"} -->
			<div class="wp-block-button btn-lg">
				<a class="wp-block-button__link wp-element-button"><?php echo esc_html_x( 'Sign up', 'Sample text for Sign Up Button', 'systempress' ); ?></a>
			</div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->

		<!-- wp:spacer {"height":"var:preset|spacing|10"} -->
		<div style="height:var(--wp--preset--spacing--10)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
