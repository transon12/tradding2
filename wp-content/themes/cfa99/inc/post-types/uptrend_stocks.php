<?php

add_action('init', 'register_uptrend_stocks_init');
function register_uptrend_stocks_init() {
    // Register Products
    $investment_labels = array(
        'name'               => 'Cổ phiếu xu hướng tăng',
        'singular_name'      => 'Cổ phiếu xu hướng tăng',
        'menu_name'          => 'Cổ phiếu xu hướng tăng',
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
        'supports'           => array( 'title', 'editor', 'revisions'),
        'menu_position'      => 7,
        'rewrite'     => array(
        'slug' => _x( 'co-phieu-xu-huong-tang', 'slug', 'flatsome' ),
        ),
        'rest_base'          => 'uptrend_stocks',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('uptrend_stocks', $investment_args);
}
add_action( 'init', function () {
    add_ux_builder_post_type( 'uptrend_stocks' );
} );

function my_plugin_rest_route_for_post( $route, $post ) {
    if ( $post->post_type === 'uptrend_stocks' ) {
        $route = '/wp/v2/uptrend_stocks/' . $post->ID;
    }
 
    return $route;
}
// add_filter( 'rest_route_for_post', 'my_plugin_rest_route_for_post', 10, 2 );

?>
