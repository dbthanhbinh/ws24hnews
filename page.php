<?php get_header();?>
    <div class="container">
      <!-- Breadcrumb -->
      <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
      <!-- End breadcrumb -->

      <?php require_once ('helpers/layout-configs.php'); ?>
      <div class="row <?= mainLayoutKey() ?>">        
        <div class="<?= mainLayoutClass() ?> article-content">
            <?php
              /* Start the Loop */
              while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/page/content', 'page' );
              endwhile;
              // End of the loop.
            ?>
        </div>
        <?php get_sidebar('second');?>
        <?php get_sidebar();?>
      </div>
    </div>
<?php get_footer();?>