<?php
add_action('init', 'register_technical_chart_init');
function register_technical_chart_init() {
    // Register Products
    $investment_labels = array(
        'name'               => 'Biểu đồ kỹ thuật',
        'singular_name'      => 'Biểu đồ kỹ thuật',
        'menu_name'          => 'Biểu đồ kỹ thuật',
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
        'slug' => _x( 'bieu-do-ky-thuat', 'slug', 'flatsome' ),
        ),
        'rest_base'          => 'technical_chart',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type('technical_chart', $investment_args);
}
add_action( 'init', function () {
    add_ux_builder_post_type( 'technical_chart' );
} );

function register_rest_route_for_technical_chart( $route, $post ) {
    if ( $post->post_type === 'technical_chart' ) {
        $route = '/wp/v2/technical_chart_detail/' . $post->ID;
    }
 
    return $route;
}
add_filter( 'rest_route_for_post', 'register_rest_route_for_technical_chart', 10, 2 );
?>