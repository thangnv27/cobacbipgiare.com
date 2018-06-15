<?php
/*
  Template Name: Contact
 */
?>
<?php get_header(); ?>
<div id="main" class="container">
    <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
    <div class="contac-info r-title">
        <div class="r-title1">
            <h1>Liên hệ</h1>
        </div>
        <div class="row">
            <div>
                <div class="col-sm-7">
                    <p class="t_center">
                        <strong><?php echo get_option('unit_owner') ?></strong><br><br>
                        Địa chỉ: <?php echo get_option('info_address') ?><br>
                        Điện thoại: <?php echo get_option('info_tel') ?>;<br>
                        Email: <?php echo get_option('info_email') ?><br>
                        Website: <?php echo get_option('info_website') ?>
                    </p>
                    <div><?php echo stripslashes_deep(get_option(SHORT_NAME . "_gmaps")) ?></div>
                </div>
                <div class="col-sm-5">
                    <div class="form-contact">
                        <h2>Mọi chi tiết xin liên hệ</h2>
                        <?php echo do_shortcode(stripslashes_deep(get_option(SHORT_NAME . "_form"))) ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
</div>
<?php get_footer(); ?>
