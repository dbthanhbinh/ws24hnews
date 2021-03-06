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
        'posts_per_page'=> 5, // Number of related posts that will be shown.
        'ignore_sticky_posts '=>1
    );
    $my_query = new wp_query( $args );

    if( $my_query->have_posts() ) {
        echo '<h3 class="header-title">'.getTranslateByKey('other_posts').'</h3>';
        while( $my_query->have_posts() ) {
            $my_query->the_post();
            $content_type = 'related';
            include TEMPLATEPATH . '/template-parts/post/content.php';
        }
    }
}
$post = $orig_post;
wp_reset_query(); 
?>