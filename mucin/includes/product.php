<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_post_type');

function create_product_post_type(){
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Sản phẩm'),
            'singular_name' => __('Products'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Product'),
            'new_item' => __('New Product'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Product'),
            'view' => __('View Product'),
            'view_item' => __('View Product'),
            'search_items' => __('Search Products'),
            'not_found' => __('No Product found'),
            'not_found_in_trash' => __('No Product found in trash'),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'author', 'thumbnail',
            //'custom-fields', 'comments','excerpt',
        ),
        'rewrite' => array('slug' => 'san-pham', 'with_front' => false),
        'can_export' => true,
        'description' => __('Product description here.'),
        'taxonomies' => array('post_tag'),
    ));
}
/* ----------------------------------------------------------------------------------- */
# Create taxonomy
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_taxonomies');

function create_product_taxonomies(){
    register_taxonomy('product_category', 'product', array(
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => array(
            'name' => __('Danh mục'),
            'singular_name' => __('Product Categories'),
            'add_new' => __('Add New'),
            'add_new_item' => __('Add New Category'),
            'new_item' => __('New Category'),
            'search_items' => __('Search Categories'),
        ),
        'rewrite' => array('slug' => 'danh-muc', 'with_front' => false),
    ));   
}



/* ----------------------------------------------------------------------------------- */
# Meta box
/* ----------------------------------------------------------------------------------- */
$product_meta_box = array(
    'id' => 'product-meta-box',
    'title' => 'Thông tin sản phẩm',
    'page' => 'product',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Giá',
            'desc' => 'Ví dụ: 77000',
            'id' => 'gia_moi',
            'type' => 'text',
            'std' => '',
        ),
));

// Add product meta box
if(is_admin()){
    add_action('admin_menu', 'product_add_box');
    add_action('save_post', 'product_add_box');
    add_action('save_post', 'product_save_data');
}

function product_add_box(){
    global $product_meta_box;
    add_meta_box($product_meta_box['id'], $product_meta_box['title'], 'product_show_box', $product_meta_box['page'], $product_meta_box['context'], $product_meta_box['priority']);
}
/**
 * Callback function to show fields in product meta box
 * @global array $product_meta_box
 * @global Object $post
 * @global array $area_fields
 */
function product_show_box() {
    global $product_meta_box, $post;
    custom_output_meta_box($product_meta_box, $post);   
}
/**
 * Save data from product meta box
 * @global array $product_meta_box
 * @param Object $post_id
 * @return 
 */
function product_save_data($post_id) {
    global $product_meta_box;
    custom_save_meta_box($product_meta_box, $post_id); 
    return $post_id;
}