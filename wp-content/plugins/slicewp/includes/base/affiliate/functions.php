<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Includes the files needed for the affiliates
 *
 */
function slicewp_include_files_affiliate() {

	// Get affiliate dir path
	$dir_path = plugin_dir_path( __FILE__ );

	// Include main affiliate class
	if( file_exists( $dir_path . 'class-affiliate.php' ) )
		include $dir_path . 'class-affiliate.php';

	// Include the db layer classes
	if( file_exists( $dir_path . 'class-object-db-affiliates.php' ) )
		include $dir_path . 'class-object-db-affiliates.php';

	if( file_exists( $dir_path . 'class-object-meta-db-affiliates.php' ) )
		include $dir_path . 'class-object-meta-db-affiliates.php';

}
add_action( 'slicewp_include_files', 'slicewp_include_files_affiliate' );


/**
 * Register the class that handles database queries for the affiliates
 *
 * @param array $classes
 *
 * @return array
 *
 */
function slicewp_register_database_classes_affiliates( $classes ) {

	$classes['affiliates']    = 'SliceWP_Object_DB_Affiliates';
	$classes['affiliatemeta'] = 'SliceWP_Object_Meta_DB_Affiliates';

	return $classes;

}
add_filter( 'slicewp_register_database_classes', 'slicewp_register_database_classes_affiliates' );


/**
 * Returns an array with SliceWP_Affiliate objects from the database
 *
 * @param array $args
 * @param bool  $count
 *
 * @return array
 *
 */
function slicewp_get_affiliates( $args = array(), $count = false ) {

	$affiliates = slicewp()->db['affiliates']->get_affiliates( $args, $count );

	/**
	 * Add a filter hook just before returning
	 *
	 * @param array $affiliates
	 * @param array $args
	 * @param bool  $count
	 *
	 */
	return apply_filters( 'slicewp_get_affiliates', $affiliates, $args, $count );

}


/**
 * Gets a affiliate from the database
 *
 * @param mixed int|object      - affiliate id or object representing the affiliate
 *
 * @return SliceWP_Affiliate|null
 *
 */
function slicewp_get_affiliate( $affiliate ) {

	return slicewp()->db['affiliates']->get_object( $affiliate );

}


/**
 * Returns an affiliate from the database based on the given user_id
 *
 * @param int $user_id
 *
 * @return SliceWP_Affiliate|null
 *
 */
function slicewp_get_affiliate_by_user_id( $user_id ) {

	if( empty( $user_id ) )
		return null;

	$affiliates = slicewp_get_affiliates( array( 'user_id' => $user_id ) );

	if( empty( $affiliates ) )
		return null;

	if( ! $affiliates[0] instanceof SliceWP_Affiliate )
		return null;

	return $affiliates[0];

}


/**
 * Returns an affiliate from the database based on the given user_email
 *
 * @param string $user_email
 *
 * @return SliceWP_Affiliate|null
 *
 */
function slicewp_get_affiliate_by_user_email( $user_email ) {

	$user = get_user_by( 'email', $user_email );

	if( empty( $user ) )
		return null;

	$affiliate = slicewp_get_affiliate_by_user_id( $user->ID );

	return $affiliate;

}


/**
 * Checks to see if the given affiliate has the given email address attached
 *
 * @param int 	 $affiliate_id
 * @param string $email
 *
 * @return bool
 *
 */
function slicewp_affiliate_has_email( $affiliate_id, $email ) {

	$return    = false;
	$affiliate = slicewp_get_affiliate_by_user_email( $email );

	if ( ! is_null( $affiliate ) && $affiliate->get('id') == $affiliate_id )
		$return = true;

	/**
	 * Filter the value before returning
	 *
	 * @param bool   $return
	 * @param int    $affiliate_id
	 * @param string $email
	 *
	 */
	$return = apply_filters( 'slicewp_affiliate_has_email', $return, $affiliate_id, $email );

	return (bool)$return;

}


/**
 * Inserts a new affiliate into the database
 *
 * @param array $data
 *
 * @return mixed int|false
 *
 */
function slicewp_insert_affiliate( $data ) {

	return slicewp()->db['affiliates']->insert( $data );

}

/**
 * Updates a affiliate from the database
 *
 * @param int 	$affiliate_id
 * @param array $data
 *
 * @return bool
 *
 */
function slicewp_update_affiliate( $affiliate_id, $data ) {

	return slicewp()->db['affiliates']->update( $affiliate_id, $data );

}

/**
 * Deletes an affiliate from the database.
 * Will delete all affiliate metadata, commissions and visits.
 *
 * @param int $affiliate_id
 *
 * @return bool
 *
 */
function slicewp_delete_affiliate( $affiliate_id ) {

	$affiliate = slicewp_get_affiliate( $affiliate_id );

	if ( is_null( $affiliate ) ) {
		return false;
	}

	$deleted = slicewp()->db['affiliates']->delete( $affiliate_id );

	if ( ! $deleted ) {
		return false;
	}

	// Delete the affiliate's metadata.
	$affiliate_meta = slicewp_get_affiliate_meta( $affiliate_id );

	if ( ! empty( $affiliate_meta ) ) {

		foreach( $affiliate_meta as $key => $value ) {

			slicewp_delete_affiliate_meta( $affiliate_id, $key );

		}

	}

	// Delete affiliate visits.
	$visits_ids = slicewp_get_visits( array( 'number' => -1, 'affiliate_id' => absint( $affiliate_id ), 'fields' => 'id' ) );

	if ( ! empty( $visits_ids ) ) {

		foreach ( $visits_ids as $visit_id ) {

			slicewp_delete_visit( $visit_id );

		}

	}

	// Delete affiliate commissions.
	$commissions_ids = slicewp_get_commissions( array( 'number' => -1, 'affiliate_id' => absint( $affiliate_id ), 'fields' => 'id' ) );

	if ( ! empty( $commissions_ids ) ) {

		foreach ( $commissions_ids as $commission_id ) {

			slicewp_delete_commission( $commission_id );

		}

	}

	return true;

}

/**
 * Inserts a new meta entry for the affiliate
 *
 * @param int    $affiliate_id
 * @param string $meta_key
 * @param string $meta_value
 * @param bool   $unique
 *
 * @return mixed int|false
 *
 */
function slicewp_add_affiliate_meta( $affiliate_id, $meta_key, $meta_value, $unique = false ) {

	return slicewp()->db['affiliatemeta']->add( $affiliate_id, $meta_key, $meta_value, $unique );

}

/**
 * Updates a meta entry for the affiliate
 *
 * @param int    $affiliate_id
 * @param string $meta_key
 * @param string $meta_value
 * @param bool   $prev_value
 *
 * @return bool
 *
 */
function slicewp_update_affiliate_meta( $affiliate_id, $meta_key, $meta_value, $prev_value = '' ) {

	return slicewp()->db['affiliatemeta']->update( $affiliate_id, $meta_key, $meta_value, $prev_value );

}

/**
 * Returns a meta entry for the affiliate
 *
 * @param int    $affiliate_id
 * @param string $meta_key
 * @param bool   $single
 *
 * @return mixed
 *
 */
function slicewp_get_affiliate_meta( $affiliate_id, $meta_key = '', $single = false ) {

	return slicewp()->db['affiliatemeta']->get( $affiliate_id, $meta_key, $single );

}

/**
 * Removes a meta entry for the affiliate
 *
 * @param int    $affiliate_id
 * @param string $meta_key
 * @param string $meta_value
 * @param bool   $delete_all
 *
 * @return bool
 *
 */
function slicewp_delete_affiliate_meta( $affiliate_id, $meta_key, $meta_value = '', $delete_all = '' ) {

	return slicewp()->db['affiliatemeta']->delete( $affiliate_id, $meta_key, $meta_value, $delete_all );

}


/**
 * Returns the display name of the affiliate
 *
 * @param mixed int|object - affiliate id or object representing the affiliate
 *
 * @return string|null
 *
 */
function slicewp_get_affiliate_name( $affiliate ) {

	$affiliate = slicewp_get_affiliate( $affiliate );

	if ( null == $affiliate )
		return null;

	if ( false === $affiliate )
		return null;

	$user = get_user_by( 'id', $affiliate->get( 'user_id' ) );

	if ( false === $user )
		return null;

	$affiliate_name = $user->first_name . ' ' . $user->last_name;

	if ( empty( trim( $affiliate_name ) ) )
		$affiliate_name = $user->display_name;

	/**
	 * Filter the affiliate name before returning the value.
	 * 
	 * @param string $affiliate_name
	 * @param int    $affiliate_id
	 * 
	 */
	$affiliate_name = apply_filters( 'slicewp_get_affiliate_name', $affiliate_name, $affiliate->get( 'id' ) );

	return $affiliate_name;

}


/**
 * Returns the affiliate's email address
 *
 * @param mixed int|object - affiliate id or object representing the affiliate
 *
 * @return string|null
 *
 */
function slicewp_get_affiliate_email( $affiliate ) {

	$affiliate = slicewp_get_affiliate( $affiliate );

	if ( is_null( $affiliate ) )
		return null;

	$user = get_user_by( 'id', $affiliate->get( 'user_id' ) );

	if ( false === $user )
		return null;

	return $user->user_email;

}


/**
 * Returns an array with the possible statuses the Affiliate can have
 *
 * @return array
 *
 */
function slicewp_get_affiliate_available_statuses() {

	$statuses = array(
		'active'   => __( 'Active', 'slicewp' ),
		'inactive' => __( 'Inactive', 'slicewp' ),
		'pending'  => __( 'Pending', 'slicewp' ),
		'rejected' => __( 'Rejected', 'slicewp' )
	);

	/**
	 * Filter the available statuses just before returning
	 *
	 * @param array $statuses
	 *
	 */
	$statuses = apply_filters( 'slicewp_affiliate_available_statuses', $statuses );

	return $statuses;

}


/**
 * Returns the number of paid earnings for an affiliate
 *
 * @param int $affiliate_id
 *
 * @return string
 *
 */
function slicewp_get_affiliate_earnings_paid( $affiliate_id ) {

	$commissions_args = array(
		'number' 	   => -1,
		'affiliate_id' => absint( $affiliate_id ),
		'fields'	   => 'amount',
		'status'	   => 'paid'
	);

	$commissions = slicewp_get_commissions( $commissions_args );

	return slicewp_format_amount( array_sum( $commissions ), slicewp_get_setting( 'active_currency', 'USD' ) );

}


/**
 * Returns the number of unpaid earnings for an affiliate
 *
 * @param int $affiliate_id
 *
 * @return string
 *
 */
function slicewp_get_affiliate_earnings_unpaid( $affiliate_id ) {

	$commissions_args = array(
		'number' 	   => -1,
		'affiliate_id' => absint( $affiliate_id ),
		'fields'	   => 'amount',
		'status'	   => 'unpaid'
	);

	$commissions = slicewp_get_commissions( $commissions_args );

	return slicewp_format_amount( array_sum( $commissions ), slicewp_get_setting( 'active_currency', 'USD' ) );

}


/**
 * Verify if a user is an affiliate.
 *
 * @param int $user_id (optional)
 *
 * @return bool
 * 
 */
function slicewp_is_user_affiliate( $user_id = 0 ) {

    // Get the current user ID
    $user_id = ( ! empty( $user_id ) ? absint( $user_id ) : get_current_user_id() );

    if ( empty ( $user_id ) )
        return false;

    // Verify if the user is also affiliate
    $affiliate = slicewp_get_affiliate_by_user_id( $user_id );

    return ( empty( $affiliate ) ) ? false : true;

}


/**
 * Returns the current user's affiliate id.
 * 
 * @return int
 * 
 */
function slicewp_get_current_affiliate_id() {
	
	// Get the user's Affiliate ID
	$affiliate = slicewp_get_affiliate_by_user_id( get_current_user_id() );
	
	return ( ! is_null( $affiliate ) ? absint( $affiliate->get('id') ) : 0 );

}


/**
 * Returns the base URL on top of which the actual affiliate referral URL is built.
 *
 * @return string
 *
 */
function slicewp_get_affiliate_url_base() {

	// Get the base URL from the settings.
	$base_url = slicewp_get_setting( 'affiliate_url_base', '' );

	// If there's no base URL in the settings or the URL is not valid, default to site_url().
	if ( empty( $base_url ) || filter_var( $base_url, FILTER_VALIDATE_URL ) === false ) {

		$base_url = site_url();

	}

	/**
     * Set and filter the base URL of the affiliate URL.
     *
     * @param string $base_url
     *
     */
    $base_url = apply_filters( 'slicewp_affiliate_url_base', $base_url );

    return $base_url;

}


/**
 * Returns the value for the referral query argument that is added to the affiliate referral URL.
 *
 * @param int $affiliate_id
 *
 * @return int|string
 *
 */
function slicewp_get_affiliate_url_referral_query_arg_value( $affiliate_id, $format = 'id' ) {

	$query_arg_value = $affiliate_id;

	/**
	 * Filter the value of the referral query argument.
	 *
	 * @param mixed  $query_arg_value
	 * @param int    $affiliate_id
	 * @param string $format
	 *
	 */
	$query_arg_value = apply_filters( 'slicewp_affiliate_url_referral_query_arg_value', $query_arg_value, $affiliate_id, $format );

	return $query_arg_value;

}


/**
 * Generate the affiliate URL
 *
 * @param int 	 $affiliate_id
 * @param string $url
 * @param string $format
 *
 * @return string|null
 *
 */
function slicewp_get_affiliate_url( $affiliate_id, $url = '', $format = 'id' ) {
    
    // Verify the affiliate status.
    $affiliate = slicewp_get_affiliate( $affiliate_id );

	if( is_null( $affiliate ) )
		return null;

    // Set URL to be used.
    $url = ( ! empty( $url ) ? $url : slicewp_get_affiliate_url_base() );
	
	// Add a slash at the end of the url.
	$url = trailingslashit( $url );
	
	// Get the settings needed for Affiliate URL creation.
    $affiliate_keyword 		= slicewp_get_setting( 'affiliate_keyword' );
    $affiliate_friendly_url = slicewp_get_setting( 'friendly_affiliate_url' );

    // Get the referral query arg value.
	$query_arg_value = slicewp_get_affiliate_url_referral_query_arg_value( $affiliate_id, $format );

    // Verify if we create pretty Affiliate URLs.
    if ( empty( $affiliate_friendly_url ) ) {

        $url = add_query_arg( array( $affiliate_keyword => $query_arg_value ), $url );
        
    } else {

        $url .= $affiliate_keyword . '/' . $query_arg_value . '/';

    }

    /**
     * Filter the affiliate URL before returning it.
     *
     * @param string $url
     * @param int    $affiliate_id
     *
     */
    $url = apply_filters( 'slicewp_get_affiliate_url', $url, $affiliate_id );

    // Return the URL.
    return $url;

}


/**
 * Returns the payout method selected for the affiliate.
 * Defaults to the default payout method selected in settings.
 * 
 * @param int $affiliate_id
 * 
 * @return string
 * 
 */
function slicewp_get_affiliate_payout_method( $affiliate_id ) {

	// Get affiliate payout method.
	$payout_method = slicewp_get_affiliate_meta( $affiliate_id, 'payout_method', true );

	// Make sure the selected method is registered.
	$payout_methods = slicewp_get_payout_methods();

	// Default to settings payout method.
	if ( empty( $payout_method ) || ! in_array( $payout_method, array_keys( $payout_methods ) ) ) {

		$payout_method = slicewp_get_default_payout_method();

	}

	return $payout_method;

}


/**
 * Returns the status of the given affiliate.
 *
 * @param int $affiliate_id
 *
 * @return string|null
 *
 */
function slicewp_get_affiliate_status( $affiliate_id ) {

	$affiliate = slicewp_get_affiliate( $affiliate_id );

	return ( ! is_null( $affiliate ) ? $affiliate->get( 'status' ) : null );

}


/**
 * Verifies if a received affiliate id is valid
 *
 * @param int $affiliate_id
 * 
 * @return bool
 *
 */
function slicewp_is_affiliate_valid( $affiliate_id ) {

	// Check that an affiliate id is received
	if ( empty( $affiliate_id ) )
		return false;

	// Get the affiliate data
	$affiliate = slicewp_get_affiliate( $affiliate_id );

	// No affiliate found
	if ( empty( $affiliate ) )
		return false;

	// Verify affiliate status
	if ( $affiliate->get( 'status' ) != 'active' )
		return false;

	// Affiliate is valid
	return true;

}


/**
 * Checks if the given affiliate is active or not.
 *
 * @param int $affiliate_id
 *
 * @return bool
 *
 */
function slicewp_is_affiliate_active( $affiliate_id ) {

	return ( 'active' == slicewp_get_affiliate_status( $affiliate_id ) ? true : false );

}


/**
 * Get the Affiliate Commission Rates
 *
 * @param int $affiliate_id
 *
 * @return array $affiliate_commission_rates
 *
 */
function slicewp_get_affiliate_commission_rates( $affiliate_id ) {

	// Get the default commission rates
	$commission_types = slicewp_get_available_commission_types( true );
	
	// Save the default commission rates
	$affiliate_commission_rates = array();

	foreach ( $commission_types as $type => $details ) {

		// Skip recurring commission type
		if( $type == 'recurring' )
			continue;

		$affiliate_commission_rates[$type]['rate']	 	= slicewp_get_setting( 'commission_rate_' . $type );
		$affiliate_commission_rates[$type]['rate_type']	= slicewp_get_setting( 'commission_rate_type_' . $type );

	}

	/**
	 * Filter the affiliate commission rates
	 *
	 * @param array $affiliate_commission_rates
	 * @param int   $affiliate_id
	 *
	 */
	return apply_filters( 'slicewp_affiliate_commission_rates', $affiliate_commission_rates, $affiliate_id );

}


/**
 * Adds the "affiliate" user role to WordPress
 *
 */
function slicewp_register_affiliate_user_role() {

	add_role( 'slicewp_affiliate', __( 'Affiliate', 'slicewp' ), array( 'read' ) );

}
add_action( 'slicewp_update_check', 'slicewp_register_affiliate_user_role' );


/**
 * Adds the "slicewp_affiliate" user role to the user when the affiliate is added to the database
 *
 * @param int   $affiliate_id
 * @param array $affiliate_data
 *
 */
function slicewp_add_user_role_affiliate( $affiliate_id, $affiliate_data ) {

	if( empty( $affiliate_data['user_id'] ) )
		return;

	$user = new WP_User( absint( $affiliate_data['user_id'] ) );

	$user->add_role( 'slicewp_affiliate' );

}
add_action( 'slicewp_insert_affiliate', 'slicewp_add_user_role_affiliate', 10, 2 );


/**
 * Removes the "slicewp_affiliate" user role from the user when the affiliate is deleted from the database
 *
 * @param int $affiliate_id
 *
 */
function slicewp_remove_user_role_affiliate( $affiliate_id ) {

	$affiliate = slicewp_get_affiliate( $affiliate_id );

	if( is_null( $affiliate ) )
		return;

	$user = new WP_User( absint( $affiliate->get( 'user_id' ) ) );

	$user->remove_role( 'slicewp_affiliate' );

}
add_action( 'slicewp_pre_delete_affiliate', 'slicewp_remove_user_role_affiliate', 10, 1 );


/**
 * Adds/removes the "slicewp_affiliate" user role to an affiliate user when updating the user's profile
 *
 * @param int $user_id
 *
 */
function slicewp_user_profile_update_user_role_affiliate( $user_id ) {

	$user 	   = new WP_User( absint( $user_id ) );
	$affiliate = slicewp_get_affiliate_by_user_id( absint( $user_id ) );

	if( ! is_null( $affiliate ) ) {

		$user->add_role( 'slicewp_affiliate' );

	} else {

		$user->remove_role( 'slicewp_affiliate' );

	}

}
add_action( 'profile_update', 'slicewp_user_profile_update_user_role_affiliate' );


/**
 * Automatically register an affiliate when a user is registered
 *
 * @param int $user_id
 *
 */
function slicewp_user_register_auto_register_affiliate( $user_id ) {

	// Bail if the action is done in the admin area
	if ( ! wp_doing_ajax() && is_admin() )
		return;

	// Bail if the user is registering manually
	if ( did_action( 'slicewp_user_action_register_affiliate' ) )
		return;

	$affiliate_auto_register = slicewp_get_setting( 'affiliate_auto_register' );

	// Bail if the auto register option isn't enabled
	if ( empty( $affiliate_auto_register ) )
		return;

	// Verify the status to be used for the affiliate
    $affiliate_register_status_active = slicewp_get_setting( 'affiliate_register_status_active' );

	// Check if affiliate already exists.
	$affiliate = slicewp_get_affiliate_by_user_id( $user_id );

	if ( ! is_null( $affiliate ) )
		return;

    // Get user
    $user = get_userdata( $user_id );

    // Prepare affiliate data to be inserted in db
    $affiliate_data = array(
        'user_id' 		=> absint( $user_id ),
        'date_created'  => slicewp_mysql_gmdate(),
        'date_modified' => slicewp_mysql_gmdate(),
        'payment_email' => ( ! empty( $user->user_email ) ? sanitize_email( $user->user_email ) : '' ),
        'website'       => ( ! empty( $user->user_url ) ? esc_url( $user->user_url ) : '' ),
        'status'		=> ( ( $affiliate_register_status_active == 1 ) ? 'active' : 'pending' )
    );

    // Insert affiliate in db
    $affiliate_id = slicewp_insert_affiliate( $affiliate_data );

}
add_action( 'user_register', 'slicewp_user_register_auto_register_affiliate' );