<div id="sidebar" class="sidebar col-lg-3 <?php echo (is_search() or is_archive()) ? "hidden-md" : "col-md-4" ?> hidden-sm hidden-xs" style="position: inherit">
    <?php if ( is_active_sidebar( 'sidebar' ) ) { dynamic_sidebar( 'sidebar' ); } ?>
</div><!-- #sidebar -->