<?php
define ('THEME_NAME', 'ws24hnews');
require_once ('lib/admin/setting.php');
require_once ('lib/_functions.php');

function ws24h_scripts () {
    // Theme stylesheet.
	wp_enqueue_style( 'ws24h-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ws24h-bootstrap', get_theme_file_uri( '/assets/vendor/bootstrap/css/bootstrap.min.css' ), array( 'ws24h-style' ), '4.1' );
	wp_enqueue_style( 'ws24h-main-style', get_theme_file_uri( '/assets/css/style.min.css' ), array( 'ws24h-style' ), '1.0' );
	wp_enqueue_style( 'ws24h-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', array( 'ws24h-style' ), '4.70' );
}
add_action( 'wp_enqueue_scripts', 'ws24h_scripts' );

function ws24h_setup () {
    // This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'    => __( 'Primary Menu', THEME_NAME ),
		'footer' => __( 'Footer Menu', THEME_NAME ),
    ) );
    
    /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
    ) );
    
    /*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );
}
add_action( 'after_setup_theme', 'ws24h_setup' );

// Footer
function ws24h_footer_scripts () {
    wp_enqueue_script( 'jquery-bootstrap', get_theme_file_uri( '/assets/vendor/jquery/jquery.min.js' ), array( 'jquery' ), '4.1', true );
    wp_enqueue_script( 'jquery-bootstrap-bundle', get_theme_file_uri( '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ), array( 'jquery' ), '4.1', true );
}
add_action( 'wp_footer', 'ws24h_footer_scripts' );

// =============================================
/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function ws24h_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'ws24h_custom_excerpt_length', 999 );

function excerpt_content ($excerpt, $limit) {
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = str_ireplace("Read", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	return $excerpt;
}
function get_excerpt($limit, $source = null){
	if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));	
    $excerpt = excerpt_content ($excerpt, $limit);
    $excerpt = $excerpt . ' ... <a class="read-more" href="'.get_permalink(get_the_ID()).'">Read more</a>';
    return $excerpt;
}

function ws24h_custom_the_excerpt () {
	$limit = 100;
	$excerpt = get_the_excerpt();
	$excerpt = excerpt_content ($excerpt, $limit);
	$excerpt = $excerpt.' ... <a class="read-more" href="'.get_permalink(get_the_ID()).'">Read more</a>';
	return $excerpt;
}
add_filter( 'the_excerpt', 'ws24h_custom_the_excerpt', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function ws24h_excerpt_more( $more ) {
	// return ' ...';
	return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Read More', THEME_NAME )
    );
}
add_filter( 'excerpt_more', 'ws24h_excerpt_more' );

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});

add_filter( 'widget_tag_cloud_args', 'change_tag_cloud_font_sizes');
/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @since 1.0.0
 *
 * @param array $args
 *
 * @return array
 */
function change_tag_cloud_font_sizes( array $args ) {
    $args['smallest'] = '11';
    $args['largest'] = '16';
    return $args;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ws24h_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'ws24h' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Second Sidebar', 'ws24h' ),
		'id'            => 'sidebar-second',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ws24h' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ws24h' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'ws24h' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'ws24h' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ws24h_widgets_init' );