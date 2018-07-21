<?php get_header();?>
    <div class="container">
      <div class="row wide-2cols">
        <div class="col-lg-6 main-content article-list">
            <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/post/content', get_post_format() );
                endwhile; // End of the loop.
            ?>    
        </div>
        <?php get_sidebar('second');?>
        <?php get_sidebar();?>
      </div>
    </div>
<?php get_footer();?>