<?php
/*
	Template Name: Lịch sử video đã xem
*/
if(!is_user_logged_in())
{
    wp_safe_redirect(home_url('dang-nhap'));
    exit;
}
get_header(); 
global $current_user;

$id_user=$current_user->data->ID; 
// $level=$current_user->data->membership_level->name;
// $time=$current_user->data->membership_level->enddate;
// $id=$current_user->data->membership_level->ID;
$user_id=$current_user->data->ID;
$idstock=array();
$data=$wpdb->get_results( "SELECT * FROM bookmark WHERE user_id = $user_id"); 
if(!empty($data)){
    foreach($data as $key)
    {
        $idstock[]=$key->id_stock;
    }
}
$data=get_user_meta( $user_id, 'historyvideo',true);
$data=$data
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
                            <div class="panel entry-content">
                                <?php if(!empty($data)){  ?>
                                <div class="tab_inner"> 
                                    <div class="lp-archive-courses">
                                        <?php 
                                         // The page to display (Usually is received in a url parameter)
                                        if(isset($_GET['trang'])){
                                            $page = intval($_GET['trang']);
                                        }else{
                                            $page = intval(1);
                                        }
                                        
                                        // The number of records to display per page
                                        $page_size = 8;
                                        // Calculate total number of records, and total number of pages
                                        $total_records = count($data);
                                        $total_pages   = ceil($total_records / $page_size);
                                        // Validation: Page to display can not be greater than the total number of pages
                                        if ($page > $total_pages) {
                                            $page = $total_pages;
                                        }
                                        // Validation: Page to display can not be less than 1
                                        if ($page < 1) {
                                            $page = 1;
                                        }
                                        // Calculate the position of the first record of the page to display
                                        $offset = ($page - 1) * $page_size;
                                        // Get the subset of records to be displayed from the array
                                        $data = array_slice($data, $offset, $page_size);   
                                        ?>
                                        <ul class="learn-press-courses" data-layout="grid">
                                            <?php foreach($data as $key){ ?>
                                            <li id="post-1370" class="post-1370 lp_course type-lp_course status-publish has-post-thumbnail hentry course_category-khoa-hoc-phan-tich-dong-tien pmpro-has-access course mb-0">
                                                <div class="course-item">
                                                    <div class="course-wrap-thumbnail">
                                                        <div class="course-thumbnail">
                                                            <div class="thumbnail-preview">
                                                                <iframe width="500" height="250" src="<?php echo get_field('link_video',$key); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="course-content">
                                                        <a href="<?php echo get_permalink($key); ?>" class="course-permalink">                                                   
                                                            <h3 class="course-title"><?php echo get_the_title($key); ?></h3>
                                                        </a>
                                                        <div class="courses-text-box">
                                                            <div class="courses-date d-flex align-items-center">
                                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5 0C2.245 0 0 2.245 0 5C0 7.755 2.245 10 5 10C7.755 10 10 7.755 10 5C10 2.245 7.755 0 5 0ZM7.175 6.785C7.105 6.905 6.98 6.97 6.85 6.97C6.785 6.97 6.72 6.955 6.66 6.915L5.11 5.99C4.725 5.76 4.44 5.255 4.44 4.81V2.76C4.44 2.555 4.61 2.385 4.815 2.385C5.02 2.385 5.19 2.555 5.19 2.76V4.81C5.19 4.99 5.34 5.255 5.495 5.345L7.045 6.27C7.225 6.375 7.285 6.605 7.175 6.785Z" fill="#475467"></path>
                                                                </svg>
                                                                <div><?php echo get_the_date('d-m-Y H:i:s',$key); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                      
                                    </div>
                                    <?php
                                    $N = min($total_pages, 9);
                                    $pages_links = array();

                                    $tmp = $N;
                                    if ($tmp < $page || $page > $N) {
                                        $tmp = 2;
                                    }
                                    for ($i = 1; $i <= $tmp; $i++) {
                                        $pages_links[$i] = $i;
                                    }

                                    if ($page > $N && $page <= ($total_pages - $N + 2)) {
                                        for ($i = $page - 3; $i <= $page + 3; $i++) {
                                            if ($i > 0 && $i < $total_pages) {
                                                $pages_links[$i] = $i;
                                            }
                                        }
                                    }

                                    $tmp = $total_pages - $N + 1;
                                    if ($tmp > $page - 2) {
                                        $tmp = $total_pages - 1;
                                    }
                                    for ($i = $tmp; $i <= $total_pages; $i++) {
                                        if ($i > 0) {
                                            $pages_links[$i] = $i;
                                        }
                                    }

                                    ?>
                                    
                                    <div class="snt-pagination-wrappe">
                                            <div class="snt-pagination">   
                                        <?php $prev = 0; ?>
                                        <?php foreach ($pages_links as $p) { ?>
                                            <?php if (($p - $prev) > 1) { ?>
                                                <a href="#">...</a>
                                            <?php } ?>
                                            <?php $prev = $p; ?>
                                        
                                            <?php
                                            $style_active = '';
                                            if ($p == $page) {
                                                $style_active = 'style="font-weight:bold"';
                                            }
                                            ?>
                                        
                                            <a <?php echo $style_active; ?> href="?page=<?php echo $p; ?>"><?php echo $p; ?></a>
                                        <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <?php } ?>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>