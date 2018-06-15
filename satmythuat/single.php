<?php get_header(); ?>
<div id="main" class="container">
    <div>
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
        }
        ?>
        <div class="col-lg-9 col-md-8">
            <div class="main-content">
                <?php
                while (have_posts()) : the_post();

                    get_template_part('content', get_post_format());

                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                
                endwhile; ?>
            </div>
        </div>

        <?php get_sidebar(); ?>
        <div class="clearfix"></div>
    </div>
    <div class="list-product">
        <div class="widget">
            <div class="r-title">
                <h2 class="widget-title">Bài viết liên quan</h2>
            </div>
            <div class="widget-content">
                <div class="flexslider" style="display: none">
                    <ul class="slides">
                    <?php
                    $terms = get_the_category();
                    $terms_id = array();
                    foreach ($terms as $term) {
                        array_push($terms_id, $term->term_id);
                    }
                    $related_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'showposts' => 8,
                        'category__in' => $terms_id,
                        'post__not_in' => array(get_the_ID()),
                    ));
                    while ($related_posts->have_posts()) : $related_posts->the_post();
                        get_template_part('template/product-item');
                    endwhile;
                    wp_reset_query();
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part('template/before', 'footer') ?>
</div>
<?php get_footer(); ?>