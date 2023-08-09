<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<?php 

	/**
	 * Hook to add extra cards if needed to the Integrations tab
	 *
	 */
	do_action( 'slicewp_view_settings_tab_integrations_top' );

?>

<div class="slicewp-card">

	<?php foreach( slicewp()->integrations as $integration_slug => $integration ): ?>

		<?php if ( empty( $integration->get( 'supports' ) ) ) continue; ?>

		<div class="slicewp-card-integration-row">

			<!-- Integration Activation Switch -->
			<div class="slicewp-card-integration-switch">
				
				<div class="slicewp-switch">

					<input id="slicewp-integration-switch-<?php echo $integration_slug; ?>" class="slicewp-toggle slicewp-toggle-round" name="settings[active_integrations][]" type="checkbox" value="<?php echo $integration_slug; ?>" <?php checked( ! empty( $_POST['settings']['active_integrations'] ) && in_array( $integration_slug, $_POST['settings']['active_integrations'] ) ? '1' : ( empty( $_POST ) ? ( slicewp_is_integration_active( $integration_slug ) ? '1' : '' ) : '' ), '1' ); ?> data-supports="<?php echo htmlspecialchars( json_encode( $integration->get( 'supports' ) ), ENT_QUOTES, 'UTF-8' ); ?>" />
					<label for="slicewp-integration-switch-<?php echo $integration_slug; ?>"></label>

				</div>

			</div>

			<!-- Integration Name -->
			<div class="slicewp-card-integration-name">
				<?php echo $integration->get('name'); ?>
			</div>

		</div>

	<?php endforeach; ?>

</div>

<?php 

	/**
	 * Hook to add extra cards if needed to the Integrations tab
	 *
	 */
	do_action( 'slicewp_view_settings_tab_integrations_bottom' );

?>

<!-- Save Settings Button -->
<input type="submit" class="slicewp-form-submit slicewp-button-primary" value="<?php echo __( 'Save Settings', 'slicewp' ); ?>" />