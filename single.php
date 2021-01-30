<?php get_header();?>
    <!-- Breadcrumb -->
    <?php get_template_part('template-parts/breadcrumb/breadcrumb', '')?>
    <!-- End breadcrumb -->

    <div class="container">
        <?php require_once ('helpers/layout-configs.php'); ?>
        <div class="row <?= mainLayoutKey() ?> ">
            <?php if(mainLayoutKey() == LAYOUT_LEFT_SIDEBAR) { ?>
                <?php get_sidebar();?>
            <?php } ?>

            <div class="<?= mainLayoutClass(true) ?>">
                <div class="row">
                    <div class="col-lg-12 article-content">
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/post/content', 'single' );
                        endwhile;
                        // End of the loop.
                        ?>
                    </div>
                </div>
                <?php  if (has_tag()): ?>
                    <div class="tags-box"> <i class="fa fa-tags" aria-hidden="true"></i>    
                        <?php the_tags(''); ?>
                    </div>
                <?php endif; ?>

                <!-- Socials -->
                <div class="social-button-show">
                    <div class="my-share-box">
                        <i class="fa fa-share-alt-square" aria-hidden="true"></i>
                    </div>
                    <div class="my-g-plus">
                        <div class="g-plus" 
                            data-action="share" 
                            data-href="<?= the_permalink(); ?>">
                        </div>
                    </div>
                    <div class="fb-like" 
                        data-href="<?= the_permalink(); ?>" 
                        data-layout="button_count" 
                        data-action="like" 
                        data-size="small" 
                        data-show-faces="true" data-share="true">
                    </div>
                </div>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    ?>
                    <div class="comments-box">
                        <?php comments_template(); ?>
                    </div>
                    <?php
                endif;
                ?>

                <!-- Related -->
                <?php
                $related_post = tie_get_option('related_post');
                if($related_post) {
                    $archive_display = tie_get_option('related_display');
                    $archive_cols = tie_get_option('related_cols');
                    $argGrid = [
                        'isGrid' => ($archive_display && $archive_display == 'grid') ? true : false,
                        'cols' => $archive_cols ? $archive_cols : 3
                    ];
                    ?>

                    <div class="related-box">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <header class="entry-header">
                                    <h3 class="header-title"><?= getTranslateByKey('other_posts') ?></h3>
                                </header>
                            </div>
                        </div>
                        <div class="<?= mainLayoutTemplate($argGrid['isGrid']) ?>">
                        <?php
                            $orig_post = $post;
                            global $post;
                            $contentFormat = '';
                            if($post->post_type == 'post'){
                                $categories = get_the_category($post->ID);
                                if ($categories) {
                                    $category_ids = array();
                                    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
                                    $args=array(
                                        'category__in' => $category_ids,
                                        'post_type' => $post->post_type,
                                        'post__not_in' => array($post->ID),
                                        'posts_per_page'=> 5 // Number of related posts that will be shown.
                                    );
                                }
                            } else {
                                $contentFormat = '-news';
                                $args=array(
                                    'post__not_in' => array($post->ID),
                                    'post_type' => $post->post_type,
                                    'posts_per_page'=> 5 // Number of related posts that will be shown.
                                );
                            }
                            $my_query = new wp_query( $args );
                            if( $my_query->have_posts() ) {
                                while( $my_query->have_posts() ) {
                                    $my_query->the_post();
                                    $content_type = 'related';
                                    get_template_part('template-parts/post/content'.$contentFormat, get_post_format(), $argGrid);
                                }
                            }

                            $post = $orig_post;
                            wp_reset_query(); 
                        ?>
                        </div>
                    </div>
                <?php } ?>
            </div>      
            
            <!-- Sidebar area: we defined sidebar's 2 area -->
            <?php get_sidebar('second');?>

            <?php if(mainLayoutKey() == LAYOUT_RIGHT_SIDEBAR) { ?>
                <?php get_sidebar();?>
            <?php } ?>

        </div>
    </div>
<?php get_footer();?>