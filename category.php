<?php get_header();?>
<?php require_once ('helpers/layout-configs.php'); ?>


<?php
$category = get_queried_object();
$catOption = get_option('tie_cat_'.$category->term_id);

if (get_theme_mod('show_breadcrumb', IS_SHOW_BREADCRUMB)) {
  if (isset($catOption['use_this_breadcrumb_banner']) && $catOption['use_this_breadcrumb_banner']) {
    $breadcrumbBanner = get_template_directory_uri().'/assets/images/breadcrumb_bg.jpg';  // Is default banner
    if (isset($catOption) && isset($catOption['breadcrumb_banner']) && $catOption['breadcrumb_banner'])
      $breadcrumbBanner = $catOption['breadcrumb_banner'];
      ?>
      <section class="box-breadcrumb-v2"
        style="background: url('<?= $breadcrumbBanner ?>') 50% -70.2188px / auto no-repeat, 0% rgb(235, 235, 235);">
          <div class="container" style="padding-top: 50px;padding-bottom: 50px;">
              <div class="row">
                  <div class="<?=  getOneColumnContentLayout() ?>">
                      <div class="fw-heading fw-content-align-center">
                          <h1 class="fw-special-title">
                          <?php 
                              if (is_page() || is_single()) {
                                  the_title();
                              } else if (is_archive()) {
                                  the_archive_title();
                              } else if (is_search()) {
                                  echo 'Tìm: ' . get_query_var('s');
                              }
                          ?>
                          </h1>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <?php
  }
  else {
    get_template_part('template-parts/breadcrumb/breadcrumb', '');
  }
}
?>

<div class="container">
  <div class="row <?= $mainLayout ?>">
    <!-- Sidebar left -->
    <?php if($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

    <div class="<?= mainLayoutClass() ?>">
      <?php if (!isset($catOption['use_this_breadcrumb_banner']) || !$catOption['use_this_breadcrumb_banner']) {?>
        <header class="entry-page-header entry-header">
          <h1  class="entry-title"><?= get_the_archive_title(); ?></h1>
        </header>
      <?php }?>
      <?php
        $archiveId = 'archive_category';
        if ( have_posts() ) :
            $pos = 1;
            $args = getLayoutArgs($archiveId);
            
            echo '<div class="'.mainLayoutTemplate($args['isGrid']).'"><div class="row">';
              while ( have_posts() ) : the_post();
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

      <!-- For Navigation -->
      <?php require_once('helpers/pagination.php'); ?>
    </div>

    <!-- Sidebar's 2 area -->
    <?php get_sidebar('second');?>

    <!-- Sidebar right -->
    <?php if($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>
    
  </div>
</div>
<?php get_footer();?>