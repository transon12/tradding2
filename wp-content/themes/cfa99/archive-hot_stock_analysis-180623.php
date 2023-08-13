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

<section class="section p-0 blog-archive archive-hot_stock">
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
                    <div class="px bg-fff">
                        <h1 class="entry-title">Phân tích cổ phiếu nóng</h1>
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
                                            <select id="nganh" name="stocks-ordering-length" class="mb-0">
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
                                        <th rowspan="1" colspan="1">Lý do biến động</th>
                                        <th rowspan="1" colspan="1">Xu hướng tương lai</th>
                                        <th rowspan="1" colspan="1"></th>
                                        <th rowspan="1" colspan="1">Ngành</th>
                                        <th rowspan="1" colspan="1">active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while ( have_posts() ) : the_post(); 
                                    $idppost=get_field('co_phieu');
                                    $id_stocks = get_post_meta( get_the_ID(), 'co_phieu', true);
                                    $info_analysis = get_field('thong_tin_co_phieu_nong',$id_stocks);
                                    $macophieu = $info_analysis['ma_co_phieu'];
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
                                                <i data-id="<?php echo $idppost; ?>" class="icon-star-o add_bookmark <?php echo $class; echo $none;?>"></i>
                                                <?php } ?>
                                                <?php echo $i++;?>
                                            </td>

                                    <td>
                                        <a class="code-de item-code-btn" data-code="<?php echo $macophieu; ?>" data-name="<?php echo get_the_title($idppost);?>" data-open="#sidebar-chart" data-pos="right" data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
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
                                    <td>
                                        <div class="content_stocks">
                                            <p class="mt-0 mb-0">
                                                <?php echo wp_trim_words(get_field('ly_do_bien_dong'),15,'...')?>
                                                <a data-id="<?php echo get_the_ID(); ?>" href="#popup_content_analysis_stock" class="rm popup_content_analysis_stock">Xem thêm</a>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                    <?php  echo wp_trim_words(get_field('xu_huong_tuong_lai'),17,'...') ?>
                                    </td>
                                    <td>
                                    </td>
                                    <td><?php $term_list = wp_get_post_terms( $idppost, 'nganh', array( 'fields' => 'ids' ) );  echo $term_list[0]; ?></td>
                                     <td><?php echo $number; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                </tbody>
                            </table>
                            
                        <?php else : ?>
                            <?php get_template_part( 'template-parts/posts/content','none'); ?>
                        <?php endif; ?>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>


<?php do_action( 'flatsome_after_page' ); ?>
	
<?php get_footer(); ?>
