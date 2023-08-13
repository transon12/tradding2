<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<form id="slicewp-affiliate-register-form" class="slicewp-form" action="" method="POST" enctype="multipart/form-data">

	<!-- Notices -->
	<?php do_action( 'slicewp_user_notices' ); ?>

	<?php 

		/**
		 * Hooks to output form fields
		 *
		 * @param string $form
		 *
		 */
		do_action( 'slicewp_form_fields', 'affiliate_registration' );

	?>

	<?php $page_terms_conditions = slicewp_get_setting( 'page_terms_conditions' ); ?>

	<?php if ( ! empty( $page_terms_conditions ) ): ?>

		<!-- Terms and Conditions -->
		<div class="slicewp-field-wrapper slicewp-field-wrapper-terms-and-conditions">

			<div class="slicewp-field-label-wrapper">

				<input id="slicewp-terms-and-conditions" name="terms_conditions" type="checkbox" value="1" <?php checked( ! empty( $_POST['terms_conditions'] ), '1' ) ?>/>
				<label for="slicewp-terms-and-conditions"><a href="<?php echo get_permalink( slicewp_get_setting( 'page_terms_conditions' ) ); ?>" target="_blank"><?php echo ( ! empty( slicewp_get_setting( 'terms_label' ) ) ? slicewp_get_setting( 'terms_label' ) :  __( 'Agree to Our Terms and Conditions', 'slicewp' ) ); ?></a></label>

			</div>

		</div>

	<?php endif; ?>

	<?php $recaptcha = slicewp_get_setting( 'enable_recaptcha' ); ?>

	<?php if( ! empty( $recaptcha ) ): ?>

		<!-- reCAPTCHA -->
		<div class="slicewp-field-wrapper slicewp-field-wrapper-recaptcha">

			<?php wp_enqueue_script( 'slicewp-recaptcha-async-defer', 'https://www.google.com/recaptcha/api.js' ); ?>
			<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( slicewp_get_setting( 'recaptcha_site_key' ) ); ?>"></div>
			<input type="hidden" name="g-recaptcha-remoteip" value="<?php echo esc_attr( slicewp_get_user_ip_address() ); ?>" />

		</div>

	<?php endif; ?>

	<!-- Action and nonce -->
	<input type="hidden" name="slicewp_hnp" autocomplete="off" value="" />
	<input type="hidden" name="slicewp_action" value="register_affiliate" />
	<?php wp_nonce_field( 'slicewp_register_affiliate', 'slicewp_token', false ); ?>

	<!-- Redirect URL -->
	<input type="hidden" name="redirect_url" value="<?php echo ( ! empty( $atts['redirect_url'] ) ? esc_url( $atts['redirect_url'] ) : '' ); ?>" />

	<!-- Submit -->
	<input type="submit" class="slicewp-button-primary" value="<?php echo apply_filters( 'slicewp_form_affiliate_registration_submit_button_label', __( 'Register', 'slicewp' ) ); ?>" />
	
</form>