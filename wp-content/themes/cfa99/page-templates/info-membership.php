<?php
/*
	Template Name: Thông tin membership
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
if(!empty($data))
{
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
                        <?php info_account_management();?>
                        <div class="snt-account-tab px-20">
                            <?php echo menu_account_management();?>
                            <div class="panel entry-content active">
                                <div class="tab_inner">
                                    <div class="tab-membership-wrapper">
                                        <div>
                                            <div class="membership-status">Bạn hiện đang sử dụng gói tài khoản
                                                <span class="snt-usergroup membership-package"><?php echo $level; ?></span>
                                            </div>
                                            <div class="membership-exp">Hiệu lực đến hết
                                                <?php if(!empty($time)){ ?>
                                                <span class="snt-usergroup membership-package"><?php echo date('d/m/Y',$time); ?></span>
                                                <?php }else{ ?>
                                                    <span class="snt-usergroup membership-package">Vĩnh viễn</span> 
                                                    <?php } ?>
                                            </div>
                                            <div class="membership-readmore"><a href="<?php echo home_url();?>/quan-ly-tai-khoan/nang-cap-tai-khoan/">Tìm hiểu thêm</a></div>
                                        </div>
                                        <div class="membership-action">
                                            <button class="btn">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.49996 10.0003L9.16663 11.667L12.9166 7.91699M14.9176 4.16575C15.0892 4.58077 15.4186 4.91066 15.8333 5.08289L17.2877 5.68531C17.7027 5.85723 18.0324 6.18699 18.2044 6.60204C18.3763 7.0171 18.3763 7.48345 18.2044 7.8985L17.6024 9.35183C17.4304 9.76707 17.4302 10.2339 17.6029 10.6489L18.2039 12.1018C18.2891 12.3074 18.333 12.5277 18.333 12.7503C18.333 12.9728 18.2892 13.1932 18.2041 13.3988C18.1189 13.6044 17.9941 13.7912 17.8367 13.9485C17.6793 14.1059 17.4925 14.2306 17.2869 14.3157L15.8336 14.9177C15.4186 15.0893 15.0887 15.4187 14.9165 15.8335L14.3141 17.2878C14.1422 17.7029 13.8124 18.0327 13.3974 18.2046C12.9823 18.3765 12.516 18.3765 12.101 18.2046L10.6477 17.6026C10.2326 17.4311 9.76648 17.4314 9.35169 17.6036L7.89737 18.2051C7.48256 18.3766 7.01664 18.3765 6.60193 18.2047C6.18723 18.0329 5.85767 17.7036 5.68564 17.289L5.08306 15.8342C4.91146 15.4191 4.58208 15.0892 4.16733 14.917L2.71301 14.3146C2.29815 14.1427 1.96851 13.8132 1.79653 13.3984C1.62455 12.9836 1.62432 12.5174 1.79588 12.1024L2.39785 10.6491C2.56934 10.2341 2.56899 9.76787 2.39687 9.35306L1.79577 7.89765C1.71055 7.69208 1.66666 7.47172 1.66663 7.24919C1.66659 7.02665 1.7104 6.80628 1.79556 6.60069C1.88072 6.39509 2.00555 6.20829 2.16293 6.05095C2.32031 5.89362 2.50715 5.76884 2.71276 5.68375L4.16604 5.08176C4.58069 4.9103 4.91036 4.58133 5.08271 4.16704L5.68511 2.71267C5.85703 2.29761 6.18677 1.96785 6.60181 1.79593C7.01685 1.62401 7.48318 1.62401 7.89822 1.79593L9.3515 2.39792C9.76655 2.56942 10.2327 2.56907 10.6475 2.39695L12.1024 1.79687C12.5174 1.62504 12.9837 1.62508 13.3986 1.79696C13.8136 1.96885 14.1433 2.29852 14.3152 2.71346L14.9178 4.16827L14.9176 4.16575Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <a href="<?php home_url(); ?>/quan-ly-tai-khoan/nang-cap-tai-khoan/">
                                                Thay đổi gói
                                                </a>
                                            </button>
                                            <?php
                                            global $wpdb;
                                            $mylink = $wpdb->get_results( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_membership_product_level' && meta_value= %d", $id ) );
                                            foreach($mylink as $key){
                                                $id=$key->post_id;
                                                if('publish' == get_post_status ( $id )){
                                            ?>
                                            <button class="btn">
                                                <a href="<?php echo home_url('thanh-toan') ?>/?add-to-cart=<?php echo $id; ?>">Gia hạn gói</a>
                                            </button>
                                            <?php } ?>
                                                <?php } ?>
                                                <?php if(empty($mylink)){?>
                                                    <button class="btn">Không hỗ trợ gia hạn</button>
                                                    <?php } ?>
                                        </div>
                                    </div>
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