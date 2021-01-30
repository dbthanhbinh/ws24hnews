<?php get_header();?>
  <!-- Breadcrumb -->
  <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
  <!-- End breadcrumb -->

  <div class="container">
    <?php require_once ('helpers/layout-configs.php'); ?>
    <div class="row <?= mainLayoutKey() ?>">
        <?php if(mainLayoutKey() == LAYOUT_LEFT_SIDEBAR) { ?>
            <?php get_sidebar();?>
        <?php } ?>

        <div class="<?= mainLayoutClass() ?>">
          <header class="entry-header">
            <h1  class="entry-title"><?php echo 'Tìm: ' . get_query_var('s'); ?></h1>
          </header>

          <?php
          if ( have_posts() ) :
              /* Start the Loop */
              $pos = 1;
              $archive_display = tie_get_option('archive_display');
              $archive_cols = tie_get_option('archive_cols');
              $args = [
                'isGrid' => ($archive_display && $archive_display == 'grid') ? true : false,
                'cols' => $archive_cols ? $archive_cols : 3
              ];
              echo '<div class="'.mainLayoutTemplate($args['isGrid']).'">';
                while ( have_posts() ) : the_post();
                    get_template_part('template-parts/post/content', get_post_format(), $args);
                  $pos++;
                endwhile;
              echo '</div>';
          else :
            echo '<div class="col-lg-12">';
              get_template_part( 'template-parts/post/content', 'none' );
            echo '</div>';
          endif;
         ?>

          <!-- For Page Nav -->
          <?php require_once('helpers/pagination.php'); ?>
        </div>
        
        <?php get_sidebar('second');?>
        <?php if(mainLayoutKey() == LAYOUT_RIGHT_SIDEBAR) { ?>
          <?php get_sidebar();?>
        <?php } ?>
      </div>
    </div>
  </div>
<?php get_footer();?>