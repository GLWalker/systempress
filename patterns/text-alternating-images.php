<?php

/**
 * Title: Text with alternating images
 * Slug: systempress/text-alternating-images
 * Categories: text, about
 * Viewport width: 1400
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":4,"fontSize":"display-5"} -->
			<h4 class="wp-block-heading has-text-align-center has-display-5-font-size">An array of resources</h4>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","style":{"layout":{"selfStretch":"fit","flexSize":null}},"className":"lead"} -->
			<p class="has-text-align-center lead">Our comprehensive suite of professional services caters to a diverse clientele, ranging from homeowners to commercial developers.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
		<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:heading {"level":5,"fontSize":"xx-large"} -->
				<h5 class="wp-block-heading has-xx-large-font-size">Études Architect App</h5>
				<!-- /wp:heading -->

				<!-- wp:list {"style":{"typography":{"lineHeight":"1.75"}},"className":"is-style-checkmark-list"} -->
				<ul style="line-height:1.75" class="is-style-checkmark-list"><!-- wp:list-item -->
					<li>Collaborate with fellow architects.</li>
					<!-- /wp:list-item -->

					<!-- wp:list-item -->
					<li>Showcase your projects.</li>
					<!-- /wp:list-item -->

					<!-- wp:list-item -->
					<li>Experience the world of architecture.</li>
					<!-- /wp:list-item -->
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"width":"50%"} -->
			<div class="wp-block-column" style="flex-basis:50%">
				<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"d-block w-100 is-style-rounded"} -->
				<figure class="wp-block-image size-large d-block w-100 is-style-rounded">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/tourist-and-building.webp" alt="<?php esc_attr_e('Tourist taking photo of a building', 'systempress'); ?>" />
				</figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->

		<!-- wp:spacer {"height":"var:preset|spacing|40"} -->
		<div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
		<div class="wp-block-columns alignwide"><!-- wp:column {"width":"50%"} -->
			<div class="wp-block-column" style="flex-basis:50%">
				<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"d-block w-100 is-style-rounded"} -->
				<figure class="wp-block-image size-large d-block w-100 is-style-rounded">
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/windows.webp" alt="<?php esc_attr_e('Windows of a building in Nuremberg, Germany', 'systempress'); ?>" />
				</figure>
				<!-- /wp:image -->
			</div>
			<!-- /wp:column -->

			<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
			<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:heading {"level":5,"fontSize":"xx-large"} -->
				<h5 class="wp-block-heading has-xx-large-font-size">Études Newsletter</h5>
				<!-- /wp:heading -->

				<!-- wp:list {"style":{"typography":{"lineHeight":"1.75"}},"className":"is-style-checkmark-list"} -->
				<ul style="line-height:1.75" class="is-style-checkmark-list"><!-- wp:list-item -->
					<li>A world of thought-provoking articles.</li>
					<!-- /wp:list-item -->

					<!-- wp:list-item -->
					<li>Case studies that celebrate architecture.</li>
					<!-- /wp:list-item -->

					<!-- wp:list-item -->
					<li>Exclusive access to design insights.</li>
					<!-- /wp:list-item -->
				</ul>
				<!-- /wp:list -->
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->