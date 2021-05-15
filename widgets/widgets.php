<?php
/*
unregister_widget('WP_Widget_Calendar');
unregister_widget('WP_Widget_Pages');
unregister_widget('WP_Widget_Archives');    
unregister_widget('WP_Widget_Links');
unregister_widget('WP_Widget_Meta');
unregister_widget('WP_Widget_Search');    
//unregister_widget('WP_Widget_Text');
unregister_widget('WP_Widget_Categories');
unregister_widget('WP_Widget_Recent_Posts');    
unregister_widget('WP_Widget_Recent_Comments');
unregister_widget('WP_Widget_RSS');
unregister_widget('WP_Widget_Tag_Cloud');    
unregister_widget('WP_Nav_Menu_Widget');

*/
/**
 * We are register widget area.
 */
function FastSpa_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', THEME_NAME ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', THEME_NAME ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Second Sidebar', THEME_NAME ),
		'id'            => 'sidebar-second',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', THEME_NAME ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', THEME_NAME ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', THEME_NAME ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', THEME_NAME ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', THEME_NAME ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', THEME_NAME ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', THEME_NAME ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', THEME_NAME ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', THEME_NAME ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );
}
add_action( 'widgets_init', 'FastSpa_widgets_init' );

//  We are include widgets here
require_once 'widget-popular.php';
require_once 'widget-video.php';
require_once 'widget-fanpage.php';
require_once 'widget-socials-button.php';
require_once 'widget-contact.php';

add_filter('get_search_form', 'new_search_button');
function new_search_button($text) {
    $text = str_replace('value="Search"', 'value="Tìm"', $text);    
    return $text;
}