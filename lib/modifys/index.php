<?php
/*********** Remove default for not admin***********/
require_once('remove-category-slug.php');

function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    wp_deregister_script('wp-mediaelement');
    wp_deregister_style('wp-mediaelement');
    
    wp_deregister_script('wp-embed');
    wp_deregister_style( 'wp-block-library' );
    wp_deregister_script('jquery');
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action ('wp_head', 'wp_site_icon', 99);
    add_filter( 'show_recent_comments_widget_style', '__return_false', 99 );
}
add_action( 'init', 'disable_emojis' );

/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );