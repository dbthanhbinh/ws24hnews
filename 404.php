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
        <h1  class="entry-title"><?php single_cat_title(); ?></h1>
      </header>
      
      <?php
        echo '<div class="'.getDefaultFullLayout().'">';
        get_template_part( 'template-parts/post/content', 'none' );
      echo '</div>';
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