<?php get_header();?>
    <div class="container">
    
    <!-- Breadcrumb -->
    <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
    <!-- End breadcrumb -->

      <div class="row <?= get_main_layout_key () ?>">        
        <div class="<?= get_main_layout () ?> article-list">
          <div class="row">
            <div class="col-lg-12">
            
              <?php
                if ( have_posts() ) :
                  /* Start the Loop */
                  $pos = 1;
                  while ( have_posts() ) : the_post();
                    if ($pos === 1)
                      get_template_part( 'template-parts/post/content', 'big');
                    else  
                      get_template_part( 'template-parts/post/content', get_post_format() );
                      
                  $pos++;
                  endwhile;                      
                else :
                  get_template_part( 'template-parts/post/content', 'none' );
                endif;
              ?>
            </div>  
          </div>
        </div>        
        <?php get_sidebar('second');?>
        <?php get_sidebar();?>
      </div>
    </div>
<?php get_footer();?>