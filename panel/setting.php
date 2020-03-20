<?php
include (TEMPLATEPATH . '/panel/register-posttype.php');
// tie-Panel
######include (TEMPLATEPATH . '/panel/shortcodes/shortcode.php');
$customSlider = true;
$customClient = false;

if (is_admin()) {
	include (TEMPLATEPATH . '/panel/mpanel-ui.php');
	include (TEMPLATEPATH . '/panel/mpanel-functions.php');
	if($customSlider)
		include (TEMPLATEPATH . '/panel/custom-slider.php');
	if($customClient)
		include (TEMPLATEPATH . '/panel/custom-client.php');

    ######include (TEMPLATEPATH . '/panel/custom-static.php');
	include (TEMPLATEPATH . '/panel/category-options-feature.php');
	include (TEMPLATEPATH . '/panel/post-options.php');	
	######include (TEMPLATEPATH . '/panel/notifier/update-notifier.php');
	######include (TEMPLATEPATH . '/panel/importer/tie-importer.php');  
} else {
	if(($customSlider || $customClient) && !is_customize_preview()){
		add_action( 'wp_enqueue_scripts', 'ws24h_slideshow_style' );
		add_action( 'wp_footer', 'ws24h_slideshow_owl_carousel_script' );
	}
}

function ws24h_slideshow_style () {
	// Theme stylesheet.
	wp_enqueue_style( 'ws24h_slideshow_owl-carousel', get_theme_file_uri( '/modules/owl-carousel/owl.carousel.css' ));
	wp_enqueue_style( 'ws24h_slideshow_owl-carousel-theme', get_theme_file_uri( '/modules/owl-carousel/owl.theme.css' ));
}

function ws24h_slideshow_owl_carousel_script(){
	?>
	<!-- Owl Carousel Assets -->
	<script src="<?php echo get_template_directory_uri();?>/modules/owl-carousel/jquery-1.9.1.min.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/modules/owl-carousel/owl.carousel.js"></script>
	<?php
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
// add_action( 'import_done', 'wordpress_importer_init' );

/*-----------------------------------------------------------------------------------*/
# Get Theme Options
/*-----------------------------------------------------------------------------------*/
function tie_get_option( $name ) {
	$get_options = get_option( 'tie_options' );
	if( !empty( $get_options[$name] ))
		return $get_options[$name];
	return false ;
}