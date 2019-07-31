<?php get_header();?>


<?php 
$tie_slider_enable = tie_get_option('slider');
$tie_slider_pos = tie_get_option('slider_pos');
if($tie_slider_enable && ($tie_slider_pos=='big' || !$tie_slider_pos)):
?>            
<!-- slide show here-->
<div class="clear-line-5"></div>
<?php include TEMPLATEPATH . ('/modules/owl-carousel/slide-show.php')?>

<?php endif;?>



<div class="container">
    <div class="clear-15"></div>
    <?php require_once ('helpers/layout-configs.php'); ?>
    <div class="row <?= mainLayoutKey() ?>">
            
            <?php
                if(function_exists('tie_get_option')
                    && tie_get_option('on_home')
                    && tie_get_option('on_home') == 'boxes' )
                {
                    $cats = get_option( 'tie_home_cats' );
                    // Dispay home with home builder
                    if($cats) {
                        foreach ($cats as $cat){
                            ?>
                            <div class="<?= mainLayoutClass() ?> <?= mainLayoutTemplate() ?>">
                                <h1 style="display:none;"><?php echo get_bloginfo('name')?></h1>
                                <div class="col-lg-12">
                                <div class="row">
                                <?php
                                    tie_get_home_cats($cat);
                                ?>
                                </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else
                        _e( 'You can use Homepage builder to build your homepage' , THEME_NAME );

                } else {
                    ?>
                    <div class="<?= mainLayoutClass() ?> <?= mainLayoutTemplate() ?>">
                    <?php
                    $p = 1;
                    while ( have_posts() ) :
                        the_post();
                        
                        include TEMPLATEPATH  . '/template-parts/pin-layout/content.php';
                        $p++;
                    endwhile;
                    ?>
                    </div>
                    <?php
                }
            ?> 
        <!-- Sidebar area: we defined sidebar's 2 area -->
        <?php get_sidebar('second');?>
        <?php get_sidebar();?>
    </div>
</div>

<?php get_footer();?>