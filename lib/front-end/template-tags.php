<?php
class menu_walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = []) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $class_names = $value = '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = '';

        $childClass = '';
        $childClassA = '';
        $dataToggle = '';
        if($args->walker->has_children){
            //code...
            $childClass = 'dropdown';
            $childClassA = 'dropdown-toggle';
            $dataToggle = 'data-toggle="dropdown"';
        }  
        $class_names = ' class="nav-item '.$childClass.' '. esc_attr( $class_names ) . '"';
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
 
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
        $item_output = $args->before;
        $item_output .= '<a '.$dataToggle.' class="nav-link '.$childClassA.'" '. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= '</a>';
        $item_output .= $args->after;
 
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

if ( ! function_exists( 'ws24h_time_link' ) ) :
    /**
     * Gets a nicely formatted string for the published date.
     */
    function ws24h_time_link() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }
    
        $time_string = sprintf( $time_string,
            get_the_date( DATE_W3C ),
            get_the_date(),
            get_the_modified_date( DATE_W3C ),
            get_the_modified_date()
        );
    
        // Wrap the time string in a link, and preface it with 'Posted on'.
        return sprintf(
            /* translators: %s: post date */
            __( '<span class="screen-reader-text">Posted on</span> %s', 'ws24h' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );
    }
endif;

if ( ! function_exists( 'ws24h_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function ws24h_posted_on($show = true) {
        if (!$show)
            return '';
            
        // Get the author name; wrap it in a link.
        $byline = sprintf(
            /* translators: %s: post author */
            __( 'by %s', 'ws24h' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
        );
    
        // Finally, let's write all of this to the page.
        echo '<div class="posted-on-box"><span class="posted-on">' . ws24h_time_link() . '</span><span class="byline"> ' . $byline . '</span></div>';
    }
endif;

if ( ! function_exists( 'render_logo' ) ) :
    function render_logo () {        
        // check to see if the logo exists and add it to the page
        if ( get_theme_mod( 'your_theme_logo' ) ) : 
        ?>
            <a class="navbar-brand them-logo" href="<?= site_url() ?>">
                <?php 
                $yourTheme = wp_get_attachment_image(get_theme_mod( 'your_theme_logo' ));
                $yourTheme = preg_replace(array('/width="[^"]*"/', '/height="[^"]*"/'), '', $yourTheme);
                echo $yourTheme;
                ?>
            </a>
        <?php // add a fallback if the logo doesn't exist
        else : ?>
            <a class="navbar-brand them-logo" href="<?= site_url() ?>">
                <img src="<?php echo get_template_directory_uri()?>/assets/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
            </a>
        <?php endif;
    }
endif;

if ( ! function_exists( 'render_mode_attachment_image' ) ) :
    function render_mode_attachment_image ($key, $size = 'large') {
        if ( !$key || !get_theme_mod( $key ))
            return '';
        return wp_get_attachment_image( get_theme_mod( $key ), $size );
    }    
endif;    