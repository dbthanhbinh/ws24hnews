<?php
function start_session() {
    if( !session_id() ) {
        session_start();
    }
}
add_action('init', 'start_session', 1);

// Defines
require_once ('lib/defined.php');
// load_theme_textdomain
if(!is_admin()) {
    load_textdomain(THEMENAME, get_template_directory() . '/languages/vi.mo' );
}

# Admin and Front-end Scope (both of Admin & Front-end)
require_once ('helpers/districts.php');
require_once ('admin/register-posttype.php');
require_once ('lib/siteCommons.php');
require_once ('widgets/widgets.php');
require_once ('admin/modifys/modify-adminlogo.php');

// Is Scope Customizer Live Preview
if (is_customize_preview()) {
    require_once ('admin/customizer.php');
    add_action( 'wp_enqueue_scripts', 'ws24h_slideshow_style' );
	add_action( 'wp_footer', 'ws24h_slideshow_owl_carousel_script' );
}

# Is Admin Scope (only admin)
if(is_admin()){
    load_theme_textdomain(THEMENAME, get_template_directory() . '/admin/languages' );
    
    // Check update plugins
    if(file_exists(dirname( __FILE__ ).'\admin\panel\theme-updates\TGM\tgm_configs.php'))
        require_once('admin/panel/theme-updates/TGM/tgm_configs.php');
    
    // Check update themes
    if(file_exists(dirname( __FILE__ ).'\admin\panel\theme-updates\theme-update-checker.php')){
        require_once (TEMPLATEPATH . '/admin/panel/theme-updates/theme-update-checker.php');
        if(class_exists('ThemeUpdateChecker'))
            $update_checker = new ThemeUpdateChecker(
                THEMENAME,
                '' // https://mydomain.com/theme-updates/info.json
            );
    }
    require_once ('admin/defined.php');
    require_once ('admin/panel/setting.php');
    require_once ('admin/modifys/index.php');
    
    add_filter('manage_posts_columns', 'add_img_column');
    function add_img_column($columns) {
        $columns = array_slice($columns, 0, 1, true) + array("img" => "Featured Image") + array_slice($columns, 1, count($columns) - 1, true);
        return $columns;
    }

    add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);
    function manage_img_column($column_name, $post_id) {
        if( $column_name == 'img' ) {
            echo get_the_post_thumbnail($post_id, 'thumbnail');
        }
        return $column_name;
    }

    // Custom Admin style
    function wp_admin_custom_style() {
        wp_register_style( 'wp-custom-style-admins', get_template_directory_uri().'/admin/assets/admin.min.css', array(), '', 'all' );
        wp_enqueue_style( 'wp-custom-style-admins' );
    }
    add_action( 'admin_enqueue_scripts', 'wp_admin_custom_style' );
}
# Is Front-end Scope (only front-end)
if(!is_admin()){
    // Front-end Commons
    require_once ('helpers/commons.php');
    require_once ('lib/modifys/index.php');
    
    // Favicon
    add_action( 'wp_head', 'render_favicon' );

    if( function_exists('tie_get_option') && tie_get_option('on_home') && tie_get_option('on_home') == 'boxes' ) {
		require_once ('modules/homepage/tpl-home.php');
	}
    add_action( 'wp_enqueue_scripts', 'ws24h_scripts' );

    add_action( 'wp_enqueue_scripts', 'ws24h_sticky_sidebar_scripts' );
    
    // Google Analytics
    add_action( 'wp_head', 'ws24h_header_analytics' );

    // Footer script
    add_action( 'wp_footer', 'ws24h_footer_scripts' );

    // facebook_lib_scripts
    add_action( 'wp_footer', 'ws24h_facebook_lib_scripts' );

    $customSlider = true;
    $customClient = false;
    if(($customSlider || $customClient)){
        add_action( 'wp_enqueue_scripts', 'ws24h_slideshow_style' );
        add_action( 'wp_footer', 'ws24h_slideshow_owl_carousel_script' );
    }

    add_action( 'wp_head', 'header_code_callback' );
    add_action( 'wp_footer', 'footer_code_callback' );

    // Footer StickySidebar_scripts
    add_action( 'wp_footer', 'ws24h_StickySidebar_scripts' );
}

if (is_customize_preview() || !is_admin()) {
    add_action( 'wp_head', 'custom_menu_colors_callback' );
    add_action( 'wp_head', 'ws24h_custom_body_background' );

    // Support online
    require_once ('modules/ws24hSupport/index.php');
}

// header_code_callback
function header_code_callback(){
    $headerCode = tie_get_option('header_code');
    if($headerCode){
        echo html_entity_decode($headerCode);
    }   
}

// footer_code_callback
function footer_code_callback() {
    $footerCode = tie_get_option('footer_code');
    if($footerCode){
        echo html_entity_decode($footerCode);
    } 
}

// custom_menu_callback
function custom_menu_colors_callback() {
    $customBg = get_theme_mod('header_background_color'); // nav
    $customBgFixed = get_theme_mod('header_background_color_fixed'); // nav when fixed

    $customLinkColor = get_theme_mod('header_link_color'); // Main menu link color
    $customLinkColorOver = get_theme_mod('header_hover_link_color'); // Main menu link color

    $customBgSub = get_theme_mod('header_background_submenu'); // Main submenu backgroud
    $customLinkColorSub = get_theme_mod('header_link_color_sub');  // link color sub
    $customLinkColorSubHover = get_theme_mod('header_link_color_sub_hover');  // link color sub

    $customHomeIconColor = get_theme_mod('header_home_icon_color'); // Home icon color

    $html = '<style>';
    $hasStyle = false;
    if(isset($customBg) && $customBg){
        $hasStyle = true;
        $html.= '
            .navbar {
                background: '.$customBg.';
            }
        ';
    }

    if(isset($customLinkColor) && $customLinkColor){
        $hasStyle = true;
        $html.= '
            .navbar-expand-lg .navbar-nav .nav-item >.nav-link {
                color: '.$customLinkColor.';
            }
        ';
    }
    if(isset($customLinkColorOver) && $customLinkColorOver){
        $hasStyle = true;
        $html.= '
            .navbar-expand-lg .navbar-nav .nav-item >.nav-link:hover {
                color: '.$customLinkColorOver.';
            }
        ';
    }


    if(isset($customBgSub) && $customBgSub){
        $hasStyle = true;
        $html.= '
            .navbar-expand-lg .navbar-nav .dropdown-menu {
                background: '.$customBgSub.';
            }
        ';
    }

    if(isset($customLinkColorSub) && $customLinkColorSub){
        $hasStyle = true;
        $html.= '
            .navbar-expand-lg .navbar-nav .dropdown-menu .nav-item .nav-link {
                color: '.$customLinkColorSub.';
            }
        ';
    }
    if(isset($customLinkColorSubHover) && $customLinkColorSubHover){
        $hasStyle = true;
        $html.= '
            .navbar-expand-lg .navbar-nav .dropdown-menu .nav-item .nav-link:hover {
                color: '.$customLinkColorSubHover.';
            }
        ';
    }

    if(isset($customHomeIconColor) && $customHomeIconColor){
        $hasStyle = true;
        $html.= '
            .navbar .navbar-brand .fa-home {
                color: '.$customHomeIconColor.';
            }
        ';
    }
    $html.= '</style>';
    echo html_entity_decode($html);
}

// For theme setup
function ws24h_setup () {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', THEMENAME ),
		'footer' => __( 'Footer Menu', THEMENAME ),
    ) );

	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
    
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	));
    add_theme_support( 'post-thumbnails', array('post', 'page', 'tin-tuc') );
    add_theme_support('category-thumbnails', array('category'));
}
add_action( 'after_setup_theme', 'ws24h_setup' );

// For custom theme background
function ws24h_custom_body_background() {
    $html = '';
    $customBackground = get_theme_mod("custom_background", false);
    if($customBackground){
        $html .= '
        <style>
            body{
                background-color: unset;
                background-image: linear-gradient(to right,rgba(237,189,189,0.28),rgba(237,189,189,0.28)),url(' . $customBackground . ');
                background-repeat: repeat;
                background-position: center center;
                background-size: contain;
                background-attachment: fixed;
            }
        </style>
        ';
    }
    echo html_entity_decode($html);
}

function ws24h_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'ws24h_custom_excerpt_length', 999 );

function excerpt_content ($excerpt, $limit, $readMore) {
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = str_ireplace("Read", '', $excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    if($readMore) {
        $postViews = get_post_meta(get_the_ID(), 'showposts_views', true);
        $postViews = $postViews ? $postViews : 10;
        return $excerpt . '<p class="article-metas"><span><strong>' .__('By:', THEMENAME). '</strong> ' . get_the_author() . ' | '.$postViews.' lượt</p>' . ws24h_excerpt_more('...');
    }

    return $excerpt.'...';
}

function get_excerpt($limit = null, $readMore=false, $source = null){
    if(!$limit)
        $limit = 150;
    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));	
    $excerpt = excerpt_content ($excerpt, $limit, $readMore);
    return $excerpt;
}

function ws24h_excerpt_more($more) {
    // return ' ...';
    return sprintf('<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ), '<i class="fa fa-long-arrow-right"></i> '. __('Excerpt_read_more', THEMENAME));
}
// add_filter( 'excerpt_more', 'ws24h_excerpt_more' );

// Remove width, height from the_post_thumb
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

function custom_admin_post_thumbnail_html( $content ) {
    $content = str_replace( __( 'Set featured image' ), __( 'Tải hình 640x480px' ), $content);
    return $content = str_replace( __( 'Đặt ảnh đại diện' ), __( 'Tải hình 640x480px' ), $content);
}
add_filter( 'admin_post_thumbnail_html', 'custom_admin_post_thumbnail_html' );

add_filter( 'get_the_archive_title', function ( $title ) {
    if ( is_category() ) {
        /* translators: Category archive title. 1: Category name */
        $title = sprintf( __( '%s' ), single_cat_title( '', false ) );
    } elseif ( is_search() ) {
        /* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( 'Tìm: %s' ), get_query_var('s') );
    } elseif ( is_tag() ) {
        /* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( 'Thẻ: %s' ), single_tag_title( '', false ) );
    } elseif ( is_author() ) {
        /* translators: Author archive title. 1: Author name */
        $title = sprintf( __( 'Author: %s' ), get_the_author() );
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

function get_link_by_slug($slug, $type = 'page'){
    $post = get_page_by_path($slug, OBJECT, $type);
    return get_permalink($post->ID);
}

// Youtube suport
function get_youtube_id_from_url($url){
    if (stristr($url,'youtu.be/'))
        {preg_match('/(https:|http:|)(\/\/www\.|\/\/|)(.*?)\/(.{11})/i', $url, $final_ID); return $final_ID[4]; }
    else 
        {@preg_match('/(https:|http:|):(\/\/www\.|\/\/|)(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $IDD); return $IDD[5]; }
}

// This configs for comment form
add_action( 'comment_form', 'my_add_comment_nonce_to_form' );
function my_add_comment_nonce_to_form() {
    wp_nonce_field( 'comment_nonce_ws24h' );
}

add_action( 'pre_comment_on_post', 'my_verify_comment_nonce' );
function my_verify_comment_nonce() {
    check_admin_referer( 'comment_nonce_ws24h' );
}

function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');

# Functions to help
// Theme stylesheet
function ws24h_scripts () {
    $default = 'default';
    if(isset($_SESSION) && $_SESSION['background'] && $_SESSION['background'] != '#e83e8c') {
        $default = 'default.temp';
    }
	wp_enqueue_script('jquery-main-script', get_theme_file_uri('/assets/vendor/jquery/jquery.min.js'));
    wp_enqueue_script('jquery-bootstrap-bundle', get_theme_file_uri('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'));
	wp_enqueue_style('ws24h-style', get_stylesheet_uri());
	wp_enqueue_style('ws24h-main-bootstrap', get_theme_file_uri('/assets/vendor/bootstrap/css/bootstrap.min.css'), array('ws24h-style'), '4.1');
	wp_enqueue_style('ws24h-main-default', get_theme_file_uri('/assets/css/'.$default.'.min.css' ), array( 'ws24h-style'), '1.0' );
    wp_enqueue_style('ws24h-main-style', get_theme_file_uri('/assets/css/style.min.css' ), array( 'ws24h-style'), '1.0' );
    wp_enqueue_style('ws24h-main-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', array('ws24h-style'), '4.70');
}

function ws24h_sticky_sidebar_scripts () {
    if (!is_front_page() && !is_home()) {
        $is_sticky_sidebar = get_theme_mod('is_sticky_sidebar');
        if($is_sticky_sidebar &&  $is_sticky_sidebar == 1){
            wp_enqueue_script('jquery-sticky-sidebar', get_theme_file_uri('/assets/js/sticky_sidebar.min.js'));
        }
    }
}


// Header
function ws24h_header_analytics() {
    if(get_theme_mod('google_analytics_code')){
        ?>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?= get_theme_mod('google_analytics_code') ?>"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?= get_theme_mod('google_analytics_code') ?>');
            </script>
        <?php
    }
}

// Footer
function ws24h_footer_scripts() {
    ?>
    <script src="<?php echo get_template_directory_uri();?>/assets/js/themejs.min.js"></script>
    <?php
}

function ws24h_StickySidebar_scripts () {
	if (!is_front_page() && !is_home()) {
        $is_sticky_sidebar = get_theme_mod('is_sticky_sidebar');
        if($is_sticky_sidebar &&  $is_sticky_sidebar == 1){
            ?>
             <!-- For sticky sidebar -->
            <script type="text/javascript">
                if( $('#sidebar').length ) {
                    var bottomSpacing = 15;
                    var footerSectionElm = $('#footer-section');
                    var copyRightBoxElm = $('#copy-right-box');
                    
                    if(copyRightBoxElm.length > 0)
                        bottomSpacing = (bottomSpacing + copyRightBoxElm.height());
                    
                    if(footerSectionElm.length > 0)
                        bottomSpacing = bottomSpacing + footerSectionElm.height();

                    var sidebar = new StickySidebar('#sidebar', {
                        topSpacing: 50,
                        bottomSpacing: bottomSpacing
                    });
                }
            </script>
            <?php
        }
	}
}

// Facebook_lib_scripts
function ws24h_facebook_lib_scripts () {
	$showFacebookFanpage = get_theme_mod('show_face_fanpage_plugin', IS_ENABLE_FACEBOOK_LIB);
    if($showFacebookFanpage &&  $showFacebookFanpage == 1){
        ?>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
        <?php
    }
}

function ws24h_slideshow_style () {
    if(is_customize_preview() || is_front_page() || is_home()){
        // Theme stylesheet.
        wp_enqueue_style( 'ws24h_slideshow_owl-carousel', get_theme_file_uri( '/modules/owl-carousel/owl.carousel.css' ));
        wp_enqueue_style( 'ws24h_slideshow_owl-carousel-theme', get_theme_file_uri( '/modules/owl-carousel/owl.theme.css' ));
    }
}

function ws24h_slideshow_owl_carousel_script(){
    if(is_customize_preview() || is_front_page() || is_home()){
	?>
	<!-- Owl Carousel Assets -->
	<script src="<?php echo get_template_directory_uri();?>/modules/owl-carousel/jquery-1.9.1.min.js"></script>
	<script src="<?php echo get_template_directory_uri();?>/modules/owl-carousel/owl.carousel.js"></script>
	<?php
    }
}

add_filter( 'widget_tag_cloud_args', 'change_tag_cloud_font_sizes');
/**
 * Change the Tag Cloud's Font Sizes.
 *
 * @return array
 */
function change_tag_cloud_font_sizes( array $args ) {
    $args['smallest'] = '10';
    $args['largest'] = '20';
    return $args;
}

// $cssString = file_get_contents(get_theme_file_path( '/assets/css/green.min.css' ));
// $cssString = str_replace('#24ca24', '#ff0000', $cssString);

//file_put_contents(get_theme_file_path( '/assets/css/green.min.css' ), $cssString);
// print_r($cssString);