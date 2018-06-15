<?php 
/*
  Template Name: News
 */
get_header(); ?>
<div id="main-content" class="container">
    
    <?php get_template_part('template', 'filter'); ?>
    
    <div class="post_category row">
        <div class="col-xs-12 col-md-8 col-sm-8">
            <p class="breadcrumbs">
                <?php
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                ?>
            </p>
            <?php
            $boxArr = json_decode(get_option('cat_box1'));
            if (count($boxArr) > 0):
            $taxonomy = 'category';
            foreach ($boxArr as $catID) :
            $category = get_term($catID, $taxonomy);
            $category_id = $category->term_id;
            $tax_meta = get_option("tag_{$catID}");
            ?>
            <h1><a href="<?php echo get_category_link($category); ?>"><?php echo ucfirst($category->name); ?></h1>
            <div class="post_grid">
                    <div class="row short_post">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <a title="" href="#">
                                <?php if (function_exists('z_taxonomy_image')) : ?>
                                    <img class="img-thumbnail alignleft pull-left" src="<?php echo z_taxonomy_image_url($category_id); ?>" />
                                <?php endif; ?>
                            </a>
                        </div> <!-- col-xs-12 col-sm-4 col-md-3 -->
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="text-content-news">
                                <p><?php echo $category->description; ?></p>
                            </div><!--end text-content-news-->
                        </div> <!-- col-xs-12 col-sm-8 col-md-8 -->
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-12 col-md-12 list-post-category">
                            <ul>
                            <?php
                                $loop = new WP_Query(array(
                                    'post_type' => 'post',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => $taxonomy,
                                            'field' => 'id',
                                            'terms' => $category->term_id,
                                        )
                                    ),  
                                    'posts_per_page' => 4,
                                ));
                                while ($loop->have_posts()) : $loop->the_post();
                            ?>

                                <li><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>                    
                            <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
            </div>
            <div class="clearfix"></div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
        <div id="slidebar" class="col-xs-12 col-sm-4 col-md-4 sidebar_category">
            <?php get_sidebar(); ?>
        </div>
    </div>       
</div>
<?php get_footer(); ?>