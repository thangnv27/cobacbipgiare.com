<?php get_header(); ?>
<div id="main" class="container">
    <div>
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
        <div class="col-lg-9 col-md-8">
            <div class="main-content">
                <?php
                while (have_posts()) : the_post();

                    get_template_part('content', 'product');

                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                
                endwhile; ?>
            </div>
        </div>

        <?php get_sidebar(); ?>
        <div class="clearfix"></div>
    </div>
    <div class="list-product" id="related-product">
        <div class="widget">
            <div class="r-title">
                <h2 class="widget-title">Sản phẩm liên quan</h2>
            </div>
            <div class="widget-content">
                <div class="flexslider" style="display: none">
                    <!--<ul class="slides owl-carousel">-->
                    <div class="row">
                    <?php
                    $taxonomy = 'product_category';
                    $terms = get_the_terms(get_the_ID(), $taxonomy);
                    $terms_id = array();
                    foreach ($terms as $term) {
                        array_push($terms_id, $term->term_id);
                    }
                    $related_posts = new WP_Query(array(
                        'post_type' => 'product',
                        'showposts' => 8,
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field' => 'term_id',
                                'terms' => $terms_id,
                            )
                        ),
                        'post__not_in' => array(get_the_ID()),
                    ));
                    while ($related_posts->have_posts()) : $related_posts->the_post();
                        get_template_part('template/product-item2');
                    endwhile;
                    wp_reset_query();
                    ?>
                    </div>
                    <!--</ul>-->
                </div>
            </div>
        </div>
    </div>

    <?php get_template_part('template/before', 'footer') ?>
</div>
<?php get_footer(); ?>