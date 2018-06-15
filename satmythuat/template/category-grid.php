<div class="list-product">
    <div class="widget">
        <div class="r-title">
            <h1 class="mt0"><?php single_cat_title(); ?></h1>
        </div>
        <div>
            <?php
            while (have_posts()): the_post();
                get_template_part('template/product-item2');
            endwhile;
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php getpagenavi(); ?>
</div>