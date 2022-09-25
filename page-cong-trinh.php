<?php get_header();?>

<?php require_once ('helpers/layout-configs.php'); ?>

<!-- Breadcrumb -->
<?php get_template_part('template-parts/breadcrumb/breadcrumb', '') ?>

<div class="container">
  <div class="row pages <?= $mainLayout ?>">
    <!-- Sidebar left -->
    <?php if ($mainLayout == LAYOUT_LEFT_SIDEBAR) { get_sidebar(); } ?>

    <div class="<?= mainLayoutClass() ?>">
      <header class="entry-page-header entry-header">
        <h1  class="entry-title"><?= the_title(); ?></h1>
      </header>
      
      <?php
        $archiveId = 'archive_category';

        $postQuery = new WP_Query(['post_type' => 'post', 'posts_per_page' => 12]);
        if ($postQuery->have_posts()) :
            $pos = 1;
            $args = getLayoutArgs($archiveId);
            echo '<div class="'.mainLayoutTemplate($args['isGrid']).'"><div class="row">';
              while ( $postQuery->have_posts() ) :
                $postQuery->the_post();
                get_template_part('template-parts/post/content', get_post_format(), $args);
                $pos++;
              endwhile;
            echo '</div></div>';
        else :
          echo '<div class="'.getDefaultFullLayout().'">';
            get_template_part( 'template-parts/post/content', 'none' );
          echo '</div>';
        endif;
      ?>
      <?php wp_reset_postdata(); ?>

        <!-- For pagination -->
        <nav class="navigation pagination">
            <div class="nav-links">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $postQuery->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                    'format'       => '?paged=%#%',
                    'show_all'     => false,
                    'type'         => 'plain',
                    'end_size'     => 2,
                    'mid_size'     => 1,
                    'prev_next'    => true,
                    'prev_text'    => sprintf( '<i></i> %1$s', __( 'Trước', THEMENAME ) ),
                    'next_text'    => sprintf( '%1$s <i></i>', __( 'Sau', THEMENAME ) ),
                    'add_args'     => false,
                    'add_fragment' => '',
                ) );
            ?>
            </div>
        </nav>


    </div>

    <!-- Sidebar's 2 area -->
    <?php get_sidebar('second');?>

    <!-- Sidebar right -->
    <?php if ($mainLayout == LAYOUT_RIGHT_SIDEBAR) { get_sidebar(); } ?>
    
  </div>
</div>
<?php get_footer();?>