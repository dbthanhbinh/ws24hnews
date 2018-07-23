<?php if (is_archive() || is_search()) :?>
<div class="row box-breadcrumb">
    <div class="col-lg-7 col-md-7">
        <ul class="breadcrumb">
            <li><a href="<?= site_url() ?>">Home</a></li>
            <li><a href="#"><?= get_the_archive_title()?></a></li>
        </ul>        
    </div>
    <div class="col-lg-5 col-md-5 social-search">
        <?php get_template_part('template-parts/socials/content', '')?>

        <?php get_search_form(); ?>
    </div>    
</div>
<?php else:?>
<div class="clear-15"></div>
<?php endif; ?>