<?php get_header();?>
    <!-- Breadcrumb -->
    <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
    <!-- End breadcrumb -->

    <div class="container">
        <?php require_once ('helpers/layout-configs.php'); ?>
        <div class="row <?= mainLayoutKey() ?> ">
            <?php if(mainLayoutKey() == LAYOUT_LEFT_SIDEBAR) { ?>
                <?php get_sidebar();?>
            <?php } ?>

            <div class="<?= mainLayoutClass() ?>">
                <div class="row">
                    <div class="col-lg-12 article-content">
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/post/content', 'single' );
                        endwhile;
                        // End of the loop.
                        ?>
                    </div>
                </div>
                <?php  if (has_tag()): ?>
                    <div class="tags-box"> <i class="fa fa-tags" aria-hidden="true"></i>    
                        <?php the_tags(); ?>
                    </div>
                <?php endif; ?>

                <!-- Socials -->
                <div class="social-button-show">
                    <div class="my-share-box">
                        <i class="fa fa-share-alt-square" aria-hidden="true"></i>
                    </div>
                    <div class="my-g-plus">
                        <div class="g-plus" 
                            data-action="share" 
                            data-href="<?= the_permalink(); ?>">
                        </div>
                    </div>
                    <div class="fb-like" 
                        data-href="<?= the_permalink(); ?>" 
                        data-layout="button_count" 
                        data-action="like" 
                        data-size="small" 
                        data-show-faces="true" data-share="true">
                    </div>
                </div>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    ?>
                    <div class="comments-box">
                        <?php comments_template(); ?>
                    </div>
                    <?php
                endif;
                ?>

                <!-- Related -->
                <div class="row">
                    <div class="related-box article-list col-lg-12">
                        <?php get_template_part( 'template-parts/post/content-related', 'post' );?>
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
<?php get_footer();?>