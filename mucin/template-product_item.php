<div class="item">
    <div class="content-product">
        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="thumbnail">
            <img class="img-rounded" alt="<?php the_title(); ?>" src="<?php get_image_url(true, '267x200'); ?>">
        </a>
        <p class="price"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> đ</p>
        <div class="clearfix"></div>
        <div class="caption">
            <h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="cart">
                <div class="productbuy">
                    <a href="<?php echo get_option('info_tel') ?>">LH: <?php echo get_option('info_tel') ?></a>
<!--                    <a href="javascript://" onclick="AjaxCart.addToCart(<?php the_ID(); ?>, '<?php get_image_url(); ?>', '<?php the_title(); ?>', <?php echo get_post_meta(get_the_ID(), "gia_moi", true); ?>, 1, '');">
                    Đặt mua <i class="fa fa-cart-plus"></i></a>-->
                </div>
                <div class="detail"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> Chi tiết <i class="fa fa-angle-double-right"></i></a></div>
            </div>
        </div> <!-- end caption -->
    </div>
</div> <!-- end col-md-2 -->