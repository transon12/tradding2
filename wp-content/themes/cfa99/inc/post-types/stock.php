<?php
add_action('init', 'register_stocks_init');
function register_stocks_init() {
    // Register Products
    $investment_labels = array(
        'name'               => 'Cổ phiếu',
        'singular_name'      => 'Cổ phiếu',
        'menu_name'          => 'Cổ phiếu',
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
        'slug' => _x( 'co-phieu', 'slug', 'flatsome' ),
        ),
        'rest_base'          => 'stocks',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('stocks', $investment_args);
}
add_action( 'init', function () {
    add_ux_builder_post_type( 'stocks' );
} );

function register_rest_route_for_stocks( $route, $post ) {
    if ( $post->post_type === 'stocks' ) {
        $route = '/wp/v2/stocks_detail/' . $post->ID;
    }
 
    return $route;
}
add_filter( 'rest_route_for_post', 'register_rest_route_for_stocks', 10, 2 );
?>