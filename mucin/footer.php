<footer class="footer">
    <div class="main-footer">
        <div class="container">
            <div class="row">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footersidebar') ) : ?><?php endif; ?>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h2>Liên hệ với chúng tôi</h2>
                    <div class="contact_footer">
                        <?php echo wpautop(stripslashes(get_option(SHORT_NAME . "_footer_info")));?>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="list-inline pull-left social-list">
                        <?php
                        $fbURL = get_option(SHORT_NAME . "_fbURL");
                        $twitterURL = get_option(SHORT_NAME . "_twitterURL");
                        $linkedInURL = get_option(SHORT_NAME . "_linkedInURL");
                        $googlePlusURL = get_option(SHORT_NAME . "_googlePlusURL");
                        $youtubeURL = get_option(SHORT_NAME . "_youtubeURL");
                        $pinterestURL = get_option(SHORT_NAME . "_pinterestURL");
                        ?>
                        <?php if (!empty($fbURL)): ?>
                        <li><a class="btn btn-danger social-icon facebook" href="<?php echo $fbURL; ?>"><i class="fa fa-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($twitterURL)): ?>
                        <li><a class="btn btn-danger social-icon" href="<?php echo $twitterURL; ?>"><i class="fa fa-twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($linkedInURL)): ?>
                        <li><a class="btn btn-danger social-icon" href="<?php echo $linkedInURL; ?>"><i class="fa fa-linkedin"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($googlePlusURL)): ?>
                        <li><a class="btn btn-danger social-icon" href="<?php echo $googlePlusURL; ?>"><i class="fa fa-google-plus"></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($youtubeURL)): ?>
                        <li><a class="btn btn-danger social-icon youtube" href="<?php echo $youtubeURL; ?>"><i class="fa fa-youtube"></i></i></a></li>
                        <?php endif; ?>
                        <?php if (!empty($pinterestURL)): ?>
                        <li><a class="btn btn-danger social-icon google-plus" href="<?php echo $pinterestURL; ?>"><i class="fa fa-google-plus"></i></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="end-footer">
        <div class="container">
            <div class="t_center copyright">
                Copyright ©
                <a title="<?php echo get_option('unit_owner'); ?>" href="<?php echo get_option('link_website'); ?>"><?php bloginfo('sitename'); ?></a>
                . All rights reserved.
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>