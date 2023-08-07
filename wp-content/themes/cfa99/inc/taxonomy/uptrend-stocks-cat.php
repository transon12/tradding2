<?php

add_action( 'init', 'create_uptrend_stocks_cat' );
function create_uptrend_stocks_cat() {
    register_taxonomy(
        'nganh',
        'stocks',
        'technical_chart',
        array(
            'label' => "Nhóm ngành",
            'rewrite' => array( 'slug' => 'nhom-nganh' ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'parent_item'  => null,
            'parent_item_colon' => null,
            'hierarchical' => true,
            'show_in_rest'          => true,
            'rest_base'             => 'nganh',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}
function rest_route_for_uptrend_stocks_cat( $route, $term ) {
    if ( $term->taxonomy === 'nganh' ) {
        $route = '/wp/v2/nganh/' . $term->term_id;
    }
 
    return $route;
}
// add_filter( 'rest_route_for_term', 'rest_route_for_uptrend_stocks_cat', 10, 2 );
