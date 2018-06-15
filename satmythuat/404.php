<?php get_header(); ?>
<div id="main" class="container">
    <div>
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>'); } ?>
        <div class="col-lg-9 col-md-8">
            <div class="main-content">
                <h1>404 NOT FROUND</h1>
                <?PHP get_search_form() ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
        <div class="clearfix"></div>
    </div>
    
    <?php get_template_part('template/before', 'footer') ?>
</div>
<?php get_footer(); ?>
