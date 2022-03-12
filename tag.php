<?php get_header();?>

<?php require_once ('helpers/layout-configs.php'); ?>

<!-- Breadcrumb -->
<?php get_template_part('template-parts/breadcrumb/breadcrumb', '') ?>

<div class="container">
  <div class="row <?= $mainLayout ?>">
    <!-- Sidebar left -->
    <?php if ($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

    <div class="<?= mainLayoutClass() ?>">
      <header class="entry-page-header entry-header">
        <h1  class="entry-title"><?= get_the_archive_title(); ?></h1>
      </header>
      
      <?php
        $tag = get_queried_object();
        $archivePosttype = get_query_var('post_type');
        $relatedPostsPerPage = RELATED_POSTS_PER_PAGE;
        $archiveId = 'archive_tag';
        $args=array(
          'post_type' => 'tin-tuc',
          'tag_slug__in' => $tag->slug,
          'posts_per_page'=> $relatedPostsPerPage // Number of related posts that will be shown.
        );
        $querys = new wp_query( $args );

        if ($querys->have_posts()) :
            $pos = 1;
            
            if(isset($archivePosttype) && $archivePosttype)
              $archiveId = 'archive_'.get_query_var('post_type');

            $args = getLayoutArgs($archiveId);
            echo '<div class="'.mainLayoutTemplate($args['isGrid']).'"><div class="row">';
              while ($querys->have_posts() ) :
                $querys->the_post();
                get_template_part('template-parts/post/content', get_post_format(), $args);
                $pos++;
              endwhile;
            echo '</div></div>';
        else :
          echo '<div class="'.getDefaultFullLayout().'">';
            get_template_part( 'template-parts/post/content', 'none' );
          echo '</div>';
        endif;
      ?>

      <!-- For Nav -->
      <?php require_once('helpers/pagination.php'); ?>
    </div>

    <!-- Sidebar's 2 area -->
    <?php get_sidebar('second');?>

    <!-- Sidebar right -->
    <?php if ($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>
    
  </div>
</div>
<?php get_footer();?>