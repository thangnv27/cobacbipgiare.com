<?php get_header(); ?>
<div id="main-content" class="container">
    <div class="single_post row">
        <?php while (have_posts()) : the_post(); ?>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <p class="breadcrumbs">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </p>
            <h1><?php the_title() ?></h1>
            <div class="luotxem">
                <p>
                    <i class="fa fa-calendar"></i> Ngày: <?php the_time('d-m-Y'); ?>  
                </p>
            </div>
            <div class="desc_p">
                <?php the_content(); ?>
            </div>
            <div class="post-tags">
                <?php the_tags( '<i class="fa fa-tags"></i> Tags: ', ', ' ); ?>
            </div>
            <div class="like_box">
                <?php show_share_socials(); ?>
            </div>
            <div class="fb-comments" data-width="100%" data-href="<?php the_permalink(); ?>" data-numposts="5" data-colorscheme="light"></div>   
            <?php endwhile; ?>
            <!--BEGIN RELATED POST-->
            <div class="related_posts">
                <div class="title"><h2>Bài viết liên quan</h2></div>
                <ul>
                    <?php
                    $loop = new WP_Query(array(
                                'post_type' => 'post',
                                'posts_per_page' => 5,
                                'orderby' => 'rand',
                                'post__not_in' => array(get_the_ID()),
                            ));
                    while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
            </div>
            <!--END RELATED POST-->
        </div>
        
        <div class="col-md-3 col-xs-12 left-content">
            <?php get_sidebar() ?>
        </div>
    </div>       
</div>
<?php get_footer(); ?>