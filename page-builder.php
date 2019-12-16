<?php /* Template Name: Page builder */ ?>
<?php get_header();?>
    <div class="container">
        <div class="page-builder-content">
        <?php    
            the_post();
            the_content();
        ?>
        </div>
    </div>
<?php get_footer();?>