<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row mb30">
        <div class="col-sm-5">
            <img alt="<?php the_title() ?>" src="<?php get_image_url() ?>" />
        </div>
        <div class="col-sm-7">
            <?php the_title('<h1 class="entry-title bold">', '</h1>'); ?>
            <div class="bold mb15">Mã sản phẩm: <?php the_field('product_code') ?></div>
            <div class="bold mb15">Giá bán: <span class="t_red font20">
                <?php echo number_format(floatval(get_field('gia_moi')), 0, ',', '.'); ?> đ
                </span></div>
            <div class="bold mb15">Liên hệ: <a href="tel:<?php echo get_option('info_tel') ?>" class="t_red font20"><?php echo get_option('info_tel') ?></a></div>
            <div class="mb28"><?php echo get_short_content(get_the_excerpt(), 300); ?></div>
            <?php show_share_socials(); ?>
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="entry-content">
        <?php
        the_content();

        edit_post_link(__('<i class="fa fa-pencil"></i> Chỉnh sửa', SHORT_NAME), '<span class="edit-link">', '</span>');
        ?>
    </div><!-- .entry-content -->
    
    <?php the_tags('<footer class="entry-meta"><span class="tag-links"><i class="fa fa-tags"></i> ', ', ', '</span></footer>'); ?>
</article><!-- #post-## -->
