<?php

function get_content_page_ux_builder_element() {

    $options =  array(
        'id_page' => array(
            'type'    => 'select',
            'heading' => 'Chọn trang',
            'default' => '',
			'options' => ux_builder_get_page_parents(),
        ),
    );

    add_ux_builder_shortcode('ux_content_page', array(
        'name' => __('Nội dung trang
        '),
        'category' => __('A2Z Content'),
        'priority' => 1,
        'options' => $options,
    ));
}

add_action('ux_builder_setup', 'get_content_page_ux_builder_element');


function content_page_shortcode($atts)
{
    extract(shortcode_atts(array(
        'id_page'         => false,
      ), $atts));
    if ( isset( $atts[ 'id_page' ] ) ) {
        $id_page = explode( ',', $atts[ 'id_page' ] );
        $id_page = array_map( 'trim', $id_page );
        $parent = '';
        $orderby = 'include';
    } else {
        $id_page = array();
    }  
    $args = array(
        'posts_per_page'   => -1,
        'post_type'        => 'page',
        'include'    => $id_page,
      );
    ob_start();
    ?>
        <?php
            $pages = get_posts( $args );
            foreach($pages as $page){ setup_postdata( $page ); ?>
                <div class="<?php echo 'page-id-'.$page->ID;?>">
                    <div class="page-inner">
                        <?php 
                        //echo $page->post_content;
                        the_content();
                        ?>
                    </div>
                </div>
        <?php } ?>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('ux_content_page', 'content_page_shortcode');