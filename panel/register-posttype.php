<?php
$rg_posttypes = array(
		array('posttype' => 'custom-video','taxonomy' => array(),'postname'=> "Video",'support' => array('title')),
		array('posttype' => 'tin-tuc','taxonomy' => array(),'postname'=> "Tin tức",'support' => array('title','excerpt','editor','thumbnail'))
);

$db_list_posttypes_rg = array();
if(!empty($rg_posttypes))
{
	foreach ($rg_posttypes as $value) 
	{
		$db_list_posttypes_rg[] = $value['posttype'];
	}
}	

// Register posttype
add_action( 'init', 'register_custom_posttype' );
function register_custom_posttype()
{
	global $rg_posttypes;
	if(!empty($rg_posttypes))
	{	
		foreach ($rg_posttypes as $key => $value)
		{
			$labels = array(
					'name' 					=> __($value['postname'], THEME_NAME),
					'singular_name' 		=> __($value['postname'], THEME_NAME),
					'add_new' 				=> __("Add new", THEME_NAME),
					'add_new_item' 			=> __("Add new ".$value['postname'],THEME_NAME),
					'edit_item' 			=> __('Edit'.$value['postname'],THEME_NAME),
					'new_item' 				=> __($value['postname'].' new',THEME_NAME),
					'all_items' 			=> __('All '.$value['postname'],THEME_NAME),
					'view_item'				=> __('View '.$value['postname'],THEME_NAME),
					'search_items'			=> __('Search '.$value['postname'],THEME_NAME),
					'not_found' 			=> __('Not found '.$value['postname'],THEME_NAME),
					'not_found_in_trash' 	=> __('Not found '.$value['postname'],THEME_NAME),
					'parent_item_colon' 	=> '',
					'menu_name' 			=> __($value['postname'],THEME_NAME)
		
			);
			$args = array(
					'labels' 				=> $labels,
					'public' 				=> true,
					'publicly_queryable' 	=> true,
					'show_ui' 				=> true,
					'show_in_menu' 			=> true,
					'query_var' 			=> true,
					'rewrite' 				=> true,
					'capability_type' 		=> 'post',
					'has_archive' 			=> true,
					'hierarchical' 			=> false,
					'taxonomies'			 => $value['taxonomy'],
					'menu_icon'				=> get_stylesheet_directory_uri().'/panel/images/add.png',
					'supports' 				=> $value['support']
			);
			register_post_type($value['posttype'],$args);
		}
	}
}



function my_feed_request($qv) {	
	    if (isset($qv['feed']) && !isset($qv['post_type']))
	        $qv['post_type'] = array('post');
	    return $qv;
	}
add_filter('request', 'my_feed_request');