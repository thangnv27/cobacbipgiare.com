<?php get_header(); ?>

<div class="container">
    <?php
    $cat_posts = new WP_Query(array(
        'post_type' => 'post',
        'showposts' => -1,
        'cat' => intval(get_option('constructions_cat')),
    ));
    if($cat_posts->have_posts()):
    ?>
    <div class="list-product portfolio">
        <div class="widget">
            <div class="r-title">
                <h2 class="widget-title">Có thể bạn quan tâm</h2>
            </div>
            <div class="widget-content">
                <div class="flexslider" style="display: none">
                    <ul class="slides owl-carousel">
                    <?php
                    while ($cat_posts->have_posts()) : $cat_posts->the_post();
                        get_template_part('template/product-item');
                    endwhile;
                    wp_reset_query();
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="list-product">
        <?php if ( is_active_sidebar( 'sidebar_home' ) ) { dynamic_sidebar( 'sidebar_home' ); } ?>
    </div>

    <?php get_template_part('template/before', 'footer') ?>
</div>

<?php get_footer(); ?>