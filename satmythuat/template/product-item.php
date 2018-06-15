<li>
    <div class="entry">
        <a href="<?php the_permalink(); ?>" class="thumbnail preview" 
           rel="<?php the_post_thumbnail_url('full'); ?>" title="<?php the_title(); ?>">
            <img src="<?php the_post_thumbnail_url('380x300'); ?>" alt="<?php the_title(); ?>"/>
        </a>
        <?php if(get_post_type(get_the_ID()) == 'product'): ?>
        <span class="post-meta">
            <span class="t_red">
                <?php echo number_format(floatval(get_field('gia_moi')), 0, ',', '.'); ?> đ
            </span>
            <span class="t_red ml5">
                (LH: <a href="tel:<?php echo get_option('info_tel') ?>" class="t_red"><?php echo get_option('info_tel') ?></a>)
            </span>
        </span>
        <?php endif; ?>
        <br>
        <a href="<?php the_permalink(); ?>">
            <h3><?php the_title(); ?></h3>
        </a>
    </div>
</li>