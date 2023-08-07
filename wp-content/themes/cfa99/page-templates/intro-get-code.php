<?php
/*
	Template Name: Giới thiệu nhận mã
*/
get_header();
if(is_user_logged_in()){
    $user_id = wp_get_current_user();
    $code = get_field('ma_gioi_thieu', 'user_'. $user_id->ID);
}else{
    $code = 'Mã giới thiệu...';
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
                <div class="col-inner px bg-fff">
                    <?php the_content();?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>