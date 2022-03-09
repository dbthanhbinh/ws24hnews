<?php
$rg_posttypes = [
	[
		'posttype' => 'custom-video',
		'taxonomy' => [],
		'postname' => 'Video',
		'support' => ['title']
	],
	[
		'posttype' => 'tin-tuc',
		'taxonomy' => [],
		'postname' => __('News', THEMENAME),
		'support' => ['title','excerpt','editor','thumbnail']
	]
];

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
				'name' 					=> __($value['postname'], THEMENAME),
				'singular_name' 		=> __($value['postname'], THEMENAME),
				'add_new' 				=> __("Add new", THEMENAME),
				'add_new_item' 			=> __("Add new ".$value['postname'],THEMENAME),
				'edit_item' 			=> __('Edit'.$value['postname'],THEMENAME),
				'new_item' 				=> __($value['postname'].' new',THEMENAME),
				'all_items' 			=> __('All '.$value['postname'],THEMENAME),
				'view_item'				=> __('View '.$value['postname'],THEMENAME),
				'search_items'			=> __('Search '.$value['postname'],THEMENAME),
				'not_found' 			=> __('Not found '.$value['postname'],THEMENAME),
				'not_found_in_trash' 	=> __('Not found '.$value['postname'],THEMENAME),
				'parent_item_colon' 	=> '',
				'menu_name' 			=> __($value['postname'],THEMENAME)
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
				'menu_icon'				=> get_stylesheet_directory_uri().'/admin/panel/images/add.png',
				'supports' 				=> $value['support']
			);
			register_post_type($value['posttype'],$args);
		}
	}
}

/**
 * Register a private 'Genre' taxonomy for post type 'book'.
 *
 * @see register_post_type() for registering post types.
 */
function wpdocs_register_private_taxonomy() {
    $args = array(
        'label'        => __('News tag', THEMENAME)
    );
     
    register_taxonomy( 'news_tag', 'tin-tuc', $args );
}
// add_action( 'init', 'wpdocs_register_private_taxonomy', 0 );

function my_feed_request($qv) {	
	    if (isset($qv['feed']) && !isset($qv['post_type']))
	        $qv['post_type'] = array('post');
	    return $qv;
	}
add_filter('request', 'my_feed_request');