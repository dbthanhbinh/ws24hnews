<?php get_header();?>
<?php require_once ('helpers/layout-configs.php'); ?>

<!-- Breadcrumb -->
<?php get_template_part('template-parts/breadcrumb/breadcrumb', '') ?>

<div class="container">
  <?php require_once ('helpers/layout-configs.php'); ?>

  <div class="row <?= $mainLayout ?>">
    <!-- Sidebar left -->
    <?php if ($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

    <div class="<?= mainLayoutClass() ?>">
      <header class="entry-header">
        <h1  class="entry-title"><?php echo 'Tìm: ' . get_query_var('s'); ?></h1>
      </header>

      <?php
      if (have_posts()) :
          $pos = 1;
          $archiveId = 'archive_search';
          $archive_display = tie_get_option($archiveId.'_display');
          $archive_cols = tie_get_option($archiveId.'_cols');
          $archiveAuthor = tie_get_option($archiveId.'_meta_author');
          $archiveDate = tie_get_option($archiveId.'_meta_date');
          $archiveReadMore = tie_get_option($archiveId.'_meta_readmore');

          $args = [
            'isGrid' => ($archive_display && $archive_display == 'grid') ? true : false,
            'cols' => $archive_cols,
            'layout' => $mainLayout,
            'author' => $archiveAuthor,
            'date' => $archiveDate,
            'readMore' => $archiveReadMore
          ];

          echo '<div class="'.mainLayoutTemplate($args['isGrid']).'">';
            while (have_posts()) :
              the_post();
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
      
    <!-- Sidebar right -->
    <?php if ($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>
    
  </div>
</div>
<?php get_footer();?>