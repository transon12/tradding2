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

        if ( strpos( $_SERVER['REQUEST_URI'], 'wp-json')) {
            $user_id = get_current_user_id();
    
            if($user_id == 0 || empty($user_id)){
    
                $data = array(
    
                    "code" => "rest_cannot_read",
                    "message" => "Bạn chưa đăng nhập",
                    "data"  => [
                        "status" => 401
                    ]
                );
    
            }else{
    
                $membership_level = pmpro_getMembershipLevelForUser($user_id);
    
                $end_date = $user_info->membership_level->enddate;
                $current_date = date();
    
                if($membership_level == false || $membership_level->ID == 1){
                    $data = array(
                        "code" => "rest_cannot_read",
                        "message" => "Bạn chưa kích hoạt gói này, vui lòng nâng cấp.",
                        "data"  => [
                            "status" => 401
                        ]
                    );
                }elseif($membership_level->ID == 9 && !empty($end_date) && $end_date < $current_date ){
                    $data = array(
                        "code" => "rest_cannot_read",
                        "message" => "Bạn chưa kích hoạt gói này, vui lòng nâng cấp",
                        "data"  => [
                            "status" => 401
                        ]
                    );
                }
            }
    
            if ( isset($data) ) {
                http_response_code(401);
                header('Content-Type: application/json');
                
                echo json_encode($data);
                die();
            }
        }

        $route = '/wp/v2/khuyennghi/' . $post->ID;
    }

    return $route;
}
add_filter( 'rest_route_for_post', 'register_rest_route_for_khuyennghi', 10, 2 );
?>