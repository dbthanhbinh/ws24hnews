<?php
// include (TEMPLATEPATH . '/panel/register-posttype.php');
// tie-Panel
######include (TEMPLATEPATH . '/panel/shortcodes/shortcode.php');
if (is_admin()) {
	include (TEMPLATEPATH . '/panel/mpanel-ui.php');
	include (TEMPLATEPATH . '/panel/mpanel-functions.php');
    // include (TEMPLATEPATH . '/panel/custom-slider.php');
    ######include (TEMPLATEPATH . '/panel/custom-static.php');
	######include (TEMPLATEPATH . '/panel/category-options.php');
	include (TEMPLATEPATH . '/panel/post-options.php');	
	######include (TEMPLATEPATH . '/panel/notifier/update-notifier.php');
	######include (TEMPLATEPATH . '/panel/importer/tie-importer.php');    
}

/*-----------------------------------------------------------------------------------*/
# Custom Admin Bar Menus
/*-----------------------------------------------------------------------------------*/
function tie_admin_bar() {
	global $wp_admin_bar;
	if ( current_user_can( 'switch_themes' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'mpanel_page',
			'title' => THEME_NAME ,
			'href' => admin_url( 'admin.php?page=panel')
		) );
	}
}
add_action( 'wp_before_admin_bar_render', 'tie_admin_bar' );

// with activate istall option
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	if( !get_option('tie_active') ){
		tie_save_settings( $default_data );
		update_option( 'tie_active' , theme_ver );
	}
   //header("Location: admin.php?page=panel");
}

add_action( 'import_done', 'wordpress_importer_init' );

/*-----------------------------------------------------------------------------------*/
# Get Theme Options
/*-----------------------------------------------------------------------------------*/
function tie_get_option( $name ) {
	$get_options = get_option( 'tie_options' );
	if( !empty( $get_options[$name] ))
		return $get_options[$name];
	return false ;
}