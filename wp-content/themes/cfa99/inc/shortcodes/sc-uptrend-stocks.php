<?php

function uptrend_stocks_ux_builder_element()
{

    $options =  array(
        'heading'    =>  array(
            'type' => 'textfield',
            'heading' => 'Tiêu đề',
            'default' => '',
        ),
        'number'    =>  array(
            'type' => 'scrubfield',
            'heading' => 'Số lượng tin hiển thị',
            'default' => '1',
            'step' => '1',
            'unit' => '',
            'min'   =>  1,
            //'max'   => 2
        ),
        'link'    =>  array(
            'type' => 'textfield',
            'heading' => 'Xem thêm',
            'default' => '',
        ),
        'description'   =>  array(
            'type' => 'textfield',
            'heading' => 'Mô tả ngắn',
            'default' => '',
        ),
    );

    add_ux_builder_shortcode('ux_stocks_shortcode', array(
        'name' => __('Cổ phiếu xu hướng tăng
        '),
        'category' => __('A2Z Content'),
        'priority' => 1,
        'options' => $options,
    ));
}

add_action('ux_builder_setup', 'uptrend_stocks_ux_builder_element');


function uptrend_stocks_shortcode($atts)
{
    $i = 1;
    $info_stocks = get_field('thong_tin_co_phieu_xu_huong_tang');
    extract(shortcode_atts(array(
        'heading'         => '',
        'number'      => '5',
        'link'        => '',
        'description' => '',
    ), $atts));

    ob_start();
?>
    <h2 class="title-stocks">
        <?php
        if ($heading) {
            echo '<div class="title">';
            echo $heading;
            if ($description) {
                echo '<div class="sub-title">' . $description . '</div>';
            }
            echo '</div>';
        }
        if ($link) {
            echo '<a href="' . $link . '" class="rm">Xem thêm</a>';
        }
        ?>
    </h2>
    <div class="scroll-inner">
        <table id="uptrend_stocks" class="dataTable ">
            <thead>
                <tr>
                    <th>
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/sort.svg">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/up.svg">
                    </th>
                    <th>Mã cổ phiếu</th>
                    <th>Tên doanh nghiệp</th>
                    <th>Giá hỗ trợ mạnh</th>
                    <th>Giá kháng cự mạnh</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $args = array(
                    'post_type' => 'uptrend_stocks',
                    'posts_per_page' => $number,
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) : $the_query->the_post();

                        $id_stocks = get_post_meta(get_the_ID(), 'co_phieu', true);
                        $info_stocks_hot = get_field('thong_tin_co_phieu_nong', $id_stocks);
                        $macophieu = $info_stocks_hot['ma_co_phieu'];
                        $giahotro = get_field('gia_ho_tro_manh', $id_stocks);
                        $giakhangcu = get_field('gia_khang_cu_manh', $id_stocks);
                        $dataValue = [
                            [
                                'label' => 'Giá kháng cự mạnh',
                                'value' => $giakhangcu,
                                'color' => '#E63124'
                            ],
                            [
                                'label' => 'Giá hỗ trợ mạnh',
                                'value' =>  $giahotro,
                                'color' => '#60B523'
                            ]

                        ]

                ?>

                        <tr>
                            <td class="stt">
                                <?php
                                $number = 0;
                                if (is_user_logged_in()) {
                                    $id_user = get_current_user_id();
                                    $id = get_the_ID();
                                    global $wpdb;
                                    $data = $wpdb->get_results("SELECT * FROM bookmark WHERE id_stock = $id_stocks AND user_id = $id_user");
                                    if (!empty($data)) {
                                        $class = "active";
                                        $number = 1;
                                    } else {
                                        $class = "";
                                        $number = 0;
                                    }
                                ?>
                                    <i data-id="<?php echo $id_stocks; ?>" class="icon-star-o add_bookmark <?php echo $class;
                                                                                                            echo $none; ?>"></i>
                                <?php } ?>

                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <a class="code-de item-code-btn" data-code="<?php echo $macophieu; ?>" data-name="<?php echo get_the_title($idppost); ?>" data-open="#sidebar-chart" data-pos="right" data-bg="main-menu-overlay" data-color="" data-value='<?php echo json_encode($dataValue) ?>' data-price-down="<?php echo get_field('gia_khang_cu_manh', $id_stocks) ?? '' ?>" class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
                                    <?php
                                    echo '<span class="avata">';
                                    echo get_the_post_thumbnail($id_stocks, 'full');
                                    echo '</span>';
                                    if ($macophieu) {
                                        echo '<span class="code_stocks">';
                                        echo $macophieu;
                                        echo '</span>';
                                    } else {
                                        echo '<span class="code_stocks">';
                                        echo '...';
                                        echo '</span>';
                                    }
                                    ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo home_url(); ?>/bieu-do-ky-thuat/?code_stock=<?php echo $macophieu; ?>" target="_blank">
                                    <?php echo get_the_title($id_stocks); ?>
                                </a>
                            </td>
                            <td>
                                <?php
                                if ($giahotro) {
                                    echo $giahotro;
                                    echo '<span class="char_money">vnd</span>';
                                } else {
                                    echo 'Đang cập nhật...';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($giakhangcu) {
                                    echo $giakhangcu;
                                    echo '<span class="char_money">vnd</span>';
                                } else {
                                    echo 'Đang cập nhật...';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php get_template_part('template-parts/posts/content', 'none'); ?>
                <?php endif;
                wp_reset_query(); ?>
            </tbody>
        </table>
    </div>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('ux_stocks_shortcode', 'uptrend_stocks_shortcode');
