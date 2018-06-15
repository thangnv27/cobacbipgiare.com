<?php get_header(); ?>
<div id="main-content" class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12">
            <?php
            $slider_id = intval(get_option('home_slider'));
            if ($slider_id > 0):
                ?>
                <!--BEGIN SLIDER-->
                <div class="slider">
                    <?php echo do_shortcode('[layerslider id="' . $slider_id . '"]'); ?>
                </div>
                <!--END SLIDER-->
            <?php endif; ?>
            <div class="clearfix"></div>
            <div class="module_product">
                <div class='full_home_product'>
                    <?php  
                        while (have_posts()) : the_post();
                        get_template_part('template', 'product_item');
                        endwhile;
                    ?> 
                    <div class="clearfix"></div>
                    <?php getpagenavi();?>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-12 left-content">
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>