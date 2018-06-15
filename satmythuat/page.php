<?php get_header(); ?>
<div id="main" class="container">
    <div>
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
        <div class="col-lg-9 col-md-8">
            <div class="main-content">
                <?php
                while (have_posts()) : the_post();

                    get_template_part('content', 'page');

                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?>

                <?php endwhile; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <div class="clearfix"></div>
    </div>
    
    <?php get_template_part('template/before', 'footer') ?>
</div>
<?php get_footer(); ?>
