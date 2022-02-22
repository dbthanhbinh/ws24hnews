<?php get_header();?>
<!-- Breadcrumb -->
<?php get_template_part('template-parts/breadcrumb/breadcrumb', '') ?>

<div class="container">
  <?php require_once ('helpers/layout-configs.php'); ?>

  <div class="row <?= $mainLayout ?>">
    <!-- Sidebar left -->
    <?php if ($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

    <div class="<?= mainLayoutClass(true) ?>">
      <div class="article-content">
        <?php
          while (have_posts()) :
            the_post();
            get_template_part( 'template-parts/page/content', 'page' );
          endwhile;
        ?>
      </div>

      <?php
        /**
         * If comments are open and display comment form
         */
        if (ALLOW_POST_COMMENT && comments_open()) :
        ?>
            <div class="comments-box">
                <?php comments_template(); ?>
            </div>
        <?php
        endif;
        ?>

    </div>

    <!-- Sidebar's 2 area -->
    <?php get_sidebar('second');?>

    <!-- Sidebar right -->
    <?php if ($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>

  </div>
</div>
<?php get_footer();?>