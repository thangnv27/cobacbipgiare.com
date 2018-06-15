<div id="footer" class="container-fluid footer">
    <div class="container">
        <div class="footer">
            <p style="text-align: center;">
                <strong><?php echo get_option('unit_owner') ?></strong>
            </p>
            <p class="t_center">
                Địa chỉ: <?php echo get_option('info_address') ?><br>
                Điện thoại: <?php echo get_option('info_tel') ?>;<br>
                Email: <?php echo get_option('info_email') ?><br>
                Website: <?php echo get_option('info_website') ?>
            </p>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>