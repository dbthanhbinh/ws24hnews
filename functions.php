<?php
require_once ('lib/defined.php');

define ('THEME_NAME', THEMENAME);
require_once ('helpers/districts.php');
require_once ('lib/admin/setting.php');
require_once ('lib/modifys/index.php');
require_once ('lib/widgets/widgets.php');
require_once ('helpers/commons.php');
require_once ('panel/setting.php');
require_once ('lib/front-end/template-tags.php');
require_once ('lib/front-end/translates.php');

// Theme stylesheet
function ws24h_scripts () {
	wp_enqueue_script('jquery-main-script', get_theme_file_uri('/assets/vendor/jquery/jquery.min.js'));
    wp_enqueue_script('jquery-bootstrap-bundle', get_theme_file_uri('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'), array('jquery'), '4.1', true);
    wp_enqueue_script('jquery-sticky-sidebar', get_theme_file_uri('/modules/sticksidebar/jquery.sticky-sidebar-scroll.js'), array('jquery'), '1.1', true);
	wp_enqueue_style('ws24h-style', get_stylesheet_uri());
	wp_enqueue_style('ws24h-main-bootstrap', get_theme_file_uri('/assets/vendor/bootstrap/css/bootstrap.min.css'), array('ws24h-style'), '4.1');
	wp_enqueue_style('ws24h-main-style', get_theme_file_uri('/assets/css/style.min.css' ), array( 'ws24h-style'), '1.0' );
    wp_enqueue_style('ws24h-main-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css', array('ws24h-style'), '4.70');
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
function ws24h_footer_scripts () {
    wp_enqueue_script(
        'jquery-mixitup-script-name',
        get_theme_file_uri('/assets/vendor/jquery/jquery.mixitup.js'), array('jquery'), '1.0', true);
    wp_enqueue_script(
        'jquery-bootstrap-customjs',
        get_theme_file_uri('/assets/js/customjs.js'), array('jquery'), '1.0', true);
}

function ws24h_StickySidebar_scripts () {
	if (is_single()) {
        $show_sticky_sidebar = 1; // get_theme_mod('show_sticky_sidebar');
        if($show_sticky_sidebar &&  $show_sticky_sidebar == 1){
            ?>
             <!-- For sticky sidebar -->
            <script type="text/javascript">
            if( $('#sidebar').length ) {
                var sidebar = new StickySidebar('#sidebar', {
                    topSpacing: 50,
                    bottomSpacing: 50
                });
            }
            </script>
            <?php
        }
	}
}

// facebook_lib_scripts
function ws24h_facebook_lib_scripts () {
	if (is_single()) {
        $showFacebookFanpage = get_theme_mod('show_face_fanpage_plugin');
        if($showFacebookFanpage &&  $showFacebookFanpage == 1){
            ?>
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
            <?php
        }
	}
}

/**
 * WP admin show thumbnail in post list
 */
if(is_admin()){
    add_filter('manage_posts_columns', 'add_img_column');
    add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

    function add_img_column($columns) {
        $columns = array_slice($columns, 0, 1, true) + array("img" => "Featured Image") + array_slice($columns, 1, count($columns) - 1, true);
        return $columns;
    }

    function manage_img_column($column_name, $post_id) {
        if( $column_name == 'img' ) {
            echo get_the_post_thumbnail($post_id, 'thumbnail');
        }
        return $column_name;
    }

    // Custom wpAdmin css
    function wp_admin_custom_style() {
        wp_register_style( 'wp-custom-style-admins', get_template_directory_uri().'/assets/admin/admin.min.css', array(), '', 'all' );
        wp_enqueue_style( 'wp-custom-style-admins' );
    }
    add_action( 'admin_enqueue_scripts', 'wp_admin_custom_style' );
} elseif(!is_admin()){
    if( function_exists('tie_get_option') && tie_get_option('on_home') && tie_get_option('on_home') == 'boxes' ) {
		require_once ('modules/homepage/tpl-home.php');
	}
    add_action( 'wp_enqueue_scripts', 'ws24h_scripts' );
    
    // Google Analytics
    add_action( 'wp_head', 'ws24h_header_analytics' );

    // Footer StickySidebar_scripts
    // add_action( 'wp_footer', 'ws24h_StickySidebar_scripts' );

    // Footer script
    add_action( 'wp_footer', 'ws24h_footer_scripts' );

    // facebook_lib_scripts
    add_action( 'wp_footer', 'ws24h_facebook_lib_scripts' );
}

function ws24h_setup () {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', THEME_NAME ),
		'footer' => __( 'Footer Menu', THEME_NAME ),
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

function ws24h_custom_body_background() {
    $html = '';
    if(get_theme_mod("custom_background")){
        $html .= '
        <style>
            body{
                background-color: unset;
                background-image: linear-gradient(to right,rgba(237,189,189,0.28),rgba(237,189,189,0.28)),url(' . get_theme_mod("custom_background") . ');
                background-repeat: repeat;
                background-position: center center;
                background-size: contain;
                background-attachment: fixed;
            }
        </style>
        ';
    }
    print_r($html);
}
// add_action( 'wp_footer', 'ws24h_custom_body_background' );

if(!is_admin()){
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
        return $excerpt;
    }

    function ws24h_custom_the_excerpt () {
        $limit = 150;
        $excerpt = get_the_excerpt();
        $excerpt = excerpt_content ($excerpt, $limit);
        // $excerpt = $excerpt.' ... <a class="read-more" href="'.get_permalink(get_the_ID()).'">Đọc thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
        return $excerpt;
    }
    // add_filter( 'the_excerpt', 'ws24h_custom_the_excerpt', 999 );

    function ws24h_excerpt_more( $more ) {
        // return ' ...';
        return sprintf('<br/><br/><a class="read-more" href="%1$s">%2$s</a>',
            get_permalink( get_the_ID() ),
            __( ' <i class="fa fa-long-arrow-right"></i> Xem thêm', THEME_NAME )
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

    // Remove width, height from the_post_thumb
    add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
    add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
    add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
    function remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
    }

    /**
     * Change the Tag Cloud's Font Sizes.
     */
    function change_tag_cloud_font_sizes( array $args ) {
        $args['smallest'] = '11';
        $args['largest'] = '16';
        return $args;
    }
    add_filter( 'widget_tag_cloud_args', 'change_tag_cloud_font_sizes');

    add_filter( 'get_the_archive_title', function ( $title ) {
        if ( is_category() ) {
            /* translators: Category archive title. 1: Category name */
            $title = sprintf( __( '%s' ), single_cat_title( '', false ) );
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

    function get_link_by_slug($slug, $type = 'page'){
        $post = get_page_by_path($slug, OBJECT, $type);
        return get_permalink($post->ID);
    }

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
}