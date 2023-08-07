<?php
/*
	Template Name: User - Login

*/
?>
<?php get_header(); 
the_post();

$err = ''; 
$success = '';
if ( isset( $_REQUEST['login_member'] ) && wp_verify_nonce( $_REQUEST['login_member'], 'login_member_event' ) ) {
    $info = array();
    $info['user_login'] = $_POST['phone'];
    $info['user_password'] = $_POST['password'];
    if($_POST['remeber_check'] == 1){
        $info['remember'] = true;
    }else{
        $info['remember'] = false;
    }
    $user_signon = wp_signon( $info, false );
    if ( !is_wp_error($user_signon) ){
        wp_clear_auth_cookie();
        wp_set_current_user($user_signon->ID);
        wp_set_auth_cookie($user_signon->ID);
        wp_send_json(array('loggedin'=>true, 'message'=>__('Đăng nhập thành công! vui lòng chờ...')));
    }else{
        wp_send_json(array('loggedin'=>false, 'message'=>__('Thông tin đăng nhập không chính xác')));
    }
    die;
}

?>

<section class="adong-section-login">
    <div class="adong-form-login">

        <div class="adong-form-logo">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.png"
            title="<?php echo get_bloginfo(); ?>" alt="<?php echo get_bloginfo(); ?> Logo"
            class="adong-logo"></a>
        </div>

        <?php 

            if(is_user_logged_in()){
                
                $current_user = wp_get_current_user();
                $user_id = get_current_user_id();
                $home_url =  home_url();
                    ?>
                    <div class="regted text-center">
                        Bạn đã đăng nhập với tên <span style="color:var(--color-main);"><?php echo $current_user->display_name; ?></span> bạn có chắc muốn  <a href="<?php echo esc_url(wp_logout_url($home_url)); ?>">thoát?</a>
                    </div>
                <?php 
            }else{?>
                <p class="adong-reg-account">Bạn chưa có tài khoản? <a href="<?php echo get_site_url(); ?>/dang-ky"  title="Đăng ký tài khoản" alt="Đăng ký tài khoản">Đăng ký ngay</a></p>
                <p class="adong-welcome">Chào mừng đến với <?php echo get_bloginfo( 'name' ); ?></p>
                <p class="adong-note">Vui lòng đăng nhập để bắt đầu sử dụng dịch vụ</p>
                <div class="adong-login-input">
                    <!-- <form action="" method="POST" id="form-login" class="mb-0"> -->
                        <div id="message">
                            <?php
                                if(! empty($err) ) :
                                    echo ''.$err.'';
                                endif;
                            ?>
                            <?php
                                if(! empty($success) ) :
                                    echo ''.$success.'';
                                endif;
                            ?>
                        </div>
                        <div class="form-outline">
                            <label class="form-label" for="email_login">Số điện thoại</label>
                            <input type="tel" id="phone_login" name="phonenumber" class="form-control" placeholder="VD: 0353454679" required/>
                        </div>
                        <div class="form-outline toogle-password-outline">
                            <label class="form-label" for="password_login">Mật khẩu</label>
                            <div class="field-group">
                                <input type="password" id="password_login" name="password" class="form-control form-adong-input-password eye-disable" placeholder="Mật khẩu" required/>
                                <span class="adong-toggle-password eye-disable" id="btn-eye-toggle">
                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/eye.svg" alt="" class="eye-toggle">
                                </span>
                            </div>
                        </div>
                        <div class="adong-if-password">
                            <div class="row row-collapse">
                                <div class="col medium-6 small-6 large-6">
                                    <div class="form-check" style="display:flex;align-content: center;">
                                        <input class="form-check-input mb-0 mt-0" type="checkbox" name="rememner" value="1" id="remember_login" checked />
                                        <label class="form-check-label mb-0" for="remember_login">Ghi nhớ đăng nhập</label>
                                    </div>
                                </div>
                                <div class="col medium-6 small-6 large-6 adong-lost-password">
                                    Quên mật khẩu? <a href="<?php echo get_site_url(); ?>/quen-mat-khau" title="Lấy lại mật khẩu" alt="Lấy lại mật khẩu">Lấy lại mật khẩu</a>
                                </div>
                            </div>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" id="adong_login_submit"
                        class="btn btn-primary btn-block adong-login-btn adong-login-submit adong-login-submit">Đăng
                        nhập ngay</button>
                        <?php wp_nonce_field( 'login_member_event', 'login_member' ); ?>
                    <!-- </form> -->
                </div>
        <?php } ?>
    </div>
</section>

<script>
    (function($) {
        $(document).ready(function() {
            $(document).on('keypress',function(e) {
            if(e.which == 13) {
               jQuery('#adong_login_submit').click();
            }
        });
        });
    })(jQuery);
</script>

<?php get_footer(); ?>