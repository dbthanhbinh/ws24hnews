<?php get_header();?>
  <!-- Breadcrumb -->
  <?php get_template_part('template-parts/breadcrumb/breadcrumb', '') ?>
  <!-- End breadcrumb -->
  
  <div class="container-fluid">
    <?php require_once ('helpers/layout-configs.php'); ?>
    <div class="row <?= mainLayoutKey() ?>">
      <?php if(mainLayoutKey() == LAYOUT_LEFT_SIDEBAR) { ?>
            <?php get_sidebar();?>
      <?php } ?>

      <div class="<?= mainLayoutClass() ?>">
        <header class="entry-header">
          <h1  class="entry-title"><?php the_archive_title(); ?></h1>
        </header>
        <div class="row">
        <?php
          $customClass = 'article-list';
          if ( have_posts() ) :
            echo '<div class="'.mainLayoutTemplate($customClass).'">';
              /* Start the Loop */
              $pos = 1;
              while ( have_posts() ) : the_post();
                //get_template_part('template-parts/post/content', get_post_format() );
                include TEMPLATEPATH . '/template-parts/post/content.php';
                $pos++;
              endwhile;
            echo '</div>';
          else :
            echo '<div class="col-lg-12">';
              get_template_part( 'template-parts/post/content', 'none' );
            echo '</div>';
          endif;
        ?>
        </div>
        <!-- For Nav -->
        <?php require_once('helpers/pagination.php'); ?>
      </div>

      <!-- Sidebar area: we defined sidebar's 2 area -->
      <?php get_sidebar('second');?>

      <?php if(mainLayoutKey() == LAYOUT_RIGHT_SIDEBAR) { ?>
          <?php get_sidebar();?>
      <?php } ?>
      
    </div>
  </div>
<?php get_footer();?>