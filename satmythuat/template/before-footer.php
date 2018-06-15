<div id="before-footer" class="contact">
    <div class="col-sm-6">
        <div class="r-title1">
            <h2>Thông tin liên hệ</h2>
        </div>
        <p><strong><?php echo get_option('unit_owner') ?></strong></p>
        <p>
            Địa chỉ: <?php echo get_option('info_address') ?><br>
            Điện thoại: <?php echo get_option('info_tel') ?><br>
            Email: <?php echo get_option('info_email') ?><br>
            Website: <?php echo get_option('info_website') ?>
        </p>
        <div><?php echo stripslashes_deep(get_option(SHORT_NAME . "_gmaps")) ?></div>
    </div>
    <div class="col-sm-6">
        <div class="r-title1">
            <h2>Video</h2>
        </div>
        <div><?php echo stripslashes_deep(get_option(SHORT_NAME . "_video")) ?></div>
    </div>
    <div class="clearfix"></div>
</div>