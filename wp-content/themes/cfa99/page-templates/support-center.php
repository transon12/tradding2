<?php
/*
	Template Name: Trung tâm hỗ trợ
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
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
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
                        <div class="snt-account-header d-flex align-item-center">
                            <div class="avatar rounded-circle">
                                <img src="<?php echo get_avatar_url( $current_user->ID ); ?>">
                            </div>
                            <div class="user-title">
                                <div class="user-name">Tài khoản <?php echo $current_user->display_name; ?></div>
                                <div class="user-group d-flex align-item-center">
                                    <span>Gói tài khoản </span>
                                    <span class="snt-usergroup"><?php echo $level; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="snt-account-tab px-20">
                            <?php echo menu_account_management();?>
                            <div class="panel entry-content">
                                <div class="tab_inner">
                                    <?php
                                    $my_postid = 431;
                                    $content_post = get_post($my_postid);
                                    $content = $content_post->post_content;
                                    $content = apply_filters('the_content', $content);
                                    $content = str_replace(']]>', ']]&gt;', $content);
                                    echo $content;
                                    ?>
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