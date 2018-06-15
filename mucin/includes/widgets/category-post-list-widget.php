<?php

class Category_Post_List_widget extends WP_Widget {

    function Category_Post_List_widget() {
        $widget_ops = array('classname' => 'cat-post-list-widget', 'description' => __('Display post under particular category.'));
        $control_ops = array('id_base' => 'cat_post_list_widget');
        parent::__construct('cat_post_list_widget', 'PPO: Category Post List', $widget_ops, $control_ops);
    }

    /**
     * Displays category posts widget on blog.
     *
     * @param array $instance current settings of widget .
     * @param array $args of widget area
     */
    function widget($args, $instance) {
        global $post;
        $post_old = $post; // Save the post object.
        extract($args);

        $title = apply_filters('title', $instance['title']);
        $term_id = trim($instance["cat"]);
        $category_info = get_category($term_id);
        // If not title, use the name of the category.
        if (!$instance["title"]) {
            $title = $category_info->name;
        }
        
        echo $before_widget;
        // Widget title
        echo $before_title;
        echo $title;
        echo $after_title;
        ?>		
        <div class="leftcat widget">
            <ul class="news_list_widget">
            <?php
            $cat_posts = new WP_Query(array(
                'post_type' => 'post',
                'showposts' => $instance["num"],
                'cat' => $term_id,
            ));
            while ($cat_posts->have_posts()) : $cat_posts->the_post();
                    ?>						
                    <li class="items_news">								
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
                                <img height="80" width="80" class="img-thumbnail img-responsive" src="<?php get_image_url(); ?>" alt="<?php the_title(); ?>" />
                                <span class="product-title"><?php the_title(); ?></span>
                            </a>
                        </div>
                        <ins>
                            <?php echo get_short_content(get_the_content(), 120); ?>
                        </ins>
                    </li> 
                <?php
            endwhile;
            wp_reset_query();
            ?>
            </ul>
        </div>
        <div class="clear"></div>
        <?php
        echo $after_widget;
        $post = $post_old; // Restore the post object.
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
            <label for="<?php echo $this->get_field_id("title"); ?>">Tiêu đề</label>
            <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
        </p>
        <p>
            <label>Chuyên mục</label><br />
            <?php wp_dropdown_categories(array('name' => $this->get_field_name("cat"), 'show_option_all' => 'All', 'hide_empty' => 0, 'selected' => $instance["cat"])); ?>
        </p>
        <p>
            <label><?php _e('Number', SHORT_NAME) ?></label><br />
            <input class="widefat" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo intval($instance["num"]); ?>" />
        </p>
        <?php
    }

}

register_widget('Category_Post_List_widget');