 <?php get_header();?>
<div id="main-content" class="container">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12 product-category">
            <p class="breadcrumbs">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </p>
            <h1><?php single_cat_title() ?></h1>
            <div class="grid-product row">
                <?php  
                    while (have_posts()) : the_post();
                    get_template_part('template', 'product_item');
                    endwhile;
                ?> 
                <div class="clearfix"></div>
                <?php getpagenavi();?>
            </div>
        </div>
        <div class="col-md-3 col-xs-12 left-content">   
            <?php get_sidebar() ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>