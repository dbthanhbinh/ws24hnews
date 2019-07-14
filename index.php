<?php get_header();?>

<div class="container">
    <div class="clear-15"></div>
    <?php require_once ('helpers/layout-configs.php'); ?>
    <div class="row <?= mainLayoutKey() ?>">
        <div class="<?= mainLayoutClass() ?> <?= mainLayoutTemplate() ?>">
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
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/pin-layout/content', get_post_format() );
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