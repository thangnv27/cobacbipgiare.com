<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="cobacbipgiare.com" />
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />
        
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if (is_singular() && pings_open(get_queried_object_id())) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php endif; ?>

        <script>
            var siteUrl = "<?php bloginfo('siteurl'); ?>";
            var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
            var is_home = <?php echo (is_home() or is_front_page()) ? 'true' : 'false'; ?>;
            var is_mobile = <?php echo wp_is_mobile() ? 'true' : 'false'; ?>;
            var is_user_logged_in = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;
            var is_fixed_menu = <?php echo (get_option(SHORT_NAME . "_fixedMenu")) ? 'true' : 'false'; ?>;
            var no_image_src = themeUrl + "/images/no_image.png";
            var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
        </script>
        <?php wp_head(); ?>
    </head>
    <body>
        <!--MOBILE HEADER-->
    <div id="st-container" class="st-container">
        <div class="mobile-header clearfix mobile-unclicked" style="transform: translate(0px, 0px);">
            <div id="st-trigger-effects">
                <button data-effect="st-effect-4" class="left-menu">
                    <div class="menu-icon">
                        <span class="bar"></span>
                        <span class="bar"></span>
                        <span class="bar"></span>
                    </div>
                    <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                </button>
            </div>
            <div class="title">
                <?php
                if(get_option('mobilelogo')){
                ?>
                    <a title="<?php bloginfo("name"); ?>" href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_option("mobilelogo"); ?>" alt="LOGO" />
                    </a>
                <?php
                } else {
                ?>
                    <p class="proxima"><a title="<?php bloginfo("name"); ?>" href="<?php echo home_url(); ?>">LOGO</a></p>
                <?php }?>
            </div>
            <div id="st-trigger-effects">
                <!--<button data-effect="st-effect-5" class="right-menu"></button>-->
            </div>
        </div>
        
        <nav id="menu-4" class="st-menu st-effect-4">
            <form method="get" action="<?php echo home_url(); ?>" id="search_mini_form">
                <div class="form-search">
                    <div class="searchcontainer"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        <input type="text" maxlength="128" class="input-text" value="" name="s" id="search" />
                    </div>
                </div>
            </form>

            <?php
            wp_nav_menu(array(
                'container' => '',
                'theme_location' => 'primary',
                'menu_class' => 'nav',
                'menu_id' => '',
            ));
            ?>
        </nav>
    </div>
    <!--/MOBILE HEADER-->
    
    <!--DESKTOP HEADER-->
    <div class="desktop-header">
        <div class="container">
            <div class="header">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="banner pdt20">
                            <a href="<?php bloginfo('siteurl') ?>">
                                <img alt="<?php bloginfo('name') ?>" src="<?php echo get_option('sitelogo'); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!--<div class="row">-->
                            <div class="col-sm-12">
                                <div class="share-box">
                                    <ul>
                                        <li>
                                            <span class="skype">
                                                <a href="http://zalo.me/<?php echo get_option('info_zalo') ?>">
                                                    <img alt="<?php bloginfo('name') ?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_zalo.png">
                                                    Zalo
                                                </a>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="hotline">
                                                <a href="tel:<?php echo get_option('info_tel') ?>">
                                                    <img alt="<?php bloginfo('name') ?>" src="<?php bloginfo('stylesheet_directory'); ?>/images/icon_hotline.png">
                                                    <?php echo get_option('info_tel') ?>
                                                </a>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
<!--                            <div class="col-sm-4">
                                <div class="search-box">   
                                    <form method="get" action="<?php echo home_url(); ?>" id="search_mini_form">
                                        <input type="text" value="" name="s" placeholder="Nhập từ khóa tìm kiếm" />
                                        <button type="submit">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <div class="menu">
                <?php
                wp_nav_menu(array(
                    'container' => '',
                    'container_class' => '',
                    'theme_location' => 'primary',
                    'menu_class' => 'nav'
                ));
                ?>
            </div>
        </div>
    </div>
    <!--/DESKTOP HEADER-->
    
    <?php
    $slider_id = intval(get_option('home_slider'));
    if ($slider_id > 0):
    ?>
    <!--BEGIN SLIDER-->
    <section id="slider">
        <div class="container">
            <?php echo do_shortcode('[layerslider id="' . $slider_id . '"]'); ?>
        </div>
    </section>
    <!--END SLIDER-->
    <?php endif;?>