<?php

add_action('init', 'register_hot_stock_anlysis_init');
function register_hot_stock_anlysis_init() {
    // Register Products
    $investment_labels = array(
        'name'               => 'Phân tích cổ phiếu nóng',
        'singular_name'      => 'Phân tích cổ phiếu nóng',
        'menu_name'          => 'Phân tích cổ phiếu nóng',
        'add_new_item'       => 'Thêm mới',
        'add_new'            => 'Thêm mới',
        'new_item'           => 'Thêm mới',
        'edit_item'          => 'Chỉnh sửa',
        'update_item'        => 'Cập nhật tin'
    );
    $investment_args = array(
        'labels'             => $investment_labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-chart-area',
        'capability_type'    => 'post',
        'publicly_queryable' => true,
        'has_archive'        => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
        'menu_position'      => 8,
        'rewrite'     => array(
        'slug' => _x( 'phan-tich-co-phieu-nong', 'slug', 'flatsome' ),
        ),
        'show_in_rest'          => true,
        'rest_base'          => 'hot_stock_analysis',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('hot_stock_analysis', $investment_args);
}
add_action( 'init', function () {
    add_ux_builder_post_type( 'hot_stock_analysis' );
} );

function hot_stock( $route, $post ) {
    if ( $post->post_type === 'hot_stock_analysis' ) {
        $route = '/wp/v2/hot_stock_analysis/' . $post->ID;
    }
 
    return $route;
}
add_filter( 'rest_route_for_post', 'hot_stock', 10, 2 );
?>