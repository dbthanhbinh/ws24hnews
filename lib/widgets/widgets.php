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
    
    require_once 'widget-popular.php';
    require_once 'widget-video.php';

add_filter('get_search_form', 'new_search_button');
function new_search_button($text) {
    $text = str_replace('value="Search"', 'value="Tìm"', $text);    
    return $text;
}