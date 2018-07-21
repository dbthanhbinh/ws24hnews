<?php get_header();?>
    <div class="container">
      <div class="row <?= get_main_layout_key () ?>">        
        <div class="col-lg-8">
            <?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/page/content', 'page' );
			endwhile; // End of the loop.
            ?>
            
            <a href="http://localhost/saigonbautyonline/?export=xls&post_type=post&from=111&to=222"> Export </a>
        </div>
        <?php get_sidebar();?>
      </div>
    </div>
<?php get_footer();?>