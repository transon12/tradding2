<?php
/**
 * The archive template file.
 *
 * @package flatsome
 */

get_header();
$info_stocks = get_field('thong_tin_co_phieu_nong');
$market_open_time = $info_stocks['thoi_gian_thi_truong_mo_cua'];
$upcoming_earnings = $info_stocks['thu_nhap_sap_toi'];
$profit = $info_stocks['loi_nhuan_tren_moi_co_phieu'];
$capitalization = $info_stocks['von_hoa'];
$dividend_yield = $info_stocks['ty_suat_co_tuc'];
$pe = $info_stocks['pe'];
$price = $info_stocks['gia_ban_dau'];
$price_sale = $info_stocks['gia_giam'];
if($price && $price_sale){
    $result = '('.round((($price_sale/$price)*100),2).'%'.')';
}
$id=get_the_ID();
?>
<?php do_action( 'flatsome_before_page' ); ?>
<section class="section pt-0 pb-0">
    <div class="row row-collapse row-full-width">
        <div class="col medium-4 small-12 large-3 snt-sidebar">
            <div class="col-inner">
            <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
            </div>
        </div>
        <div class="col medium-8 small-12 large-9 snt-main-content">
            <div class="col-inner">
                <div class="snt-single-post px">
                    <div class="back">
                        <a href="#" onclick="window.history.go(-1); return false;">
                            <svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 7H1M1 7L7 13M1 7L7 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Tất cả cổ phiếu
                        </a>
                    </div>
                    <div class="entry-content">
                        <div class="row">
                            <div class="col large-12">
                                <div class="col-inner">
                                    <div class="details-name-comp">
                                        <div class="name-comp-info">
                                            <div class="comp-info-svg">
                                                
                                            <?php echo the_post_thumbnail();?>
                                            </div>
                                            <div class="comp-info-details">
                                                <div class="info-detail-name">
                                                    <h1><?php echo the_title();?></h1>
                                                    <div class="info-details-des">
                                                        <span class="name-acr">
                                                            <?php echo $info_stocks ['ma_co_phieu'];?>
                                                        </span>
                                                        <svg
                                                            width="18"
                                                            height="18"
                                                            viewBox="0 0 18 18"
                                                            fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                            d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z"
                                                            fill="#D80027"
                                                            ></path>
                                                            <path
                                                            d="M8.99917 4.69592L9.97046 7.68523H13.1136L10.5707 9.53269L11.542 12.522L8.99917 10.6745L6.45632 12.522L7.42762 9.53269L4.88477 7.68523H8.02787L8.99917 4.69592Z"
                                                            fill="#FFDA44"
                                                            ></path>
                                                        </svg>
                                                        <span>VN</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row details-info-comp" id="row">
                                            <div id="col" class="col medium-4 small-12 large-5">
                                                <div class="col-inner">
                                                    <div class="details-content-comp">
                                                        <div class="content-price">
                                                            <div class="content-price-title">
                                                                <div class="price-stocks"><?php echo $price;?></div>
                                                                <p></p>
                                                            </div>
                                                            <div class="content-price-unit">
                                                                <h6 class="price-unit">VND</h6>
                                                                <p></p>
                                                            </div>
                                                            <div class="content-price-percent">
                                                                <h3 class="percent">
                                                                    <?php 
                                                                        echo $price_sale;
                                                                        if($result){
                                                                            echo $result;
                                                                        }
                                                                    ?>
                                                                </h3>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                        <div class="content-des">
                                                            <div class="dot"></div>
                                                            <p>
                                                                <?php 
                                                                    if($market_open_time){
                                                                        echo $market_open_time;
                                                                    }else{
                                                                        echo 'Đang cập nhật...';
                                                                    }
                                                                ?>
                                                            </p>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g clip-path="url(#clip0_43_13315)">
                                                                <path d="M10.625 9.375C10.625 9.02982 10.3452 8.75 10 8.75C9.65482 8.75 9.375 9.02982 9.375 9.375V13.125C9.375 13.4702 9.65482 13.75 10 13.75C10.3452 13.75 10.625 13.4702 10.625 13.125V9.375Z" fill="#98A2B3"/>
                                                                <path d="M10.625 6.875C10.625 7.22018 10.3452 7.5 10 7.5C9.65482 7.5 9.375 7.22018 9.375 6.875C9.375 6.52982 9.65482 6.25 10 6.25C10.3452 6.25 10.625 6.52982 10.625 6.875Z" fill="#98A2B3"/>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5ZM3.75 10C3.75 6.54822 6.54822 3.75 10 3.75C13.4518 3.75 16.25 6.54822 16.25 10C16.25 13.4518 13.4518 16.25 10 16.25C6.54822 16.25 3.75 13.4518 3.75 10Z" fill="#98A2B3"/>
                                                                </g>
                                                                <defs>
                                                                <clipPath id="clip0_43_13315">
                                                                <rect width="15" height="15" fill="white" transform="translate(2.5 2.5)"/>
                                                                </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="col" class="col medium-8 small-12 large-7">
                                                <div class="col-inner">
                                                    <div class="row details-info-comp" id="row">
                                                        <div id="col" class="col medium-3 small-12 large-3">
                                                            <div class="col-inner">
                                                                <h4>
                                                                    <?php 
                                                                        if($upcoming_earnings){
                                                                            echo $upcoming_earnings;
                                                                        }else{
                                                                            echo '...';
                                                                        }
                                                                    ?>
                                                                </h4>
                                                                <p class="content-price-text">THU NHẬP SẮP TỚI</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-4 small-12 large-4">
                                                            <div class="col-inner">
                                                                <h4>
                                                                    <?php 
                                                                        if($profit){
                                                                            echo $profit;
                                                                        }else{
                                                                            echo '...';
                                                                        }
                                                                    ?>
                                                                </h4>
                                                                <p class="content-price-text">LỢI NHUẬN TRÊN MỖI CỔ PHIẾU</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-2 small-12 large-2">
                                                            <div class="col-inner">
                                                                <h4>
                                                                    <?php 
                                                                        if($capitalization){
                                                                            echo $capitalization;
                                                                        }else{
                                                                            echo '...';
                                                                        }
                                                                    ?>
                                                                </h4>
                                                                <p class="content-price-text">VỐN HÓA</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-2 small-12 large-2">
                                                            <div class="col-inner">
                                                                <h4>
                                                                    <?php 
                                                                        if($dividend_yield){
                                                                            echo $dividend_yield;
                                                                        }else{
                                                                            echo '...';
                                                                        }
                                                                    ?>
                                                                    </h4>
                                                                <p class="content-price-text">TỶ SUẤT CỔ TỨC</p>
                                                            </div>
                                                        </div>

                                                        <div id="col" class="col medium-1 small-12 large-1">
                                                            <div class="col-inner">
                                                                <div id="text" class="text">
                                                                    <h4>
                                                                        <?php 
                                                                            if($pe){
                                                                                echo $pe;
                                                                            }else{
                                                                                echo '...';
                                                                            }
                                                                        ?>
                                                                    </h4>
                                                                    <p class="content-price-text">P/E</p>

                                                                    <style>
                                                                    #text {
                                                                        text-align: left;
                                                                    }
                                                                    </style>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col large-12 details-text">
                                <div class="col-inner">
                                        <div class="tabbed-content">
                                            <ul class="nav nav-line-bottom nav-normal nav-size-xlarge nav-left">
                                                <li class="tab has-icon tongquan active">
                                                    <a href="#tab_tong-quan"><span>Tổng quan</span></a>
                                                </li>
                                                <li class="tab has-icon">
                                                    <a href="#tab_tin-tuc"><span>Tin tức</span></a>
                                                </li>
                                            </ul>
                                            <div class="tab-panels">
                                                <?php 
                                                    if(is_user_logged_in()){ ?>
                                                    <div class="panel entry-content active" id="tab_tong-quan">
                                                        <div class="tab_inner">
                                                            <?php the_content();?>
                                                            <!-- Tin tức đề xuất -->
                                                                <?php
                                                                $recommended_news = get_field('tin_tuc_co_phieu_de_xuat');
                                                                if( $recommended_news ): ?>
                                                                <div class="recommen-news">
                                                                    <div class="recommen-news-title">
                                                                        <h3 class="mb-0">Tin tức đề xuất</h3>
                                                                        <a href="#" class="rm">Xem thêm</a>
                                                                    </div>
                                                                    <div class="row large-columns-4 medium-columns-2 small-columns-1">
                                                                    <?php foreach( $recommended_news as $post ): 
                                                                        $permalink = get_permalink( $post->ID );
                                                                        $title = get_the_title( $post->ID );
                                                                        $excerpt = get_the_excerpt($post->ID);
                                                                        $thumnail = get_the_post_thumbnail($post->ID);
                                                                        ?>
                                                                        <div class="col post-item">
                                                                            <div class="col-inner">
                                                                                <a href="<?php echo $permalink; ?>" class="plain">
                                                                                    <div class="box box-text-bottom box-blog-post has-hover">
                                                                                        <div class="box-image">
                                                                                            <div class="image-cover" style="padding-top:56%;">
                                                                                                <?php echo $thumnail; ?>
                                                                                                <?php do_action('flatsome_blog_image_post_after'); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="box-text text-left">
                                                                                            <div class="box-text-inner blog-post-inner">
                                                                                                <h5 class="post-title is-large ">
                                                                                                    <?php echo $title; ?>
                                                                                                </h5>
                                                                                                <div class="from_the_blog_excerpt ">
                                                                                                    <?php echo $excerpt; ?>
                                                                                                </div>
                                                                                                <?php do_action('flatsome_blog_post_after'); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                    </div>
                                                                </div>
                                                                <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="panel entry-content" id="tab_tin-tuc">
                                                        <div class="tab_inner">
                                                        <?php
                                                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                                                            $args =array(
                                                                'post_type' => 'post',
                                                                'paged'          => $paged, 
                                                                'meta_query' => array(                                 
                                                                    array(
                                                                      'key' => 'co_phieu',                 
                                                                      'value' => '"'.$id.'"',                                                        
                                                                      'compare' => 'LIKE'                   
                                                                    )
                                                                ),
                                                                'posts_per_page' 	=> 8,
                                                            );
                                                            $the_query = new WP_Query( $args );
                                                            if( $the_query->have_posts() ) : 
                                                                ?>
                                                                <div class="row large-columns-4 medium-columns-2 small-columns-1">
                                                                <?php
                                                                while( $the_query->have_posts() ) : $the_query->the_post();
                                                                ?>
                                                                <div class="col post-item">
                                                                    <div class="col-inner">
                                                                        <a href="<?php the_permalink(); ?>" class="plain">
                                                                            <div class="box box-text-bottom box-blog-post has-hover">
                                                                                <div class="box-image">
                                                                                    <div class="image-cover" style="padding-top:56%;">
                                                                                        <?php the_post_thumbnail(); ?>
                                                                                        <?php do_action('flatsome_blog_image_post_after'); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="box-text text-left">
                                                                                    <div class="box-text-inner blog-post-inner">
                                                                                        <h5 class="post-title is-large ">
                                                                                            <?php the_title(); ?>
                                                                                        </h5>
                                                                                        <div class="from_the_blog_excerpt ">
                                                                                            <?php the_excerpt(); ?>
                                                                                        </div>
                                                                                        <?php do_action('flatsome_blog_post_after'); ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                endwhile;
                                                            endif;
                                                            wp_reset_query();
                                                            echo "<nav class=\"sw-pagination\">";
                                                            $big = 999999999; // need an unlikely integer
                                                            echo paginate_links( array(
                                                                'base' => get_permalink().'?trang=%#%/#tab_tin-tuc',
                                                                'format' => '?trang=%#%',
                                                                'current' => max( 1, $_GET['trang'] ),
                                                                'total' => $the_query->max_num_pages
                                                            ) );
                                                            echo "</nav>";
                                                            ?>
                                                            </div>
                                                            <?php
                                                        ?>
                                                        </div>
                                                    </div>

                                                    <?php }else{?>

                                                    <div class="row" id="row">
                                                        <div id="col" class="col small-12 large-12">
                                                            <div class="col-inner">                                                    
                                                                <div id="text" class="text-sigin-details">
                                                                    <h3>Bạn cần đăng nhập để có thể xem nội dung này</h3>
                                                                    <p>Bạn đã xem tất cả các video miễn phí , hãy trở thành thành viên để có quyền truy cập không giới hạn. Đăng nhập để có thể xem thêm video</p>
                                                            
                                                                    <style>
                                                                    #text-1105673059 {
                                                                    text-align: center;
                                                                    }
                                                                    </style>
                                                                </div>
                                                                <div class="row" id="row">
                                                                    <div id="col" class="col small-12 large-12 sigin-btn">
                                                                        <div class="col-inner">
                                                                            <a href="/dang-ky" class="button primary is-outline lowercase" style="border-radius:10px;">
                                                                                <span>Đăng ký</span>
                                                                            </a>
                                                                            <a href="/dang-nhap" class="button primary lowercase" style="border-radius:10px;">
                                                                                <span>Đăng nhập</span>
                                                                            </a>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }?>
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
<?php do_action( 'flatsome_after_page' ); ?>
	
<?php get_footer(); ?>
