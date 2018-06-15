<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Cache-control" content="no-store; no-cache"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="author" content="cobacbipgiare.com" />
    <meta name="robots" content="index, follow" /> 
    <meta name="googlebot" content="index, follow" />
    <meta name="bingbot" content="index, follow" />
    <meta name="geo.region" content="VN" />
    <meta name="geo.position" content="14.058324;108.277199" />
    <meta name="ICBM" content="14.058324, 108.277199" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php if(is_home() or is_front_page()): ?>
    <meta name="keywords" content="<?php echo get_option('keywords_meta') ?>" />
    <?php endif; ?>
    <link rel="publisher" href="https://plus.google.com/+NgôVănThắngIT"/>
    <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />        
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php if (is_singular() && pings_open(get_queried_object_id())) : ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php endif; ?>

    <script>
        var siteUrl = "<?php bloginfo('siteurl'); ?>";
        var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
        var no_image_src = themeUrl + "/images/no_image_available.jpg";
        var is_fixed_menu = <?php echo (get_option(SHORT_NAME . "_fixedMenu")) ? 'true' : 'false'; ?>;
        var is_home = <?php echo (is_home() or is_front_page()) ? 'true' : 'false'; ?>;
        var is_mobile = <?php echo wp_is_mobile() ? 'true' : 'false'; ?>;
        var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
        var cartUrl = "<?php echo get_page_link(get_option(SHORT_NAME . "_pageCartID")); ?>";
        var checkoutUrl = "<?php echo get_page_link(get_option(SHORT_NAME . "_pageCheckoutID")); ?>";
        var lang = "<?php echo getLocale(); ?>";
    </script>

    <?php wp_head(); ?>
    <style type="text/css">
        @media (max-width: 991px){html {margin-top:0!important}}
    </style>
</head>
<body>
    <div id="ajax_loading" style="display: none;z-index: 99999" class="ajax-loading-block-window">
        <div class="loading-image"></div>
    </div>
    <!--Alert Message-->
    <div id="nNote" class="nNote" style="display: none;"></div>
    <div id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="header-main">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="logo">
                            <div itemtype="http://schema.org/Organization" itemscope="itemscope">
                                <a title="<?php bloginfo('sitename'); ?>" itemprop="url" href="<?php bloginfo('siteurl'); ?>">
                                    <img title="<?php bloginfo('sitename'); ?>" alt="<?php bloginfo('sitename'); ?>" src="<?php echo get_option('sitelogo'); ?>" itemprop="logo">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="hotline">
                                                            <img src="<?php echo get_option('hotlineimg'); ?>" alt="Hotline" title="Hotline" />
                        </div>
                    </div>

                    <div class="cart col-md-4 col-sm-4 col-xs-12">
                        <div class="header_login">
                            <?php if (!is_user_logged_in()): ?>
                            <a class="header_login_link" href="<?php echo wp_login_url(getCurrentRquestUrl()); ?>">Đăng nhập | </a><a class="header_registration" href=" <?php echo wp_registration_url(); ?> ">Đăng ký | </a>  
                            <?php else: ?>
                            <a href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageHistoryOrder")); ?>">Lịch sử mua hàng | </a> 
                           <?php endif; ?> 
                            <a href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageCartID")); ?>">Giỏ hàng (<span class="cart-count">
                                <?php if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])){
                                    $cart = $_SESSION['cart'];
                                    echo count($cart);
                                }else{
                                    echo "0";
                                }
                                ?>
                                </span>)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default fixedHeader">
            <div class="container"  style="position: relative">
                <a id="menu">
                    <span class="menu-mobile-icon">&nbsp;</span>
                </a>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="menu-content collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php
                    wp_nav_menu(array(
                        'container' => '',
                        'theme_location' => 'primary',
                        'menu_class' => 'nav navbar-nav navbar-left',
                    ));
                    ?>
                </div><!-- /.navbar-collapse -->
                <div class="search-box">
                    <a href="javascript://" title="Tìm kiếm" id="btnSearch"><i class="fa fa-search"></i></a>
                    <div class="search-form">
                        <span class="arrow-wrap">
                            <span class="arrow"></span>
                        </span>
                        <form id="searchform" action="<?php bloginfo( 'siteurl' ); ?>" method="get">
                            <div class="input-group">
                                <input type="text" name="s" value="" placeholder="Tìm kiếm..." class="form-control" />
                                <span class="input-group-btn">
                                    <input type="submit" value="" />
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <!--MENU MOBILE-->
        <section class="menu-mobile">
            <div style="text-align: right">
                <span class="btn-close-menu"></span>
            </div>
            <?php
            wp_nav_menu(array(
                'container' => '',
                'theme_location' => 'primary',
                'menu_class' => 'mnleft',
            ));
            ?> 
        </section>
    </div>
