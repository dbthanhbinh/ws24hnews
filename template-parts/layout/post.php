<div class="container">
      <div class="row <?= get_main_layout_key () ?>">
        <?php get_sidebar();?>
        <div class="<?= get_main_layout () ?>">

            <?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/page/content', 'page' );
			endwhile; // End of the loop.
            ?>
            
            <a href="http://localhost/saigonbautyonline/?export=xls&post_type=post&from=111&to=222"> Export </a>

            <?php 
            if (has_tag()):
                ?>
                <div class="tags-box">
                    <?php
                    the_tags();
                    ?>
                </div>
                <?php
            endif;    
            ?>
            <!-- Socials -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                ?>
                <div class="comments-box">
                    <?php
                    comments_template();
                    ?>
                </div>
                <?php
            endif;
            ?>

        </div>
      </div>
    </div>