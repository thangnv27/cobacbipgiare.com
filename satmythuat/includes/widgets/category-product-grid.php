<?php

class Category_Product_Grid_Widget extends WP_Widget {

    function Category_Product_Grid_Widget() {
        $widget_ops = array('classname' => 'cat-product-grid-widget', 'description' => __('Show product by category.'));
        $control_ops = array('id_base' => 'cat_product_grid_widget');
        parent::__construct('cat_product_grid_widget', 'PPO: Products Grid', $widget_ops, $control_ops);
    }

    /**
     * Displays category posts widget on blog.
     *
     * @param array $instance current settings of widget .
     * @param array $args of widget area
     */
    function widget($args, $instance) {
        global $post;
        extract($args);

        $taxonomy = 'product_category';
        $title = apply_filters('title', $instance['title']);
        $term_id = trim($instance["cat"]);
        if($term_id > 0):
            $category_info = get_term($term_id, $taxonomy);
            // If not title, use the name of the category.
            if (!$instance['title']) {
                $title = $category_info->name;
            }

            echo $before_widget;
            // Widget title
            echo $before_title;
            ?>
            <a href="<?php echo get_term_link($category_info, $taxonomy) ?>" title="<?php echo ucfirst($category_info->name); ?>" rel="bookmark category"><?php echo $category_info->name; ?></a>
            <?php echo $after_title; ?>
            <div class="widget-content">
                <div class="flexslider" style="display: none">
                    <!--<ul class="slides owl-carousel">-->
                    <div class="row">
                    <?php
                    $cat_posts = new WP_Query(array(
                        'post_type' => 'product',
                        'showposts' => $instance["num"],
                        'tax_query' => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field' => 'term_id',
                                'terms' => $term_id,
                            )
                        ),
                    ));
                    while ($cat_posts->have_posts()) : $cat_posts->the_post();
                        get_template_part('template/product-item2');
                    endwhile;
                    wp_reset_query();
                    ?>
                    </div>
                    <!--</ul>-->
                </div>
            </div>
            <?php
            echo $after_widget;
        endif;
    }

    /**
     * Form processing...
     *
     * @param array $new_instance of widget .
     * @param array $old_instance of widget .
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['cat'] = $new_instance['cat'];
        $instance['desc'] = $new_instance['desc'];
        $instance['num'] = $new_instance['num'];
        return $instance;
    }

    /**
     * The configuration form.
     *
     * @param array $instance of widget to display already stored value .
     * 
     */
    function form($instance) {
        ?>		
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', SHORT_NAME) ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label><?php _e('Category', SHORT_NAME) ?></label><br />
            <?php 
            wp_dropdown_categories(array(
                'name' => $this->get_field_name("cat"), 
                'taxonomy' => 'product_category', 
                'hide_empty' => 0, 
                'selected' => $instance["cat"],
                'hierarchical' => true,
                'class' => 'widefat',
            ));
            ?>
        </p>
        <p>
            <textarea rows="8" class="widefat"  id="<?php echo $this->get_field_id('desc') ?>" name="<?php echo $this->get_field_name("desc") ?>"><?php echo stripslashes_deep($instance['desc']) ?></textarea>
        </p>
        <p>
            <label><?php _e('Number', SHORT_NAME) ?></label><br />
            <input class="widefat" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo intval($instance["num"]); ?>" />
        </p>
        <?php
    }

}
