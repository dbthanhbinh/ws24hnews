<?php get_header();?>
  <!-- Breadcrumb -->
  <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
  <!-- End breadcrumb -->

  <div class="container">
    <?php require_once ('helpers/layout-configs.php'); ?>
    <div class="row <?= mainLayoutKey() ?>">       
      <div class="<?= mainLayoutClass() ?>">
          <h1 class="entry-title"><?php echo 'Tìm: ' . get_query_var('s'); ?></h1>
          <div class="row">
            <?php
              if ( have_posts() ) :
                echo '<div class="'. mainLayoutTemplate() .'">';
                /* Start the Loop */
                $pos = 1;
                if(isPinLayout()){
                  while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/pin-layout/content', get_post_format()); 
                  
                    $pos++;
                  endwhile;
                } else {
                  while ( have_posts() ) : the_post();
                    if ($pos === 1)
                      get_template_part( 'template-parts/post/content', 'big');
                    else  
                      get_template_part( 'template-parts/post/content', get_post_format() );                      
                  
                    $pos++;
                  endwhile;
                }
                echo '</div>';
              else :
                echo '<div class="col-lg-12">';
                get_template_part( 'template-parts/post/content', 'none' );
                echo '</div>';
              endif;
            ?>
          </div>

          <!-- For Page Nav -->
          <?php require_once('helpers/pagination.php'); ?>
        </div>        
        <?php get_sidebar('second');?>
        <?php get_sidebar();?>
      </div>
    </div>
  </div>
<?php get_footer();?>