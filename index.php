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
                            else
                                _e( 'You can use Homepage builder to build your homepage' , THEME_NAME );

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