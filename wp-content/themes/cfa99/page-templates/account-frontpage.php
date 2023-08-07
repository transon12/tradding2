<?php
/*
	Template Name: Quản lý tài khoản
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
                        <?php info_account_management();?>
                        <div class="snt-account-tab px-20">
                            <?php echo menu_account_management();?>
                            <div class="panel entry-content active pt-0" id="tab1">
                                <div class="tab_inner">
                                    <div id="filter-table">
                                        <div class="filter-left">
                                            <div class="filter-all">
                                                <form class="stocks-ordering mb-0" method="get">
                                                    <select id="nganh" name="stocks-ordering-length" class="mb-0">
                                                        <option value="">Tất các ngành</option>
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
                                            <div class="filter-add-code-stock">
                                                <form class="mb-0" method="get">
                                                    <div class="d-flex">
                                                        <select class="stock">
                                                        <option value="">Tìm mã cố phiếu</option>
                                                            <?php $query= new WP_Query(array('post_type'=>'stocks','posts_per_page'=>-1));
                                                            if($query->have_posts()):while($query->have_posts()):$query->the_post();
                                                            $id=get_the_ID();
                                                            if(!in_array($id,$idstock)){
                                                            ?>
                                                            <option value="<?php echo get_the_ID(); ?>"><?php $data=get_field('thong_tin_co_phieu_nong');echo $data['ma_co_phieu']; ?></option>
                                                            <?php
                                                            }
                                                        endwhile;wp_reset_query();endif;
                                                             ?>
                                                        </select>   
                                                        <button id="addfollow" type="submit" class="btn btn-primary">
                                                            <img src="<?php echo get_stylesheet_directory_uri()?>'/assets/img/plus.svg'">
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <table id="uptrend_stocks" class="chung">
                                        <thead>
                                            <tr>
                                                <th rowspan="1" colspan="1">
                                                    <img src="https://cfa99.net/wp-content/themes/cfa99/assets/img/sort.svg">
                                                    <img src="https://cfa99.net/wp-content/themes/cfa99/assets/img/up.svg">
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
                                    <?php 
                                    
                                    $result= array_unique($idstock);
                                    $i=1;
                                    foreach($result as $key){
                                        $data = get_field('thong_tin_co_phieu_nong',$key); 
                                    ?>
                                                                
                                            <tr>
                                                <td class="stt">
                                                    <i data-id="<?php echo $key; ?>" class="icon-star-o add_bookmark active"></i>
                                                <?php
                                                    echo $i++;
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="code">
                                                        <span class="avata">
                                                            <?php echo get_the_post_thumbnail($key);?>
                                                        </span>
                                                        <span class="code_stocks">
                                                            <?php 
                                                                if($data['ma_co_phieu']){
                                                                    echo $data['ma_co_phieu']; 
                                                                }else{
                                                                    echo '...';
                                                                }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </td>						
                                                <td class="title_stocks">
                                                    <?php echo get_the_title($key); ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if(get_field('gia_ho_tro_manh',$key)){
                                                            echo '<span class="price">'.get_field('gia_ho_tro_manh',$key).'</span>'; 
                                                            echo '<span class="char_money">vnd</span>';
                                                        }else{
                                                            echo '...';
                                                        }
                                                    ?> 
                                                </td>
                                                <td>
                                                <?php 
                                                    if(get_field('gia_khang_cu_manh',$key)){
                                                        echo '<span class="price">'.get_field('gia_khang_cu_manh',$key).'</span>'; 
                                                        echo '<span class="char_money">vnd</span>';
                                                    }else{
                                                        echo '...';
                                                    }
                                                ?> 
                                                </td>
                                                <td><?php $term_list = wp_get_post_terms( $key, 'nganh', array( 'fields' => 'ids' ) );  echo $term_list[0]; ?></td>
                                                <td>1</td>
                                            </tr>
                                        <?php } ?>                       
                                        </tbody>
                                    </table>                                  
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
<script>
    jQuery('.stock').select2();
    </script>