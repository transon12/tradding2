<?php

// Danh mục - Strategies (Category - Tin Chiến Lược)
add_action( 'init', 'create_market_analyst_cat' );
function create_market_analyst_cat() {
    register_taxonomy(
        'market_analyst_cat',
        'market_analyst',
        array(
            'label' => "Chuyên mục tin thị trường",
            'rewrite' => array( 'slug' => 'tin-thi-truong' ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'parent_item'  => null,
            'parent_item_colon' => null,
            'hierarchical' => true,
        )
    );
}

// Tags - Strategies (Tags - Tin Chiến Lược)
add_action( 'init', 'create_market_analyst_tags' );
function create_market_analyst_tags() {
    register_taxonomy(
        'market_analyst_tag',
        'market_analyst',
        array(
            'label' => "Thẻ / Tags",
            'rewrite' => array( 'slug' => 'tags-tin-thi-truong' ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'parent_item'  => null,
            'parent_item_colon' => null,
            'hierarchical' => false,
        )
    );
}