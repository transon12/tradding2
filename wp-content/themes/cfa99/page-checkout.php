<?php
/*
Template name: Trang thanh toán
*/
get_header();
?>

<?php do_action( 'flatsome_before_page' ); ?>

<section class="section p-0  page-left-sidebar">
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
                <div class="col-inner">
                    <?php info_account_management();?>
                    <div class="px bg-fff pt-0">
                        <?php echo menu_account_management();?>
                        <div class="back">
                            <a href="<?php echo home_url().'/quan-ly-tai-khoan/nang-cap-tai-khoan';?>" class="mb-0">
                                <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 7H1M1 7L7 13M1 7L7 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <?php
                                    if ( is_checkout() && empty( is_wc_endpoint_url('order-received') ) ) {
                                        echo 'Tất cả gói nâng cấp';
                                    }
                                    if ( is_checkout() && !empty( is_wc_endpoint_url('order-received') ) ) {
                                        echo 'Thanh toán';
                                    }
                                ?>
                            </a>
                        </div>
                        <?php wc_get_template_part('checkout/layouts/checkout', get_theme_mod('checkout_layout'));?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php do_action( 'flatsome_after_page' ); ?>

<?php get_footer(); ?>
