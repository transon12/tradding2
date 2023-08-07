<?php
/*
	Template Name: User - ForgotPassword

*/
?>
<?php get_header(); 
the_post();

$err = ''; 
$success = '';
if ( isset( $_REQUEST['lostpass_member'] ) && wp_verify_nonce( $_REQUEST['lostpass_member'], 'lostpass_event' ) ) {

}

?>

<section class="adong-section-login">
    <div class="adong-form-login">

        <div class="adong-form-logo">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.png"
                    title="<?php echo get_bloginfo(); ?> Logo" alt="<?php echo get_bloginfo(); ?> Logo"
                    class="adong-logo">
            </a>
        </div>

        <div>
            <p class="adong-welcome" style="margin-top: 34px;">Lấy lại mật khẩu</p>
            <p class="adong-note">Vui lòng nhập thông tin điền dưới để lấy lại mật khẩu</p>

            <div class="adong-login-input">
                <form action="" method="POST" id="loss-password" class="mb-0">
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
                    <div class="form-outline" style="margin: 36px auto 24px auto;">
                        <label class="form-label" for="reset_pw_email">Số điện thoại</label>
                        <input type="tel" name="phone" id="reset_pw_phone" class="form-control" placeholder="Nhập số điện thoại" />
                    </div>
                    <?php wp_nonce_field('lostpass_event', 'lostpass_member'); ?>
                    <button id="reset_pw_submit" type="button" class="btn btn-primary btn-block adong-login-btn adong-login-submit">
                        Tiếp tục
                    </button>
                    <p class="adong-login-note-bottom" style="margin: 24px auto 24px">Trở về trang 
                    <a href="<?php echo get_site_url(); ?>/dang-nhap" title="Đăng nhập" alt="Đăng nhập">Đăng nhập</a>
                    </p>
                </form>
            </div>
        </div>

    </div>
</section>


<div id="myModal" class="modal adong-form-login">
   <div class="modal-dialog">                         
        <div class="modal-content">
            <span class="close">
                <img class="svg-img" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/close.svg" title="Close" alt="Close">
            </span>
            <div class="adong-login-success">
                <div class="adong-success-icon">
                    <span></span>
                    <img class="svg-img" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/check.svg" title="Đặt lại mật khẩu thành công" alt="Đặt lại mật khẩu thành công">
                </div>
                <div class="adong-success-noitice">
                    <p style="font-size: 30px; font-weight: 600;margin-bottom: 8px;color: #101828;">Hoàn thành</p>
                    <p style="font-size: 18px; font-weight: 400; line-height: 28px; color: #344054; margin-bottom: 20px;">Chúng tôi đã gửi link cập nhật lại mật khẩu<br/>qua email của bạn. Vui lòng kiểm tra Email !</p>
                </div>
            </div>
            <button type="button" class="btn btn-primary btn-block adong-login-btn adong-login-submit btn-home-resend-success" style="margin-bottom: 32px">
                <img class="svg-img" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/home.svg" title="icon-home" alt="icon-home" style="margin-right: 12px">
                <a href="<?php echo home_url(); ?>" style="color:#101828;"> Trang chủ</a>
            </button>
        </div>
    </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<?php get_footer(); ?>