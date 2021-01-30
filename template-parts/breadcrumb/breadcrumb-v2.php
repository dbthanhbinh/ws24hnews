<!-- Breadcrumb -->
<?php  if(get_theme_mod('show_breadcrumb')){
    $category = get_queried_object();
    $cat_option = get_option('tie_cat_'.$category->term_id);
    $breadcrumb_banner = get_template_directory_uri().'/assets/images/breadcrumb_bg.jpg';
    if(isset($cat_option) && isset($cat_option['breadcrumb_banner']) && $cat_option['breadcrumb_banner'])
      $breadcrumb_banner = $cat_option['breadcrumb_banner'];
    ?>
    <section class="box-breadcrumb-v2"
      style="background: url('<?= $breadcrumb_banner ?>') 50% -70.2188px / cover no-repeat, 0% rgb(235, 235, 235);">
        <div class="container" style="padding-top: 130px;padding-bottom: 130px;">
            <div class="row">
                <div class="col-lg-7 col-md-7 box-breadcrumb-part">
                    <ul class="breadcrumb">
                        <li><a href="<?= site_url() ?>">Home</a></li>
                        <li><a href="#">
                            <?php 
                            if(is_page() || is_single()){
                                the_title();
                            } else if(is_archive()){
                                the_archive_title();
                            } else if(is_search()){
                                echo 'Tìm: ' . get_query_var('s');
                            }
                            ?>
                        </a></li>
                    </ul>        
                </div>
                <div class="col-lg-5 col-md-5 social-search">
                    <?php get_template_part('template-parts/socials/content', '')?>
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </section>
  <?php }?>
  <!-- End breadcrumb -->