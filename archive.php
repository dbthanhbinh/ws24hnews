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
      $isPinLayout = true;
      
      ?>
      <div class="row <?= $layoutClass ?>">        
        <div class="<?= $mainClass ?> article-list">
          <div class="row">
            <div class="col-lg-12 <?php if($isPinLayout) echo 'pinterest-template' ?>">            
              <?php
                if ( have_posts() ) :
                  /* Start the Loop */
                  $pos = 1;
                  if($isPinLayout){
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
                else :
                  get_template_part( 'template-parts/post/content', 'none' );
                endif;
              ?>
            </div>
            <?php
            echo '<div class="clear-15"></div>';
            the_posts_pagination( array(
              'before'      => '<div class="page-links">' . __( 'Pages:', THEME_NAME ),
              'after'       => '</div>',
              'link_before' => '<span class="page-number">',
              'link_after'  => '</span>',
              'prev_text'          => __('Trước'),
              'next_text'          => __( 'Sau' ),
            ) );
            ?>
          </div>
        </div>        
        <?php if($isSecondSidebar) get_sidebar('second');?>
        <?php if($isSidebar) get_sidebar();?>
      </div>
    </div>
<?php get_footer();?>