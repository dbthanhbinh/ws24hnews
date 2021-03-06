<?php get_header();?>
  <?php require_once ('helpers/layout-configs.php'); ?>

  <!-- Breadcrumb -->
  <?php  if(get_theme_mod('show_breadcrumb', IS_SHOW_BREADCRUMB)){
    $category = get_queried_object();
    $cat_option = get_option('tie_cat_'.$category->term_id);
    $breadcrumb_banner = get_template_directory_uri().'/assets/images/breadcrumb_bg.jpg';
    if(isset($cat_option) && isset($cat_option['breadcrumb_banner']) && $cat_option['breadcrumb_banner'])
      $breadcrumb_banner = $cat_option['breadcrumb_banner'];
    ?>
    <section class="box-breadcrumb-v2"
      style="background: url('<?= $breadcrumb_banner ?>') 50% -70.2188px / cover no-repeat, 0% rgb(235, 235, 235);">
        <div class="container" style="padding-top: 50px;padding-bottom: 50px;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="fw-heading fw-content-align-center">
                        <h1 class="fw-special-title">
                        <?php 
                            if(is_page() || is_single()){
                                the_title();
                            } else if(is_archive()){
                                the_archive_title();
                            } else if(is_search()){
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
  <!-- End breadcrumb -->
  
  <div class="container">
    <div class="row <?= $mainLayout ?>">
      <!-- Sidebar left -->
      <?php if($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

      <div class="<?= mainLayoutClass() ?>">        
        <?php
          if ( have_posts() ) :
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

        <!-- For Navigation -->
        <?php require_once('helpers/pagination.php'); ?>
      </div>

      <!-- We defined sidebar's 2 area -->
      <?php get_sidebar('second');?>

      <!-- Sidebar right -->
      <?php if($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>
      
    </div>
  </div>
<?php get_footer();?>