<?php
/*
  Template Name: Page Contact
 */
get_header(); ?>
<div class="main container">
    <p class="breadcrumbs">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
        ?>
    </p>
    <div class="main-content">
        <?php while (have_posts()) : the_post(); ?>
        <div class="row contact">
            <div class="col-md-5 col-sm-6 col-xs-12">
                <?php the_content(); ?>
            </div>
            <div class="col-md-7 col-sm-6 col-xs-12">
                <?php echo stripslashes(get_option(SHORT_NAME . "_gmaps")); ?>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
</div>
<?php get_footer(); ?>