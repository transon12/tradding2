<?php
/**
 * The archive template file.
 *
 * @package flatsome
 */

get_header();
$i = 1;
if(!is_user_logged_in()){
    $none = 'd-none';
}
?>

<?php do_action( 'flatsome_before_page' ); ?>

<section class="section p-0 blog-archive archive-uptrend_stock">
    <div class="bg section-bg fill bg-fill bg-loaded">
    </div>
    <div class="section-content relative">
        <div class="row row-collapse row-full-width">
            <div class="col medium-4 small-12 large-3 snt-sidebar">
                <div class="col-inner">
                <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]');?>
                </div>
            </div>
            <div class="col medium-8 small-12 large-9 snt-main-content 1">
                <div class="snt-auto">
                    <div class="col-inner">
                    <div class="px bg-fff">
                            <h1 class="entry-title">
                                Cổ phiếu xu hướng tăng
                                <div class="sub-title">(Cổ phiếu đạt mục tiêu trong 1-2 tháng tới)</div>
                            </h1>
                            <?php if ( have_posts() ) : ?>
                                <div id="filter-table">
                                    <div class="filter-left">
                                        <div class="filter-care hotstock <?php echo $none;?>">
                                            <div class="save-car">
                                                <i class="icon-star-o"></i>
                                            </div>
                                            <div class="text">&ensp;Quan tâm</div>
                                        </div>
                                        <div class="filter-all">
                                            <form class="stocks-ordering mb-0" method="get">
                                                <select id="nganh" class="mb-0">
                                                    <option value="">Tất cả các ngành</option>
                                                   <?php
                                                   $terms = get_terms( array(
                                                    'taxonomy' => 'nganh',
                                                    'hide_empty' => false,
                                                    ) ); 
                                                   
                                                   ?>
                                                   <?php foreach($terms as $term){ ?>
                                                    <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <table id="uptrend_stocks" class="dataTable chung">
                                    <thead>
                                        <tr>
                                            <th rowspan="1" colspan="1">
                                                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/sort.svg">
                                                <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/up.svg">
                                            </th>
                                            <th rowspan="1" colspan="1">Mã cổ phiếu</th>
                                            <th rowspan="1" colspan="1">Tên doanh nghiệp</th>
                                            <th rowspan="1" colspan="1">Giá hỗ trợ mạnh</th>
                                            <th rowspan="1" colspan="1">Giá kháng cự mạnh</th>
                                            <th rowspan="1" colspan="1">Ngành</th>
                                            <th rowspan="1" colspan="1">Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ( have_posts() ) : the_post(); 
                                        $idppost = get_field('co_phieu');
                                        $info_stocks_hot = get_field('thong_tin_co_phieu_nong',$idppost);
                                        $macophieu = $info_stocks_hot['ma_co_phieu'];
                                        $dataValue = [
                                            [
                                            'label'=> 'Giá kháng cự mạnh',
                                            'value' => get_field('gia_khang_cu_manh',$idppost),
                                            'color' => '#E63124'
                                            ],
                                            [
                                                'label'=> 'Giá hỗ trợ mạnh',
                                                'value' => get_field('gia_ho_tro_manh',$idppost),
                                                'color' => '#60B523'
                                             ]

                                        ]
                                    ?>
                                        <tr>
                                        
                                            <td class="stt">
                                            <?php $number=0; if(is_user_logged_in()){ 
                                                    $id_user=get_current_user_id();
                                                    $id=get_the_ID();
                                                    global $wpdb;
                                                    $data=$wpdb->get_results( "SELECT * FROM bookmark WHERE id_stock = $idppost AND user_id = $id_user");
                                                    if(!empty($data))
                                                    {
                                                        $class="active";
                                                        $number=1;
                                                    }else{
                                                        $class="";
                                                        $number=0;
                                                    }
                                                ?>
                                                <i data-id="<?php echo $idppost; ?>" class="icon-star-o add_bookmark <?php echo $class; echo $none; ?>"></i>
                                                <?php } ?>
                                                <?php echo $i++;?>
                                            </td>
                                            <td>
                                                <a class="code-de item-code-btn" data-code="<?php echo $macophieu; ?>" data-name="<?php echo get_the_title($idppost);?>" data-open="#sidebar-chart" data-pos="right" 
                                                data-value='<?php echo json_encode($dataValue) ?>'
                                                data-price-down="<?php echo get_field('gia_khang_cu_manh',$idppost)?? '' ?>"
                                                data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
                                                    <?php
                                                        echo '<span class="avata">';
                                                            echo get_the_post_thumbnail($idppost, 'full');
                                                        echo '</span>';
                                                        if($macophieu){
                                                            echo '<span class="code_stocks">';
                                                                echo $macophieu;
                                                            echo '</span>';
                                                        }else{
                                                            echo '<span class="code_stocks">';
                                                                echo '...';
                                                            echo '</span>';
                                                        }
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="title_stocks">
                                                <?php echo get_the_title($idppost);?>
                                            </td>
                                            <td>
                                                <?php
                                                    if(get_field('gia_ho_tro_manh',$idppost)){
                                                        echo '<span class="price">'.get_field('gia_ho_tro_manh',$idppost).'</span>';
                                                        echo '<span class="char_money">vnd</span>';
                                                    }else{
                                                        echo 'Đang cập nhật...';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if(get_field('gia_khang_cu_manh',$idppost)){
                                                        echo '<span class="price">'.get_field('gia_khang_cu_manh',$idppost).'</span>';
                                                        echo '<span class="char_money">vnd</span>';
                                                    }else{
                                                        echo 'Đang cập nhật...';
                                                    }
                                                ?>
                                            </td>
                                            <td><?php $term_list = wp_get_post_terms( $idppost, 'nganh', array( 'fields' => 'ids' ) );  echo $term_list[0]; ?></td>
                                            <td><?php echo $number; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <!-- <?php get_template_part( 'template-parts/posts/content','none'); ?> -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php do_action( 'flatsome_after_page' ); ?>
	
<?php get_footer(); ?>
