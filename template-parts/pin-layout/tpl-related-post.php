<?php 
$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
    $category_ids = array();
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

    $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=> 6, // Number of related posts that will be shown.
        'ignore_sticky_posts '=>1
    );
    $my_query = new wp_query( $args );
    
    if( $my_query->have_posts() ) {
        echo '<h3 class="header-title"><span>Xem bài khác</span></h3>';
        echo '<div class="row">';
        echo '<div class="pinterest-template pinterest-template-related">';
        while( $my_query->have_posts() ) {
            $my_query->the_post();
            $content_type = 'related';
            include TEMPLATEPATH . '/template-parts/pin-layout/content.php';
        }
        echo '</div>';
        echo '</div>';
    }
}
$post = $orig_post;
wp_reset_query(); 
?>