<?php
/*
	Template Name: User - ResetSucsessful

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
    <div class="adong-form-login" style="width: 100%; max-width: 450px;">
        <div class="adong-login-close-btn">
            <span><img class="svg-img" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/close.svg" title="Close" alt="Close"></span>
        </div>
        <div class="adong-login-success">
            <div class="adong-success-icon"><img class="svg-img" src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/success_check.svg" title="Đặt lại mật khẩu thành công" alt="Đặt lại mật khẩu thành công"></div>
            <div class="adong-success-noitice">
                <p style="font-size: 30px; font-weight: 600; color: #101828; margin: 0 0 8px;">Hoàn Thành</p>
                <p style="font-size: 18px; font-weight: 500; line-height: 28px; color: #344054; margin-bottom: 20px;">Mật khẩu của bạn đã được thay đổi</p>
            </div>
        </div>
        <!-- Submit button -->
        <a href="<?php echo get_site_url(); ?>" title="Trang Chủ" alt="Homepage" class="btn back-to-home adong-login-btn adong-login-submit" style="margin-bottom: 32px" role="button" aria-pressed="true">
        <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 17V11H12V17H17V9H20L10 0L0 9H3V17H8Z" fill="#101828"/>
        </svg>
        Trang chủ
        </a>
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
                    <p style="font-size: 18px; font-weight: 400; line-height: 28px; color: #344054; margin-bottom: 20px;">Mật khẩu của bạn đã được thay đổi</p>
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