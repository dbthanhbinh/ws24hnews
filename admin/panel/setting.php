<?php
// tie-Panel
// require_once ('shortcodes/shortcode.php');
$customSlider = true;
$customClient = true;

require_once ('mpanel-ui.php');
require_once ('mpanel-functions.php');
if($customSlider)
	require_once ('custom-slider.php');
if($customClient)
	require_once ('custom-client.php');

// require_once ('custom-static.php');
require_once ('category-options-feature.php');
require_once ('post-options.php');	
// require_once ('notifier/update-notifier.php');

// Custom Admin Bar Menus
function tie_admin_bar() {
	global $wp_admin_bar;
	if ( current_user_can( 'switch_themes' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'mpanel_page',
			'title' => THEMENAME ,
			'href' => admin_url( 'admin.php?page=panel')
		) );
	}
}
add_action( 'wp_before_admin_bar_render', 'tie_admin_bar' );

// with activate istall option
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	if( !get_option('tie_active') ){
		tie_save_settings( $default_data );
		update_option( 'tie_active' , THEMENAME );
	}
   //header("Location: admin.php?page=panel");
}
// add_action( 'import_done', 'wordpress_importer_init' );
