<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Popup Maker's admin script collides with our own scripts and breaks our admin pages.
 * 
 * This script deregisters Popup Maker's script from SliceWP's admin pages.
 * 
 */
function slicewp_compatibility_deregister_popup_maker_admin_script() {
	
	if ( empty( $_GET['page'] ) )
		return;
	
	if ( false === strpos( $_GET['page'], 'slicewp' ) )
		return;
	
	wp_deregister_script( 'pum-admin-general' );
	
}
add_action( 'admin_enqueue_scripts', 'slicewp_compatibility_deregister_popup_maker_admin_script', 100 );