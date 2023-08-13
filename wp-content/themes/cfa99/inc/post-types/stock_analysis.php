<?php

add_action('init', 'register_stock_anlysic_init');
function register_stock_anlysic_init() {
    // Register Products
    $investment_labels = array(
        'name'               => 'Báo cáo phân tích cổ phiếu',
        'singular_name'      => 'Báo cáo phân tích cổ phiếu',
        'menu_name'          => 'Báo cáo phân tích cổ phiếu',
        'add_new_item'       => 'Thêm mới',
        'add_new'            => 'Thêm mới',
        'new_item'           => 'Thêm mới',
        'edit_item'          => 'Chỉnh sửa',
        'update_item'        => 'Cập nhật tin'
    );
    $investment_args = array(
        'labels'             => $investment_labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-chart-pie',
        'capability_type'    => 'post',
        'publicly_queryable' => true,
        'has_archive'        => true,
        'show_in_rest' => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
        'menu_position'      => 6,
        'rewrite'     => array(
        'slug' => _x( 'phan-tich-co-phieu', 'slug', 'flatsome' ),
        ),
        'rest_base'          => 'stock_anlysic',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('stock_anlysic', $investment_args);
}
add_action( 'init', function () {
    add_ux_builder_post_type( 'stock_anlysic' );
} );
function register_rest_route_for_stock_anlysic( $route, $post ) {
    if ( $post->post_type === 'stock_anlysic' ) {
        $route = '/wp/v2/stock_anlysic/' . $post->ID;
    }
 
    return $route;
}
add_filter( 'rest_route_for_post', 'register_rest_route_for_stock_anlysic', 10, 2 );
?>  