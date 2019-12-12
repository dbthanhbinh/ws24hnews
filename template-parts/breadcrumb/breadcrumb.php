<?php  if(get_theme_mod('show_breadcrumb')){ ?>
<div class="box-breadcrumb">
    <div class="container">
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
</div>
<?php }?>