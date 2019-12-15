<?php get_header();?>

<!-- slide show here-->
<?php if(get_theme_mod('show_main_slideshow')) { ?>
    <?php
    $tie_slider_enable = tie_get_option('slider');
    $tie_slider_pos = tie_get_option('slider_pos');
    if($tie_slider_enable && ($tie_slider_pos=='big' || !$tie_slider_pos)):
    ?>
    <div class="clear-line-5"></div>
    <?php include TEMPLATEPATH . ('/modules/owl-carousel/slide-show.php')?>
    <?php endif;?>
<?php } ?>

<?php
$args = array( 'taxonomy' => 'category' );
$the_query = new WP_Term_Query($args);
$catFeatures = [];
foreach ( $the_query->get_terms() as $term )
{
    $cat_option = get_option('tie_cat_'. $term->term_id);
    $term = (array)$term;
    if($cat_option){
        $term = array_merge($term, $cat_option);
    }
    if($term && $term['show_as_home_feature']){
        $catFeatures[$term['term_id']] = $term;
    }
}

if(count($catFeatures) >= 6){
    ?>
    <!-- feature blog area start -->
    <div class="ptb--30">
        <div class="container-fluid">
            <div class="row">
                <?php
                foreach($catFeatures as $catFeature){
                    $category_link = get_category_link( $catFeature['term_id'] );
                    ?>
                    <div class="col-lg-2 col-md-6">
                        <div class="service-cat-item">
                            <a href="<?= esc_url( $category_link ); ?>">
                                <img src="<?= $catFeature['cat_img_feature']?>" alt="<?= $catFeature['name']?>">
                            </a>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- feature blog area end -->
    <?php
}
?>    
<!-- app-cta area start -->
<div class="ptb--30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-md-12 list-item-group">
                <div class="row mb--30">
                    <div class="col-md-12">
                        <div class="item-content">
                            <div class="item-thumb">
                                <a href="#">
                                    <img src="https://vinamas.vn/wp-content/uploads/2017/11/web_design_chandigarh.png" />
                                </a>
                            </div>
                            <div class="item-body">
                                <h2 class="item-title-big text-items-center"><a href="#">TƯ VẤN GIẢI PHÁP</a></h2>
                                <p>The Win hỗ trợ khách hàng doanh nghiệp mục tiêu và phương hướng kinh doanh trong trung hạn (2 năm, 3 năm) và dài hạn (5 năm) và được quán triệt một cách đầy đủ trong tất cả các hoạt động sản xuất kinh doanh của doanh nghiệp nhằm đảm bảo cho doanh nghiệp phát triển bền vững.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb--30">
                        <div class="item-content">
                            <div class="item-thumb">
                                <a href="#">
                                    <img src="https://vinamas.vn/wp-content/uploads/2017/11/web_design_chandigarh.png" />
                                </a>
                                <a class="read-more-small" href="#">Xem thêm</a>
                            </div>
                            <div class="item-body">
                                <h2 class="item-title">DỊCH VỤ QUẢNG CÁO</h2>
                                <p>The Win hỗ trợ khách hàng doanh nghiệp mục tiêu và phương hướng kinh doanh trong trung hạn (2 năm, 3 năm) và dài hạn (5 năm) và được quán triệt một cách đầy đủ trong tất cả các hoạt động sản xuất kinh doanh của doanh nghiệp nhằm đảm bảo cho doanh nghiệp phát triển bền vững.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb--30">
                        <div class="item-content">
                            <div class="item-thumb">
                                <a href="#">
                                    <img src="https://vinamas.vn/wp-content/uploads/2017/11/web_design_chandigarh.png" />
                                </a>
                                <a  class="read-more-small" href="#">Xem thêm</a>
                            </div>
                            <div class="item-body">
                                <h2 class="item-title">XÂY DỰNG VÀ ĐỊNH HƯỚNG</h2>
                                <p>The Win hỗ trợ khách hàng doanh nghiệp mục tiêu và phương hướng kinh doanh trong trung hạn (2 năm, 3 năm) và dài hạn (5 năm) và được quán triệt một cách đầy đủ trong tất cả các hoạt động sản xuất kinh doanh của doanh nghiệp nhằm đảm bảo cho doanh nghiệp phát triển bền vững.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb--30">
                        <div class="item-content">
                            <div class="item-thumb">
                                <a href="#">
                                    <img src="https://vinamas.vn/wp-content/uploads/2017/11/web_design_chandigarh.png" />
                                </a>
                                <a  class="read-more-small" href="#">Xem thêm</a>
                            </div>
                            <div class="item-body">
                                <h2 class="item-title">THIẾT KẾ WEBSITE CHUẨN SEO</h2>
                                <p>The Win hỗ trợ khách hàng doanh nghiệp mục tiêu và phương hướng kinh doanh trong trung hạn (2 năm, 3 năm) và dài hạn (5 năm) và được quán triệt một cách đầy đủ trong tất cả các hoạt động sản xuất kinh doanh của doanh nghiệp nhằm đảm bảo cho doanh nghiệp phát triển bền vững.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb--30">
                        <div class="item-content">
                            <div class="item-thumb">
                                <a href="#">
                                    <img src="https://vinamas.vn/wp-content/uploads/2017/11/web_design_chandigarh.png" />
                                </a>
                                <a class="read-more-small" href="#">Xem thêm</a>
                            </div>
                            <div class="item-body">
                                <h2 class="item-title">RÀ SOÁT CHIẾN LƯỢC MARKETING</h2>
                                <p>The Win hỗ trợ khách hàng doanh nghiệp mục tiêu và phương hướng kinh doanh trong trung hạn (2 năm, 3 năm) và dài hạn (5 năm) và được quán triệt một cách đầy đủ trong tất cả các hoạt động sản xuất kinh doanh của doanh nghiệp nhằm đảm bảo cho doanh nghiệp phát triển bền vững.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-3 col-md-12 list-item-group">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mb--30">
                        <div class="item-content">
                            <div class="item-thumb">
                                <img src="https://vinamas.vn/wp-content/uploads/2017/11/web_design_chandigarh.png" />
                            </div>
                            <div class="item-body">
                                <a href="#">The Win hỗ trợ khách hàng doanh nghiệp mục tiêu</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 mb--30">
                        <div class="item-content">
                            <div class="item-thumb">
                                <img src="https://vinamas.vn/wp-content/uploads/2017/11/web_design_chandigarh.png" />
                            </div>
                            <div class="item-body">									
                                <a href="#">The Win hỗ trợ khách hàng doanh nghiệp mục tiêu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$banner1 = get_theme_mod('ads_banner1');
$banner2 = get_theme_mod('ads_banner2');

$urlBanner1 = get_theme_mod('ads_url_banner1');
$urlBanner2 = get_theme_mod('ads_url_banner2');

if($banner1 && $banner2){
?>
<div class="ptb--30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <a href="<?= $urlBanner1 ? $urlBanner1 : '#'?>"><?php echo wp_get_attachment_image( $banner1, 'large' ); ?></a>					
            </div>
            <div class="col-md-8">
                <a href="<?= $urlBanner2 ? $urlBanner2 : '#'?>"><?php echo wp_get_attachment_image( $banner2, 'large' ); ?></a>
            </div>
        </div>
    </div>
</div>
<?php
}
?>

<!-- classes area start -->
<?php
$serviceQuery = new WP_Query(['posts_per_page' => 12]);
if($serviceQuery->have_posts()){
?>
<section class="classes-area ptb--30" id="classes">
    <div class="container-fluid">
        <div class="section-title">
            <h2>Giải pháp Tất Cả Trong Một </h2>
        </div>
        <div class="classes-carousel swiper-container">
            <div class="swiper-wrapper">
                <?php
                while ($serviceQuery->have_posts()): $serviceQuery->the_post();
                    ?>
                        <div class="swiper-slide">
                            <div class="item-content">
                                <div class="item-thumb">
                                    <?= the_post_thumbnail( 'large' ); ?>
                                </div>
                                <div class="item-body">
                                    <h2  class="item-title">
                                        <a href="<?= the_permalink(); ?>"><?= the_title(); ?></a>
                                    </h2>
                                    <?= the_excerpt();?>
                                </div>
                            </div>
                        </div>
                    <?php
                endwhile;
                ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
<?php
}
?>
<!-- classes area end -->


<!-- testimonial area start -->
<?php
$postQuery = new WP_Query(['posts_per_page' => 10, 'post_type' => 'khach-hang']);
if($postQuery->have_posts()){
?>
<section class="testimonial-area pos-rel ptb--30" id="testimonial">
    <div class="container-fluid">
        <div class="section-title">
            <h2>Khách Hàng Nói Về Chúng Tôi</h2>
        </div>
        <div class="testimonials-carousel swiper-container">
            <div class="swiper-wrapper">
                <?php
                while ($postQuery->have_posts()): $postQuery->the_post();
                    ?>
                    <div class="swiper-slide">
                        <div class="item-content">
                            <div class="item-thumb">
                                <div class="single-trainer trainer_s_two">
                                    <div class="thumb">
                                    <?= the_post_thumbnail( 'large' ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="item-body">
                                <h2 class="item-title"><?= the_title(); ?></h2>
                                <?= the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>
<?php }?>
<!-- testimonial area end -->

<!-- Footer show here-->
<?php get_footer();?>