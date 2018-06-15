<?php get_header(); ?>
<div id="main-content" class="container">
    <div class="single_post row">
        <?php while (have_posts()) : the_post(); ?>
        <div class="col-xs-12  col-sm-12 col-md-9">
            <p class="breadcrumbs">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </p>
            <h1><?php the_title() ?></h1>
            <div class="desc_p">
                <?php the_content(); ?>
            </div>
            <?php endwhile; ?>
        </div>
        
        <div class="col-md-3 col-xs-12 relate_p left-content">
            <?php get_sidebar() ?>
        </div>
    </div>       
</div>
<?php get_footer(); ?>