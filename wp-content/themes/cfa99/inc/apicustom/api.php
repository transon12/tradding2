<?php


function qod_remove_extra_data( $data, $post, $context ) {
	// We only want to modify the 'view' context, for reading posts
	if ( $context !== 'view' || is_wp_error( $data ) ) {
		 unset( $data->data ['slug'] ); // Example
		 // unset ($data->data ['content']); //Example
		 // unset ($data->data ['name field to remove'])
		 // or
		 // unset ($data->data ['name field to remove'] ['name subfield if you only want to delete the sub-field of field' ])
		 return $data;
	}
}
add_filter( 'rest_prepare_post', 'qod_remove_extra_data', 12, 3 );


function phoneapi( $phone, $code ) {
	$curl = curl_init();

	curl_setopt_array(
		$curl,
		array(
			CURLOPT_URL            => 'http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=' . $phone . '&Content=' . $code . '&ApiKey=4B532DAF5F6D3FB53238D8C244DC1C&SecretKey=4FBA0E8CA5A237D0403EE20FE6543D&SmsType=2&Brandname=Verify',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'GET',
			CURLOPT_HTTPHEADER     => array(
				'Cookie: ASP.NET_SessionId=w0qrxxlhsktstbur0vpe1q41',
			),
		)
	);

	$response = curl_exec( $curl );

	curl_close( $curl );
	return $response;
}


$carriers_number = array(
	'096' => 'Viettel',
	'097' => 'Viettel',
	'098' => 'Viettel',
	'032' => 'Viettel',
	'033' => 'Viettel',
	'034' => 'Viettel',
	'035' => 'Viettel',
	'036' => 'Viettel',
	'037' => 'Viettel',
	'038' => 'Viettel',
	'039' => 'Viettel',

	'090' => 'Mobifone',
	'093' => 'Mobifone',
	'070' => 'Mobifone',
	'071' => 'Mobifone',
	'072' => 'Mobifone',
	'076' => 'Mobifone',
	'078' => 'Mobifone',

	'091' => 'Vinaphone',
	'094' => 'Vinaphone',
	'083' => 'Vinaphone',
	'084' => 'Vinaphone',
	'085' => 'Vinaphone',
	'087' => 'Vinaphone',
	'089' => 'Vinaphone',

	'099' => 'Gmobile',

	'092' => 'Vietnamobile',
	'056' => 'Vietnamobile',
	'058' => 'Vietnamobile',

	'095' => 'SFone',
);


function start_with( $needle, $haystack ) {
	$length = strlen( $needle );
	return ( substr( $haystack, 0, $length ) === $needle );
}

function detect_number( $number ) {
	$number = str_replace( array( '-', '.', ' ' ), '', $number );

	// $number is not a phone number
	if ( ! preg_match( '/^0[0-9]{8}$/', $number ) ) {
		return false;
	}

	// Store all start number in an array to search
	$start_numbers = array_keys( $GLOBALS['carriers_number'] );

	foreach ( $start_numbers as $start_number ) {
		// if $start number found in $number then return value of $carriers_number array as carrier name
		if ( start_with( $start_number, $number ) ) {
			return false;
		}
	}

	// if not found, return false
	return true;
}

// Custom API
function get_number_code( $data ) {
	$phone = $data['phonenumber'];
	if ( empty( $phone ) ) {
		$error = array(
			'success' => false,
			'data'    => array( 'message' => 'Xin vui lòng nhập số điện thoại' ),
		);
		return $error;
	}
	if ( detect_number( $phone ) ) {
		$error = array(
			'success' => false,
			'data'    => array( 'message' => 'Định dạng số điện thoại không đúng' ),
		);
		return $error;
	}

	$code   = rand( 100000, 999999 );
	$key    = time() . ':' . $code;
	$active = phoneapi( $phone, $code );

	if ( ! username_exists( $phone ) ) {

		$data = json_decode( $active );
		if ( $data->CodeResult == 100 || true ) {
			$id        = wp_create_user( $phone, $code, '' );
			$key_saved = wp_update_user(
				array(
					'ID'                  => $id,
					'user_activation_key' => $key,
				)
			);
			$error     = array(
				'success' => true,
				'data'    => array(
					'action'  => 'createacc',
					'message' => 'Tạo tài khoản thành công',
				),
			);
		} else {
			$error = array(
				'success' => false,
				'data'    => array(
					'action'  => 'createacc',
					'message' => 'Số điện thoại không đúng',
				),
			);
		}
	} else {
		$user      = get_user_by( 'login', $data['phonenumber'] );
		$key_saved = wp_update_user(
			array(
				'ID'                  => $user->ID,
				'user_activation_key' => $key,
			)
		);
			$error = array(
				'success' => true,
				'data'    => array(
					'action'  => 'login',
					'message' => 'Đăng nhập thành công',
				),
			);
	}

	return $error;
}

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'wp/v1',
			'/getcode/(?P<phonenumber>\d+)',
			array(
				'methods'  => 'GET',
				'callback' => 'get_number_code',
			)
		);
	}
);

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'wp/v2',
			'/nganh',
			array(
				'methods'  => 'GET',
				'callback' => 'get_nganh',
			)
		);
	}
);

function get_nganh() {
	$terms = get_terms( array(
		'taxonomy' => 'nganh',
		'hide_empty' => false,
	) ); 
	return $terms;
}

add_action( 'init', 'wpdocs_init' );
add_action( 'rest_api_init', 'meta_in_rest' );
function meta_in_rest() {
	// avarta
	register_rest_field(
		array( 'market_analyst', 'post', 'stock_anlysic' ),
		'avatar',
		array(
			'get_callback' => 'get_avatar_api',
			'schema'       => null,
		)
	);

	// Name author
	register_rest_field(
		array( 'market_analyst', 'post', 'stock_anlysic', 'stocks', 'hot_stock_analysis', 'uptrend_stocks', 'khuyennghi' ),
		'author_name',
		array(
			'get_callback' => 'get_name_author',
			'schema'       => null,
		)
	);
	// Name follow_stocks
	register_rest_field(
		array( 'market_analyst', 'post', 'stock_anlysic', 'stocks', 'hot_stock_analysis', 'uptrend_stocks', 'khuyennghi' ),
		'follow_stocks',
		array(
			'get_callback' => 'followstocks',
			'schema'       => null,
		)
	);
	// Ngành stocks
	register_rest_field(
		array( 'market_analyst', 'post', 'stock_anlysic', 'stocks', 'hot_stock_analysis', 'uptrend_stocks', 'khuyennghi' ),
		'nganh',
		array(
			'get_callback' => 'nganh_stocks',
			'schema'       => null,
		)
	);
	register_rest_field(
		array( 'market_analyst', 'post', 'stock_anlysic', 'stocks', 'hot_stock_analysis', 'uptrend_stocks', 'khuyennghi' ),
		'thumbnail',
		array(
			'get_callback' => 'thumbnail_image',
			'schema'       => null,
		)
	);
	register_rest_field(
		array( 'uptrend_stocks', 'stocks' ),
		'data_price',
		array(
			'get_callback' => 'get_price_data',
			'schema'       => null,
		)
	);
	register_rest_field(
		array( 'market_analyst', 'post', 'stock_anlysic', 'stocks', 'hot_stock_analysis', 'uptrend_stocks', 'khuyennghi' ),
		'stock_code',
		array(
			'get_callback' => 'get_stock_code',
			'schema'       => null,
		)
	);

}

function get_name_author( $object = '', $field_name = '', $request = array() ) {
	$authour  = get_post_field( 'post_author', $object['id'] );
	$userdata = get_user_by( 'id', $authour );
	$name     = $userdata->display_name;
	return $name;
}

function get_avatar_api( $object = '', $field_name = '', $request = array() ) {
	 $authour = get_post_field( 'post_author', $object['id'] );

		$avatar = get_avatar_url( $authour );

	return $avatar;
}

function followstocks( $object = '', $field_name = '', $request = array() ) {
	$idstock   = array();
	$id_stocks = get_field( 'co_phieu', $id_check );
	if ( ! $id_stocks ) {
		$id_stocks = $object['id'];
	}
	global $wpdb,$current_user;
	$user_id = $current_user->ID;
	$data    = $wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id" );
	if ( ! empty( $data ) ) {
		foreach ( $data as $key ) {
			$idstock[] = $key->id_stock;
		}
	}
	if ( in_array( $id_stocks, $idstock ) ) {
		return true;
	} else {
		return false;
	}
}


function nganh_stocks( $object = '', $field_name = '', $request = array() ) {
	$id        = $object['id'];
	$id_stocks = get_field( 'co_phieu', $id );
	if ( $id_stocks ) {
		$term = wp_get_post_terms( $id_stocks, 'nganh', array( 'fields' => 'all' ) );
		if ( ! empty( $term ) ) {
			$name = $term[0]->name;
			$id   = $term[0]->term_id;
			return array(
				'name'    => $name,
				'term_id' => $id,
			);
		} else {
			return array();
		}
	} else {
		$term = wp_get_post_terms( $id, 'nganh', array( 'fields' => 'all' ) );
		if ( ! empty( $term ) ) {
			$name = $term[0]->name;
			$id   = $term[0]->term_id;
			return array(
				'name'    => $name,
				'term_id' => $id,
			);
		} else {
			return array();
		}
	}
}

// Thumbnail
function thumbnail_image( $request_data ) {
	 $id = $request_data['id'];

	$url = get_the_post_thumbnail_url( $id );
	if ( empty( $url ) ) {
		$url = home_url() . '/medias/woocommerce-placeholder.png';
	}
	return $url;
}

function get_price_data() {
	 $id      = $request_data['id'];
	$co_phieu = get_field( 'co_phieu' );

	if ( is_numeric( $co_phieu ) ) {
		$gia_ho_tro_manh   = get_field( 'gia_ho_tro_manh', $co_phieu );
		$gia_khang_cu_manh = get_field( 'gia_khang_cu_manh', $co_phieu );
	} else {
		$gia_ho_tro_manh   = get_field( 'gia_ho_tro_manh', $id );
		$gia_khang_cu_manh = get_field( 'gia_khang_cu_manh', $id );
	}
	return array(
		'giahotro'     => $gia_ho_tro_manh,
		'gia_khang_cu' => $gia_khang_cu_manh,
	);
}

function get_stock_code() {
	 $id      = $request_data['id'];
	$co_phieu = get_field( 'co_phieu' );
	if ( is_numeric( $co_phieu ) ) {
		$data      = get_field( 'thong_tin_co_phieu_nong', $co_phieu );
		$stockcode = $data['ma_co_phieu'];
	} else {
		$data      = get_field( 'thong_tin_co_phieu_nong' );
		$stockcode = $data['ma_co_phieu'];
	}
	return $stockcode;
}


























function check_is_affiliate_active_user( $user_id = 0 ) {
	if ( '0' === $user_id ) {
		return false;
	}

	$affiliate = slicewp_get_affiliate_by_user_id( $user_id );

	if ( is_null( $affiliate ) ) {
		return false;
	}

	$status = $affiliate->get( 'status' );

	if ( 'active' !== $status ) {
		return false;
	}

	return $affiliate->get( 'id' );

}

// Custom api

add_action( 'init', 'setup_init' );


function setup_init() {

	add_action( 'rest_api_init', 'custom_endpoint' );

	function custom_endpoint() {
		if ( ! is_admin() ) {
			register_rest_route(
				'wp/v2',
				'/fstock',
				array(
					'methods'  => 'GET',
					'callback' => 'custom_callback',
				)
			);

			register_rest_route(
				'setting',
				'/current_user',
				array(
					'methods'  => 'GET',
					'callback' => 'user_current_data',
				)
			);

			register_rest_route(
				'video',
				'/current_user',
				array(
					'methods'  => 'GET',
					'callback' => 'video_waited',
				)
			);

			register_rest_route(
				'update',
				'/current_user',
				array(
					'methods'  => 'POST',
					'callback' => 'update_current_user',
				)
			);

			register_rest_route(
				'get_news',
				'/stock/(?P<id>\d+)',
				array(
					'methods'  => 'GET',
					'callback' => 'get_news_stock',
				)
			);

			register_rest_route(
				'infor',
				'/member_packet/(?P<id>\d+)',
				array(
					'methods'  => 'GET',
					'callback' => 'membership_packet',
				)
			);

			register_rest_route(
				'infor',
				'/member_packet',
				array(
					'methods'  => 'GET',
					'callback' => 'membership_packet',
				)
			);

			register_rest_route(
				'check',
				'/mgt',
				array(
					'methods'  => 'GET',
					'callback' => 'check_mgt',
				)
			);

			register_rest_route(
				'packet_created',
				'/packet/(?P<id>\d+)',
				array(
					'methods'  => 'POST',
					'callback' => 'create_order_packet',
				)
			);

			register_rest_route(
				'news',
				'/get_news',
				array(
					'methods'  => 'GET',
					'callback' => 'get_news',
				)
			);
			register_rest_route(
				'notice',
				'/get_notice',
				array(
					'methods'  => 'GET',
					'callback' => 'get_notice',
				)
			);
			register_rest_route(
				'fcm',
				'/test',
				array(
					'methods'  => 'GET',
					'callback' => 'get_fcm',
				)
			);
			register_rest_route(
				'update',
				'/deviceid',
				array(
					'methods'  => 'POST',
					'callback' => 'update_driverid',
				)
			);
			register_rest_route(
				'search',
				'/all',
				array(
					'methods'  => 'POST',
					'callback' => 'search_all_function',
				)
			);

			// Get affiliate data by id.
			register_rest_route(
				'affiliate',
				'/me',
				array(
					'methods'  => 'GET',
					'callback' => 'cfa99_get_affiliate_by_user',
				)
			);
			register_rest_route(
				'affiliate',
				'/invited_list',
				array(
					'methods'  => 'GET',
					'callback' => 'cfa99_get_current_user_invited_user_list',
				)
			);
			register_rest_route(
				'affiliate',
				'/commissions',
				array(
					'methods'  => 'GET',
					'callback' => 'cfa99_get_current_user_commissions',
				)
			);
			register_rest_route(
				'affiliate',
				'/commissions/list',
				array(
					'methods'  => 'GET',
					'callback' => 'cfa99_get_current_user_commissions_list',
				)
			);
		}
	}

	// Affiliate.
	function cfa99_get_current_user_commissions_list( $data ) {

		if ( ! is_user_logged_in() ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa đăng nhập',
			);
		}

		global $current_user;

		$curr_aff_id = check_is_affiliate_active_user( $current_user->ID );

		if ( ! $curr_aff_id ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa tham gia chương trình',
			);
		}

		// Get the commissions page number.
		$page  = ( ! empty( $data['page'] ) ? absint( $data['page'] ) : 1 );
		$limit = ( ! empty( $data['limit'] ) ? absint( $data['limit'] ) : 10 );

		// Prepare the commission args.
		$commission_args = array(
			'number'       => $limit,
			'affiliate_id' => $curr_aff_id,
			'offset'       => ( $page - 1 ) * $limit,
			'status'       => array( 'paid', 'unpaid' ),
		);

		$commissions         = slicewp_get_commissions( $commission_args );
		$commission_types    = slicewp_get_commission_types();
		$commission_statuses = slicewp_get_commission_available_statuses();

		if ( empty( $commissions ) ) :
			return array(
				'success' => false,
				'data'    => 'Bạn không có hoa hồng.',
			);
		else :
			$commissions_format = array();
			foreach ( $commissions as $commission ) :
				$commission_format = array(
					'id'     => $commission->get( 'id' ),
					'date'   => slicewp_date_i18n( $commission->get( 'date_created' ) ),
					'type'   => ( ! empty( $commission_types[ $commission->get( 'type' ) ]['label'] ) ? $commission_types[ $commission->get( 'type' ) ]['label'] : $commission->get( 'type' ) ),
					'amount' => slicewp_format_amount( $commission->get( 'amount' ), slicewp_get_setting( 'active_currency', 'USD' ), false ),
					'status' => ( ! empty( $commission_statuses[ $commission->get( 'status' ) ] ) ? $commission_statuses[ $commission->get( 'status' ) ] : $commission->get( 'status' ) ),
				);
				array_push( $commissions_format, $commission_format );
			endforeach;
			return array(
				'success' => true,
				'data'    => $commissions_format,
			);
		endif;

	}
	function cfa99_get_current_user_commissions() {

		if ( ! is_user_logged_in() ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa đăng nhập',
			);
		}

		global $current_user;

		$curr_aff_id = check_is_affiliate_active_user( $current_user->ID );

		if ( ! $curr_aff_id ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa tham gia chương trình',
			);
		}

		$range = isset( $data['time'] ) ? sanitize_text_field( $data['time'] ) : 'all';

		// Count all of commissions.
		$commissions_args = array(
			'number'       => -1,
			'affiliate_id' => $curr_aff_id,
			'fields'       => 'amount',
			'status'       => array( 'unpaid', 'paid' ),
		);

		$unpaid_commissions_args           = $commissions_args;
		$unpaid_commissions_args['status'] = 'unpaid';

		$paid_commissions_args           = $commissions_args;
		$paid_commissions_args['status'] = 'paid';

		$commissions        = slicewp_get_commissions( $commissions_args );
		$unpaid_commissions = slicewp_get_commissions( $unpaid_commissions_args );
		$paid_commissions   = slicewp_get_commissions( $paid_commissions_args );

		$total_amount  = slicewp_format_amount( array_sum( $commissions ), slicewp_get_setting( 'active_currency', 'USD' ), false );
		$unpaid_amount = slicewp_format_amount( array_sum( $unpaid_commissions ), slicewp_get_setting( 'active_currency', 'USD' ), false );
		$paid_amount   = slicewp_format_amount( array_sum( $paid_commissions ), slicewp_get_setting( 'active_currency', 'USD' ), false );

		return array(
			'success' => true,
			'data'    => array(
				'count'         => count( $commissions ),
				'total_amount'  => $total_amount,
				'unpaid_amount' => $unpaid_amount,
				'paid_amount'   => $paid_amount,
			),
		);
	}
	function cfa99_get_current_user_invited_user_list() {

		if ( ! is_user_logged_in() ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa đăng nhập',
			);
		}

		global $wpdb, $current_user;

		$curr_aff_id = check_is_affiliate_active_user( $current_user->ID );

		if ( ! $curr_aff_id ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa tham gia chương trình',
			);
		}

		$sql_query = "SELECT id, display_name, user_registered FROM {$wpdb->prefix}users WHERE id IN ( SELECT user_id FROM {$wpdb->prefix}usermeta WHERE meta_value LIKE '{$current_user->ID}' AND meta_key = 'referral_user' )  ORDER BY user_registered DESC";

		$results = $wpdb->get_results( $sql_query ); // phpcs:ignore.

		return array(
			'success' => true,
			'data'    => $results,
		);
	}
	function cfa99_get_affiliate_by_user( $data ) {

		if ( ! is_user_logged_in() ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa đăng nhập',
			);
		}

		global $current_user;

		$curr_aff_id = check_is_affiliate_active_user( $current_user->ID );

		if ( ! $curr_aff_id ) {
			return array(
				'success' => false,
				'data'    => 'Bạn chưa tham gia chương trình',
			);
		}

		$affiliate = slicewp_get_affiliate( $curr_aff_id );
		return array(
			'id'            => $affiliate->get( 'id' ),
			'user_id'       => $affiliate->get( 'user_id' ),
			'date_created'  => $affiliate->get( 'date_created' ),
			'date_modified' => $affiliate->get( 'date_modified' ),
			'status'        => $affiliate->get( 'status' ),
			'payment_email' => $affiliate->get( 'payment_email' ),
			'website'       => $affiliate->get( 'website' ),
		);
	}

	// Theo dõi cổ phiếu.
	function custom_callback( $request_data ) {
		if ( is_user_logged_in() ) {
			  global $wpdb,$current_user;
			  $user_id = $current_user->ID;
			  $idstock = $request_data['id'];
			  $data    = $wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id" );
			if ( empty( $idstock ) ) {
				foreach ( $data as $key ) {
					$id_stock_a        = $key->id_stock;
					$data_stock        = get_field( 'thong_tin_co_phieu_nong', $id_stock_a );
					$mcp               = $data_stock['ma_co_phieu'];
					$gia_ban_dau       = $data_stock['gia_ban_dau'];
					$gia_giam          = $data_stock['gia_giam'];
					$gia_ho_tro_manh   = get_field( 'gia_ho_tro_manh', $id_stock_a );
					$gia_khang_cu_manh = get_field( 'gia_khang_cu_manh', $id_stock_a );
					$thumbnail         = get_the_post_thumbnail_url( $id_stock_a );
					$data_check[]      = array(
						'id'              => $id_stock_a,
						'ma_co_phieu'     => $mcp,
						'gia_ban_dau'     => $gia_ban_dau,
						'gia_giam'        => $gia_giam,
						'gia_ho_tro_manh' => $gia_ho_tro_manh,
						'gia_khang_cu'    => $gia_khang_cu_manh,
						'thumbnail'       => $thumbnail,
					);
				}
				return $data_check;
			} elseif ( is_numeric( $idstock ) && get_post_type( $idstock ) == 'stocks' ) {
				$data_check = array();
				foreach ( $data as $key ) {
					$data_check[] = $key->id_stock;
				}
				if ( in_array( $idstock, $data_check ) ) {
					$wpdb->delete(
						'bookmark',
						array( 'id_stock' => $idstock ),
						array( '%d' ),
					);
					$data = array(
						'success' => 'true',
						'data'    => array( 'Đã xóa khỏi theo dõi' ),
					);
					return $data;
				} else {
					$wpdb->insert(
						'bookmark',
						array(
							'id'       => 0,
							'id_stock' => $idstock,
							'user_id'  => $user_id,
						),
						array( '%d', '%d', '%d' )
					);
					$data = array(
						'success' => 'true',
						'data'    => array( 'Đã thêm vào theo dõi' ),
					);
					return $data;
				}
			} else {
					  $data = array(
						  'success' => 'false',
						  'data'    => array( 'ID không tồn tại' ),
					  );
					  return $data;
			}
		} else {
			$data = array(
				'success' => 'false',
				'data'    => 'Bạn chưa đăng nhập',
			);
			return $data;
		}
	}

	// User hiện tại
	function user_current_data() {
		global $current_user;
		$id                   = $current_user->ID;
		$current_user->avatar = get_avatar_url( $id );
		if ( is_user_logged_in() ) {
			return $current_user;
		} else {
			$data = array(
				'success' => 'false',
				'data'    => 'Bạn chưa đăng nhập',
			);
			return $data;
		}

	}

	// Lịch sử video
	function video_waited() {
		$data = array();
		if ( is_user_logged_in() ) {
			global $current_user;
			$user_id   = $current_user->ID;
			$data      = array();
			$datavideo = get_user_meta( $user_id, 'historyvideo', true );
			foreach ( $datavideo as $key ) {

				 $title  = get_the_title( $key );
				 $date   = get_the_date( 'd-m-Y H:i:s', $key );
				 $url    = get_field( 'link_video', $key );
				 $data[] = array(
					 'title' => $title,
					 'date'  => $date,
					 'url'   => $url,
				 );
			}
			return $data;
		} else {
				  return array(
					  'success' => 'false',
					  'data'    => 'Bạn chưa đăng nhập',
				  );
		}
	}

	// Update user
	function update_current_user( $request_data ) {
		if ( is_user_logged_in() ) {
			global $current_user,$wpdb;
			$id             = $current_user->ID;
			$last_name      = $request_data['last_name'];
			$frist_name     = $request_data['frist_name'];
			$password       = $request_data['password'];
			$password_again = $request_data['password_again'];
			$mgt            = $request_data['magt'];
			// $authors1= $wpdb->get_results("SELECT * FROM a2z_usermeta WHERE meta_key ='data_ref' AND meta_value LIKE '%\"user_used\";i:$id;%'");

			if ( empty( $last_name ) || empty( $frist_name ) ) {
					 return array(
						 'success' => 'false',
						 'data'    => array( 'Xin vui lòng nhập đầy đủ các trường' ),
					 );
			}
			if ( is_numeric( $last_name ) || is_numeric( $frist_name ) ) {
				   return array(
					   'success' => 'false',
					   'data'    => array( 'Định dạng tên sai' ),
				   );
			}
			if ( $password !== $password_again && ! empty( $password ) ) {
				 return array(
					 'success' => 'false',
					 'data'    => array( '2 mật khẩu khác nhau' ),
				 );
			}
			if ( ! empty( $mgt ) ) {
					 $authors = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key = 'ma_gioi_thieu' AND meta_value LIKE '$mgt'" );
				if ( empty( $authors ) ) {
					return array(
						'success' => 'false',
						'data'    => array( 'Mã giới thiệu không tồn tại' ),
					);
				} else {
					$id_ref   = $authors[0]->user_id;
					$userdata = get_user_meta( $id_ref, 'data_ref', true );
					if ( empty( $user_data ) ) {
						$userdata = array();
					}
					$userdata[] = array(
						'user_used' => $id,
						'datetime'  => date( 'd-m-y h:i:s' ),
					);
					update_user_meta( $id_ref, 'data_ref', $userdata );
				}
			}

			update_user_meta( $id, 'first_name', $frist_name );
			update_user_meta( $id, 'last_name', $last_name );
			$full_name = trim( $frist_name . ' ' . $last_name );
			$userdata  = array(
				'ID'           => $id,
				'display_name' => $full_name,
			);

			wp_update_user( $userdata );
			if ( $password === $password_again ) {
				wp_set_password( $password, $id );
			}
			return array(
				'success' => 'true',
				'data'    => array( 'Cập nhập thành công' ),
			);
		} else {
			return array(
				'success' => 'false',
				'data'    => 'Bạn chưa đăng nhập',
			);
		}
	}

	// Get news stock
	function get_news_stock( $request_data ) {
		$id        = $request_data['id'];
		$paged     = empty( $request['page'] ) ? 1 : $request['page'];
		$datapost  = array();
		$args      = array(
			'post_type'      => 'post',
			'paged'          => $paged,
			'meta_query'     => array(
				array(
					'key'     => 'co_phieu',
					'value'   => '"' . $id . '"',
					'compare' => 'LIKE',
				),
			),
			'posts_per_page' => 8,
		);
		$the_query = new WP_Query( $args );
		$maxpage   = $the_query->max_num_pages;
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
					$post_id      = get_the_ID();
					$author_id    = get_post_field( 'post_author', $post_id );
					$display_name = get_the_author_meta( 'display_name', $author_id );
					$avatar       = get_field( 'anh_dai_dien', 'user_' . $author_id );
				if ( empty( $avatar ) ) {
					$avatar = get_avatar_url( $author_id );
				}
				$title      = get_the_title();
				$date       = get_the_date( 'F Y', get_the_ID() );
				$datapost[] = array(
					'author_name'   => $display_name,
					'author_avatar' => $avatar,
					'new_id'        => $post_id,
					'title'         => $title,
					'date'          => $date,
				);
		endwhile;
			wp_reset_query();
	else :
		return array(
			'success' => 'false',
			'data'    => array( 'Không có bài viết liên quan' ),
		);
	endif;

	return array(
		'max_page'  => $maxpage,
		'data_post' => $datapost,
	);
	}

	// Get Membership packet
	function membership_packet( $request_data ) {
		if ( is_user_logged_in() ) {
			global $current_user;
			$user_id = $current_user->ID;
			$member  = $current_user->membership_level->ID;
			$id      = $request_data['id'];
			global $wpdb;
			$authors1 = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key ='data_ref' AND meta_value LIKE '%\"user_used\";i:$user_id;%'" );
			if ( ! empty( $authors1 ) ) {
				$id_query = $authors1[0]->user_id;
				$mgt      = get_field( 'ma_gioi_thieu', 'user_' . $id_query );

			}
			$my_mgt = get_field( 'ma_gioi_thieu', 'user_' . $user_id );
			$data   = array();
			if ( empty( $id ) ) {
				$query = new WP_Query(
					array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
					)
				);
			} else {
				$query = new WP_Query(
					array(
						'post_type'      => 'product',
						'posts_per_page' => -1,
						'post__in'       => array( $id ),
					)
				);
			}
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) :
					$query->the_post();
					$product_id      = get_the_ID();
					$_product        = wc_get_product( $product_id );
					$title           = get_the_title();
					$price           = $_product->get_price();
					$price_html      = $_product->get_price_html();
					$packet_id       = get_post_meta( $product_id, '_membership_product_level', true );
					$content         = get_the_content();
					$descriptin      = get_the_excerpt();
					$data_membership = $wpdb->get_results( 'SELECT * FROM a2z_pmpro_membership_levels WHERE id=' . $packet_id );
					$numbermonth     = $data_membership[0]->expiration_number;
					$datamonth       = $data_membership[0]->expiration_period;
					if ( ! empty( $numbermonth ) ) {
						if ( $datamonth == 'Month' ) {
							$datamonth = 'Tháng';
						} elseif ( $datamonth == 'Day' ) {
							$datamonth = 'Ngày';
						} elseif ( $datamonth == 'Hour' ) {
							$datamonth = 'Giờ';
						} elseif ( $datamonth == 'Week' ) {
							$datamonth = 'Tuần';
						} elseif ( $datamonth == 'Year' ) {
							$datamonth = 'Năm';
						} else {
							$datamonth = '';
						}
					} else {
						$numbermonth = 'Vĩnh Viễn';
						$datamonth   = '';
					}
					$data[] = array(
						'product_id'        => $product_id,
						'title'             => $title,
						'price'             => $price,
						'price_html'        => $price_html,
						'packet_id'         => $packet_id,
						'content'           => $content,
						'description'       => $descriptin,
						'expiration_number' => $numbermonth,
						'expiration_period' => $datamonth,
						'current_packet'    => $member,
						'used_mgt'          => $mgt,
						'my_mgt'            => $my_mgt,
					);
				 endwhile;
				wp_reset_query();
endif;
			return array(
				'success' => 'true',
				'data'    => $data,
			);
		} else {
			return array(
				'success' => 'false',
				'data'    => 'Bạn chưa đăng nhập',
			);
		}
	}
	// Kiểm tra mã giới thiệu
	function check_mgt( $request_data ) {
		global $current_user;
		if ( is_user_logged_in() ) {
			$mgt     = $request_data['mgt'];
			$user_id = $current_user->ID;
			$my_mgt  = get_field( 'ma_gioi_thieu', 'user_' . $user_id );
			global $wpdb;
			$authors1 = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key ='data_ref' AND meta_value LIKE '%\"user_used\";i:$user_id;%'" );
			if ( ! empty( $authors1 ) ) {
				return array(
					'success' => 'false',
					'data'    => array( 'Bạn đã dùng mã giới thiệu' ),
				);
			}
			if ( $my_mgt == $mgt ) {
				return array(
					'success' => 'false',
					'data'    => array( 'Bạn không thể dùng mã giới thiệu của bản thân' ),
				);
			}
			$check = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key = 'ma_gioi_thieu' AND meta_value LIKE '$mgt'" );
			if ( ! empty( $check ) ) {
				return array(
					'success' => 'false',
					'data'    => array( 'Mã giới thiệu không tồn tại' ),
				);
			}
			$id_ref   = $check[0]->user_id;
			$userdata = get_user_meta( $id_ref, 'data_ref', true );
			if ( empty( $user_data ) ) {
				$userdata = array();
			}
			$userdata[] = array(
				'user_used' => $user_id,
				'datetime'  => date( 'd-m-y h:i:s' ),
			);
			update_user_meta( $id_ref, 'data_ref', $userdata );
			return array(
				'success' => 'true',
				'data'    => array( 'Mã giới thiệu đã thêm thành công' ),
			);

		} else {
			return array(
				'success' => 'false',
				'data'    => 'Bạn chưa đăng nhập',
			);
		}

	}

	function create_order_packet( $request_data ) {
		if ( is_user_logged_in() ) {
			global $current_user;
			$id           = $request_data['id'];
			$user_id      = $current_user->id;
			$display_name = $current_user->display_name;
			$phone        = $current_user->user_login;
			$address      = array(
				'first_name' => $display_name,
				'last_name'  => '',
				'company'    => '',
				'email'      => '',
				'phone'      => $phone,
				'address_1'  => '',
				'address_2'  => '',
				'city'       => '',
				'state'      => '',
				'postcode'   => '',
				'country'    => '',
			);
			$dataoption   = array(
				'ngan_hang'      => get_field( 'ngan_hang', 'option' ),
				'icon_ngan_hang' => get_field( 'icon_ngan_hang', 'option' ),
				'ten_tai_khoan'  => get_field( 'ten_tai_khoan', 'option' ),
				'so_tai_khoan'   => get_field( 'so_tai_khoan', 'option' ),
				'anh_qrcode'     => get_field( 'anh_qrcode', 'option' ),
				'cu_phap'        => get_field( 'cu_phap', 'option' ),
			);
			// Now we create the order
			$order = wc_create_order();
			update_post_meta( $order->id, '_customer_user', $user_id );
			// The add_product() function below is located in /plugins/woocommerce/includes/abstracts/abstract_wc_order.php
			$order->add_product( get_product( $id ), 1 ); // This is an existing SIMPLE product
			$order->set_address( $address, 'billing' );
			$order->calculate_totals();
			$order->update_status( 'Completed', 'Imported order', true );
			return array(
				'success' => 'true',
				'data'    => array(
					'order_id'   => $order->id,
					'infor_bank' => $dataoption,
				),
			);
		} else {
			return array(
				'success' => 'false',
				'data'    => 'Bạn chưa đăng nhập',
			);
		}
	}

	// get news
	function get_news( $request_data ) {
		$datapost = array();
		$query    = new WP_Query(
			array(
				'post_type'      => array( 'post', 'market_analyst', 'stocks', 'stock_anlysic', 'hot_stock_analysis', 'uptrend_stocks', 'khuyennghi' ),
				'meta_key'       => 'thong_bao_news',
				'meta_value_num' => 1,
				'meta_compare'   => '=',
			)
		);
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$post_id      = get_the_ID();
				$author_id    = get_post_field( 'post_author', $post_id );
				$display_name = get_the_author_meta( 'display_name', $author_id );
				$avatar       = get_field( 'anh_dai_dien', 'user_' . $author_id );
				if ( empty( $avatar ) ) {
					$avatar = get_avatar_url( $author_id );
				}

				$title         = get_the_title();
				$date          = get_the_date( 'F Y', get_the_ID() );
				$post_type     = get_post_type( get_the_ID() );
				$post_type_obj = get_post_type_object( $post_type );
				$nameposttype  = $post_type_obj->labels->singular_name; // Ice Cream.
				$datapost[]    = array(
					'author_name'    => $display_name,
					'author_avatar'  => $avatar,
					'new_id'         => $post_id,
					'title'          => $title,
					'date'           => $date,
					'post_type'      => $post_type,
					'name_post_type' => $nameposttype,
				);

			endwhile;
			return array(
				'success' => 'true',
				'data'    => $datapost,
			);

			wp_reset_query();
		else :

			return array(
				'success' => 'true',
				'data'    => array( 'Không có dữ liệu hiển thị' ),
			);
		   endif;

	}

	// Notice
	function get_notice() {
		 global $current_user,$wpdb;
		$id_user = $current_user->ID;
		$data    = array();
		$results = $wpdb->get_results( 'SELECT * FROM a2z_notice WHERE user_id = 0 OR user_id=' . $id_user . ' AND readed = 0' );
		$number  = count( $results );
		if ( ! empty( $results ) ) {
			foreach ( $results as $key ) {
				$time    = date( 'd-m-Y H:i:s', strtotime( $key->date_notice ) );
				$content = $key->content_notice;
				$data[]  = array(
					'time'    => $time,
					'content' => $content,
				);

			}
			return array(
				'success' => 'true',
				'data'    => array(
					'notice_number' => $number,
					'data'          => $data,
				),
			);
		} else {
			return;
		}
	}

	function get_fcm() {
		$blogusers = get_users( array( 'role__in' => array( 'customer' ) ) );

		$listidmesuser = array();
		foreach ( $blogusers as $user ) {
			$listidmes = array();
			$userid    = $user->ID;
			$data      = get_user_meta( $userid, 'driver_update_id', true );
			if ( ! empty( $data ) ) {
				foreach ( $data as $key ) {
					$test        = sendGCM( $key );
					$listidmes[] = $test;
				}
			}
			$listidmesuser[ 'user_' . $userid ] = $listidmes;
		}
		return array(
			'success' => 'true',
			'data'    => $listidmesuser,
		);
	}
}








function sendGCM( $deviceid, $data ) {
	// FCM API Url
	$url = 'https://fcm.googleapis.com/fcm/send';

	$apiKey = 'AAAABAdX3AE:APA91bGjbPPuxjxJZTsW1tGncws8FWb1lWULRFBM6NOgWxUri1n7vWvbk_mpp6Bly3OMdKwFgYu99us5TM_kwyleXRwex3t9KMVCps3hqNJ30BNrRa4d9TCQFs5Q6NGyDJhRX28SN-NQ';

	$headers = array(
		'Authorization:key=' . $apiKey,
		'Content-Type:application/json',
	);

	// Create the api body
	$apiBody = array(
		'notification' => 'Thông báo',
		'data'         => $data,
		'time_to_live' => 600, // Optional
		'to'           => $deviceid, // Replace 'mytargettopic' with your intended notification audience
	);

	// Initialize curl with the prepared headers and body
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $apiBody ) );

	// Execute call and save result
	$result = curl_exec( $ch );

	// Close curl after call
	curl_close( $ch );

	return $result;
}





function update_driverid( $request_data ) {
	 $user = wp_get_current_user();
	$id    = $user->ID;
	if ( is_user_logged_in() ) {
		$driverid = $request_data['id'];
		if ( empty( $driverid ) ) {
			return array(
				'success' => 'false',
				'data'    => array( 'Không được để trống trường thiết bị' ),
			);
		} else {
			$data = get_user_meta( $id, 'driver_update_id', true );
			if ( empty( $data ) ) {
				$data = array();
			}
			if ( ! in_array( $driverid, $data ) ) {
				$data[] = $driverid;
				update_user_meta( $id, 'driver_update_id', $data );
			}
			return array(
				'success' => 'true',
				'data'    => array( 'Đã cập nhập mã thiết bị' ),
			);
		}
	} else {
		return array(
			'success' => 'false',
			'data'    => 'Bạn chưa đăng nhập',
		);
	}

}

function search_all_function( $request_data ) {
	 $post_type = $request_data['type_data'];
	$keyword    = $request_data['kw'];
	$term       = $request_data['nganhid'];
	$datapost   = array();

	if ( $post_type == 'post' || $post_type == 'stock_anlysic' || $post_type == 'market_analyst' || $post_type == 'lp_course' ) {
		$querystock = new WP_Query(
			array(
				'post_type' => $post_type,
				's'         => $keyword,
			)
		);

	} else {
		if ( isset( $term ) ) {
			$idstock = array();

			$querystart = new WP_Query(
				array(
					'post_type'      => 'stocks',
					'tax_query'      => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'nganh',
							'field'    => 'id',
							'terms'    => array( $term ),
							'operator' => 'IN',
						),
					),
					'meta_key'       => 'thong_tin_co_phieu_nong_ma_co_phieu',
					'meta_value'     => $keyword,
					'meta_compare'   => 'LIKE',
					'posts_per_page' => -1,
				)
			);

			if ( $querystart->have_posts() ) :
				while ( $querystart->have_posts() ) :
					$querystart->the_post();
					$idstock[] = get_the_ID();
			endwhile;
				wp_reset_query();
endif;
			$querystock = new WP_Query(
				array(
					'post_type'      => $post_type,
					'meta_key'       => 'co_phieu',
					'meta_value'     => $idstock,
					'meta_compare'   => 'IN',
					'posts_per_page' => -1,
				)
			);

		} else {

			$idstock = array();

			$querystart = new WP_Query(
				array(
					'post_type'      => 'stocks',
					'meta_key'       => 'thong_tin_co_phieu_nong_ma_co_phieu',
					'meta_value'     => $keyword,
					'meta_compare'   => 'LIKE',
					'posts_per_page' => -1,
				)
			);
			if ( $querystart->have_posts() ) :
				while ( $querystart->have_posts() ) :
					$querystart->the_post();
					$idstock[] = get_the_ID();
			endwhile;
				wp_reset_query();
endif;

			$querystock = new WP_Query(
				array(
					'post_type'      => $post_type,
					'meta_key'       => 'co_phieu',
					'meta_value'     => $idstock,
					'meta_compare'   => 'IN',
					'posts_per_page' => -1,
				)
			);
		}
	}
		$idstock = array();

	if ( ! $id_stocks ) {
		$id_stocks = $object['id'];
	}
	global $wpdb,$current_user;
	$user_id = $current_user->ID;
	$data    = $wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id" );
	if ( ! empty( $data ) ) {
		foreach ( $data as $key ) {
			$idstock[] = $key->id_stock;
		}
	}

	if ( $querystock->have_posts() ) :
		while ( $querystock->have_posts() ) :
			$querystock->the_post();

			$post_id = get_the_ID();

			$id_stocks_now = get_field( 'co_phieu', $post_id );

			if ( in_array( $id_stocks_now, $idstock ) ) {
				$checkf = true;
			} else {
				$checkf = false;
			}

			$author_id    = get_post_field( 'post_author', $post_id );
			$display_name = get_the_author_meta( 'display_name', $author_id );
			$avatar       = get_avatar_url( $author_id );
			$title        = get_the_title();
			$date         = get_the_date( 'F Y', $post_id );
			$id_stock_a   = get_field( 'co_phieu', $post_id );
			$thumbnail    = get_the_post_thumbnail_url( $post_id );
			if ( $id_stock_a ) {
				$gia_ho_tro_manh   = get_field( 'gia_ho_tro_manh', $id_stock_a );
				$gia_khang_cu_manh = get_field( 'gia_khang_cu_manh', $id_stock_a );
				$stockcode         = get_field( 'thong_tin_co_phieu_nong_ma_co_phieu', $id_stock_a );
				$thumbnail         = get_the_post_thumbnail_url( $id_stock_a );
			}
			$lydo               = get_the_content( $post_id );
			$ly_do_bien_dong    = get_field( 'ly_do_bien_dong', $post_id );
			$tuong_lai_xu_huong = get_field( 'xu_huong_tuong_lai', $post_id );
			$gia_mua            = get_field( 'gia_mua', $post_id );
			$gia_loi            = get_field( 'gia_loi', $post_id );
			$gia_cat_lo         = get_field( 'gia_cat_lo', $post_id );
			$datapost[]         = array(
				'id_stock'           => $id_stock_a,
				'stockcode'          => $stockcode,
				'author_name'        => $display_name,
				'author_avatar'      => $avatar,
				'id'                 => $post_id,
				'title'              => $title,
				'date'               => $date,
				'thumbnail'          => $thumbnail,
				'gia_ho_tro_manh'    => $gia_ho_tro_manh,
				'gia_khang_cu_manh'  => $gia_khang_cu_manh,
				'ly_do_bien_dong'    => $ly_do_bien_dong,
				'tuong_lai_xu_huong' => $tuong_lai_xu_huong,
				'gia_mua'            => $gia_mua,
				'gia_loi'            => $gia_loi,
				'gia_cat_lo'         => $gia_cat_lo,
				'content'            => strip_tags( $lydo ),
				'follow_stock'       => $checkf,
			);
		endwhile;
		wp_reset_query();
		return array(
			'success' => 'true',
			'data'    => $datapost,
		);

	else :

		return array(
			'success' => 'false',
			'data'    => '',
		);
	endif;

}
