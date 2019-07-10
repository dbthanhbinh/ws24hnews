<?php get_header();?>
    <div class="container">
        <!-- Breadcrumb -->
        <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
        <!-- End breadcrumb -->
      <div class="row <?= get_main_layout_key () ?>">        
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 article-content">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/post/content', get_post_format() );
                    endwhile; // End of the loop.
                    ?>
                </div>
                <?php //get_sidebar('second');?>
            </div>
            <?php 
            if (has_tag()):
                ?>
                <div class="tags-box">
                    <i class="fa fa-tags" aria-hidden="true"></i>    
                    <?php
                    the_tags();
                    ?>
                </div>
                <?php
            endif;    
            ?>
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

            <!-- Related -->
            <div class="related-box article-list">
                <?php get_template_part( 'template-parts/pin-layout/tpl-related', 'post' );?>
            </div>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                ?>
                <div class="comments-box">
                    <?php
                    comments_template();
                    ?>
                </div>
                <?php
            endif;
            ?>

        </div>        
        <?php get_sidebar();?>
      </div>
    </div>
<?php get_footer();?>