<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_product_post_type');

function create_product_post_type(){
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Products', SHORT_NAME),
            'singular_name' => __('Products', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add new Product', SHORT_NAME),
            'new_item' => __('New Product', SHORT_NAME),
            'edit' => __('Edit', SHORT_NAME),
            'edit_item' => __('Edit Product', SHORT_NAME),
            'view' => __('View Product', SHORT_NAME),
            'view_item' => __('View Product', SHORT_NAME),
            'search_items' => __('Search Products', SHORT_NAME),
            'not_found' => __('No Product found', SHORT_NAME),
            'not_found_in_trash' => __('No Product found in trash', SHORT_NAME),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 20,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'thumbnail', 'comments', 'excerpt'
            //'custom-fields', 'author', 
        ),
        'rewrite' => array('slug' => 'san-pham', 'with_front' => false),
        'can_export' => true,
        'description' => __('Product description here.', SHORT_NAME),
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
            'name' => __('Product Categories', SHORT_NAME),
            'singular_name' => __('Product Categories', SHORT_NAME),
            'add_new' => __('Add new', SHORT_NAME),
            'add_new_item' => __('Add New Category', SHORT_NAME),
            'new_item' => __('New Category', SHORT_NAME),
            'search_items' => __('Search Categories', SHORT_NAME),
        ),
        'rewrite' => array('slug' => 'danh-muc', 'with_front' => false),
    ));
}

// Show filter
add_action('restrict_manage_posts','restrict_product_by_product_category');
function restrict_product_by_product_category() {
    global $wp_query, $typenow;
    if ($typenow=='product') {
        $taxonomies = array('product_category');
        foreach ($taxonomies as $taxonomy) {
            $category = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' =>  __("$category->label"),
                'taxonomy'        =>  $taxonomy,
                'name'            =>  $taxonomy,
                'value_field'     =>  'slug',
                'orderby'         =>  'name',
                'selected'        =>  $wp_query->query['term'],
                'hierarchical'    =>  true,
                'depth'           =>  3,
                'show_count'      =>  true, // Show # listings in parens
                'hide_empty'      =>  true, // Don't show businesses w/o listings
            ));
        }
    }
}

/***************************************************************************/

// ADD NEW COLUMN  
function product_columns_head($defaults) {
    unset($defaults['comments']);
    unset($defaults['date']);
    $defaults['cat'] = __('Categories', SHORT_NAME);
    $defaults['date'] = __('Date');
    return $defaults;
}

// SHOW THE COLUMN
function product_columns_content($column_name, $post_id) {
    switch ($column_name) {
        case 'cat':
            $taxonomy = 'product_category';
            $terms = get_the_terms($post_id, $taxonomy);
            foreach ($terms as $key => $term) {
                echo '<a href="' . get_edit_tag_link($term->term_id, $taxonomy) . '" target="_blank">' . $term->name . '</a>';
                if($key < count($terms) - 1){
                    echo ", ";
                }
            }
            break;
        default:
            break;
    }
}

add_filter('manage_product_posts_columns', 'product_columns_head');  
add_action('manage_product_posts_custom_column', 'product_columns_content', 10, 2);  