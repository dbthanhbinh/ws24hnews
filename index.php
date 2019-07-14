<?php get_header();?>

<div class="container">
    <div class="clear-15"></div>
    <?php require_once ('helpers/layout-configs.php'); ?>
    <div class="row <?= mainLayoutKey() ?>">
        <div class="<?= mainLayoutClass() ?> <?= mainLayoutTemplate() ?>">
            <h1 style="display:none;"><?php echo get_bloginfo('name')?></h1>
            <?php
                if(function_exists('tie_get_option')
                    && tie_get_option('on_home')
                    && tie_get_option('on_home') == 'boxes' )
                {
                    $cats = get_option( 'tie_home_cats' );
                    // Dispay home with home builder
                    if($cats) {
                        foreach ($cats as $cat) tie_get_home_cats($cat);
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
        <!-- Sidebar area: we defined sidebar's 2 area -->
        <?php get_sidebar('second');?>
        <?php get_sidebar();?>
    </div>
</div>

<?php get_footer();?>