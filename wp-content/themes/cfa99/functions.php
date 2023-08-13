<?php

require get_stylesheet_directory() . '/inc/init.php';

add_action( 'wp_enqueue_scripts', 'cfa99_add_frontend_scripts' );
function cfa99_add_frontend_scripts() {
	wp_localize_script(
		'custom-js',
		'cfa99_vars',
		array(
			'nonce'         => wp_create_nonce( 'cfa99_nonce' ),
			'wp_rest_nonce' => wp_create_nonce( 'wp_rest' ),
		)
	);
}

// add_filter( 'walker_nav_menu_start_el', 'wpstudio_add_description', 10, 2 );
// function wpstudio_add_description( $item_output, $item ) {

// $description = $item->post_content;
// if (' ' !== $description ) {
// return preg_replace( '/(<a.*)</', '$1' . '<p class="menu-description">' . $description . '</p><', $item_output) ;
// }
// else {
// return $item_output;
// };

// }
function prefix_nav_description( $item_output, $item, $depth, $args ) {
	if ( ! empty( $item->description ) ) {
		$item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-description">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );

/* codfe.com tao bai viet lien quan trong flatsome */
add_shortcode( 'codfe_posts_related', 'flatsome_related_posts' );
function flatsome_related_posts() {
	ob_start();
	$categories = get_the_category( get_the_ID() );
	if ( $categories ) {
		echo '<div class="relatedcat">';
		$category_ids = array();
		foreach ( $categories as $individual_category ) {
			array_push( $category_ids, $individual_category->term_id );
		}
		$my_query = new wp_query(
			array(
				'category__in'   => $category_ids,
				'post__not_in'   => array( get_the_ID() ),
				'posts_per_page' => 6,
			)
		);
		$ids      = wp_list_pluck( $my_query->posts, 'ID' );
		$ids      = implode( ',', $ids );
		if ( $my_query->have_posts() ) {
			echo '<h3 class="title-relate">Related News</h3>';
			// echo do_shortcode('[blog_posts style="normal" columns="3" columns__md="2" ids="' . $ids . '" image_height="56.25%" text_align="left"]');
			echo do_shortcode( '[blog_posts style="normal" class="box-relate" show_date="false" excerpt="false" comments="false" type="row" columns="3" columns__md="2" posts="6" image_height="56.25%" text_align="left" ids="' . $ids . '"]' );
			// Row
		}
		echo '</div>';
	}
	return ob_get_clean();
}
// Just hide woocommerce billing country
add_action( 'woocommerce_before_checkout_form', 'hide_checkout_billing_country', 5 );
function hide_checkout_billing_country() {
	echo '<style>#billing_country_field{display:none;}</style>';
}

add_filter( 'woocommerce_billing_fields', 'customize_checkout_fields', 100 );
function customize_billing_fields( $fields ) {
	if ( is_checkout() ) {
		// HERE set the required key fields below
		$chosen_fields = array( 'first_name', 'last_name', 'address_1', 'address_2', 'city', 'postcode', 'country', 'state' );

		foreach ( $chosen_fields as $key ) {
			if ( isset( $fields[ 'billing_' . $key ] ) && $key !== 'country' ) {
				unset( $fields[ 'billing_' . $key ] ); // Remove all define fields except country
			}
		}
	}
	return $fields;
}


add_filter(
	'learn-press/override-templates',
	function() {
		return true;
	}
);

add_filter( 'woocommerce_product_data_tabs', 'custom_product_data_tabs' );
function custom_product_data_tabs( $tabs ) {
	// unset( $tabs['general'] );
	unset( $tabs['inventory'] );
	unset( $tabs['shipping'] );
	unset( $tabs['linked_product'] );
	unset( $tabs['attribute'] );
	unset( $tabs['variations'] );
	unset( $tabs['advanced'] );
	return $tabs;
}
add_action( 'admin_menu', 'remove_faq_subpages', 999 );

function remove_faq_subpages() {
	remove_submenu_page( 'edit.php?post_type=product', 'edit.php?post_type=product&page=product-reviews' );
	// remove_submenu_page( "edit.php?post_type={$ptype}", "edit-tags.php?taxonomy=faq-topics&amp;post_type={$ptype}" );
}

add_action( 'wp_ajax_send_reset_password_modal', 'send_reset_password_modal' );
add_action( 'wp_ajax_nopriv_send_reset_password_modal', 'send_reset_password_modal' );
function send_reset_password_modal() {
	session_start();
	$phone = $_POST['phone'];
	if ( ! empty( $phone ) ) {
		$phone = $_POST['phone'];
	} else {
		$phone = $_SESSION['phone'];
	}
	if ( username_exists( $phone ) == false ) {
		wp_send_json_error( username_exists( $phone ) );
		die();
	}
	if ( empty( $phone ) ) {
		wp_send_json_error( 'Không được để trống số điện thoại' );
		die();
	} else {
		if ( detect_number( $phone ) ) {
			wp_send_json_error( 'Định dạng số điện thoại không đúng' );
			die();
		} else {

			$_SESSION['phone'] = $phone;
			$curl              = curl_init();

			curl_setopt_array(
				$curl,
				array(
					CURLOPT_URL            => home_url() . '/?rest_route=/simple-jwt-login/v1/user/reset_password&phone=' . $phone,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING       => '',
					CURLOPT_MAXREDIRS      => 10,
					CURLOPT_TIMEOUT        => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST  => 'POST',
					CURLOPT_HTTPHEADER     => array(
						'Cookie: _learn_press_session_99c2e08e2a7ba7cad10b6040d9e2352b=8120c3ab198b41511734b524bf9f937e%7C%7C1660106676%7C%7C29f4d9ec7c3b1f6aedee383932a66161',
					),
				)
			);

			$response = curl_exec( $curl );

			curl_close( $curl );
			wp_send_json_success( 'Mã code đã được gửi' );
			die();
		}
	}
}

add_action( 'wp_ajax_check_code_active_reset_password', 'check_code_active_reset_password' );
add_action( 'wp_ajax_nopriv_check_code_active_reset_password', 'check_code_active_reset_password' );
function check_code_active_reset_password() {
	session_start();
	$phone = $_POST['phone_number'];
	$code_active = $_POST['code_active'];
	
	// if ( $phone != "") {
	// 	$phone = $_POST['phone'];
	// } else {
	// 	$phone = $_SESSION['phone'];
	// }
	if ( username_exists( $phone ) == false ) {
		wp_send_json_error( 'Số điện thoại không tồn tại: '. $phone  );
	}
	if ( $phone == "" ) {
		wp_send_json_error( 'Không nhận được số điện thoại' );
	} else {
		if ( detect_number( $phone ) ) {
			wp_send_json_error( 'Định dạng số điện thoại không đúng' );
		} else {
			$author_obj = get_user_by('login',$phone);
			$code_user = explode(':',$author_obj->user_activation_key);
			if($code_active != $code_user[1]){
				wp_send_json_error( 'Mã code không đúng' );
			}else{
				$_SESSION['phone'] = $phone;
				$_SESSION['actived'] = true;
				wp_send_json_success( 'true');
			}
			
			
		}
	}
	die();
}



add_filter( 'woocommerce_add_to_cart_validation', 'remove_cart_item_before_add_to_cart', 20, 3 );
function remove_cart_item_before_add_to_cart( $passed, $product_id, $quantity ) {
	if ( ! WC()->cart->is_empty() ) {
		WC()->cart->empty_cart();
	}
		wp_safe_redirect( home_url() . '/quan-ly-tai-khoan/nang-cap-tai-khoan/thanh-toan/' );
	return $passed;
	exit();
}

add_action( 'wp_logout', 'auto_redirect_after_logout' );
function auto_redirect_after_logout() {
	wp_redirect( home_url() );
	exit();
}
add_action( 'user_profile_update_errors', 'validate_profile_fields', 0, 3 );
function validate_profile_fields( &$errors, $update, &$user ) {
	$error = $errors->errors;
	if ( ! empty( $error ['empty_email'] ) ) {
		$errors = new WP_Error();
	}
	return $errors;

}
add_action( 'woocommerce_after_checkout_validation', 'ybc_validate_fname_lname', 10, 2 );

function ybc_validate_fname_lname( $fields, $errors ) {

	if ( ! empty( $_REQUEST['mgt'] ) ) {
		$mgt = $_REQUEST['mgt'];
		global $wpdb,$current_user;
		$id  = $current_user->ID;
		$mkm = get_field( 'ma_gioi_thieu', 'user_' . $id );

		$authors1 = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key ='data_ref' AND meta_value LIKE '%\"user_used\";i:$id;%'" );
		if ( ! empty( $authors1 ) ) {
			$idnow  = $authors1[0]->user_id;
			$mkmnow = get_field( 'ma_gioi_thieu', 'user_' . $idnow );
			if ( $idnow != $mgt ) {
				  $errors->add( 'validation', 'Mã giới thiệu không đúng' );
			}
		}

		if ( $mkm == $mgt ) {
			$errors->add( 'validation', 'Bạn không thể dùng giới thiệu của bản thân' );
		}
		$authors = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key = 'ma_gioi_thieu' AND meta_value LIKE '$mgt'" );
		if ( empty( $authors ) ) {
			$errors->add( 'validation', 'Mã giới thiệu không tồn tại' );
		}
	}
}

add_action( 'woocommerce_checkout_update_order_meta', 'custom_checkout_fields_update_order_meta' );
function custom_checkout_fields_update_order_meta( $order_id ) {
	update_post_meta( $order_id, 'mgt_user', sanitize_text_field( $_POST['mgt'] ) );
}

// Display on admin orders
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'display_chosen_delivery_on_admin_orders' );
function display_chosen_delivery_on_admin_orders( $order ) {
	$mgt = $order->get_meta( 'mgt_user' );
	if ( $mgt ) {
		global $wpdb;
		$authors = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key = 'ma_gioi_thieu' AND meta_value LIKE '$mgt'" );
		$user_id = $authors[0]->user_id;
		$alldata = get_user_by( 'id', $user_id );
		$name    = $alldata->display_name;
		// Display the delivery option (post title + post id)
		echo '<p><strong>' . __( 'Mã giới thiệu' ) . ':</strong> ' . $mgt . '- Của user <a href="' . get_edit_user_link( $user_id ) . '">' . $name . '</a></p>';
	}
}

add_action( 'woocommerce_order_status_changed', 'so_status_completed', 10, 3 );

function so_status_completed( $order_id, $old_status, $new_status ) {

	$order = wc_get_order( $order_id );
	$mgt   = $order->get_meta( 'mgt_user' );
	if ( $new_status == 'completed' && $mgt ) {
		$user    = $order->get_user();
		$user_id = $user->ID;
		global $wpdb;
		$authors = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_key LIKE 'ma_gioi_thieu' AND meta_value LIKE '$mgt'" );
		if ( ! empty( $authors ) ) {
			$id       = $authors[0]->user_id;
			$userdata = get_user_meta( $id, 'data_ref', true );
			if ( empty( $user_data ) ) {
				$userdata = array();
			}
			$userdata[] = array(
				'user_used' => $user_id,
				'datetime'  => date( 'd-m-y h:i:s' ),
			);
			update_user_meta( $id, 'data_ref', $userdata );
		}
	}
}

function pmpro_hide_acf_fields( $value, $post_id, $field ) {
	$name = $field['name'];
	// Check if the user has access to the post.
	if ( function_exists( 'pmpro_has_membership_access' ) ) {
		$hasaccess = pmpro_has_membership_access( $post_id );
	}

	if ( empty( $hasaccess ) && ( $name == 'ly_do_bien_dong' || $name == 'xu_huong_tuong_lai' ) && ! is_archive() ) {
		// If user does not have acces to the post, empty the field value.
		if ( ! is_user_logged_in() ) {
			$value = 'Xin vui lòng đăng nhập';
		} else {
			$value = false;
		}
	}
	if ( empty( $hasaccess ) && ( $name == 'gia_mua' || $name == 'gia_loi' || $name == 'gia_cat_lo' ) && ! is_archive() ) {

		//$value = 'xx.xxx';

	}
	// return
	return $value;
}
add_filter( 'acf/format_value', 'pmpro_hide_acf_fields', 10, 3 );

add_action( 'flatsome_after_header', 'runningfiled' );
function runningfiled() {

	if(is_front_page()):
		$string = '';
		if ( have_rows( 'noidung', 'option' ) ) :
			while ( have_rows( 'noidung', 'option' ) ) :
				the_row();
				$string .= '<li>• ' . get_sub_field( 'content' ) . '</li>';
		endwhile;
			echo '<div class="news-wrapper-stock">
		<div class="news-wrapper">
		<div class="inner">
		<ul style="animation-play-state: running;">
		' . $string . '
		</ul>
		</div>
		</div>
		</div>';
		endif;
	endif;
}
if ( function_exists( 'acf_add_options_page' ) ) {
	//acf_add_options_page( 'Cài đặt toàn cục' );
	acf_add_options_page(array(
		'page_title'    => __('Cài đặt toàn cục'),
		'menu_title'    => __('Cài đặt toàn cục'),
		'parent_slug' => 'options-general.php',
	));
}

function acf_load_permission_choices( $field ) {

	// reset choices
	$field['choices']     = array();
	$data                 = pmpro_getAllLevels();
	$field['choices'][''] = 'Lựa chọn quyền';
	foreach ( $data as $key ) {
		$value                      = $key->id;
		$label                      = $key->name;
		$field['choices'][ $value ] = $label;
	}
	return $field;

}

add_filter( 'acf/load_field/name=permission_khuyen_nghi', 'acf_load_permission_choices' );
add_filter( 'acf/load_field/name=permission_khoa_hoc', 'acf_load_permission_choices' );

add_filter( 'learnpress/course/can-view-content', 'open_couse', 10, 3 );
function open_couse( $view, $get_id, $course ) {
	global $current_user;
	$level      = $current_user->membership_level->name;
	$time       = $current_user->membership_level->enddate;
	$id         = $current_user->membership_level->ID;
	$permission = get_field( 'permission_khoa_hoc', 'option' );
	$now        = time();
	if ( ( in_array( $id, $permission ) && ( $time > $now || empty( $time ) ) ) || empty( $permission ) ) {
		$view->flag    = true;
		$view->message = 'Bạn đang dùng gói Pro+ chức năng này được mở';
	}

	return $view;
}


// Affiliate functions.

// Remove unused tabs.
add_filter( 'slicewp_affiliate_account_tabs', 'cfa99_custom_account_tabs', 10, 1 );
function cfa99_custom_account_tabs( $tabs ) {
	unset( $tabs['creatives'] );
	unset( $tabs['settings'] );
	unset( $tabs['payments'] );

	$tabs['invited_list'] = array(
		'label' => __( 'Lịch sử mời' ),
		'icon' => slicewp_get_svg( 'outline-document-duplicate' ),
	);
	

	return $tabs;
}

add_action( 'slicewp_get_template_part', 'cfa99_custom_invited_list_tab_content', 10, 4 );
function cfa99_custom_invited_list_tab_content( $slug, $name, $templates, $args ) {
	if ( 'affiliate-area/affiliate-account-tab-invited_list' === $slug ) {
		//get_template_part( 'affiliate-templates/invited-list', '', $args );
		echo do_shortcode( '[cfa99_aff_invited_list]' );
	}
}

// add_action( 'slicewp_get_template_part', 'cfa99_custom_affilate_link_list_tab_content', 10, 4 );
// function cfa99_custom_affilate_link_list_tab_content( $slug, $name, $templates, $args ) {
// 	if ( 'affiliate-area/affiliate-account-tab-affiliate_links' === $slug ) {
// 		//get_template_part( 'affiliate-templates/invited-list', '', $args );
// 		echo do_shortcode( '[cfa99_aff_invited_list]' );
// 	}
// }

add_filter( 'slicewp_affiliate_account_tab_dashboard_bottom', 'hom_tab_user_invite_controlpanel', 10, 2 );
function hom_tab_user_invite_controlpanel(){ 
	
	?>
	<div class="info_intro">
		<?php echo get_the_content(get_the_ID()); ?>

	</div>

	<?php 
}


add_filter( 'slicewp_affiliate_account_affiliate_link_actions', 'block_code_invitation', 10, 2 );
function block_code_invitation(){ 
	$curr_user_id = get_current_user_id();

	?>
	<div class="wrap-code-invite">
		<label for="slicewp-affiliate-link">Mã giới thiệu</label>
		<input type="text" value="<?php echo get_field('ma_gioi_thieu','user_'.$curr_user_id); ?>" readonly>
		<button class="slicewp-input-copy">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" style="fill: none;" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>                <span class="slicewp-input-copy-label">Sao chép</span>
			<span class="slicewp-input-copy-label-copied">Đã sao chép!</span>
		</button>

	</div>

	<style>
		.wrap-code-invite {
			border-top: 1px solid #efeeee;
			padding-top: 20px;
			margin-top: 20px;
		}
	</style>

	<?php 
}


// Add affiliate id for commission by invitation code.
add_filter( 'slicewp_referrer_affiliate_id_woo', 'cfa99_update_affiliate_id_for_commission', 10, 2 );
function cfa99_update_affiliate_id_for_commission( $affiliate_id, $order_id ) {
	$referral_user_id = get_user_meta( get_current_user_id(), 'referral_user', true );

	if ( '' !== $referral_user_id ) {
		$affiliate = slicewp_get_affiliate_by_user_id( $referral_user_id );

		if ( ! is_null( $affiliate ) ) {
			return $affiliate->get( 'id' );
		}
	}

	return $affiliate_id;
}

add_action( 'wp_ajax_apply_referral_code', 'cfa99_apply_referral_code' );
add_action( 'wp_ajax_nopriv_apply_referral_code', 'cfa99_apply_referral_code' );
function cfa99_apply_referral_code() {
	if ( ! wp_verify_nonce( $_POST['nonce'], 'cfa99_nonce' ) ) {
		return wp_send_json_error(
			array(
				'message' => __( 'Đã xảy ra lỗi! Hãy thử lại sau.' ),
			)
		);
	}

	if ( ! isset( $_POST['code'] ) || '' === $_POST['code'] ) {
		return wp_send_json_error(
			array(
				'message' => __( 'Mã giới thiệu không tồn tại!' ),
			)
		);
	}

	// Check exists referral user for this user.
	$referral_user = get_user_meta( get_current_user_id(), 'referral_user', true );

	if ( $referral_user && '' !== $referral_user ) {
		return wp_send_json_error(
			array(
				'message' => __( 'Bạn đã nhập mã mời rồi' ),
			)
		);
	}

	global $wpdb;

	// Check exists referral code.
	$authors = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}usermeta WHERE meta_value LIKE '{$_POST['code']}'" );
	if ( empty( $authors ) ) {
		return wp_send_json_error(
			array(
				'message' => __( 'Mã giới thiệu không tồn tại!' ),
			)
		);
	}

	$id       = $authors[0]->user_id;
	$userdata = get_user_meta( $id, 'data_ref', true );
	if ( ! is_array( $userdata ) ) {
		$userdata = array();

	}
	$userdata[] = array(
		'user_used' => get_current_user_id(),
		'datetime'  => date( 'd-m-y h:i:s' ),
	);

	update_user_meta( $id, 'data_ref', $userdata );

	// add referral user id if referral code exists.
	update_user_meta( get_current_user_id(), 'referral_user', $id );

	wp_send_json_success(
		array(
			'message' => __( 'Đã lưu mã giới thiệu' ),
		)
	);
}

function debug($var){
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
}


add_action( 'save_data_from_tradingview', 'get_data_from_tradingview' );
function get_data_from_tradingview() {
	//URL of targeted site  
	$url = "https://sbboard.sbsi.vn/getlistallstock";  
	$ch = curl_init();  
	// set URL and other appropriate options  
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_HEADER, 0);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
	// grab URL and pass it to the browser  
	$output = curl_exec($ch);  
	// close curl resource, and free up system resources  
	curl_close($ch);  
	if(update_field('content_json_technical_chart', $output, 3642 )){
	    echo 'update data tradingview ok';
	}else{
	    echo 'update data tradingview failed';
	}

}
