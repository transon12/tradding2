<?php
/*
	Template Name: User - Register

*/
?>
<?php
get_header();
the_post();

$err     = '';
$success = '';
if ( isset( $_REQUEST['register_member'] ) && wp_verify_nonce( $_REQUEST['register_member'], 'register_member_event' ) ) {
	global $wpdb;

	$new_user_password  = $_POST['password'];
	$new_user_firstname = $_POST['firstname'];
	$new_user_lastname  = $_POST['lastname'];
	$new_user_phone     = $_POST['phone'];
	$new_code_intro     = $_POST['code_intro'];
	$user_data          = array(
		'user_login' => $new_user_phone,
		'user_pass'  => $new_user_password,
		'first_name' => $new_user_firstname,
		'last_name'  => $new_user_lastname,
		'role'       => 'customer',
	);
	$dataref            = array();
	if ( ! empty( $new_code_intro ) ) {

		$authors = $wpdb->get_results( "SELECT * FROM a2z_usermeta WHERE meta_value LIKE '$new_code_intro'" );
		if ( empty( $authors ) ) {
			wp_send_json(
				array(
					'register' => false,
					'message'  => __( 'Mã giới thiệu không tồn tại! . ' ),
				)
			);
			die();
		}
	}
	if ( detect_number( $new_user_phone ) ) {
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
				if ( empty( $user_data ) ) {
					$userdata = array();
				}
				$userdata[] = array(
					'user_used' => $user_id,
					'datetime'  => date( 'd-m-y h:i:s' ),
				);
				update_user_meta( $id, 'data_ref', $userdata );

				// Update referral user id.
				update_user_meta( $user_id, 'referral_user', $id );

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

$referral_code = '';

$affiliate_id = slicewp_get_referrer_affiliate_id();
if ( ! is_null( $affiliate_id ) ) {
	$affiliate = slicewp_get_affiliate( $affiliate_id );
	if ( ! is_null( $affiliate ) ) {
		$aff_user_id   = $affiliate->get( 'user_id' );
		$referral_code = get_user_meta( $aff_user_id, 'ma_gioi_thieu', true );
	}
}
?>

<section class="adong-section-login res">
	<div class="adong-form-login">
		<div class="adong-form-logo">
			<a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" title="<?php echo get_bloginfo(); ?> Logo" alt="<?php echo get_bloginfo(); ?> Logo" class="adong-logo">
			</a>
		</div>

		<p class="adong-welcome">Chào mừng đến với <?php echo get_bloginfo(); ?> </p>
		<p class="adong-note">Vui lòng đăng ký theo mẫu điền dưới để bắt đầu sử dụng dịch vụ</p>
		<p class="adong-go-to-login">Bạn đã có tài khoản? <a href="<?php echo get_site_url(); ?>/dang-nhap" title="Đăng nhập" alt="Đăng nhập">Đăng nhập</a></p>

	<div class="adong-login-input">
	<form action="" method="POST" id="form-register" class="mb-0">
			<div id="message"></div>
		<div class="row row-collapse">
			<div class="col medium-6 small-6 large-6" style="padding-right: 12px !important;">
				<div class="form-outline">
					<label class="form-label" for="last_name_res">Họ</label>
					<input type="text" id="last_name_res" name="last_name" class="form-control" placeholder="Nhập họ của bạn"  aria-label="Last name">
				</div>
			</div>
			<div class="col medium-6 small-6 large-6" style="padding-left: 12px !important;">
				<div class="form-outline">
					<label class="form-label" for="first_name_res">Tên</label>
					<input type="text" id="first_name_res" name="first_name" class="form-control" placeholder="Nhập tên của bạn" aria-label="First name">
				</div>
			</div>
			<div class="col medium-12 small-12 large-12">
				<div class="form-outline">
					<label class="form-label" for="email_res">Số điện thoại</label>
					<input type="tel" id="phone_res" name="phone_res" class="form-control" placeholder="VD: 0353454679" />
				</div>
			</div>
			<div class="col medium-12 small-12 large-12">
				<div class="form-outline toogle-password-outline">
					<label class="form-label" for="password_res">Mật khẩu</label>
					<div class="field-group">
						<input type="password" id="password_res" name="password" class="form-control form-adong-input-password" placeholder="Mật khẩu" />
						<span class="adong-toggle-password eye-disable" id="btn-eye-toggle">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/eye.svg" alt="Hide/Show" class="eye-toggle">
						</span>
					</div>
				</div>
				<div class="form-outline toogle-password-outline">
					<label class="form-label" for="password_res">Nhập lại mật khẩu</label>
					<div class="field-group">
						<input type="password" id="confirm_password_res" name="password" class="form-control form-adong-input-password" placeholder="Nhập lại mật khẩu" />
						<span class="adong-toggle-password eye-disable" id="adong-cf-toggle-password">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/eye.svg" alt="Hide/Show" class="eye-toggle">
						</span>
					</div>
				</div>
			</div>
			<div class="col medium-12 small-12 large-12">
				<div class="form-outline toogle-password-outline">
					<label class="form-label" for="code_res">Mã giới thiệu (Không bắt buộc)</label>
					<div class="field-group">
						<input type="text" id="code_res" name="code_res" value="<?php esc_html_e( $referral_code ); ?>" class="form-control form-adong-input-code" placeholder="Nhập mã giới thiệu" />
					</div>
				</div>
			</div>
			<div class="col medium-12 small-12 large-12 adong-if-password">
				<div class="form-check" style="display:flex;align-content: center;">
					<input class="form-check-input mb-0 mt-0" name="nhan_thongbao" type="checkbox" value="" id="sub_email" checked />
					<label class="form-check-label mb-0" for="sub_email">Tôi đồng ý với các điều khoản & quy định sử dụng.</label>
				</div>
			</div>
			<div class="col medium-12 small-12 large-12">
				<?php wp_nonce_field( 'register_member_event', 'register_member' ); ?>
				<button type="button" id="adong_reg_submit" class="btn btn-primary btn-block adong-login-btn adong-login-submit adong-res-submit">Đăng ký</button>
				<div class="adong-login-terms">Bằng cách tiếp tục, bạn đồng ý với các <a href="<?php echo get_site_url(); ?>/dieu-khoan-su-dung"
							title="Điều khoản sử dụng" alt="Điều khoản sử dụng">Điều khoản sử dụng</a><br />và <a href="<?php echo get_site_url(); ?>/chinh-sach-bao-mat"
							title="Chính sách bảo mật" alt="Chính sách bảo mật">Chính sách bảo mật</a></div>
			</div>
		</div>
	</form>
</div>

</div>
</section>

<?php get_footer(); ?>
