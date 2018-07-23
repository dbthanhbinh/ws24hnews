<?php /* Template Name: Page builder */ ?>
<?php get_header();?>
    <div class="container">
        <?php    
            the_post();
            the_content();
        ?>
    </div>
<?php get_footer();?>