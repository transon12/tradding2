<?php

add_action('init', 'register_market_analyst_init');
function register_market_analyst_init() {
    // Register Products
    $investment_labels = array(
        'name'               => 'Phân tích thị trường',
        'singular_name'      => 'Phân tích thị trường',
        'menu_name'          => 'Phân tích thị trường',
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
        'menu_position'      => 5,
        'rewrite'     => array(
        'slug' => _x( 'phan-tich-thi-truong', 'slug', 'flatsome' ),
        ),
        'rest_base'          => 'market_analysts',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('market_analyst', $investment_args);
}
add_action( 'init', function () {
    add_ux_builder_post_type( 'market_analyst' );
} );

function register_rest_route_for_market_analyst( $route, $post ) {
    if ( $post->post_type === 'market_analyst' ) {
        $route = '/wp/v2/market_analysts/' . $post->ID;
    }
 
    return $route;
}
add_filter( 'rest_route_for_post', 'register_rest_route_for_market_analyst', 10, 2 );
?>