<?php



/**

 * The archive template file.

 *

 * @package flatsome

 */



get_header();

$i = 1;

$info_stocks = get_field('thong_tin_co_phieu_xu_huong_tang');

global $current_user;

$level = $current_user->membership_level->name;

$time = $current_user->membership_level->enddate;

$id = $current_user->membership_level->ID;

$permission = get_field('permission_khuyen_nghi', 'option');

$now = time();

?>



<?php do_action('flatsome_before_page'); ?>



<section class="section p-0 blog-archive archive-uptrend_stock">

    <div class="bg section-bg fill bg-fill bg-loaded">

    </div>

    <div class="section-content relative">

        <div class="row row-collapse row-full-width">

            <div class="col medium-4 small-12 large-3 snt-sidebar">

                <div class="col-inner">

                    <?php echo do_shortcode('[ux_sidebar id="menu-sidebar" class="menu__sidebar"]'); ?>

                </div>

            </div>

            <div class="col medium-8 small-12 large-9 snt-main-content ">

                <div class="snt-auto">

                    <div class="col-inner">

                        <?php if ((in_array($id, $permission) && ($now < $time || empty($time))) || empty($permission)) { ?>

                            <div class="px bg-fff">

                                <h1 class="entry-title">Khuyến nghị đầu tư</h1>

                                <?php if (have_posts()) : ?>

                                    <div id="filter-table">

                                        <div class="filter-left">

                                            <div class="filter-care khuyennghiqt">

                                                <div class="save-car">

                                                    <i class="icon-star-o"></i>

                                                </div>

                                                <div class="text">&ensp;Quan tâm</div>

                                            </div>

                                            <div class="filter-all">

                                                <form class="stocks-ordering mb-0" method="get">

                                                    <select id="khuyen-nghi-filter" name="stocks-ordering-length" class="mb-0">

                                                        <option value="">Tất các ngành</option>

                                                        <?php

                                                        $terms = get_terms(array(

                                                            'taxonomy' => 'nganh',

                                                            'hide_empty' => false,

                                                        ));

                                                        ?>

                                                        <?php foreach ($terms as $term) { ?>

                                                            <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?>

                                                            </option>

                                                        <?php } ?>

                                                    </select>

                                                </form>

                                            </div>

                                        </div>



                                    </div>

                                    <table id="uptrend_stocks" class="dataTable khuyen-nghi">

                                        <thead>

                                            <tr>

                                                <th rowspan="1" colspan="1">

                                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/sort.svg">

                                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/up.svg">

                                                </th>

                                                <th rowspan="1" colspan="1">Mã cổ phiếu</th>

                                                <th rowspan="1" colspan="1">Giá mua</th>

                                                <th rowspan="1" colspan="1">Giá chốt lời</th>

                                                <th rowspan="1" colspan="1">Giá cắt lỗ </th>

                                                <th rowspan="1" colspan="1">Lý do mua </th>

                                                <th rowspan="1" colspan="1">Ngành</th>

                                                <th rowspan="1" colspan="1">active</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php while (have_posts()) : the_post();

                                                $idppost = get_field('co_phieu');

                                                $dataValue = [

                                                    // ['label' => 'Lý do mua', "value" => get_field('phan_tich_ly_do', get_the_ID())],

                                                    [

                                                        'label' => 'Giá mua ',

                                                        "value" => get_field('gia_mua', get_the_ID()) ?number_format(get_field('gia_mua', get_the_ID()), 0): 'đang cập nhật',

                                                        "color" => get_field('gia_mua', get_the_ID()) ? '#FEC703': '#000'

                                                    ],

                                                    [

                                                        'label' => 'Giá chốt lời ', 

                                                        "value" => get_field('gia_loi', get_the_ID()) ? number_format(get_field('gia_loi', get_the_ID()),0) : 'đang cập nhật',

                                                        "color" => get_field('gia_loi', get_the_ID()) ? '#60B523' : '#000'

                                                    ],

                                                    [

                                                        'label' => 'Giá cắt lỗ',

                                                        "value" => get_field('gia_cat_lo', get_the_ID())? number_format(get_field('gia_cat_lo', get_the_ID()),0): 'đang cập nhật', 

                                                        "color" => get_field('gia_cat_lo', get_the_ID())? '#E63124' : '#000'

                                                    ],

                                                    [

                                                        'label' => 'Lý do mua',

                                                        "value" => get_field('phan_tich_ly_do') ?? 'đang cập nhật', 

                                                        "color" => ''

                                                    ],

                                                ]

                                            ?>
 
                                                <tr>

                                                    <td class="stt">

                                                        <?php $number = 0;

                                                        if (is_user_logged_in()) {

                                                            $id_user = get_current_user_id();

                                                            $id = get_the_ID();

                                                            global $wpdb;

                                                            $data = $wpdb->get_results("SELECT * FROM bookmark WHERE id_stock = $idppost AND user_id = $id_user");

                                                            if (!empty($data)) {

                                                                $class = "active";

                                                                $number = 1;

                                                            } else {

                                                                $class = "";

                                                                $number = 0;

                                                            }

                                                        ?>

                                                            <i data-id="<?php echo $idppost; ?>" class="icon-star-o add_bookmark <?php echo $class; ?>"></i>

                                                        <?php } ?>

                                                        <?php echo $i++; ?>

                                                    </td>

                                                    <td>

                                                        <div class="d-flex flex-center-item">

                                                            <a class="code-de item-code-btn" data-code="<?php echo the_field('ma_co_phieu'); ?>" data-name="<?php echo the_field('ma_co_phieu'); ?>" data-open="#sidebar-chart" data-pos="right" data-value='<?php echo json_encode($dataValue) ?>' data-bg="main-menu-overlay" data-color="" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">

                                                                <?php



                                                                if (!empty(the_field('ma_co_phieu'))) {

                                                                    echo '<span class="code_stocks">';

                                                                    echo the_field('ma_co_phieu');

                                                                    echo '</span>';

                                                                }

                                                                ?>

                                                            </a>





                                                        </div>



                                                    <td>

                                                        <?php

                                                        if (get_field('gia_mua')) {

                                                            echo '<span class="price">' . get_field('gia_mua', get_the_ID()) . '</span>';

                                                            echo '<span class="char_money ">vnd</span>';

                                                        } else {

                                                            echo 'Đang cập nhật...';

                                                        }

                                                        ?>

                                                    </td>

                                                    <td>

                                                        <?php

                                                        if (get_field('gia_loi')) {

                                                            echo '<span class="price">' . get_field('gia_loi', get_the_ID()) . '</span>';

                                                            echo '<span class="char_money">vnd</span>';

                                                        } else {

                                                            echo 'Đang cập nhật...';

                                                        }

                                                        ?>

                                                    </td>

                                                    <td>

                                                        <?php

                                                        if (get_field('gia_cat_lo')) {

                                                            echo '<span class="price">' . get_field('gia_cat_lo', get_the_ID()) . '</span>';

                                                            echo '<span class="char_money">vnd</span>';

                                                        } else {

                                                            echo 'Đang cập nhật...';

                                                        }

                                                        ?>

                                                    </td>
 
                                                    <td>
                                                        <span data-id="<?php echo get_the_ID(); ?>" class="open"><?php echo wp_trim_words(get_field('phan_tich_ly_do'), 20, '...') ?></span>
                                                        <a class="popup" href="#khuyennghi"></a> 
                                                    </td>

                                                    <td><?php $term_list = wp_get_post_terms($idppost, 'nganh', array('fields' => 'ids'));

                                                        echo $term_list[0]; ?>

                                                    </td>

                                                    <td> <?php echo $number; ?></td>

                                                </tr>

                                            <?php endwhile; ?>

                                        </tbody>

                                    </table>



                                <?php else : ?>

                                    <?php get_template_part('template-parts/posts/content', 'none'); ?>

                                <?php endif; ?>

                            </div>

                        <?php } else {

                        ?>



                            <div class="entry-content">

                                <div class="course-entry-content">

                                    <!-- Entry content of course -->

                                    <div class="login-to-learn">



                                        <div class="haveto-upgrade haveto__login">

                                            <div class="blur-bg" style="background-image: url('https://www.w3schools.com/howto/photographer.jpg')">

                                            </div>

                                            <div class="blur-bg-dark"></div>

                                            <div class="blur-bg-content">



                                                <div>Bạn cần nâng cấp để xem mục này</div>

                                                <div>Hãy nâng cấp để có thể sử dụng các tính năng đầy đủ và nhận nhiều ưu

                                                    đãi hấp dẫn</div>

                                                <?php if (($now > $time) && !in_array($permission, $id)) {

                                                ?>

                                                    <div><a href="<?php echo home_url(); ?>/quan-ly-tai-khoan/nang-cap-tai-khoan/" class="btn__reg c-btn" title="Đăng ký">Xin vui lòng gia hạn</a><a href="<?php echo home_url(); ?>" class="mainbg btn__login c-btn" title="Đăng nhập">Trở lại trang chủ</a></div>



                                                <?php

                                                } else { ?>

                                                    <div><a href="<?php echo home_url(); ?>/quan-ly-tai-khoan/nang-cap-tai-khoan/" class="btn__reg c-btn" title="Đăng ký">Nâng cấp ngay</a><a href="<?php echo home_url(); ?>" class="mainbg btn__login c-btn" title="Đăng nhập">Trở lại trang chủ</a></div>



                                                <?php } ?>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                            </div>



                        <?php

                        } ?>

                    </div>

                </div>



            </div>

        </div>

    </div>

</section>

<?php echo do_shortcode('[lightbox id="khuyennghi" width="600px" padding="20px"]Add lightbox content here...[/lightbox]'); ?>



<?php do_action('flatsome_after_page'); ?>



<?php get_footer(); ?>