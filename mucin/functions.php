<?php
/* ----------------------------------------------------------------------------------- */
# adds the plugin initalization scripts that add styles and functions
/* ----------------------------------------------------------------------------------- */
if(!current_theme_supports('deactivate_layerslider')) require_once( "config-layerslider/config.php" );//layerslider plugin

######## BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/config.php';
include 'libs/HttpFoundation/Request.php';
include 'libs/HttpFoundation/Response.php';
include 'libs/HttpFoundation/Session.php';
include 'libs/custom.php';
include 'libs/common-scripts.php';
include 'libs/meta-box.php';
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/custom-user.php';
include 'includes/product.php';
include 'includes/product-metabox.php';
include 'includes/widgets/ads.php';
include 'includes/widgets/category-post-list-widget.php';
include 'ajax.php';

if (is_admin()) {
    $basename_excludes = array('plugins.php','plugin-install.php', 'plugin-editor.php','themes.php', 'theme-install.php', 'theme-editor.php', 
        'import.php', 'export.php');
    if (in_array($basename, $basename_excludes)) {
        wp_redirect(admin_url());
    }

    include 'includes/orders.php';
    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}

/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
    remove_menu_page('plugins.php');
    remove_menu_page('tools.php');
}

function remove_menu_editor() {
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if (!function_exists("custom_theme_setup")) {

    function custom_theme_setup() {
        ## Enable Links Manager (WP 3.5 or higher)
//        add_filter('pre_option_link_manager_enabled', '__return_true');

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }
        add_image_size('267x200', 267, 200, true);
        add_image_size('550x412', 550, 412, true);
        add_image_size('275x150', 275, 150, true);
        add_image_size('110x92', 110, 92, true);

        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
        ));
    }

}
add_action('after_setup_theme', 'custom_theme_setup');

/* ----------------------------------------------------------------------------------- */
# Widgets init
/* ----------------------------------------------------------------------------------- */
if (!function_exists("custom_widgets_init")) {

    // Register Sidebar
    function custom_widgets_init() {
        register_sidebar(array(
            'id' => 'sidebar',
            'name' => __('Sidebar'),
            'before_widget' => '<div id="%1$s" class="widget-container widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h4>',
            'after_title' => '</h4></div>',
        ));
        register_sidebar(array(
            'id' => 'footersidebar',
            'name' => __('Footer Sidebar'),
            'before_widget' => ' <div class="col-md-4 col-sm-4 col-xs-12">',
            'after_widget' => '</div>',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        ));
    }

}

add_action('widgets_init', 'custom_widgets_init');

/**
 * Enqueue scripts and styles for the front end.
 */
function custom_enqueue_scripts() {
    // Common stylesheet
    wp_enqueue_style( SHORT_NAME . '-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.1.1' );
    wp_enqueue_style( SHORT_NAME . '-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.3.0' );
    wp_enqueue_style( SHORT_NAME . '-common', get_template_directory_uri() . '/css/common.css', array(), THEME_VER );
    wp_enqueue_style( SHORT_NAME . '-wp-default', get_template_directory_uri() . '/css/wp-default.css', array(), THEME_VER );
    
    if(is_singular('product')){
        wp_enqueue_style( SHORT_NAME . '-cloud-zoom', get_template_directory_uri() . '/css/cloud-zoom.css', array(), '1.0.3' );
    }

    // Load our main stylesheet.
    wp_enqueue_style( SHORT_NAME . '-style', get_stylesheet_uri() );

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( SHORT_NAME . '-ie', get_template_directory_uri() . '/css/ie.css', array( SHORT_NAME . '-style' ), THEME_VER );
    wp_style_add_data( SHORT_NAME . '-ie', 'conditional', 'lt IE 9' );
/*
    if ( is_singular() && comments_open() ) {
        // Add Genericons font, used in the main stylesheet.
        wp_enqueue_style( SHORT_NAME . '-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

        // Add comment stylesheet
        wp_enqueue_style( SHORT_NAME . '-comment', get_template_directory_uri() . '/css/comment.css', array(), THEME_VER );

        // Add comment script
        wp_enqueue_script( 'comment-reply' );
    }
*/
    // Add script references
    wp_deregister_script( 'wp-embed' );
    wp_enqueue_script( SHORT_NAME . '-easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array( ), '1.3.2', true );
    wp_enqueue_script( SHORT_NAME . '-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( ), '3.1.1', true );
    wp_enqueue_script( SHORT_NAME . '-custom', get_template_directory_uri() . '/js/custom.js', array( ), THEME_VER, true );
    wp_enqueue_script( SHORT_NAME . '-simplesidebar', get_template_directory_uri() . '/js/jquery.simplesidebar.js', array( ), '1.1.0', true );
    wp_enqueue_script( SHORT_NAME . '-scrolltofixed', get_template_directory_uri() . '/js/jquery-scrolltofixed-min.js', array( ), THEME_VER, true );
    wp_enqueue_script( SHORT_NAME . '-ajax', get_template_directory_uri() . "/js/ajax.js", array(), THEME_VER, true);
    wp_enqueue_script( SHORT_NAME . '-app', get_template_directory_uri() . '/js/app.js', array(), THEME_VER, true );
    if(is_singular('product')){
        wp_enqueue_script( SHORT_NAME . '-cloud-zoom', get_template_directory_uri() . '/js/cloud-zoom.1.0.3.min.js', array( ), '1.0.3', true );
    }
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts' );

function custom_script_add_data() {
    echo <<<HTML
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
HTML;
}

add_action('wp_head', 'custom_script_add_data');

/* ----------------------------------------------------------------------------------- */
# User login
/* ----------------------------------------------------------------------------------- */
add_action('init', 'redirect_after_logout');

function redirect_after_logout() {
    if (preg_match('#(wp-login.php)?(loggedout=true)#', $_SERVER['REQUEST_URI']))
        wp_redirect(get_option('siteurl'));
}

function get_history_order() {
    global $wpdb, $current_user;
    get_currentuserinfo();
    $records = array();
    if (is_user_logged_in()) {
        $tblOrders = $wpdb->prefix . 'orders';
        $query = "SELECT $tblOrders.*, $wpdb->users.display_name, $wpdb->users.user_email FROM $tblOrders 
            JOIN $wpdb->users ON $wpdb->users.ID = $tblOrders.customer_id 
            WHERE $tblOrders.customer_id = $current_user->ID ORDER BY $tblOrders.ID DESC";
        $records = $wpdb->get_results($query);
    }
    return $records;
}

function admin_add_custom_js() {
    ?>
    <script type="text/javascript">/* <![CDATA[ */
        jQuery(function($) {
            var area = new Array();
            $.each(area, function(index, id) {
                //tinyMCE.execCommand('mceAddControl', false, id);
                tinyMCE.init({
                    selector: "textarea#" + id,
                    height: 400
                });
                $("#newmeta-submit").click(function() {
                    tinyMCE.triggerSave();
                });
            });
            $(".submit input[type='submit']").click(function() {
                if (typeof tinyMCE != 'undefined') {
                    tinyMCE.triggerSave();
                }
            });
        });
        /* ]]> */
    </script>
    <?php
}

add_action('admin_print_footer_scripts', 'admin_add_custom_js', 99);

/* ----------------------------------------------------------------------------------- */
# Custom search
/* ----------------------------------------------------------------------------------- */
add_action('pre_get_posts', 'custom_search_filter');

function custom_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        $products_per_page = intval(get_option(SHORT_NAME . "_product_pager"));
        if ($query->is_search) {
            $query->set('posts_per_page', 8);
        }elseif ($query->is_home) {
            $query->set('post_type', 'product');
            $query->set('posts_per_page', $products_per_page);
        } else if (is_taxonomy('product_category')) {
            $query->set('posts_per_page', $products_per_page);
        }
    }
    return $query;
}