<?php get_header(); ?>
<div id="main-content" class="container">   
    <div class="post_category row">
        <div class="col-xs-12 col-md-9 col-sm-9">
            <p class="breadcrumbs">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </p>
            <h2 class="title_search">Kết quả tìm kiếm: "<?php the_search_query(); ?>"</h2>
            <div class="post_grid">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="row short_post">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                <img class="img-thumbnail alignleft pull-left" alt="<?php the_title(); ?>" src="<?php get_image_url(true, '275x150'); ?>"></a>
                        </div> <!-- col-xs-12 col-sm-4 col-md-3 -->
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="text-content-news">
                                <h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php
                                $post_type = get_post_type(get_the_ID());
                                if ($post_type == "product") { ?>
                                <p class="price">Giá: <?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> đ</p>
                                <?php } ?>
                                <p><?php the_excerpt(); ?></p>
                                <h6 class="label label-danger"><a title="<?php the_title(); ?>" rel="nofollow" href="<?php the_permalink(); ?>" style="color:#FFF"> Xem tiếp</a></h6>
                            </div><!--end text-content-news-->
                        </div> <!-- col-xs-12 col-sm-8 col-md-8 -->
                    </div>
                <?php endwhile; ?>
                <?php getpagenavi(); ?>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 left-content">
            <?php get_sidebar() ?>
        </div>
    </div>       
</div>
<?php get_footer(); ?>