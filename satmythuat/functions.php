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
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
include 'libs/template-tags.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/widgets/ads.php';
include 'includes/widgets/category-posts-list.php';
include 'includes/widgets/category-product-grid.php';
include 'includes/product.php';

if (is_admin()) {
    $basename_excludes = array('plugin-install.php', 'plugin-editor.php', 'themes.php', 'theme-editor.php', 'import.php', 'export.php');
    if (in_array($basename, $basename_excludes)) {
//        wp_redirect(admin_url());
    }

    include 'includes/plugins-required.php';

    // Add filter
    add_filter( 'enter_title_here', 'ppo_change_title_text' );
    add_filter('acf/settings/show_updates', '__return_false');
    
    // Add action
    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}

/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
//    remove_menu_page('plugins.php');
//    remove_menu_page('tools.php');
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
if (!function_exists("ppo_theme_setup")) {

    function ppo_theme_setup() {
        /*
	 * Make theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( SHORT_NAME, get_template_directory() . '/languages' );
        
        ## Enable Links Manager (WP 3.5 or higher)
        //add_filter('pre_option_link_manager_enabled', '__return_true');
        
        // This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 
            'css/editor-style.css',
            get_stylesheet_directory_uri(), 
        ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }
//        add_image_size('260x130', 260, 130, true); // Post thumbnail
        add_image_size('380x300', 380, 300, true); // Product thumbnail
        add_image_size('267x200', 267, 200, true);
        add_image_size('550x412', 550, 412, true);
        add_image_size('275x150', 275, 150, true);
        add_image_size('110x92', 110, 92, true);

        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
        ));
        
        // Front-end remove admin bar
        if (!current_user_can('administrator') && !current_user_can('editor') && !is_admin()) {
            show_admin_bar(false);
        }
    }

}

add_action('after_setup_theme', 'ppo_theme_setup');

/**
 * Enqueue scripts and styles for the front end.
 */
function ppo_enqueue_scripts() {
    // Add Common stylesheet
    wp_enqueue_style( SHORT_NAME . '-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7' );
    wp_enqueue_style( SHORT_NAME . '-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );
    wp_enqueue_style( SHORT_NAME . '-owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '2.0.0' );
    wp_enqueue_style( SHORT_NAME . '-wp-default', get_template_directory_uri() . '/css/wp-default.min.css', array(), FALSE );
    wp_enqueue_style( SHORT_NAME . '-common', get_template_directory_uri() . '/css/common.min.css', array(), FALSE );

    // Add font styles
    wp_enqueue_style( SHORT_NAME . '-Roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,vietnamese', array(), false );
    wp_enqueue_style( SHORT_NAME . '-Roboto-Condensed', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic&subset=latin,vietnamese', array(), false );

    // Load our main stylesheet.
    wp_enqueue_style( SHORT_NAME . '-style', get_stylesheet_uri() );

/*
    if ( is_singular() && comments_open() ) {
        // Add comment stylesheet
        wp_enqueue_style( 'comment', get_template_directory_uri() . '/css/comment.css', array(), FALSE );
        
        wp_enqueue_script( 'comment-reply' );
    }
*/
    // Add script references
    wp_deregister_script( 'wp-embed' );
    wp_enqueue_script( SHORT_NAME . '-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
    wp_enqueue_script( SHORT_NAME . '-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( SHORT_NAME . '-scrolltofixed', get_template_directory_uri() . '/js/jquery-scrolltofixed-min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( SHORT_NAME . '-app', get_template_directory_uri() . '/js/app.min.js', array( 'jquery' ), false, true );
}

add_action( 'wp_enqueue_scripts', 'ppo_enqueue_scripts' );

function ppo_script_add_data() {
    echo <<<HTML
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
HTML;
}

add_action('wp_head', 'ppo_script_add_data');

/* ----------------------------------------------------------------------------------- */
# Widgets init
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_widgets_init")) {

    // Register Sidebar
    function ppo_widgets_init() {
        register_sidebar(array(
            'id' => 'sidebar',
            'name' => __('Sidebar', SHORT_NAME),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
        register_sidebar(array(
            'id' => 'sidebar_home',
            'name' => __('Sidebar Home', SHORT_NAME),
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="r-title"><h2 class="widget-title">',
            'after_title' => '</h2></div>',
        ));
    }

    // Register widgets
    register_widget('Ads_Widget');
    register_widget('Category_Posts_List_Widget');
    register_widget('Category_Product_Grid_Widget');
}

add_action('widgets_init', 'ppo_widgets_init');

/**
 * Override wp title for add new/edit a post
 * 
 * @param string $title
 * @return string
 */
function ppo_change_title_text( $title ){
    $screen = get_current_screen();
 
    switch ($screen->post_type) {
        case 'product':
            $title = 'Nhập tên sản phẩm';
            break;
        default:
            break;
    }
 
     return $title;
}

//add extra fields to tag category form hook
add_action('edit_category_form_fields', 'extra_category_fields');

//add extra fields to category edit form callback function
function extra_category_fields($tag) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $tag_meta = get_option("tag_$t_id");
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="tag_meta_layout"><?php _e('View Layout'); ?></label></th>
        <td>
            <select class="postform" name="tag_meta[layout]" id="tag_meta_layout">
                <?php
                $layout = array(0 => 'Default: Grid', 1 => 'List');
                foreach ($layout as $k => $v) {
                    if ($tag_meta['layout'] == $k) {
                        echo '<option value="' . $k . '" selected>' . $v . '</option>';
                    } else {
                        echo '<option value="' . $k . '">' . $v . '</option>';
                    }
                }
                ?>
            </select>
            <br />
            <span class="description">Layout display in front end</span>
        </td>
    </tr>
    <?php
}

// save category extra fields hook
add_action('edited_category', 'save_extra_category_fileds');

// save category extra fields callback function
function save_extra_category_fileds($term_id) {
    if (isset($_POST['tag_meta'])) {
        $t_id = $term_id;
        $tag_meta = get_option("tag_$t_id");
        $tag_keys = array_keys($_POST['tag_meta']);
        foreach ($tag_keys as $key) {
            if (isset($_POST['tag_meta'][$key])) {
                $tag_meta_value = stripslashes_deep($_POST['tag_meta'][$key]);
                if(!empty($tag_meta_value)){
                    $tag_meta[$key] = $tag_meta_value;
                }
            }
        }
        //save the option array
        update_option("tag_$t_id", $tag_meta);
    }
}