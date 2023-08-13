<?php
/**
 * Class LP_PMS_Handle_Curl
 *
 * @desription Handle curl
 *
 * @version    1.0.0
 * @since      3.1.10
 * @author     tungnx
 */

class LP_PMS_Handle_Curl {
	/**
	 * @param array  $headers
	 * @param string $method
	 * @param string $params
	 *
	 * @return false|resource
	 */
	public static function curl( $method = 'GET', $params = '', $headers = array() ) {
		$url_handle = home_url() . '/wp-admin/admin-ajax.php';

		$curl = curl_init();

		if ( $method == 'GET' ) {
			$url_handle .= '?' . $params;
		}

		curl_setopt_array(
			$curl,
			array(
				CURLOPT_URL            => $url_handle,
				CURLOPT_HEADER         => false,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPHEADER     => $headers,
			)
		);

		if ( $method == 'GET' ) {
			curl_setopt( $curl, CURLOPT_HTTPGET, true );
		} elseif ( $method == 'POST' || $method == 'PUT' || $method == 'DELETE' ) {
			curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, $method );

			if ( $params != '' ) {
				curl_setopt( $curl, CURLOPT_POSTFIELDS, $params );
			}
		}

		return $curl;
	}

	/**
	 * @param resource $curlMultiProcess
	 * @param array    $curlArr
	 * @param string   $callBack
	 */
	public static function curlMultipleExec( $curlMultiProcess, $curlArr = array(), $callBack = '' ) {
		do {
			$status = curl_multi_exec( $curlMultiProcess, $still_running );

			while ( $read = curl_multi_info_read( $curlMultiProcess, $msgs_in_queue ) ) {
				try {
					$response = curl_multi_getcontent( $read['handle'] );
					// Debug here
					// var_dump( $response );
					// die;

					$response = json_decode( $response );

					call_user_func( $callBack, $response );
				} catch ( Exception $e ) {
					$response        = new stdClass();
					$response->error = $e->getMessage();

					call_user_func( $callBack, $response );
				}
			}

			if ( $still_running ) {
				curl_multi_select( $curlMultiProcess );
			}
		} while ( $still_running && $status == CURLM_OK );

		foreach ( $curlArr as $curl ) {
			curl_multi_remove_handle( $curlMultiProcess, $curl );
		}
		curl_multi_close( $curlMultiProcess );
	}
}
