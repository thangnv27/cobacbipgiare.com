<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

    <div class="entry-meta">
        <?php 
        if ('post' == get_post_type())
            ppo_posted_on();
        ?>
    </div>
    <div class="entry-content">
        <?php
        the_content();
        show_share_socials();

        edit_post_link(__('<i class="fa fa-pencil"></i> Chỉnh sửa', SHORT_NAME), '<span class="edit-link">', '</span>');
        ?>
    </div><!-- .entry-content -->
    
    <?php the_tags('<footer class="entry-meta"><span class="tag-links"><i class="fa fa-tags"></i> ', ', ', '</span></footer>'); ?>
</article><!-- #post-## -->
