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
        <div class="article-content">
          <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/page/content', 'page' );
            endwhile;
            // End of the loop.
          ?>
        </div>
      </div>

      <!-- Sidebar area: we defined sidebar's 2 area -->
      <?php get_sidebar('second');?>

      <?php if(mainLayoutKey() == LAYOUT_RIGHT_SIDEBAR) { ?>
          <?php get_sidebar();?>
      <?php } ?>

    </div>
  </div>
<?php get_footer();?>