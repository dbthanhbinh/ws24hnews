<?php get_header(); ?>

<?php
    /**
     * Breadcrumb
     */
    get_template_part('template-parts/breadcrumb/breadcrumb', '');

    /**
     * Layout config
     */
    require_once ('helpers/layout-configs.php');
?>

<div class="container">
    <div class="row <?= $mainLayout ?>">
        <?php
            /**
             * Sidebar left
             */
            if ($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); }
        ?>

        <div class="<?= mainLayoutClass(true) ?>">
            <div class="row">
                <div class="<?= getSingleArticleContentLayout(); ?>">
                    <?php
                        /**
                         * Content of article
                         */
                        if(have_posts()):
                            the_post();
                            get_template_part('template-parts/post/content', 'single');
                        endif;
                    ?>
                </div>
            </div>

            <?php 
            /**
             * Tags area
             */
            if (has_tag()): ?>
                <div class="tags-box">
                    <i class="fa fa-tags" aria-hidden="true"></i>    
                    <?php the_tags(''); ?>
                </div>
            <?php endif; ?>

            <?php
            /**
             * Socials
             */
            ?>
            <div class="social-button-show">
                <div class="my-share-box">
                    <i class="fa fa-share-alt-square" aria-hidden="true"></i>
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
            /**
             * If comments are open and display comment form
             */
            if (ALLOW_POST_COMMENT && comments_open()) :
            ?>
                <div class="comments-box">
                    <?php comments_template(); ?>
                </div>
            <?php
            endif;
            ?>

            <?php
            /**
             * Related post
             */
            global $post;
            $isRelatedPost = IS_RELATED_POST;
            $archiveDisplay = RELATED_DISPLAY_AS;
            $archiveCols = RELATED_DISPLAY_COLS;
            $relatedPostsPerPage = RELATED_POSTS_PER_PAGE;
            $relatedId = 'related_'.$post->post_type;
            $related_post = tie_get_option($relatedId);
            
            $relatedDisplay = tie_get_option($relatedId.'_display');
            if(isset($relatedDisplay) && $relatedDisplay) {
                $isRelatedPost = (isset($related_post) && $related_post) ? $related_post : false;
            }

            if ($isRelatedPost) {
                if (isset($relatedDisplay)) {
                    $archiveDisplay = $relatedDisplay;
                }

                $relatedCols = tie_get_option($relatedId.'_cols');
                if (isset($relatedCols)) {
                    $archiveCols = $relatedCols;
                }
                
                $relatedNumber = tie_get_option($relatedId.'_number');
                if (isset($relatedNumber)) {
                    $relatedPostsPerPage = $relatedNumber;
                }

                $argGrid = [
                    'isGrid' => $archiveDisplay == 'grid' ? true : false,
                    'cols' => $archiveCols
                ];
                ?>

                <div class="related-box">
                    <div class="row">
                        <div class="<?= getColsLayout(true, 1); ?>">
                            <header class="entry-header">
                                <h5 class="header-title"><span><?= getTranslateByKey('other_posts') ?></span></h5>
                            </header>
                        </div>
                    </div>

                    <div class="<?= mainLayoutTemplate($argGrid['isGrid']) ?>">
                    <?php
                        $orig_post = $post;
                        $contentFormat = '';
                        if ($post->post_type == 'post') {
                            $categories = get_the_category($post->ID);
                            if ($categories) {
                                $category_ids = array();
                                foreach ($categories as $individual_category)
                                    $category_ids[] = $individual_category->term_id;

                                $args = array(
                                    'category__in' => $category_ids,
                                    'post_type' => $post->post_type,
                                    'post__not_in' => array($post->ID),
                                    'posts_per_page'=> $relatedPostsPerPage // Number of related posts that will be shown.
                                );
                            }
                        } else {
                            $contentFormat = '-news';
                            $args=array(
                                'post__not_in' => array($post->ID),
                                'post_type' => $post->post_type,
                                'posts_per_page'=> $relatedPostsPerPage // Number of related posts that will be shown.
                            );
                        }
                        $my_query = new wp_query( $args );
                        if ($my_query->have_posts()) {
                            while ($my_query->have_posts()) {
                                $my_query->the_post();
                                $content_type = 'related';
                                $argGrid['content_type'] = $content_type;
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
        
        <!-- Sidebar area -->
        <?php get_sidebar('second');?>

        <!-- Sidebar right -->
        <?php if ($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>

    </div>
</div>
<?php get_footer();?>