<?php
/*
	Template Name: Tùy chỉnh hồ sơ
*/
if(!is_user_logged_in())
{
    wp_safe_redirect(home_url('dang-nhap'));
    exit;
}
get_header(); 
global $current_user; 
$level=$current_user->membership_level->name;
$time=$current_user->membership_level->enddate;
$id=$current_user->membership_level->ID;
$user_id=$current_user->ID;
$idstock=array();
$data=$wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id"); 
if(!empty($data)){
    foreach($data as $key)
    {
        $idstock[]=$key->id_stock;
    }
}
?>
<section class="section p-0 account-frontpage snt">
    <div class="bg section-bg fill bg-fill bg-loaded"></div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                    <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content">
                <div class="snt-auto">
                    <div class="col-inner">
                        <?php info_account_management();?>
                        <div class="snt-account-tab px-20">
                            <?php echo menu_account_management();?>
                           <div class="panel entry-content">
                                <div class="tab_inner">
                                    <div class="row row-small edit-avatar-profile tab-custom-profile">
                                        <div class="col medium-12 small-12 large-6 desc">
                                            <div class="col-inner">
                                                <strong>Cập nhật ảnh đại diện</strong>
                                                <p>Ảnh đại diện sẽ được hiển thị trong sơ đồ của bạn.</p>
                                                <?php echo do_shortcode('[avatar_upload]');?>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="" name="form_edit-profile" id="form_edit-profile" class="snt-form">
                                        <div class="row row-small tab-custom-profile">
                                            <div class="col medium-12 small-12 large-6 desc">
                                                <div class="col-inner">
                                                    <strong>Cập nhật thông tin công khai</strong><br/>
                                                    Những thông tin này sẽ được hiển thị công khai và hiển thị cho tất cả người dùng.
                                                </div>
                                            </div>
                                            <div class="col medium-12 small-12 large-6">
                                                <div class="col-inner">
                                                    <div id="message" class="is-large"></div>
                                                    <label class="form-label" for="phone_profile">Số điện thoại</label>
                                                    <input type="tel" id="phone_profile" name="phone_profile" min='0' class="form-control" disabled placeholder="<?php echo $current_user->user_login;?>">
                                                    <div class="row">
                                                        <div class="col medium-12 small-12 large-6" style="padding-left: 12px !important;">
                                                            <div class="col-inner">
                                                                <label class="form-label" for="firstname_profile">Họ</label>
                                                                <input type="text" id="firstname_profile" name="firstname_profile" class="form-control" placeholder="<?php echo $current_user->first_name;?>">
                                                            </div>
                                                        </div>
                                                        <div class="col medium-12 small-12 large-6" style="padding-right: 12px !important;">
                                                            <div class="col-inner">
                                                                <label class="form-label" for="lastname_profile">Tên</label>
                                                                <input type="text" id="lastname_profile" name="lastname_profile" class="form-control" placeholder="<?php echo $current_user->last_name;?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col medium-12 small-12 large-6 desc">
                                                <div class="col-inner">
                                                    <strong>Thay đổi mật khẩu</strong><br/>
                                                    Quản lý mật khẩu của bạn để đảm bảo mật khẩu của bạn được an toàn
                                                </div>
                                            </div>
                                            <div class="col medium-12 small-12 large-6">
                                                <div class="col-inner">
                                                    <label class="form-label" for="oldpw">Mật khẩu cũ</label>
                                                    <div class="position-relative">
                                                        <input type="password" id="oldpw_profile" name="phone_profile" class="form-control input__password" placeholder="Mật khẩu cũ của bạn">
                                                        <span class="adong-toggle-password eye-disable" id="adong-toggle-oldpassword">
                                                            <svg width="24" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="#7C8493"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <label class="form-label" for="newpw_profile">Mật khẩu mới</label>
                                                    <div class="position-relative">
                                                        <input type="password" id="newpw_profile" name="fullname_profile" class="form-control input__password" placeholder="Mật khẩu mới của bạn">
                                                        <span class="adong-toggle-password eye-disable" id="adong-toggle-newpassword">
                                                            <svg width="24" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5C17 19.5 21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12C7 9.24 9.24 7 12 7C14.76 7 17 9.24 17 12C17 14.76 14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12C9 13.66 10.34 15 12 15C13.66 15 15 13.66 15 12C15 10.34 13.66 9 12 9Z" fill="#7C8493"/>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col medium-12 small-12 large-6">
                                                <div class="col-inner">
                                                </div>
                                            </div>
                                            <div class="col medium-12 small-12 large-6">
                                                <div class="col-inner">
                                                <button type="button" form="form_edit-profile" id="save-info-user" value="Submit" class="edit_profile_submit check_validation">Lưu thay đổi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>