<?php
function ws24h_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Primary Widget Area', THEMENAME),
		'id'            => 'primary-sidebar',
		'description'   => __( 'Drag widgets here to appear in your sidebar.',THEMENAME),
		'before_widget' => '<div id="%1$s" class="widget sidebar-widgets">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div class="widgets-title"> <h3>',
		'after_title'   => '</div></h3><div class="row"><div class="col-sm-12">',
	) );
	
    
    ## Footer Widgets ------------------------------------------------------------
	$footer_before_widget =  '<div id="%1$s" class="footer-widget %2$s">';
	$footer_after_widget  =  '</div><!-- .widget /-->';
	$footer_before_title  =  '<div class="footer-widget-top"><h4 class="widget-title clearfix"><span>';
	$footer_after_title   =  '</span></h4></div>';
	
    				
	$footer_widgets = tie_get_option( 'footer_widgets' );
	if( $footer_widgets != 'disable' )
    {
	
		register_sidebar( array(
			'name' =>  __( 'First Footer Widget Area', THEMENAME ),
			'id' => 'first-footer-widget-area',
			'description' => __( 'The first footer widget area', THEMENAME ),
			'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
		) );

		if( $footer_widgets == 'footer-2c' || $footer_widgets == 'narrow-wide-2c' || $footer_widgets == 'wide-narrow-2c' || $footer_widgets == 'footer-3c' || $footer_widgets == 'wide-left-3c' || $footer_widgets == 'wide-right-3c' || $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' =>  __( 'Second Footer Widget Area', THEMENAME ),
				'id' => 'second-footer-widget-area',
				'description' => __( 'The Second footer widget area', THEMENAME ),
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
	
		if( $footer_widgets == 'footer-3c' || $footer_widgets == 'wide-left-3c' || $footer_widgets == 'wide-right-3c' || $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' =>  __( 'Third Footer Widget Area', THEMENAME ),
				'id' => 'third-footer-widget-area',
				'description' => __( 'The Third footer widget area', THEMENAME ),
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
		
		if( $footer_widgets == 'footer-4c' ){
			register_sidebar( array(
				'name' => __( 'Fourth Footer Widget Area', THEMENAME ),
				'id' => 'fourth-footer-widget-area',
				'description' => __( 'The Fourth footer widget area', THEMENAME ),
				'before_widget' => $footer_before_widget , 'after_widget' => $footer_after_widget , 'before_title' => $footer_before_title , 'after_title' => $footer_after_title ,
			) );
		}
	}
    
	
	//Custom Sidebars
	$before_widget =  '<div id="%1$s" class="widget %2$s">';
	$after_widget  =  '</div><!-- .widget /-->';
	$before_title  =  '<div class="widget-top"><h3>';
	$after_title   =  '</h3></div>';
	
	$sidebars = tie_get_option('sidebars') ;	
	if($sidebars)
    {
		foreach ($sidebars as $sidebar) 
        {
			register_sidebar( array(
			'name' => $sidebar,
			'id' => sanitize_title($sidebar),
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}
	}	
}
add_action( 'widgets_init', 'ws24h_widgets_init' );

function tcr_tag_cloud_filter($args = array()) {
    $args['smallest'] = 10;
    $args['largest'] = 12;
    $args['unit'] = 'pt';
    return $args;
}
add_filter('widget_tag_cloud_args', 'tcr_tag_cloud_filter', 90);