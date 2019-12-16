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
                <?php
                    $page = get_page_by_path( 'home-page' );
                    $content = apply_filters('the_content', $page->post_content); 
                    print_r($content);
                ?>
            </div>
            <div class="col-lg-3 col-md-12 list-item-group">
                <div class="row">
                <?php
                $newsQuery = new WP_Query(['posts_per_page' => 4, 'post_type' => 'tin-tuc']);
                if($newsQuery->have_posts()){
                    while ($newsQuery->have_posts()): $newsQuery->the_post();
                        ?>
                        <div class="col-lg-12 col-md-12 mb--30">
                            <div class="item-content">
                                <div class="item-thumb">
                                    <?= the_post_thumbnail( 'large' ); ?>
                                </div>
                                <div class="item-body">
                                    <a href="<?= the_permalink() ?>"><?= the_title() ?></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                }
                ?>
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
                                    <?= the_post_thumbnail( 'medium' ); ?>
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