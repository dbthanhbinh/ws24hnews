<?php get_header();?>

  <?php require_once ('helpers/layout-configs.php'); ?>

  <!-- Breadcrumb -->
  <?php get_template_part('template-parts/breadcrumb/breadcrumb', '') ?>
  <!-- End breadcrumb -->
  
  <div class="container">
    <div class="row <?= $mainLayout ?>">

      <!-- Sidebar left -->
      <?php if($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

      <div class="<?= mainLayoutClass() ?>">
        <header class="entry-page-header entry-header">
          <h1  class="entry-title"><?php single_cat_title(); ?></h1>
        </header>
        
        <?php
          if (have_posts()) :
              $pos = 1;
              $archive_display = tie_get_option('archive_display');
              $archive_cols = tie_get_option('archive_cols');

              $args = [
                'isGrid' => ($archive_display && $archive_display == DISPLAY_AS_GRID) ? true : false,
                'cols' => $archive_cols,
                'layout' => $mainLayout
              ];
              echo '<div class="'.mainLayoutTemplate($args['isGrid']).'">';
                while ( have_posts() ) : the_post();
                    get_template_part('template-parts/post/content', get_post_format(), $args);
                  $pos++;
                endwhile;
              echo '</div>';
          else :
            echo '<div class="'.getDefaultFullLayout().'">';
              get_template_part( 'template-parts/post/content', 'none' );
            echo '</div>';
          endif;
        ?>

        <!-- For Nav -->
        <?php require_once('helpers/pagination.php'); ?>
      </div>

      <!-- We defined sidebar's 2 area -->
      <?php get_sidebar('second');?>

      <!-- Sidebar right -->
      <?php if($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>
      
    </div>
  </div>

<?php get_footer();?>