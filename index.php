<?php get_header(); ?>

<?php require_once ('helpers/layout-configs.php'); ?>

<!-- Slideshow -->
<?php include TEMPLATEPATH . ('/modules/owl-carousel/slide-show.php') ?>

<div class="<?= mainLayoutKey() ?>">
    <?php if (mainLayoutKey() == LAYOUT_LEFT_SIDEBAR) { ?>
        <?php get_sidebar(); ?>
    <?php } ?>

    <div class="home-main-content">
        <h1 style="display:none;"><?php echo get_bloginfo('name') ?></h1>
        <?php
            $onHome = tie_get_option('on_home');
            if (function_exists('tie_get_option') && $onHome && $onHome == 'boxes') {
                $cats = get_option('tie_home_cats');
                if ($cats) {
                    $loopSection = 1;
                    foreach ($cats as $cat) {
                        $cat['loop'] = $loopSection;
                        tie_get_home_cats($cat);
                        $loopSection++;
                    }
                }
            } else {
                $p = 1;
                $args = [
                    'isGrid' => true,
                    'cols' => 4,
                    'layout' => 'full'
                ];
                echo '<div class="'.mainLayoutTemplate($args['isGrid']).'">';
                echo '<div class="container">';
                while ( have_posts() ) :
                    the_post();
                    get_template_part('template-parts/post/content', '', $args);

                    $p++;
                endwhile;
                echo '</div>';
                echo '</div>';
            }
        ?>
    </div>

    <!-- Sidebar area: we defined sidebar's 2 area -->
    <?php get_sidebar('second'); ?>
    <?php if(mainLayoutKey() == LAYOUT_RIGHT_SIDEBAR) { ?>
        <?php get_sidebar('second'); ?>
    <?php } ?>
</div>

<!-- Footer here-->
<?php get_footer(); ?>