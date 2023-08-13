<?php
define( 'PARENT_THEME', get_template_directory() . '/inc/builder/shortcodes' );
require 'apicustom/api.php';
require 'bookmark/ajaxbookmark.php';

require 'functions/auto-save-image.php';
require 'functions/a2ztech_admin.php';
require 'post-types/market-analyst.php';
require 'post-types/stock.php';
require 'post-types/stock_analysis.php';
require 'post-types/hot_stock_analysis.php';
require 'post-types/uptrend_stocks.php';
require 'post-types/khuyen_nghi_dau_tu.php';
//require 'post-types/technical-charts.php';
require 'taxonomy/market-analyst-cat.php';
require 'taxonomy/uptrend-stocks-cat.php';
require 'shortcodes/sc-market-analyst.php';
require 'shortcodes/sc-uptrend-stocks.php';
require 'shortcodes/analysis_sc.php';
require 'shortcodes/get-content-page.php';
require 'shortcodes/read-more.php';
require 'shortcodes/affiliate-invited-list.php';
require 'widget/wg-news-market-analyst.php';
require 'widget/featured_course.php';
function remove_footer_admin() {
	echo '<span id="footer-thankyou">Developed by <a href="https://a2ztech.vn">A2Z Tech</a></span>';
}

add_filter( 'admin_footer_text', 'remove_footer_admin' );
add_filter( 'use_block_editor_for_post', '__return_false', 10 );

add_action( 'admin_bar_menu', 'add_top_link_to_admin_bar', 1 );
function add_top_link_to_admin_bar( $admin_bar ) {
	// add a parent item
	$args = array(
		'id'    => 'a2ztech',
		'title' => 'A2Z Tech',
		'href'  => 'https://a2ztech.vn/', // Showing how to add an external link
	);
	$admin_bar->add_node( $args );

	// add a child item to our parent item
	$args = array(
		'parent' => 'a2ztech',
		'id'     => 'a2z-home',
		'title'  => 'Trang chủ',
		'href'   => 'https://a2ztech.vn/',
		'meta'   => false,
	);
	$admin_bar->add_node( $args );

	// add a child item to our parent item
	$args = array(
		'parent' => 'a2ztech',
		'id'     => 'a2z-support',
		'title'  => 'Hỗ trợ',
		'href'   => 'https://a2ztech.vn/support',
	);
	$admin_bar->add_node( $args );
}

add_action('init', 'do_output_buffer');
function do_output_buffer() {
    ob_start();
} 

add_action( 'wp_head', 'a2z_ajaxurl' );
function a2z_ajaxurl() {
	echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";
         </script>';
}

function wpb_login_logo_url() {
	 return home_url();
}

add_filter( 'login_headerurl', 'wpb_login_logo_url' );


function remove_admin_bar_links() {
	 global $wp_admin_bar;

	$wp_admin_bar->remove_menu( 'updates' );          // Remove the updates link
	$wp_admin_bar->remove_menu( 'comments' );         // Remove the comments link
	$wp_admin_bar->remove_menu( 'wp-logo' );          // Remove the comments link
	// $wp_admin_bar->remove_menu('flatsome_panel');   // Remove the comments link
}

add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


// custom css and js
add_action( 'admin_enqueue_scripts', 'my_scripts_method' );
add_action( 'login_head', 'my_scripts_method' );
function my_scripts_method() {
	wp_enqueue_style( 'boot_css', get_stylesheet_directory_uri() . '/assets/admin.css' );
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/assets/admin.js', array( 'jquery' ), 1.1, true );
}

add_action( 'wp_enqueue_scripts', 'dcinvest_custom_styles_scripts' );
function dcinvest_custom_styles_scripts() {
	wp_enqueue_script( 'bigger-link', get_stylesheet_directory_uri() . '/assets/js/bigger-link-min.js', array( 'jquery' ), 1.1, true );

	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), 1.1, true );
	wp_enqueue_script( 'custom-js-app', 'https://www.fireant.vn/Scripts/web/widgets.js', array( 'jquery' ), 1.1, true );
	wp_enqueue_script( 'sweetalert-js', get_stylesheet_directory_uri() . '/assets/js/sweetalert2.min.js', array( 'jquery' ), 1.1, true );
	wp_enqueue_style( 'sweetalert-style', get_stylesheet_directory_uri() . '/assets/css/sweetalert2.min.css' );
	wp_enqueue_style( 'post-types-style', get_stylesheet_directory_uri() . '/assets/css/post-types.css' );
	wp_enqueue_script( 'fancybox-js', get_stylesheet_directory_uri() . '/assets/js/jquery.fancybox.min.js', array( 'jquery' ), 1.1, true );
	wp_enqueue_style( 'fancybox-style', get_stylesheet_directory_uri() . '/assets/css/fancybox.min.css' );

	

	// number format

	wp_enqueue_script( 'number-divider-js', get_stylesheet_directory_uri() . '/assets/js/number-divider.min.js', array( 'jquery' ), 1.1, true );

	wp_enqueue_style( 'style-1', get_stylesheet_directory_uri() . '/assets/css/style1.css' );
	wp_enqueue_style( 'style-2', get_stylesheet_directory_uri() . '/assets/css/style2.css' );
	// Font Awesome
	wp_enqueue_style( 'font-awesome-5-all', home_url() . '/wp-content/plugins/learnpress/assets/src/css/vendor/font-awesome-5.min.css' );
	// Font Awesome
	if ( is_page( 1484 ) ) {
		wp_enqueue_style( 'css-lernpress', home_url() . '/wp-content/plugins/learnpress/assets/css/learnpress.min.css' );
	}
	if ( is_archive() || is_page( 272 ) || is_page( 3455 ) || is_page(3642) || is_front_page()) {
		wp_enqueue_style( 'datatable-css', get_stylesheet_directory_uri() . '/assets/css/jquery.dataTables.min.css' );
		wp_enqueue_style( 'datatable-reponsive-css', get_stylesheet_directory_uri() . '/assets/css/responsive.dataTables.min.css' );
		wp_enqueue_style( 'datatable-reponsive-select-css', get_stylesheet_directory_uri() . '/assets/css/select.dataTables.min.css' );

		wp_enqueue_script( 'datatable-js', get_stylesheet_directory_uri() . '/assets/js/jquery.dataTables.min.js', array( 'jquery' ), 1.1, true );
		wp_enqueue_script( 'datatable-reponsive-js', get_stylesheet_directory_uri() . '/assets/js/dataTables.responsive.min.js', array( 'jquery' ), 1.1, true );
		wp_enqueue_script( 'datatable-reponsive-select-js', get_stylesheet_directory_uri() . '/assets/js/dataTables.select.min.js', array( 'jquery' ), 1.1, true );
		wp_enqueue_script( 'datatable-custom', get_stylesheet_directory_uri() . '/assets/js/jquerytable.js', array( 'jquery' ), 1.1, true );
	}
	wp_enqueue_script( 'key-frame', get_stylesheet_directory_uri() . '/assets/js/jquery.keyframes.min.js', array( 'jquery' ), 1.1, true );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
function add_theme_scripts() {
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/assets/client.js', array( 'jquery' ), 1.1, true );
	// wp_enqueue_style( 'style_css', get_stylesheet_directory_uri() . '/fonts/font-awesome.min.css' );
}


function tp_custom_logo() {
	?>
	<style type="text/css">
		#login h1 a {
			background-image: url(<?php echo get_theme_mod( 'site_logo' ); ?>);
			background-size: contain;
			width: 100%;
			height: 110px;
			margin: 0;
		}
	</style>
	<?php
}

add_action( 'login_enqueue_scripts', 'tp_custom_logo' );


// * Hide this administrator account from the users list
add_action( 'pre_user_query', 'dt_pre_user_query', 10, 2 );
function dt_pre_user_query( $user_search ) {
	global $current_user;
	$username = $current_user->user_login;

	if ( $username != 'a2ztech_admin' ) {
		global $wpdb;
		$user_search->query_where = str_replace(
			'WHERE 1=1',
			"WHERE 1=1 AND {$wpdb->users}.user_login != 'a2ztech_admin'",
			$user_search->query_where
		);
	}
	if ( ( is_post_type_archive( 'uptrend_stocks' ) ) && $user_search->is_main_query() ) {
		$user_search->set( 'posts_per_page', -1 );

		return $user_search;
	}
}

add_filter( 'use_block_editor_for_post', '__return_false', 10 );

// btn-xemthem - bai viet
add_action( 'flatsome_blog_post_after', 'info_news_meta', 17 );
function info_news_meta() {
	?>
	<?php if ( ! is_front_page() ) { ?>
		<div class="info-news-meta">
			<div class="info-author">
				<?php
					$author_id = get_post_field( 'post_author', get_the_ID() );
					$username  = get_the_author_meta( 'user_nicename', $author_id );
				?>
				<img src="<?php echo esc_url( get_avatar_url( $author_id ) ); ?>" />
				<?php echo $username; ?>
			</div>
			<div class="info-date">
				<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z" fill="#475467"/>
				</svg>
				<?php echo get_the_date( 'd-m-y' ); ?>
			</div>
		</div>
	<?php } ?>
	<?php
}

register_nav_menus(
	array(
		'menu-sidebar' => esc_html__( 'Menu Sidebar', 'flatsome' ),
	)
);

function shortcode_menu_sidebar() {
	$menu      = '<div id="menu">';
		$menu .= wp_nav_menu(
			array(
				'theme_location' => 'menu-sidebar',
				'menu_id'        => 'menu-sidebar',
				'menu_class'     => 'menu-sidebar',
			)
		);
	$menu     .= '</div>';
	return $menu;
}
add_shortcode( 'shortcode_menu_sidebar', 'shortcode_menu_sidebar' );

function shortcode_menu_topbar() {
	$menu  = '<div id="menu">';
	$menu .= wp_nav_menu(
		array(
			'theme_location' => 'top_bar_nav',
			'menu_id'        => 'menu-info-user',
			'menu_class'     => 'menu-info-user',
		)
	);
	$menu .= '</div>';
	return $menu;
}
add_shortcode( 'shortcode_menu_topbar', 'shortcode_menu_topbar' );


add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2 );
function my_wp_nav_menu_objects( $items, $args ) {
	foreach ( $items as &$item ) {
		$icon = get_field( 'icon_menu', $item );
		if ( $icon ) {
			$item->title .= $icon;
		}
	}
	return $items;
}

/**
 * Add Widget
 */
function sh_register_footer_widget_areas() {

	register_sidebar(
		array(
			'name'          => sprintf( __( 'Sidebar tin thị trường', 'shtheme' ) ),
			'id'            => sprintf( 'sidebar-market-analyst' ),
			'description'   => sprintf( __( 'Hiển thị bài viết theo chuyên mục', 'shtheme' ) ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => sprintf( __( 'Menu Sidebar', 'shtheme' ) ),
			'id'            => sprintf( 'menu-sidebar' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => sprintf( __( 'Menu Info User', 'shtheme' ) ),
			'id'            => sprintf( 'menu-info-user' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

}
add_action( 'widgets_init', 'sh_register_footer_widget_areas' );

if ( ! function_exists( 'hiepdesign_mce_text_sizes' ) ) {
	function hiepdesign_mce_text_sizes( $initArray ) {
		$initArray['fontsize_formats'] = '8px 10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 48px 60px 72px 96px';
		return $initArray;
	}
	add_filter( 'tiny_mce_before_init', 'hiepdesign_mce_text_sizes', 99 );
}


function generate_license($suffix = null) {

	global $wpdb;
    // Default tokens contain no "ambiguous" characters: 1,i,0,o
	
		if(isset($suffix)){
			// Fewer segments if appending suffix
			$num_segments = 3;
			$segment_chars = 6;
		}else{
			$num_segments = 2;
			$segment_chars = 5;
		}
		$tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
	
	$i = 0;

	do {	
		
		$license_string = '';
		// Build Default License String
		for ($i = 0; $i < $num_segments; $i++) {
			$segment = '';
			for ($j = 0; $j < $segment_chars; $j++) {
				$segment .= $tokens[rand(0, strlen($tokens)-1)];
			}
			$license_string .= $segment;
			if ($i < ($num_segments - 1)) {
				$license_string .= '-';
			}
		}
		// If provided, convert Suffix
		if(isset($suffix)){
			if(is_numeric($suffix)) {   // Userid provided
				$license_string .= '-'.strtoupper(base_convert($suffix,10,36));
			}else{
				$long = sprintf("%u\n", ip2long($suffix),true);
				if($suffix === long2ip($long) ) {
					$license_string .= '-'.strtoupper(base_convert($long,10,36));
				}else{
					$license_string .= '-'.strtoupper(str_ireplace(' ','-',$suffix));
				}
			}
		}
	
		$data_code = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_value LIKE '{$license_string}'" );
	} while(!empty($data_code));

    return $license_string;
}

// function regenerate_code(){
// 	$data = generate_license();
// 	do {
// 		$data_code = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_value LIKE '{$data}'" );
// 	} while(!empty($data_code));
// 	return $data;
// }

// global $wpdb;
// //$code_text = generate_license();
// $code_text = 'R7S4S-ZN2LW';

// debug($data_code);



add_action( 'wp_ajax_login_ajax', 'login_ajax' );
add_action( 'wp_ajax_nopriv_login_ajax', 'login_ajax' );
function login_ajax() {
	$info                  = array();
	$info['user_login']    = $_POST['phone'];
	$info['user_password'] = $_POST['password'];
	if ( $_POST['remeber_check'] == 1 ) {
		$info['remember'] = true;
	} else {
		$info['remember'] = false;
	}
	$user_signon = wp_signon( $info, false );
	if ( ! is_wp_error( $user_signon ) ) {
		wp_set_current_user( $user_signon->ID );
		wp_set_auth_cookie( $user_signon->ID );
		wp_send_json(
			array(
				'loggedin' => true,
				'message'  => __( 'Đăng nhập thành công! vui lòng chờ...' ),
			)
		);
	} else {
		wp_send_json(
			array(
				'loggedin' => false,
				'message'  => __( 'Thông tin đăng nhập không chính xác' ),
			)
		);
	}
	die();
}
function validate_mobile( $mobile ) {
	return preg_match( '/^[0-9]{10}+$/', $mobile );
}
add_action( 'wp_ajax_register_modal', 'register_modal' );
add_action( 'wp_ajax_nopriv_register_modal', 'register_modal' );
function register_modal() {

	global $wpdb;
	$code_invite = generate_license();
	$new_user_password  = $_POST['password'];
	$new_user_firstname = $_POST['firstname'];
	$new_user_lastname  = $_POST['lastname'];
	$new_user_phone     = $_POST['phone'];
	$dataref            = array();

	$user_data          = array(
		'user_login' => $new_user_phone,
		'user_pass'  => $new_user_password,
		'first_name' => $new_user_firstname,
		'last_name'  => $new_user_lastname,
		'role'       => 'customer',
	);

	$new_code_intro = '';
	if ( isset( $_POST['code_intro'] ) && '' !== $_POST['code_intro'] ) {
		$new_code_intro = $_POST['code_intro'];
	} else {
		$affiliate_id = slicewp_get_referrer_affiliate_id();
		if ( ! is_null( $affiliate_id ) ) {
			$affiliate = slicewp_get_affiliate( $affiliate_id );
			if ( ! is_null( $affiliate ) ) {
				$new_code_intro = get_user_meta( $affiliate->get( 'user_id' ), 'ma_gioi_thieu', true );
			}
		}
	}

	$authors = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}usermeta WHERE meta_value LIKE '{$new_code_intro}'" );

	if ( empty( $authors ) ) {
		wp_send_json(
			array(
				'register' => false,
				'message'  => __( 'Mã giới thiệu không tồn tại! . ' ),
			)
		);
		die();
	}


	if ( ! validate_mobile( $new_user_phone ) ) {
		wp_send_json(
			array(
				'register' => false,
				'message'  => __( 'Định dạng số điện thoại không đúng!. ' ),
			)
		);
		die();
	}
	if ( username_exists( $new_user_phone ) ) {
		wp_send_json(
			array(
				'register' => false,
				'message'  => __( 'Số điện thoại đăng ký đã tồn tại!. ' ),
			)
		);
		die();
	} else {

		$user_id = wp_insert_user( $user_data );

		if ( $user_id != '' ) {
			update_user_meta( $user_id, 'billing_phone', $new_user_phone );
			if ( ! empty( $authors ) ) {
				$id       = $authors[0]->user_id;
				$userdata = get_user_meta( $id, 'data_ref', true );
				if ( ! is_array( $userdata ) ) {
					$userdata = array();

				}
				$userdata[] = array(
					'user_used' => $user_id,
					'datetime'  => date( 'd-m-y h:i:s' ),
				);

				

				update_user_meta( $id, 'data_ref', $userdata );

				// add referral user id if code_intro exists.
				update_user_meta( $user_id, 'referral_user', $id );

		
				update_field( 'ma_gioi_thieu', $code_invite, 'user_'.$user_id );

				wp_send_json(
					array(
						'register' => true,
						'message'  => __( 'Đăng ký thành công' ),
					)
				);
			}
			die();
		} else {
				wp_send_json(
					array(
						'register' => false,
						'message'  => __( 'Có lỗi xảy ra, vui lòng thử lại!' ),
					)
				);
			if ( isset( $user_id->errors['empty_user_login'] ) ) {
				$notice_key = 'User Name and Email are mandatory';
				wp_send_json(
					array(
						'register' => false,
						'message'  => __( 'User Name and Email are mandatory' ),
					)
				);
			} elseif ( isset( $user_id->errors['existing_user_login'] ) ) {
				echo 'User name already exixts.';
			} else {
				echo 'Error Occured please fill up the sign up form carefully.';
			}
		}
	}

	die;
}
add_action( 'wp_ajax_change_info_user', 'change_info_user' );
add_action( 'wp_ajax_nopriv_change_info_user', 'change_info_user' );
function change_info_user() {
	global $wpdb;
	$current_user         = wp_get_current_user();
	$username             = $current_user->user_login;
	$user                 = get_user_by( 'login', $username );
	$current_user_id      = $current_user->ID;
	$new_user_firstname   = $_POST['firstname'];
	$new_user_lastname    = $_POST['lastname'];
	$new_user_fullname    = $new_user_firstname . ' ' . $new_user_lastname;
	$new_user_password    = $_POST['password'];
	$new_user_newpassword = $_POST['new_password'];
	$website              = get_home_url();
	$userdata             = array(
		'user_url' => $website,
	);
	if ( $user && wp_check_password( $new_user_password, $user->data->user_pass, $user->ID ) ) {
		$user_data = $wpdb->update( $wpdb->users, $userdata, array( 'ID' => $current_user_id ) );
		if ( $new_user_firstname && $new_user_lastname ) {
			update_user_meta( $current_user_id, 'nickname', $new_user_fullname );
			$user_data = $wpdb->update( $wpdb->users, array( 'display_name' => $new_user_fullname ), array( 'ID' => $current_user_id ) );
		}
		if ( isset( $_POST['new_password'] ) && ! empty( $_POST['new_password'] ) ) {
			$user_data = $wpdb->update( $wpdb->users, array( 'user_pass' => wp_hash_password( $new_user_newpassword ) ), array( 'ID' => $current_user_id ) );
		}
		if ( isset( $_POST['firstname'] ) && ! empty( $_POST['firstname'] ) ) {
			update_user_meta( $current_user_id, 'first_name', $new_user_firstname );
		}
		if ( isset( $_POST['lastname'] ) && ! empty( $_POST['lastname'] ) ) {
			update_user_meta( $current_user_id, 'last_name', $new_user_lastname );
		}
		wp_send_json(
			array(
				'save'    => true,
				'message' => __( 'Thay đổi thông tin thành công.' ),
			)
		);
	} else {
		wp_send_json(
			array(
				'save'    => false,
				'message' => __( 'Mật khẩu sai.' ),
			)
		);
	}
	die();
}


add_filter( 'pre_get_posts', 'custom_change_uptrend_stocks_posts_per_page' );
/**
 * Change Posts Per Page for Portfolio Archive.
 *
 * @param object $query data
 */
function custom_change_uptrend_stocks_posts_per_page( $query ) {

	if ( ( $query->is_post_type_archive( 'uptrend_stocks' ) || $query->is_post_type_archive( 'hot_stock_anlysis' ) || $query->is_post_type_archive( 'khuyennghi' ) ) && ! is_admin() && $query->is_main_query() ) {
		  $query->set( 'posts_per_page', '-1' );
	}
	return $query;

}

add_action( 'flatsome_blog_image_post_after', 'show_icon_video_post' );
function show_icon_video_post() {
	$icon_video = get_field( 'dinh_dang_bai_viet' );
	if ( $icon_video ) {
		echo '<div class="icon_video"></div>';
	}
}
add_action( 'wp_footer', 'add_loader_ajax' );
function add_loader_ajax() {
	echo '<div id="loader" class="lds-dual-ring overlay hidden"></div>';
	?>
		<div id="sidebar-chart" class="mobile-sidebar no-scrollbar mfp-hide">
			<div class="title-box-chart">
				Biểu đồ kĩ thuật
			</div>
			<iframe src="https://info.sbsi.vn/chart/?symbol=VNINDEX&language=vi&theme=light" frameborder="0" width="100%" height="100%" style="margin:0"></iframe>
		</div>
	<?php 
}

/**
 * Count view post
 **/
function postview_set( $postID ) {
	$count_key = 'postview_number';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}
}

function postview_get( $postID ) {
	$count_key = 'postview_number';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
		return '0 ' . __( 'lượt xem', 'shtheme' );
	}
	return $count . ' ' . __( 'lượt xem', 'shtheme' );
}

if ( ! function_exists( 'wp_educationlearn_press_custom_tab_content' ) ) {
	function wp_educationlearn_press_custom_tab_content() {
		$user_id = get_current_user_id();
		?>
		<div class="course-entry-teachers">
			<h3 class="title-tabs">Giảng viên</h3>
			<div class="course_teachers">
				<div class="teacher-item">
					<div class="teacher-avatar radius-c">
						<img src="<?php echo get_avatar_url( $user_id ); ?>">
					</div>
					<div class="teacher-name">
						<?php echo get_field( 'ho_ten_giang_vien', 'user_' . $user_id ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}


add_filter( 'learn-press/course-tabs', 'theme_prefix_lp_course_tab_remove' );

function theme_prefix_lp_course_tab_remove( $tabs ) {
	unset( $tabs['reviews'] );
	return $tabs;
}

add_shortcode( 'upgrade_account', 'upgrade_account' );
function upgrade_account() {
	global $current_user;
	$time = $current_user->membership_level->enddate;
	$id   = $current_user->membership_level->ID;
	ob_start();
	?>
	<div class="row row-small account-packages">
		<?php
			$the_query = new WP_Query(
				array(
					'post_type'   => 'product',
					'post_status' => 'publish',
					'order'       => 'ASC',
					'orderby'     => 'ID',
					'tax_query'   => array(
						array(
							'taxonomy' => 'product_cat',
							'field'    => 'slug',
							'terms'    => 'nang-cap-tai-khoan',
						),
					),
				)
			);
		if ( $the_query->have_posts() ) {
			?>
				<?php while ( $the_query->have_posts() ) { ?>
					<?php $the_query->the_post(); ?>
					<?php
						$postid  = get_the_ID();
						$product = wc_get_product( $postid );
						$data    = get_post_meta( $postid, '_membership_product_level', true );
						global $wpdb;
						$data_membership = $wpdb->get_results( 'SELECT * FROM a2z_pmpro_membership_levels WHERE id=' . $data );
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

					?>
					<div id="col-1032580377" class="col medium-4 small-12 large-4">
						<div class="col-inner">                                     
							<div class="top-package">
								<h3>
									<?php
									the_title();
									if ( '1275' == $postid ) {
										echo '<sup>Phổ biến</sup>';
									}
									?>
								</h3>
								<div class="info-package">
									<?php
										global $post;
										$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
										echo $short_description;
									?>
								</div>
								<p class="price-package"><?php echo $product->get_price_html(); ?><span class="late-date">/ <?php echo $numbermonth . ' ' . $datamonth; ?> </span></p>
							</div>
							<?php if ( $id != $data ) { ?>
							<a class="button primary lowercase upgrade-now" href="<?php echo home_url(); ?>/thanh-toan?add-to-cart=<?php echo $postid; ?>">
								<span>Mua Ngay</span>
							</a>
							<?php } else { ?>
								<?php if ( ! empty( $datamonth ) ) { ?>
								<a class="button primary lowercase upgrade-now" href="<?php echo home_url(); ?>/thanh-toan?add-to-cart=<?php echo $postid; ?>">
								<span>Gia hạn ngay</span>
							</a>
							<?php } else { ?>
								<a class="button primary lowercase upgrade-now" href="#">
								<span>Không thể gia hạn</span>
							</a> 
								<?php } ?>
								<?php } ?>
							<hr>
							<div class="bot-package">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
	</div>
	
	<?php
	return ob_get_clean();
}

add_filter( 'woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2 );
function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch ( $currency ) {
		case 'VND':
			$currency_symbol = 'VNĐ';
			break;
	}
	return $currency_symbol;
}

// Add the filter to manage the p tags
add_filter( 'the_content', 'wti_remove_autop_for_image', 0 );
function wti_remove_autop_for_image( $content ) {
	if ( is_page() ) {
		remove_filter( 'the_content', 'wpautop' );
	}
	 return $content;
}

register_nav_menus(
	array(
		'account-management' => esc_html__( 'Account Management', 'shtheme' ),
	)
);

function menu_account_management() {
	wp_nav_menu(
		array(
			'theme_location' => 'account-management',
			'menu_id'        => 'account-management',
			'menu_class'     => 'menu account-management',
		)
	);
}

function info_account_management() {
	global $current_user;
	
	
	?>
	<div class="snt-account-header d-flex align-item-center">
		<div class="avatar rounded-circle">
			<img src="<?php echo get_avatar_url( $current_user->ID ); ?>">
		</div>
		<div class="user-title">
			<div class="user-name">Hi, <?php echo $current_user->display_name; ?></div>
			<div class="user-group d-flex align-item-center">
				<?php 
					if($current_user->membership_level->name){ ?>
						<span>Gói tài khoản </span>
						<span class="snt-usergroup"><?php  echo $current_user->membership_level->name; ?></span>
						<?php 
					}else{ 
						echo '<span>Gói tài khoản: chưa có!</span>';
					}
				?>
				
			</div>
		</div>
	</div>
	<?php
}

function ra_change_translate_text_multiple( $translated, $text, $domain ) {
	$text       = array(
		'processing' => 'Đang xử lý',
		'completed'  => 'Đang hoàn tất',
	);
	$translated = str_ireplace( array_keys( $text ), $text, $translated );
	return $translated;
}
add_filter( 'gettext', 'ra_change_translate_text_multiple', 10, 3 );

// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_filter( 'woocommerce_cart_needs_payment', '__return_false' );
add_filter( 'woocommerce_order_button_text', 'misha_custom_button_text' );
function misha_custom_button_text( $button_text ) {
	return 'Xác nhận thanh toán'; // new text is here
}

function filter_woocommerce_order_number( $order_number, $order ) {
	$prefix = 'HNH';
	return $prefix . $order_number;
}
add_filter( 'woocommerce_order_number', 'filter_woocommerce_order_number', 10, 2 );
// add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2 );

add_action( 'wp_footer', 'popup_notifi' );
function popup_notifi() {
	global $current_user;
	$id_user = $current_user->ID;
	$level   = $current_user->membership_level;
	$nowid   = $level->ID;
	if ( ! empty( $nowid ) ) {
		?>
		<div class="popUp" id="popUp-notifi">
			<div id="close" class="close"><i class="fa fa-times"></i></div>
			<div id="new">Thông báo mới!</div>
			<ul>
			<?php
			 global $wpdb;
			 $results = $wpdb->get_results( 'SELECT * FROM a2z_notice WHERE user_id = 0 OR user_id=' . $id_user . ' AND readed = 0' );
			foreach ( array_reverse( $results ) as $key ) {
				?>
				<li><span><?php echo date( 'd-m-Y H:i:s', strtotime( $key->date_notice ) ); ?></span><p><?php echo $key->content_notice; ?></p></li>
			 <?php } ?>
			 </ul>
		</div>
		<?php
	}
}

add_action( 'wp_footer', 'popup_news' );
function popup_news() {
	?>
		<div class="popUp" id="popUp-news">
			<div id="close" class="close"><i class="fa fa-times"></i></div>
			<div id="new"><span>Tin tức mới!</span></div>
			<ul class="list-item-news">
				<?php
				$query = new WP_Query(
					array(
						'post_type'      => array( 'market_analyst', 'stocks', 'post', 'uptrend_stocks', 'post' ),
						'meta_key'       => 'thong_bao_news',
						'meta_value_num' => 1,
						'meta_compare'   => '=',
					)
				);
				if ( $query->have_posts() ) :
					while ( $query->have_posts() ) :
						$query->the_post();
						$post_type = get_post_type_object( get_post_type( get_the_ID() ) );
						?>
					<li>
						<a href="<?php the_permalink(); ?>">
							<div class="box-img">
								<?php the_post_thumbnail( get_the_ID() ); ?>
							</div>
							<div class="box-txt">
								<label><?php echo $post_type->labels->singular_name; ?></label>
								<div><?php the_title(); ?></div>
								<div><i class="fas fa-calendar-alt"></i>&nbsp;<?php echo get_the_date( 'd-m-Y h:s:i' ); ?></div>
							</div>
						</a>
					</li>
						<?php
				endwhile;
					wp_reset_query();
endif;
				?>
			</ul>
		</div>
	<?php
}

add_action( 'wp_footer', 'popup_contact' );
function popup_contact() {
	echo do_shortcode( '[lightbox id="contact" width="395px" padding="30px 24px 20px 24px"][contact-form-7 id="1533" title="Liên hệ với chúng tôi"][/lightbox]' );
	echo '<a href="#fan-quote-520" target="_self" class="button primary showstocks d-none"></a>';
	echo do_shortcode( '[lightbox id="fan-quote-520" width="600px" padding="20px"]Loading...[/lightbox]' );

}

// The shortcode function
function shortcodebox() {
	$data            = pmpro_getAllLevels();
	$last_permission = end( $data );

	if ( ! is_user_logged_in() ) {

		$string = '
        <ul class="snt-top-notice">
        <li>
            <div class="snt-icon-notice" id="notice-news">
                <a>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.8424 11.9058C12.2931 12.0751 12.8132 12.0487 13.2626 11.7892L17.5927 9.28916C18.3899 8.82899 18.663 7.80964 18.2027 7.01248L16.1194 3.40405C15.6592 2.60689 14.6399 2.33377 13.8427 2.79401L9.51258 5.29401C8.97341 5.60529 8.67399 6.17233 8.67908 6.75341C8.61349 6.78076 8.54899 6.81262 8.48583 6.84907L4.87738 8.93241C4.33825 9.24366 4.03881 9.81066 4.04383 10.3917C3.97831 10.4191 3.91379 10.4509 3.85067 10.4874L2.40729 11.3207C1.61014 11.781 1.33702 12.8002 1.79725 13.5974L2.21392 14.3191C2.67416 15.1162 3.69348 15.3894 4.49063 14.9292L5.934 14.0958C5.99712 14.0594 6.05693 14.0194 6.11338 13.9764C6.61408 14.2713 7.25488 14.2955 7.79405 13.9842L9.30799 13.1102L7.56735 17.1717C7.38605 17.5947 7.58201 18.0847 8.00503 18.2659C8.42808 18.4472 8.91799 18.2512 9.09924 17.8282L10.8333 13.7822L12.5673 17.8282C12.7487 18.2512 13.2386 18.4472 13.6616 18.2659C14.0846 18.0847 14.2806 17.5947 14.0992 17.1717L11.8424 11.9058Z" fill="#FFC629"/>
                    </svg>
                    <svg class="have-notice" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="3.5" cy="3.5" r="3" fill="#D92D20" stroke="#344054"/><!-- if .have-notice -->
                    </svg>
                    <span class="hide-for-medium">Tin mới nhất</span>
                </a>
            </div>
        </li>
        <li>
            <div class="snt-icon-notice" id="notice">
                <a>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5 15.8333C12.5 16.712 11.8201 17.4318 10.9577 17.4954L10.8333 17.5H9.16665C8.28802 17.5 7.56818 16.8201 7.50456 15.9577L7.49999 15.8333H12.5ZM10.0002 1.66663C13.1547 1.66663 15.7244 4.17061 15.8301 7.29942L15.8335 7.49996V10.6365L17.3518 13.6734C17.6421 14.2539 17.2539 14.9319 16.6277 14.9952L16.532 15H3.4683C2.81931 15 2.38641 14.3495 2.6099 13.7611L2.6484 13.6734L4.16679 10.6365V7.49996C4.16679 4.2783 6.77846 1.66663 10.0002 1.66663Z" fill="#FFC629"/>
                    </svg>
                    <svg class="have-notice" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="3.5" cy="3.5" r="3" fill="#D92D20" stroke="#344054"/><!-- if .have-notice -->
                    </svg>
                    <span class="hide-for-medium">Thông báo</span>
                </a>
            </div>
        </li>
        <li class="sig-log">
            <a href="/dang-ky" class="btn-sig">Đăng ký</a>
            <a href="/dang-nhap" class="btn-log">Đăng nhập</a>
        </li>
        </ul>';
	} else {
		global $current_user,$wpdb;
		$id_user  = $current_user->ID;
		$results  = $wpdb->get_results( 'SELECT * FROM a2z_notice WHERE user_id = 0 OR user_id=' . $id_user . ' AND readed = 0' );
		$number   = count( $results );
		$user     = wp_get_current_user();
		$username = $user->display_name;
		$user_id  = $user->ID;
		$urlavata = get_avatar_url( $user_id );
		$level    = $user->membership_level;
		$lastid   = $last_permission->id;
		$nowid    = $level->ID;
		if ( $level == false ) {
			$stringlevel = '<li><div class="upgrade-account">
        <a href="' . home_url() . '/quan-ly-tai-khoan/nang-cap-tai-khoan/" title="Nâng cấp ngay">
            <p class="upgrade-now">Nâng cấp ngay</p>
            <p>Mở khóa tất cả tính năng</p>
        </a>
        </div></li>';
		} elseif ( $lastid != $nowid ) {
			if ( empty( $level->name ) ) {
				$name = 'Miễn phí';
			} else {
				$name = $level->name;
			}
			$stringlevel = '<li class="hide-for-medium"><div class="upgrade-account">
            <a href="' . home_url() . '/quan-ly-tai-khoan/nang-cap-tai-khoan/" title="Nâng cấp ngay">
                <p class="upgrade-now">Gói ' . $name . '</p>
                <p>Nâng cấp ngay</p>
            </a>
            </div></li>';
		}
		$string                      = '<ul class="snt-top-notice">';
			$string                 .= '<li>';
				$string             .= '<div class="snt-icon-notice" id="notice-news">';
					$string         .= '<a>';
						$string     .= '<svg width="25" height="25" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">';
							$string .= '<path d="M11.8424 11.9058C12.2931 12.0751 12.8132 12.0487 13.2626 11.7892L17.5927 9.28916C18.3899 8.82899 18.663 7.80964 18.2027 7.01248L16.1194 3.40405C15.6592 2.60689 14.6399 2.33377 13.8427 2.79401L9.51258 5.29401C8.97341 5.60529 8.67399 6.17233 8.67908 6.75341C8.61349 6.78076 8.54899 6.81262 8.48583 6.84907L4.87738 8.93241C4.33825 9.24366 4.03881 9.81066 4.04383 10.3917C3.97831 10.4191 3.91379 10.4509 3.85067 10.4874L2.40729 11.3207C1.61014 11.781 1.33702 12.8002 1.79725 13.5974L2.21392 14.3191C2.67416 15.1162 3.69348 15.3894 4.49063 14.9292L5.934 14.0958C5.99712 14.0594 6.05693 14.0194 6.11338 13.9764C6.61408 14.2713 7.25488 14.2955 7.79405 13.9842L9.30799 13.1102L7.56735 17.1717C7.38605 17.5947 7.58201 18.0847 8.00503 18.2659C8.42808 18.4472 8.91799 18.2512 9.09924 17.8282L10.8333 13.7822L12.5673 17.8282C12.7487 18.2512 13.2386 18.4472 13.6616 18.2659C14.0846 18.0847 14.2806 17.5947 14.0992 17.1717L11.8424 11.9058Z" fill="#FFC629"/>';
						$string     .= '</svg>';
						$string     .= '<svg class="have-notice" width="7" height="7" viewBox="0 0 7 7" fill="none" xmlns="http://www.w3.org/2000/svg">';
							$string .= '<circle cx="3.5" cy="3.5" r="3" fill="#D92D20" stroke="#344054"/>';
						$string     .= '</svg>';
						$string     .= '<span class="hide-for-medium">Tin mới nhất</span>';
					$string         .= '</a>';
				$string             .= '</div>';
			$string                 .= '</li>';

		if ( ! empty( $level->name ) ) {
			$string             .= '<li>';
			$string             .= '<div class="snt-icon-notice" id="notice">';
				$string         .= '<a>';
					$string     .= '<svg width="25" height="25" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">';
						$string .= '<path d="M12.5 15.8333C12.5 16.712 11.8201 17.4318 10.9577 17.4954L10.8333 17.5H9.16665C8.28802 17.5 7.56818 16.8201 7.50456 15.9577L7.49999 15.8333H12.5ZM10.0002 1.66663C13.1547 1.66663 15.7244 4.17061 15.8301 7.29942L15.8335 7.49996V10.6365L17.3518 13.6734C17.6421 14.2539 17.2539 14.9319 16.6277 14.9952L16.532 15H3.4683C2.81931 15 2.38641 14.3495 2.6099 13.7611L2.6484 13.6734L4.16679 10.6365V7.49996C4.16679 4.2783 6.77846 1.66663 10.0002 1.66663Z" fill="#FFC629"/>';
					$string     .= '</svg>';
					$string     .= '<span class="have-notice">' . $number . '</span>';
					$string     .= '<span>Thông báo</span>';
				$string         .= '</a>';
			$string             .= '</div>';
			$string             .= '</li>';
		}

			$string                 .= '<li class="html custom html_topbar_right">';
				$string             .= '<div class="snt-user-login-header d-flex align-items-center">';
					$string         .= '<div class="user-login-avatar rounded-circle">';
						$string     .= '<a href="' . home_url( 'quan-ly-tai-khoan' ) . '">';
							$string .= '<img src="' . $urlavata . '" alt="User Avatar" title="">';
						$string     .= '</a>';
					$string         .= '</div>';
					$string         .= '<div class="menu-user">';
						$string     .= do_shortcode( '[ux_sidebar id="menu-info-user"]' );
					$string         .= '</div>';
				$string             .= '</div>';
			$string                 .= '</li>';
			$string                 .= $stringlevel;
		$string                     .= '</ul>';
	}
	// Ad code returned
	return $string;

}
	// Register shortcode
add_shortcode( 'Nangcapgoi', 'shortcodebox' );


add_action( 'show_user_profile', 'pmpro_membership_history_affilate' );
add_action( 'edit_user_profile', 'pmpro_membership_history_affilate' );
add_action( 'personal_options_update', 'pmpro_membership_history_affilate' );
add_action( 'edit_user_profile_update', 'pmpro_membership_history_affilate' );

function pmpro_membership_history_affilate( $user ) {
	$membership_level_capability = apply_filters( 'pmpro_edit_member_capability', 'manage_options' );

	if ( ! current_user_can( $membership_level_capability ) ) {
		return false;
	}
	$id      = $user->ID;
	$dataref = get_user_meta( $id, 'data_ref', true );
	?>
	<hr />
		<h3><?php esc_html_e( 'Thông tin người dùng mã GT', 'paid-memberships-pro' ); ?></h3>
		<div id="member-history-orders" class="widgets-holder-wrap">
			<?php if ( empty( $dataref ) ) { ?>
					<table class="wp-list-table widefat striped fixed" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tbody>
					<tr>
						<td>Chưa có người sử dụng mã giới thiệu của bạn</td>
					</tr>
				</tbody>
			</table>
			<?php } else { ?>
				<table class="wp-list-table widefat striped fixed" width="100%" cellpadding="0" cellspacing="0" border="0">
  <thead>
	<tr>
	  <th>Date</th>
	  <th>Người dùng sử dụng</th>
	  
	</tr>
  </thead>
  <tbody>
				<?php
				foreach ( $dataref as $key ) {
					?>
	<tr>
	  <td> <?php echo $key['datetime']; ?> </td>
					<?php $use_data = get_user_by( 'id', $key['user_used'] ); ?>
	  <td> <?php echo $use_data->display_name; ?> </td>
	</tr>
				<?php } ?>
  </tbody>
</table>
				<?php } ?>
				</div>
	<?php

}


/** Vo hieu hoa tat ca cac thong bao cap nhat trong WordPress */
function remove_core_updates() {
	global $wp_version_check;
	return (object) array(
		'last_checked'    => time(),
		'version_checked' => $wp_version_check,
	);
}
add_filter( 'pre_site_transient_update_core', 'remove_core_updates' );
add_filter( 'pre_site_transient_update_plugins', 'remove_core_updates' );
add_filter( 'pre_site_transient_update_themes', 'remove_core_updates' );

// add_filter( 'wc_add_to_cart_message_html', '__return_null' );

function user_track_stock() {
	global $wpdb,$current_user;
	$user_id = $current_user->ID;
	$idstock = array();
	$data    = $wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id" );
	if ( ! empty( $data ) ) {
		foreach ( $data as $key ) {
			$idstock[] = $key->id_stock;
		}
	}
	$html  = '';
	$html .= '&nbsp;<span class="count-stock">(' . count( $idstock ) . ')</span>';
	return $html;
}
add_shortcode( 'user_track_stock', 'user_track_stock' );

// add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items, $args ) {
	if ( $args->theme_location == 'account-management' ) {
		$searchbox .= '<li class="menu-searchbox">';
		$searchbox .= do_shortcode( '[user_track_stock]' );
		$searchbox .= '</li>';
	}
	return $searchbox . $items;
}

add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_1', 10, 2 );
function my_wp_nav_menu_objects_1( $items, $args ) {
	if ( $args->theme_location == 'account-management' ) {
		foreach ( $items as $key => $item ) {
			if ( $key == 1 ) {
				$item->title .= do_shortcode( '[user_track_stock]' );
			}
		}
	}
	return $items;
}

add_shortcode( 'shortcode_popup_content_analysis_stock', 'shortcode_popup_content_analysis_stock' );
function shortcode_popup_content_analysis_stock() {
	$html  = '<div class="result-content">';
	$html .= '</div>';
	return $html;
}

add_action( 'wp_footer', 'popup_content_analysis_stock' );
function popup_content_analysis_stock() {
	echo do_shortcode( '[lightbox id="popup_content_analysis_stock" width="864px" padding="0"][shortcode_popup_content_analysis_stock][/lightbox]' );
}

add_action( 'wp_ajax_ajax_content_analysis_stock', 'ajax_content_analysis_stock_init' );
add_action( 'wp_ajax_nopriv_ajax_content_analysis_stock', 'ajax_content_analysis_stock_init' );
function ajax_content_analysis_stock_init() {
	ob_start();
	$id_post   = $_POST['data_id'];
	$args      = array(
		'post_type' => 'hot_stock_analysis',
		'p'         => $id_post,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			echo '<h3 class="heading">' . get_the_title() . '</h3>';
			echo '<div class="row">';
				echo '<div class="col medium-12 small-12 large-6">';
					echo '<div class="col-inner">';
						echo '<div class="title-popup">Lý do biến động</div>';
						echo '<p class="mb-0">' . get_field( 'ly_do_bien_dong' ) . '</p>';
					echo '</div>';
				echo '</div>';
				echo '<div class="col medium-12 small-12 large-6">';
					echo '<div class="col-inner">';
						echo '<div class="title-popup">Xu hướng tương lai</div>';
						echo '<p class="mb-0">' . get_field( 'xu_huong_tuong_lai' ) . '</p>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		endwhile;
	endif;
	wp_reset_query();

	$result = ob_get_clean(); // cho hết bộ nhớ đệm vào biến $result

	wp_send_json_success( $result ); // trả về giá trị dạng json

	die();// bắt buộc phải có khi kết thúc
}

remove_action( 'wpua_before_avatar', 'wpua_do_before_avatar' );
remove_action( 'wpua_after_avatar', 'wpua_do_after_avatar' );

add_action( 'wp_footer', 'button_question' );
function button_question() {
	?>
		<a id="submit-question" href="<?php home_url(); ?>/ho-tro">
			<i class="fas fa-question"></i>
		</a>
	<?php
}

global $current_user;
$level = $current_user->membership_level->name;
$id    = $current_user->membership_level->id;

$actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if ( ( $id <= 3 || $id = null ) && strpos( $actual_link, 'khuyen-nghi-dau-tu' ) !== false ) {
	wp_redirect( home_url() . '/quan-ly-tai-khoan/nang-cap-tai-khoan' );
	exit;
}


add_action('rest_api_init','init_api');
function init_api() {
    
    register_rest_route('technical-chart/v1','/get-data-new',array(
        //'methods'   =>  "POST",
        'methods' => 'GET',
        'callback'  =>  'get_new_technical_chart',    
    ));

	register_rest_route('/wp/v2','/technical_chart_detail',array(
        //'methods'   =>  "POST",
        'methods' => 'GET',
        'callback'  =>  'get_detail_technical_chart',    
    ));

	register_rest_route( 'technical_chart_detail', 'post_data/(?P<id>\d+)', [
        'methods' => WP_REST_Server::READABLE,
        'permission_callback' => '__return_true',
        'callback' => function ( WP_REST_Request $request ) {
            $id = (int) $request['id'];

            $post = get_post( $id );

            $valid_post_types = get_post_types([
                'public' => true,
                'show_in_rest' => true,
            ]);

            if ( ! in_array('technical_chart', $valid_post_types ) ) {
                return new WP_Error( 'rest_post_invalid_id', __( 'Invalid post ID.' ), [ 'status' => 404 ] );
            }

            $controller = new WP_REST_Posts_Controller( 'technical_chart' );

            $check = $controller->get_item_permissions_check( $request );

            if ( $check !== true ) {
                return $check;
            }

            return $controller->get_item( $request );
           
        }
    ]);
}

// Get all projects and assign thumbnail
function get_new_technical_chart( $params ) {

    $data  = array();
    $args = array(
        'post_type' => 'technical_chart',
        'posts_per_page' => '15',
        'order' => 'DESC',
        'orderby' => 'DATE'
     ); $news = new WP_query($args); 
     if($news->have_posts()):
        while($news->have_posts()): $news->the_post();
            $idp = get_the_ID();
            $title = get_the_title($idp);
            $code_chart = get_field('code_chart_trading_view',$idp);

            $data[$idp] = array(
				'charttite' => $title, 
				'url' => get_the_permalink($idp),
				'content' => get_the_content($idp),
				'code_chart' =>$code_chart, 
			);
     
        endwhile;
    endif;wp_reset_query();

 	
  	return $data;
}

// Get all projects and assign thumbnail
function get_detail_technical_chart( $params ) {

	$data = $_GET['filter'];
 	
  	return $data;
}

function slicewp_custom_round_up_commission_amount( $data ) {

	if ( empty( $data['amount'] ) )
		return $data;

	$data['amount'] = slicewp_sanitize_amount( ceil( $data['amount'] ) );

	return $data;

}
add_filter( 'slicewp_pre_insert_commission_data', 'slicewp_custom_round_up_commission_amount', 50 );


function slicewp_format_amount_custom( $amount, $currency, $show_currency = true ) {

    // Get the currency decimal places
    $decimal_places = 0;
    //$decimal_places = ( isset( $decimal_places[$currency] ) ? absint( $decimal_places[$currency] ) : 2 );

    // Format number to two decimals
    $amount = number_format( (float)$amount, $decimal_places, slicewp_get_setting( 'currency_decimal_separator', '.' ), slicewp_get_setting( 'currency_thousands_separator', '' ) );

    // If show currency is true, add the currency symbol to the appropiate position
    if ( $show_currency ) {

        // Get the currency position set in the settings page
        $currency_position = slicewp_get_setting( 'currency_symbol_position', 'before' );

        // Get the currency symbol for the currency
        $currency_symbol = slicewp_get_currency_symbol( $currency );
        $currency_symbol = ( ! empty( $currency_symbol ) ? $currency_symbol : $currency );

        // Set the format for the amount
        switch( $currency_position ) {

            case 'before':
                $format = '%1$s%2$s';
                break;

            case 'after':
                $format = '%2$s%1$s';
                break;

            case 'before_space':
                $format = '%1$s&nbsp;%2$s';
                break;

            case 'after_space':
                $format = '%2$s&nbsp;%1$s';
                break;

            default:
                $format = '%1$s%2$s';
                break;

        }

        /**
         * Filter the amount format
         *
         * @param string $format
         *
         */
        $format = apply_filters( 'slicewp_amount_format', $format );

        // Format the output
        $formatted_amount = sprintf( $format, $currency_symbol, $amount );

    // If show currency is false, just return the formatted amount, without the currency symbol
    } else {

        $formatted_amount = $amount;

    }

    return $formatted_amount;

}