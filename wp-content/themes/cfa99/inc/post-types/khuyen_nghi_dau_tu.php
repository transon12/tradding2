<?php
add_action('init', 'register_khuyen_nghi_init');
function register_khuyen_nghi_init() {
    // Register Products
    $investment_labels = array(
        'name'               => 'Khuyến nghị đầu tư',
        'singular_name'      => 'Khuyến nghị đầu tư',
        'menu_name'          => 'Khuyến nghị đầu tư',
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
        'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions'),
        'menu_position'      => 7,
        'rewrite'     => array(
        'slug' => _x( 'khuyen-nghi-dau-tu', 'slug', 'flatsome' ),
        ),
        'rest_base'          => 'khuyennghi',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('khuyennghi', $investment_args);
}
add_action( 'init', function () {
    add_ux_builder_post_type( 'khuyennghi' );
} );

function register_rest_route_for_khuyennghi( $route, $post ) {
    if ( $post->post_type === 'khuyennghi' ) {
        $route = '/wp/v2/khuyennghi/' . $post->ID;
    }
 
    return $route;
}
add_filter( 'rest_route_for_post', 'register_rest_route_for_khuyennghi', 10, 2 );
?>