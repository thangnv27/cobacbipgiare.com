<?php get_header(); ?>

<div id="main" class="container">
    <?php
    if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); }

    get_template_part('template/category-grid');
    
    get_template_part('template/before', 'footer')
    ?>
</div>

<?php get_footer(); ?>