<?php 
function hide_admin_bar_from_front_end(){
  if (is_blog_admin()) 
  {
    return true;
  }
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	// remove junk from head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator'); //removes WP Version # for security
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
}
add_action('init', 'removeHeadLinks');

// main default sidebar widgets
// Remove sidebar widgets
add_action( 'widgets_init', 'crm_remove_widgets', 1 );
function crm_remove_widgets(){
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	//unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Categories');
	//unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	//unregister_widget('WP_Widget_Tag_Cloud');
}

?>