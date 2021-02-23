<?php get_header();?>

<!-- Slide show here-->
<?php include TEMPLATEPATH . ('/modules/owl-carousel/slide-show.php')?>

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
                            // foreach ($cats as $cat) { tie_get_home_cats($cat); }
                        ?>
                        <?php
                    }
                } else {
                    $p = 1;
                    $args = [
                        'isGrid' => true,
                        'cols' => 4,
                        'layout' => 'full'
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