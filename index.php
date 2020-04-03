<?php get_header();?>
<?php
function get_link_by_slug($slug, $type = 'page'){
    $post = get_page_by_path($slug, OBJECT, $type);
    return get_permalink($post->ID);
}
function get_youtube_id_from_url($url)
{
    if (stristr($url,'youtu.be/'))
        {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
    else 
        {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
}
?>
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

<!-- Main content show here-->
<div class="container">
    <div class="clear-15"></div>
    <?php require_once ('helpers/layout-configs.php'); ?>
    <div class="row <?= mainLayoutKey() ?>">
        <?php if(mainLayoutKey() == LAYOUT_LEFT_SIDEBAR) { ?>
            <?php get_sidebar();?>
        <?php } ?>

        <div class="<?= mainLayoutClass() ?>">
            <div class="row">
                <div class="<?= mainLayoutTemplate() ?>">
                    <?php
                        if(function_exists('tie_get_option')
                            && tie_get_option('on_home')
                            && tie_get_option('on_home') == 'boxes' )
                        {
                            $cats = get_option( 'tie_home_cats' );
                            
                            // Dispay home with home builder
                            if($cats) {
                                ?>
                                <h1 style="display:none;"><?php echo get_bloginfo('name')?></h1>
                                <?php
                                foreach ($cats as $cat) { tie_get_home_cats($cat); }
                                ?>
                                <?php
                            }
                        } else {
                            $p = 1;
                            while ( have_posts() ) :
                                the_post();
                                include TEMPLATEPATH  . '/template-parts/pin-layout/content.php';
                                $p++;
                            endwhile;
                        }
                    ?>            
                </div>
            </div>
            <?php
            $home_page_intro = get_theme_mod('home_page_intro');
            if($home_page_intro){
                $p = get_page($home_page_intro);
            ?>
            <div class="home-intro-section">
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="service-name-section"><span><?= $p->post_title ?></span><img class="img-ticker img-ticker-left" alt="" src="<?= get_template_directory_uri() ?>/assets/images/hoa-trai.png"/></h2>
                        <?= $p->post_content ?>
                        <p class="home-intro-readmore">
                            <a href="<?php echo get_link_by_slug('gioi-thieu', $type = 'page'); ?>">Xem thêm </a>
                        </p>
                    </div>
                    <div class="col-lg-4 home-intro-thumb">
                        <?php echo get_the_post_thumbnail( $home_page_intro, 'large', array( 'class' => 'alignright' ) ); ?>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>

            <?php
            $postQuery = new WP_Query(['post_type' => 'custom-video', 'posts_per_page' => 3]);
            if($postQuery->have_posts()):
            ?>
            <div class="home-video-section">
                <div class="row">
                    <?php
                    while ($postQuery->have_posts()):
                        $postQuery->the_post();
                        $postId = get_the_ID();
                        $customMeta = get_post_custom($postId);
                        $youtube_video_link = null;
                        $youtube_video_id = null;
                        if($customMeta && $customMeta['youtube_video_link'] && $customMeta['youtube_video_link'][0])
                            $youtube_video_link = $customMeta['youtube_video_link'][0];
                        if ($youtube_video_link) {
                            $youtube_video_id = get_youtube_id_from_url($youtube_video_link);
                        }
                        ?>
                        <div class="col-lg-4 col-md-4 home-video-item">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $youtube_video_id ?>?feature=oembed&amp;start&amp;end&amp;wmode=opaque&amp;loop=0&amp;controls=1&amp;mute=0&amp;rel=0&amp;modestbranding=0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    ?>
                </div>
            </div>
            <?php endif; ?>

            <?php
            $tie_home_tabs = tie_get_option('home_tabs');
            if($tie_home_tabs){
                echo '<div class="custom-home-tabs-section">';
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<h2 class="service-name-section"><img class="img-ticker img-ticker-left" alt="" src="'.get_template_directory_uri().'/assets/images/hoa-phai.png"/><span>Dịch Vụ</span><img class="img-ticker img-ticker-left" alt="" src="'.get_template_directory_uri().'/assets/images/hoa-trai.png"/></h2>';
                echo '</div>';

                foreach ($tie_home_tabs as $key => $option) {
                    $cat_data = get_category($option);
                    $cat_option = get_option('tie_cat_'.$option);
                    $cat_logo = '';
                    if($cat_option && $cat_option['logo']){
                        $cat_logo = $cat_option['logo'];
                    }
                    $category_link = get_category_link( $option );
                    ?>
                    <div class="col-md-4 service-item-parent">
                        <div class="service-item">
                            <?php
                            if($cat_logo){
                                ?>
                                <div class="item-thumb">
                                    <a href="<?= $category_link ?>">
                                        <img alt="" src="<?= $cat_logo ?>"/>
                                    </a>                                            
                                </div>
                                <?php
                            }
                            ?>
                            <div class="item-content">
                                <h3 class="service-name"><a href="<?= $category_link ?>"><?= $cat_data->name ?></a></h3>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                echo '</div>';
            }
            ?>
            </div>
        </div>

        <!-- Sidebar area: we defined sidebar's 2 area -->
        <?php get_sidebar('second');?>

        <?php if(mainLayoutKey() == LAYOUT_RIGHT_SIDEBAR) { ?>
            <?php get_sidebar();?>
        <?php } ?>
    </div>
</div>

<!-- Footer show here-->
<?php get_footer();?>