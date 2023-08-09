<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


Class SliceWP_Submenu_Page_Add_Ons extends SliceWP_Submenu_Page {

	/**
	 * Callback for the HTML output for the Add-ons page
	 *
	 */
	public function output() {

		// Get cached add-ons.
		$remote_add_ons = get_option( 'slicewp_remote_add_ons', array() );

		// Check if there are any values set. If there aren't pull from the server.
		if ( empty( $remote_add_ons['add_ons'] ) || $remote_add_ons['time_updated'] < time() - 2 * HOUR_IN_SECONDS ) {

			$add_ons = $this->remote_get_add_ons();

			if ( ! empty( $add_ons ) )
				update_option( 'slicewp_remote_add_ons', array( 'add_ons' => $add_ons, 'time_updated' => time() ) );

		} else {

			$add_ons = $remote_add_ons['add_ons'];

		}

		// Switch the add-on url from the landing page to the account download page, if the website is registered.
		foreach ( $add_ons as $key => $add_on ) {

			if ( slicewp_is_website_registered() ) {

				$add_ons[$key]['url'] = 'https://slicewp.com/account/?tab=file-downloads';

			}

		}

		// Sort add-ons.
		$add_ons_order = array(
			'affiliate-coupons',
			'custom-affiliate-fields',
			'paypal-payouts',
			'multi-level-affiliates',
			'store-credit',
			'mailchimp-integration',
			'custom-affiliate-slug',
			'recurring-commissions',
			'mailerlite-integration',
			'lead-commissions',
			'product-commission-rates',
			'convertkit-integration',
			'reports',
			'lifetime-commissions',
			'affiliate-leaderboard',
			'affiliate-start-id',
			'cross-site-tracking',
			'import-export',
			'affiliate-social-share',
			'custom-conversion',
			'affiliate-commission-rates'
		);

		$_add_ons = array();

		foreach ( $add_ons_order as $add_on_slug ) {

			foreach ( $add_ons as $add_on ) {

				if ( empty( $add_on['slug'] ) )
					continue;

				if ( $add_on['slug'] == $add_on_slug ) {
					$_add_ons[] = $add_on;
				}

			}

		}

		$add_ons = $_add_ons;

		// Display add-ons page
		if ( empty( $this->current_subpage ) )
			include 'views/view-add-ons.php';

	}


	/**
	 * Connects to the server to pull new information regarding add-ons
	 *
	 * @return array
	 *
	 */
	protected function remote_get_add_ons() {

		$add_ons  = array();
		$response = wp_remote_get( 'https://slicewp.com/wp-content/uploads/add-ons.json', array( 'sslverify' => false, 'timeout' => 15 ) );

		if( ! is_wp_error( $response ) ) {

			$add_ons = json_decode( wp_remote_retrieve_body( $response ), true );

		}

		return $add_ons;

	}

}