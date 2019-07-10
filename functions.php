<?php
define ('THEME_NAME', 'ws24hnews');
$districts = [
    [
        "name" => "Q.12",
        "type" => "quan",
        "slug" => "quan-12",
    ],
    [
        "name" => "Q.1",
        "type" => "quan",
        "slug" => "quan-1",
    ],
    [
        "name" => "Q.2",
        "type" => "quan",
        "slug" => "quan-2",
    ],
    [
        "name" => "Q.3",
        "type" => "quan",
        "slug" => "quan-3",
    ],
    [
        "name" => "Q.4",
        "type" => "quan",
        "slug" => "quan-4",
    ],
    [
        "name" => "Q.5",
        "type" => "quan",
        "slug" => "quan-5",
    ],
    [
        "name" => "Q.6",
        "type" => "quan",
        "slug" => "quan-6",
    ],
    [
        "name" => "Q.7",
        "type" => "quan",
        "slug" => "quan-7",
    ],
    [
        "name" => "Q.8",
        "type" => "quan",
        "slug" => "quan-8",
    ],
    [
        "name" => "Q.9",
        "type" => "quan",
        "slug" => "quan-9",
    ],
    [
        "name" => "Q.10",
        "type" => "quan",
        "slug" => "quan-10",
    ],
    [
        "name" => "Q.11",
        "type" => "quan",
        "slug" => "quan-11",
    ],
    [
        "name" => "Thủ Đức",
        "type" => "quan",
        "slug" => "thu-duc",
    ],
    [
        "name" => "Gò Vấp",
        "type" => "quan",
        "slug" => "go-vap",
    ],
    [
        "name" => "Bình Thạnh",
        "type" => "quan",
        "slug" => "binh-thanh",
    ],
    [
        "name" => "Tân Bình",
        "type" => "quan",
        "slug" => "tan-binh",
    ],
    [
        "name" => "Tân Phú",
        "type" => "quan",
        "slug" => "tan-phu",
    ],
    [
        "name" => "Phú Nhuận",
        "type" => "quan",
        "slug" => "phu-nhuan",
    ],
    [
        "name" => "Bình Tân",
        "type" => "quan",
        "slug" => "binh-tan",
    ],
    [
        "name" => "Củ Chi",
        "type" => "huyen",
        "slug" => "cu-chi",
    ],
    [
        "name" => "Hóc Môn",
        "type" => "huyen",
        "slug" => "hoc-mon",
    ],
    [
        "name" => "Bình Chánh",
        "type" => "huyen",
        "slug" => "binh-chanh",
    ],
    [
        "name" => "Nhà Bè",
        "type" => "huyen",
        "slug" => "nha-be",
    ],
    [
        "name" => "Cần Giờ",
        "type" => "huyen",
        "slug" => "can-gio",
    ]
];

function getDistrictName($key){
	if(!$key) return null;
	global $districts;
	foreach ($districts as $key=>$item) {
		if($item['slug'] == $key)
			return $item['name'];
	}
	return null;
}

require_once ('lib/admin/setting.php');
require_once ('lib/modifys/index.php');
require_once ('lib/_functions.php');
require_once ('lib/widgets/widgets.php');
require_once ('panel/setting.php');
if (is_admin()) {

} else {
	if( tie_get_option('on_home') && tie_get_option('on_home') == 'boxes' ) {
		require_once ('modules/homepage/tpl-home.php');
	}
}

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
	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
	
    
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

	add_theme_support( 'post-thumbnails', array('post') );  
}
add_action( 'after_setup_theme', 'ws24h_setup' );

// Footer
function ws24h_footer_scripts () {
    wp_enqueue_script( 'jquery-bootstrap', get_theme_file_uri( '/assets/vendor/jquery/jquery.min.js' ), array( 'jquery' ), '4.1', true );
	wp_enqueue_script( 'jquery-bootstrap-bundle', get_theme_file_uri( '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ), array( 'jquery' ), '4.1', true );
	wp_enqueue_script( 'jquery-sticky-sidebar', get_theme_file_uri( '/modules/sticksidebar/jquery.sticky-sidebar-scroll.js' ), array( 'jquery' ), '1.1', true );
	wp_enqueue_script( 'jquery-bootstrap-customjs', get_theme_file_uri( '/assets/js/customjs.js' ), array( 'jquery' ), '1.0', true );
}
add_action( 'wp_footer', 'ws24h_footer_scripts' );

function ws24h_facebook_lib_scripts () {
	if (is_single()) {
		?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.0';
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<script src="https://apis.google.com/js/platform.js" async defer>
		{lang: 'en-GB'}
		</script>		

		<?php
	}
}
add_action( 'wp_footer', 'ws24h_facebook_lib_scripts' );

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
function get_excerpt($limit, $readMore=false, $source = null){
	if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));	
	$excerpt = excerpt_content ($excerpt, $limit);
	// if ($readMore)
	// 	return $excerpt = $excerpt . '... <a class="read-more" href="'.get_permalink(get_the_ID()).'">Read more</a>';
    return $excerpt . '...';
}

function ws24h_custom_the_excerpt () {
	$limit = 150;
	$excerpt = get_the_excerpt();
	$excerpt = excerpt_content ($excerpt, $limit);
	// $excerpt = $excerpt.' ... <a class="read-more" href="'.get_permalink(get_the_ID()).'">Đọc thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
	return $excerpt.'...';
}
// add_filter( 'the_excerpt', 'ws24h_custom_the_excerpt', 999 );

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


add_filter( 'get_the_archive_title', function ( $title ) {
	if ( is_category() ) {
        /* translators: Category archive title. 1: Category name */
        $title = sprintf( __( 'Danh mục: %s' ), single_cat_title( '', false ) );
	} elseif ( is_search() ) {
        /* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( 'Tìm kiếm: %s' ), get_query_var('s') );
    } elseif ( is_tag() ) {
        /* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( 'Thẻ: %s' ), single_tag_title( '', false ) );
    } elseif ( is_author() ) {
        /* translators: Author archive title. 1: Author name */
        $title = sprintf( __( 'Author: %s' ), '<span class="vcard">' . get_the_author() . '</span>' );
    } elseif ( is_year() ) {
        /* translators: Yearly archive title. 1: Year */
        $title = sprintf( __( 'Năm: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
    } elseif ( is_month() ) {
        /* translators: Monthly archive title. 1: Month name and year */
        $title = sprintf( __( 'Tháng: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
    } elseif ( is_day() ) {
        /* translators: Daily archive title. 1: Date */
        $title = sprintf( __( 'Ngày: %s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title' );
        }
    } elseif ( is_post_type_archive() ) {
        /* translators: Post type archive title. 1: Post type name */
        $title = sprintf( __( ' %s' ), post_type_archive_title( '', false ) );
    } elseif ( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
    } else {
        $title = __( ' ' );
    }

    return $title;
});

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ws24h_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'ws24h' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Second Sidebar', 'ws24h' ),
		'id'            => 'sidebar-second',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'ws24h' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'ws24h' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'ws24h' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'ws24h' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'ws24h' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title"><label>',
		'after_title'   => '</label></h2>',
	) );
}
add_action( 'widgets_init', 'ws24h_widgets_init' );