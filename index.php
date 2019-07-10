<?php get_header();?>
    <div class="container">
        <!-- Breadcrumb -->
        <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
        <!-- End breadcrumb -->

        <?php
        $layoutClass = 'layout-';
        $isSidebar = false;
        $isSecondSidebar = false;
        $mainClass = 'col-lg-6';
        $layout = get_theme_mod('home_layout');
        $layout = $layout ? $layout : '1c';
        if($layout == '1c'){
            $mainClass = 'col-lg-12';
        }
        $layoutClass .= $layout;
        ?>
      <div class="row <?= $layoutClass?>">
        <div class="<?= $mainClass ?> main-content article-list pinterest-template">
        <?php
            if( tie_get_option('on_home') && tie_get_option('on_home') == 'boxes' ) {
                $cats = get_option( 'tie_home_cats' );
                if($cats) {
                    foreach ($cats as $cat)
                        tie_get_home_cats($cat);
                }    
                else
                    _e( 'You can use Homepage builder to build your homepage' , THEME_NAME );
            }
            else {
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/pin-layout/content', get_post_format() );
                endwhile; // End of the loop.
            }
            ?> 
        </div>
        <?php if($isSecondSidebar) get_sidebar('second');?>
        <?php if($isSidebar) get_sidebar();?>
      </div>
    </div>
<?php get_footer();?>