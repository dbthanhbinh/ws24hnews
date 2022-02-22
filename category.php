<?php get_header();?>
<?php require_once ('helpers/layout-configs.php'); ?>

<!-- Breadcrumb -->
<?php  if (get_theme_mod('show_breadcrumb', IS_SHOW_BREADCRUMB)) {
  $category = get_queried_object();
  $catOption = get_option('tie_cat_'.$category->term_id);
  $breadcrumbBanner = get_template_directory_uri().'/assets/images/breadcrumb_bg.jpg';  // Is default banner
  if (isset($catOption) && isset($catOption['breadcrumbBanner']) && $catOption['breadcrumbBanner'])
    $breadcrumbBanner = $catOption['breadcrumbBanner'];
  ?>
  <section class="box-breadcrumb-v2"
    style="background: url('<?= $breadcrumbBanner ?>') 50% -70.2188px / cover no-repeat, 0% rgb(235, 235, 235);">
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
<?php }?>

<div class="container">
  <div class="row <?= $mainLayout ?>">
    <!-- Sidebar left -->
    <?php if($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

    <div class="<?= mainLayoutClass() ?>">        
      <?php
        $archiveId = 'archive_category';
        if ( have_posts() ) :
            $pos = 1;
            $args = getLayoutArgs($archiveId);
            
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