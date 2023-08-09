<?php

function analysis_ux_builder_element() {

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

    add_ux_builder_shortcode('ux_analysis', array(
        'name' => __('Phân tích cổ phiếu nóng'),
        'category' => __('A2Z Content'),
        'priority' => 1,
        'options' => $options,
    ));
}

add_action('ux_builder_setup', 'analysis_ux_builder_element');


function analysis_shortcode($atts)
{
    $i = 1;
    $info_stocks = get_field('thong_tin_co_phieu_nong');
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
                if($heading){
                    echo '<div class="title">';
                        echo $heading;
                        if($description){
                            echo '<div class="sub-title">'.$description.'</div>';
                        } 
                    echo '</div>';
                } 
                if($link){
                    echo '<a href="'.$link.'" class="rm">Xem thêm</a>';
                }
            ?>
        </h2>
        <table id="uptrend_stocks" class="dataTable">
            <thead>
                <tr>
                    <th>
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/sort.svg">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/up.svg">
                    </th>
                    <th>Mã cổ phiếu</th>
                    <th colspan="3">Lý do biến động</th>
                    <th>Xu hướng tương lai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $args = array(
                    'post_type' => 'hot_stock_analysis',
                    'posts_per_page' => $number,  
                );
                $the_query = new WP_Query($args);
                if($the_query->have_posts()):
                while ( $the_query->have_posts()): $the_query->the_post(); 
                    $id_stocks = get_post_meta( get_the_ID(), 'co_phieu', true);
                    $info_analysis = get_field('thong_tin_co_phieu_nong',$id_stocks);
                    $macophieu = $info_analysis['ma_co_phieu'];
                    $why = get_field('ly_do_bien_dong');
                    $trend = get_field('xu_huong_tuong_lai');
                    $dataValue = [
                        ['label' => 'Lý do biến động', 'value' =>  $why],
                        ['label' => 'Xu hướng tăng', 'value' =>   $trend]
                        ]
                ?>
                <tr>
                    <td class="stt">
                        <i class="d-inline-block" style="width:14px;"></i>
                        <?php echo $i++;?>
                    </td>
                    <td>
                        <a class="code-de item-code-btn" data-code="<?php echo $macophieu; ?>" data-name="<?php echo get_the_title($idppost);?>" data-open="#sidebar-chart" data-pos="right" data-bg="main-menu-overlay" data-color="" 
                        data-value='<?php echo json_encode( $dataValue) ?>'
                        data-price-down="<?php echo get_field('gia_khang_cu_manh',$id_stocks)?? '1111' ?>"
                        class="is-small" aria-label="Menu" aria-controls="main-menu" aria-expanded="false">
                        <?php
                            echo '<span class="avata">';
                                echo get_the_post_thumbnail($id_stocks, 'full');
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
                    <td colspan="3">
                        <div class="content_stocks">
                            <?php 
                                echo '<p class="mt-0 mb-0">'.wp_trim_words($why, 8, '...').'<a href="#popup_content_analysis_stock" class="rm popup_content_analysis_stock" data-id="'.get_the_ID().'">Xem thêm</a></p>';
                            ?>

                        </div>
                    </td>
                    <td>
                        <?php echo wp_trim_words($trend,10,'...'); ?>
                    </td>
                    
                </tr>
                <?php endwhile; ?>
                <?php else : ?>
                    <?php get_template_part( 'template-parts/posts/content','none'); ?>
                <?php endif;wp_reset_query(); ?>
            </tbody>
        </table>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('ux_analysis', 'analysis_shortcode');