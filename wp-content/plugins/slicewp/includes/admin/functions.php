<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Includes the files needed for the admin area
 *
 */
function slicewp_include_files_admin() {

	// Get dir path
	$dir_path = plugin_dir_path( __FILE__ );

	// Include the admin promo functions
	if( file_exists( $dir_path . 'functions-promo.php' ) )
		include $dir_path . 'functions-promo.php';

	// Include the admin notices classes
	if( file_exists( $dir_path . 'class-admin-notices.php' ) )
		include $dir_path . 'class-admin-notices.php';

	// Include the admin notifications classes
	if( file_exists( $dir_path . 'class-admin-dashboard-notifications.php' ) )
		include $dir_path . 'class-admin-dashboard-notifications.php';

	// Include the HelpScout beacon
	//if( file_exists( $dir_path . 'class-helpscout-beacon.php' ) )
		//include $dir_path . 'class-helpscout-beacon.php';

	// Include the deactivation class
	//if( file_exists( $dir_path . 'class-deactivation.php' ) )
		//include $dir_path . 'class-deactivation.php';

}
add_action( 'slicewp_include_files', 'slicewp_include_files_admin' );


/**
 * Adds a central action hook on the admin_init that the plugin and add-ons
 * can use to do certain actions, like adding a new affiliate, editing an affiliate, deleting, etc.
 *
 */
function slicewp_register_admin_do_actions() {

	if ( empty( $_REQUEST['slicewp_action'] ) )
		return;

	$action = sanitize_text_field( $_REQUEST['slicewp_action'] );

	/**
	 * Hook that should be used by all processes that make a certain action
	 * withing the plugin, like adding a new affiliate, editing an affiliate, deleting, etc.
	 *
	 */
	do_action( 'slicewp_admin_action_' . $action );

}
add_action( 'admin_init', 'slicewp_register_admin_do_actions' );


/**
 * Verifies if the given action is currently in process.
 *
 * @param string $action
 *
 * @return bool
 *
 */
function slicewp_verify_request_action( $action ) {

	if ( empty( $_REQUEST['slicewp_action'] ) )
		return false;

	if ( $_REQUEST['slicewp_action'] != $action )
		return false;

	if ( empty( $_REQUEST['slicewp_token'] ) )
		return false;

	if ( ! wp_verify_nonce( $_REQUEST['slicewp_token'], 'slicewp_' . $action ) )
		return false;

	return true;

}


/**
 * Prints a tooltip helper into the page
 *
 * @param string $message
 *
 */
function slicewp_output_tooltip( $message ) {

	$output  = '<span class="slicewp-tooltip-wrapper">';

		// Icon
		$output .= '<svg class="slicewp-tooltip-icon" height="18" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path d="M13 9h-2V7h2v2zm0 2h-2v6h2v-6zm-1-7c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8m0-2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"></path></g></svg>';

		// Message
		$output .= '<span class="slicewp-tooltip-message">';

			$output .= $message;

			// Arrow
			$output .= '<span class="slicewp-tooltip-arrow"></span>';

		$output .= '</span>';

	$output .= '</span>';

	echo $output;

}


/**
 * Prints a progressbar into the page
 *
 * @param int|bool $progress
 *
 */
function slicewp_output_progressbar( $progress, $return = false ) {

	$output  = '<div class="slicewp-progressbar">';

		if( empty( $progress ) )
			$output .= '<span class="slicewp-progressbar-empty">0%</span>';

		else
			$output .= '<span class="slicewp-progressbar-fill" style="width: ' . esc_attr( $progress ) . '%">' . $progress . '%</span>';

	$output .= '</div>';

	if( ! $return )
		echo $output;
	else
		return $output;

}


/**
 * Outputs a select2 field to select one or multiple users or affiliates.
 * 
 * @param array $args
 * 
 */
function slicewp_output_select2_user_search( $args, $return = false ) {

	$defaults = array(
		'is_multiple'  => false,
		'is_disabled'  => false,
		'placeholder'  => '',
		'id'		   => 'slicewp-user-search',
		'name'		   => 'user_search',
		'value'		   => '',
		'user_type'	   => '', // Possible values are 'affiliate', 'non_affiliate'
	);

	$args = wp_parse_args( $args, $defaults );

	// Build the selected options.
	$selected_options = array();

	if ( ! empty( $args['value'] ) ) {

		$object_ids = array_unique( is_array( $args['value'] ) ? array_map( 'trim', $args['value'] ) : array( absint( $args['value'] ) ) );

		foreach ( $object_ids as $object_id ) {

			if ( $args['user_type'] == 'affiliate' ) {

				$affiliate = slicewp_get_affiliate( $object_id );

				$user = get_userdata( ! is_null( $affiliate ) ? $affiliate->get( 'user_id' ) : 0 );
				
			} else {

				$user = get_userdata( $object_id );

			}

			if ( ! $user )
				continue;

			$display_name = $user->first_name . ' ' . $user->last_name;
			$display_name = ( ! empty( trim( $display_name ) ) ? $display_name : $user->display_name );

			$selected_options[$object_id] = $display_name . ' (' . $user->user_email . ')';

		}

	}

	// Prepare the output.
	$output = '<select id="' . esc_attr( $args['id'] ) . '" name="' . $args['name'] . ( $args['is_multiple'] ? '[]' : '' ) .  '" class="slicewp-select2-users-autocomplete" data-affiliates="' . ( $args['user_type'] == 'affiliate' ? 'include' : ( $args['user_type'] == 'non_affiliate' ? 'exclude' : '' ) ) . '" data-return-value="' . ( $args['user_type'] == 'affiliate' ? 'affiliate_id' : 'user_id' ) . '" ' . ( $args['is_multiple'] ? 'multiple' : '' ) . ' ' . ( $args['is_disabled'] ? 'disabled' : '' ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" nonce="' . wp_create_nonce( 'slicewp_user_search' ) . '">';

		foreach ( $selected_options as $key => $label ) {

			$output .= '<option value="' . absint( $key ) . '">' . $label . '</option>';

		}

	$output .= '</select>';

	if ( ! $return )
		echo $output;
	else
		return $output;

}


/**
 * Register and display an admin notice if any add-ons exist, yet the website isn't registered
 *
 */
function slicewp_register_website_admin_notice() {

	if( ! slicewp_add_ons_exist() )
		return;

	if( slicewp_is_website_registered() )
		return;

	slicewp_admin_notices()->register_notice( 'slicewp_not_registered', '<p>' . sprintf( __( 'Your %sSliceWP%s license key is missing. To receive automatic updates and technical support, please %sregister your website in SliceWP &rarr; Settings%s', 'slicewp' ), '<strong>', '</strong>', '<a href="' . add_query_arg( array( 'page' => 'slicewp-settings' ), 'admin.php' ) . '">', '</a>' ) . '</p>', 'notice-info' );
	slicewp_admin_notices()->display_notice( 'slicewp_not_registered' );

}
add_action( 'admin_init', 'slicewp_register_website_admin_notice' );


/**
 * Register core admin dashboard notifications.
 *
 */
function slicewp_register_admin_dashboard_notification() {

	// For pending affiliates.
	$pending_affiliates = slicewp_get_affiliates( array( 'status' => 'pending' ), true );

	if ( ! empty( $pending_affiliates ) ) {

		slicewp_admin_dashboard_notifications()->register_notification( 'pending_affiliates', '<p>' . sprintf( __( 'You have %d affiliate(s) pending approval.', 'slicewp' ), $pending_affiliates ) . '</p><p><a href="' . add_query_arg( array( 'page' => 'slicewp-affiliates', 'affiliate_status' => 'pending' ), admin_url( 'admin.php' ) ) . '">' . __( 'View pending applications', 'slicewp' ) . '</a></p>' );

	}

	// For pending affiliate payments.
	$due_payments = slicewp_generate_payout_payments_preview( array( 'date_range' => 'up_to', 'payments_minimum_amount' => slicewp_get_setting( 'payments_minimum_amount', 0 ) ) );

	if ( ! empty( $due_payments ) ) {

		slicewp_admin_dashboard_notifications()->register_notification( 'due_payments', '<p>' . sprintf( __( 'You have %d affiliate(s) that are eligible for payment, totalling %s.', 'slicewp' ), count( $due_payments ), slicewp_format_amount( array_sum( array_column( $due_payments, 'amount' ) ), slicewp_get_setting( 'active_currency', 'USD' ) ) ) . '</p><p><a href="' . add_query_arg( array( 'page' => 'slicewp-payouts', 'subpage' => 'preview-payout', 'date_range' => 'up_to', 'payments_minimum_amount' => slicewp_get_setting( 'payments_minimum_amount', 0 ) ), admin_url( 'admin.php' ) ) . '">' . __( 'Preview affiliate payments', 'slicewp' ) . '</a></p>' );

	}

}
add_action( 'admin_init', 'slicewp_register_admin_dashboard_notification' );


/**
 * Adds a notification number in the main menu and submenu items when certain criteria is met,
 * similar to what is shown on the Plugins menu item when you have plugin updates.
 *
 */
function slicewp_add_admin_menu_notification() {

	global $menu, $submenu;

	if ( empty( $menu ) || ! is_array( $menu ) )
		return;

	if ( empty( $submenu ) || ! is_array( $submenu ) || empty( $submenu['slicewp-page'] ) )
		return;

	// Get admin dashboard notifications.
	$notifications_count = slicewp_admin_dashboard_notifications()->notifications_count();

	// Bail if we have nothing to show
	if ( empty( $notifications_count ) )
		return;

	// Add the number of notifications to the main menu item.
	foreach ( $menu as $index => $menu_item ) {

		if( empty( $menu_item[2] ) || $menu_item[2] != 'slicewp-page' )
			continue;

		$menu[$index][0] .= ' <span class="update-plugins slicewp-notifications-count"><span>' . $notifications_count . '</span></span>';

	}

	// Add the number of notifications to the dashboard page.
	foreach ( $submenu['slicewp-page'] as $index => $submenu_item ) {

		if( empty( $submenu_item[2] ) )
			continue;

		if( $submenu_item[2] != 'slicewp-dashboard' )
			continue;

		$submenu['slicewp-page'][$index][0] .= ' <span class="update-plugins slicewp-notifications-count"><span>' . $notifications_count . '</span></span>';

	}

}
add_action( 'admin_init', 'slicewp_add_admin_menu_notification', 1000 );


/**
 * Adds a header to the plugin's settings pages
 *
 */
function slicewp_admin_header() {

	if( empty( $_GET['page'] ) || false === strpos( $_GET['page'], 'slicewp' ) || $_GET['page'] == 'slicewp-setup' )
		return;

	?>

	<div id="slicewp-header">
		<a href="https://slicewp.com/" target="_blank">
			<img src="<?php echo SLICEWP_PLUGIN_DIR_URL; ?>/assets/img/slicewp-logo.png" />
		</a>

		<?php if( ! slicewp_is_website_registered() ): ?>
			<a href="https://wordpress.org/support/plugin/slicewp/" target="_blank" class="slicewp-button-secondary"><span class="dashicons dashicons-email-alt"></span><?php echo __( 'Support', 'slicewp' ); ?></a>
		<?php else: ?>
			<a href="https://slicewp.com/contact/?utm_source=header-contact&amp;utm_medium=plugin-admin&amp;utm_campaign=SliceWPFree" target="_blank" class="slicewp-button-secondary"><span class="dashicons dashicons-email-alt"></span><?php echo __( 'Support', 'slicewp' ); ?></a>
		<?php endif; ?>

		<a href="https://slicewp.com/docs/?utm_source=header-docs&amp;utm_medium=plugin-admin&amp;utm_campaign=SliceWPFree" target="_blank" class="slicewp-button-secondary"><span class="dashicons dashicons-book"></span><?php echo __( 'Documentation', 'slicewp' ); ?></a>

		<?php if( ! slicewp_is_website_registered() ): ?>
			<a href="https://slicewp.com/?utm_source=header-upgrade&amp;utm_medium=plugin-admin&amp;utm_campaign=SliceWPFree" target="_blank" class="slicewp-button-upgrade"><span class="dashicons dashicons-upload"></span><?php echo __( 'Upgrade to PRO', 'slicewp' ); ?></a>
		<?php endif; ?>

	</div>

	<?php

}
add_action( 'admin_notices', 'slicewp_admin_header', 1 );