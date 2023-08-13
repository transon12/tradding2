<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<div class="wrap slicewp-wrap slicewp-wrap-add-ons">

	<!-- Page Heading -->
	<h1 class="wp-heading-inline"><?php echo __( 'Add-ons', 'slicewp' ); ?></h1>
	<hr class="wp-header-end" />

	<?php if ( empty( $add_ons ) ): ?>

		<p><?php echo __( 'Something went wrong. Could not connect to the server to retrieve the add-ons. Please refresh the page to try again.', 'slicewp' ); ?></p>

	<?php else: ?>

		<?php if ( ! slicewp_add_ons_exist() ): ?>

			<div class="slicewp-card slicewp-card-price-notice">
				<div class="slicewp-card-inner">
					<span><?php echo __( 'Take your affiliate program to the next level!', 'slicewp' ); ?></span>
					<p><?php echo __( 'Extend your affiliate program with the PRO growth tools your affiliates need to stand out in a crowded market.', 'slicewp' ); ?></p>
					<a href="https://slicewp.com/pricing/?utm_source=plugin-free&amp;utm_medium=plugin-add-ons-page&amp;utm_campaign=SliceWPFree" target="_blank" class="slicewp-button-secondary"><?php echo __( 'Get started with PRO', 'slicewp' ); ?></a>
				</div>
			</div>

		<?php endif; ?>

		<div class="slicewp-grid slicewp-grid-columns-3" style="margin-top: 1.5rem;">

			<?php foreach ( $add_ons as $add_on ): ?>

				<div class="slicewp-card slicewp-card-add-on">

					<div class="slicewp-card-inner">

						<div class="slicewp-flex">

							<div>
								<?php if ( ! empty( $add_on['slug'] ) ): ?>
									<img src="<?php echo SLICEWP_PLUGIN_DIR_URL . '/assets/img/add-on-icon-' . esc_attr( $add_on['slug'] ) . '.png'; ?>" />
								<?php endif; ?>
							</div>

							<div>
								<h4><?php echo esc_html( $add_on['name'] ); ?></h4>
								<p><?php echo esc_html( $add_on['description'] ); ?></p>
							</div>

						</div>

					</div>

					<div class="slicewp-card-footer">
						<a href="<?php echo esc_url( add_query_arg( array( 'utm_source' => 'add-on-' . sanitize_title( $add_on['name'] ), 'utm_medium' => 'plugin-add-ons-page', 'utm_campaign' => 'SliceWPFree' ), $add_on['url'] ) ); ?>" target="_blank" class="slicewp-button-secondary"><?php echo __( 'Get this add-on', 'slicewp' ) ?></a>
					</div>

				</div>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

</div>