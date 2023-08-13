<?php
/*
	Template Name: User - PhoneVerification

*/
?>
<?php get_header();
session_start();
$phone_send = $_SESSION['phone'];
$phone_cut = substr($phone_send, -4);
if($phone_send == ""){
    wp_redirect(home_url('/quen-mat-khau'));
}


?>

<section class="adong-section-login">
    <div class="adong-form-login pb-0">

        <div class="adong-form-logo">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/logo.png"
                    title="<?php echo get_bloginfo(); ?> Logo" alt="<?php echo get_bloginfo(); ?> Logo"
                    class="adong-logo">
            </a>
        </div>

        <div>
            <p class="adong-welcome" style="margin-top: 34px;">Nhập mã xác thực</p>
            <p class="adong-note">Nhập mã code chúng tôi đã gửi đến số điện thoại có đuôi (***<?php echo $phone_cut; ?>)</p>
            <p id="message"></p>
            <div class="adong-login-input">
                    <div class="box-code">
                        <input type="tel" name="phone_code[]" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="tel" name="phone_code[]" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="tel" name="phone_code[]" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="tel" name="phone_code[]" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="tel" name="phone_code[]" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                        <input type="tel" name="phone_code[]" maxLength="1" size="1" min="0" max="9" pattern="[0-9]{1}" />
                    </div>
                    <div class="box-bottom">
                        <div id="change-phone" class="change-phone">
                            <a href="/quen-mat-khau/">
                                <span>Đổi số điện thoại</span>
                            </a>
                        </div>
                        <button id="phone_verifycode" type="button" class="btn btn-primary btn-block adong-login-btn adong-login-submit" data-phone="<?php echo $phone_send; ?>">
                            Tiếp tục
                        </button>
                        <p class="adong-login-note-bottom" style="margin: 24px auto 34px">Trở về trang 
                            <a href="<?php echo get_site_url(); ?>/dang-nhap" title="Đăng nhập" alt="Đăng nhập">Đăng nhập</a>
                        </p>
                    </div>
                    <div class="box-info">
                        <div class="txt">
                            Bạn không nhận được mã xác thực ? <br/>Vui lòng đợi 30 giây để trước khi yêu cầu gửi mã khác. 
                        </div>
                        <div id="sendcode-again" class="send-code" data-phone="<?php echo $phone_send; ?>">
                            Gửi lại mã
                        </div>
                    </div>
            </div>
        </div>

    </div>
</section>

<script>
    jQuery(document).ready(function() {
        
        jQuery(".box-code input").keyup(function () {
            if (this.value.length == this.maxLength) {
            jQuery(this).next('.box-code input').focus();
            }
        });

        // (function() {
        //     var params = null;
        //     this.l = typeof Location !== "undefined" ? Location.prototype : window.location;
        //     this.l.getParameter = function(name) {
        //         return Array.prototype.slice.apply(this.getParameterValues(name))[0];
        //     };
        //     this.l.getParameterMap = function() {
        //         if (params === null) {
        //             params = {};
        //             this.search.substr(1).split("&").map(function(param) {
        //                 if (param.length === 0) return;
        //                 var parts = param.split("=", 2).map(decodeURIComponent);
        //                 if (!params.hasOwnProperty(parts[0])) params[parts[0]] = [];
        //                 params[parts[0]].push(parts.length == 2 ? parts[1] : null);
        //             });
        //         }
        //         return params;
        //     };
        //     this.l.getParameterNames = function() {
        //         var map = this.getParameterMap(), names = [];
        //         for (var name in map) {
        //             if (map.hasOwnProperty(name)) names.push(name);
        //         }
        //         return names;
        //     };
        //     this.l.getParameterValues = function(name) {
        //         return this.getParameterMap()[name];
        //     };
        // })();

        // if (typeof location.getParameter("phone") !== "undefined" ) {
        //     var phone_param = location.getParameter("phone");
        //     if(isVietnamesePhoneNumber( phone_param ) == false){
        //         alert(phone_param + ' không đúng định dạng');
        //         window.location.href = 'https://cfa99.net/quen-mat-khau/';
        //     }
            
        // }

    });
</script>

<?php get_footer(); ?>