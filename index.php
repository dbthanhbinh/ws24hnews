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
            <?php
                if(function_exists('tie_get_option')
                    && tie_get_option('on_home')
                    && tie_get_option('on_home') == 'boxes' )
                {
                    $cats = get_option( 'tie_home_cats' );
                    if($cats){
                        ?>
                        <h1 style="display:none;"><?php echo get_bloginfo('name')?></h1>
                        <?php
                            foreach ($cats as $cat) { tie_get_home_cats($cat); }
                        ?>
                        <?php
                    }
                } else {
                    $p = 1;
                    $args = [
                        'isGrid' => true,
                        'cols' => 4
                    ];
                    echo '<div class="'.mainLayoutTemplate($args['isGrid']).'">';
                    while ( have_posts() ) :
                        the_post();
                        get_template_part('template-parts/post/content', '', $args);
                        $p++;
                    endwhile;
                    echo '</div>';
                }
            ?>
            <?php
            // Home tabs
            // require('modules/homepage/home_tab.php');
            ?>
        </div>
        <!-- Sidebar area: we defined sidebar's 2 area -->
        <?php get_sidebar('second');?>
        <?php if(mainLayoutKey() == LAYOUT_RIGHT_SIDEBAR) { ?>
            <?php get_sidebar('second');?>
        <?php } ?>

    </div>
</div>
<!-- End Main content show here-->

<!-- Footer show here-->
<?php get_footer();?>