<?php get_header(); ?>
<div id="main-content">
    <?php get_template_part('template', 'filter'); ?>
    <div class="single-product container">
        <p class="breadcrumbs">
            <?php
            if (function_exists('bcn_display')) {
                bcn_display();
            }
            ?>
        </p>
        <?php while (have_posts()) : the_post(); ?>
            <div class="product-info row" itemscope itemtype="http://schema.org/Product">
                <div class="col-md-6 col-sm-6 col-xs-12 product-preview">
                    <div class="productViewImg">
                        <a href="<?php get_image_url(); ?>" class="cloud-zoom" id="zoom01" rel="adjustX:20, adjustY:-3">
                            <img itemprop="image" id="imgView" title="<?php the_title(); ?>" src="<?php get_image_url(true, '550x412'); ?>" />
                        </a> 
                    </div>
                    <div class="thumbprev" style="display:none"></div>
                    <div class="listimg">
                        <ul id="thumb">
                            <?php
                            $images = rwmb_meta('product_hinhanh', 'type=image');
                            foreach ($images as $image) {
                                $i = wp_get_attachment_image_src($image['ID'], "550x412");
                                ?>
                                <li>
                                    <a  href="<?php echo $image['full_url']; ?>" rel="useZoom: 'zoom01', smallImage: '<?php echo $i[0]; ?>'" class="<?php echo $image['ID']; ?> cloud-zoom-gallery">
                                        <img title="<?php the_title(); ?>" alt="<?php the_title(); ?>" src="<?php echo $image['full_url']; ?>" />
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="thumbnext"></div>
                </div><!--end .product-preview-->
                <div class="col-md-6 col-sm-6 col-xs-12 product-meta">
                    <h1 itemprop="name" class="title-p"><?php the_title(); ?></h1>
                    <p class="price_singlep"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> đ</p>
                    <!--<p class="pds_title">Thông tin sản phẩm</p>-->
                    <div class="giohang mb10">
                        <a class="btn btn-danger pdt10 pdb10"  href="<?php echo get_option('info_tel') ?>">
                            <i class="fa fa-phone"></i> GỌI ĐẶT HÀNG NGAY: <?php echo get_option('info_tel') ?>
                        </a>
<!--                        <div class="quantity mb10">
                        Số lượng: <select name="quantity" style="width: 80px;">
                            <?php
                                $maxQuantity = intval(get_option(SHORT_NAME . '_maxQuantity'));
                                for ($i = 1; $i <= $maxQuantity; $i++) {
                                    echo "<option value=\"{$i}\">{$i}</option>";
                                }
                            ?>
                            </select>
                        </div>
                        <a class="btn btn-danger"  href="javascript://" onclick="AjaxCart.addToCart(<?php the_ID(); ?>, '<?php get_image_url(); ?>', '<?php the_title(); ?>', <?php echo get_post_meta(get_the_ID(), "gia_moi", true); ?>, document.getElementsByName('quantity')[0].value, '');">
                    Đặt hàng <i class="fa fa-cart-plus"></i></a>-->
                    </div>
                    <div class="like_box">
                        <?php show_share_socials(); ?>
                    </div>
                </div><!--end .product-meta-->
            </div><!--end .product-info-->
            <div class="main-product row">
                <div class="col-md-9 col-sm-8 col-xs-12 desc_p">
                    <p class="pds_title">Mô tả sản phẩm</p>
                        <?php the_content() ?>
                    <div class="post-tags">
                         <?php the_tags('<i class="fa fa-tags"></i> Tags: ', ', '); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="fb-comments" data-width="100%" data-href="<?php the_permalink(); ?>" data-numposts="5" data-colorscheme="light"></div> 
                    <div class="clearfix"></div>
                    <div class="related_product row">
                        <h4 class="title_module_user">
                            <i class="fa fa-align-justify"></i>
                            Sản phẩm liên quan
                        </h4>
                        <?php
                        $taxonomy = 'product_category';
                        $terms = get_the_terms(get_the_ID(), $taxonomy);
                        $terms_id = array();
                        if(is_array($terms)){
                            foreach ($terms as $term) {
                                array_push($terms_id, $term->term_id);
                            }
                            $loop = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => 6,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'term_id',
                                        'terms' => $terms_id,
                                    )
                                ),
                                'post__not_in' => array(get_the_ID()),
                            ));
                            while ($loop->have_posts()) : $loop->the_post();
                                get_template_part('template', 'product_item');
                            endwhile;
                            wp_reset_query();
                        }
                        ?>
                    </div> <!-- end .related_product-->
                    <div class="clearfix"></div>
                </div>
                <?php endwhile; ?>
            <div class="col-md-3 col-sm-4 col-xs-12 relate_p left-content">
                <?php get_sidebar() ?>
            </div>
            <div class="clearfix"></div>
        </div><!--end.main-product-->

    </div>
</div>
<?php get_footer(); ?>