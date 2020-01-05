<?php 
global $post;
$orig_post = $post;
$postType = $post->post_type;

// 1 - Get related post by category
$categories = get_the_category($post->ID);
$category_ids = array();
if ($categories) {
    foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
    if($category_ids){
        $args=array(
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page'=> 5, // Number of related posts that will be shown.
            'ignore_sticky_posts '=>1
        );
    }
}
if(!$args){
    $args = array (
        'post_type' => $postType,
        'posts_per_page'=> 5
    );
}


if ($args) {
    $my_query = new wp_query( $args );
    if( $my_query->have_posts() ) {
        echo '<h3 class="header-title">Bài viết khác</h3>';
        echo '<div class="row">';
        while( $my_query->have_posts() ) {
            $my_query->the_post();
            $content_type = 'related';
            include TEMPLATEPATH . '/template-parts/post/content.php';
        }
        echo '</div>';
    }
}
$post = $orig_post;
wp_reset_query(); 
?>