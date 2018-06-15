<?php get_header(); ?>

<div id="main" class="container">
    <?php
    if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }

    $term_id = get_queried_object_id();
    $tag_meta = get_option("tag_$term_id");
    $layout = intval($tag_meta['layout']);
    if($layout != 1):
        get_template_part('template/category-grid');
    else:
    ?>
        <div class="col-lg-9 col-md-12">
            <div class="news">
                <div class="r-title1">
                    <h1><?php single_cat_title();?></h1>
                </div>
                <div class="main-content">
                    <?php
                    $date_format = get_option('date_format');
                    $time_format = get_option('time_format');
                    while (have_posts()): the_post();
                        ?>
                        <div class="row entry1">
                            <div class="col-sm-3">
                                <a href="<?php the_permalink(); ?>" class="thumbnail">
                                    <img src="<?php the_post_thumbnail_url('380x300'); ?>" alt="<?php the_title(); ?>"/>
                                </a>
                            </div>
                            <div class="col-sm-9">
                                <a href="<?php the_permalink(); ?>">
                                    <h3><?php the_title(); ?></h3>
                                </a>
                                <div class="entry-meta">
                                    <span><?php the_time($time_format); ?></span> | 
                                    <span itemprop="datePublished"><?php echo date($date_format, strtotime($post->post_date)); //the_date($date_format);  ?></span>
                                </div>
                                <div class="description">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <?php getpagenavi();?>
            </div>
        </div>

        <?php get_sidebar();?>
        <div class="clearfix"></div>
    <?php endif; ?>
    
    <?php get_template_part('template/before', 'footer') ?>
</div>

<?php get_footer(); ?>