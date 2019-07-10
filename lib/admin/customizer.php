<?php
/**
 * Create new section Customizer */
 
function your_theme_new_customizer_settings( $wp_customize ) {   

    // add a setting for the site logo
    $wp_customize->add_setting('your_theme_logo');
    // Add a control to upload the logo
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'your_theme_logo',
    array(
        'label' => 'Upload Logo (200 x 80)',
        'section' => 'title_tagline',
        'settings' => 'your_theme_logo',
        'height' => 80,
        'width' => 200,
        'flex_width ' => false,
        'flex_height ' => false,
    ) ) );

    $wp_customize->add_setting('top_banner');
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'top_banner',
    array(
        'label' => 'Upload top banner (720 x 90)',
        'section' => 'title_tagline',
        'settings' => 'top_banner',
        'height' => 80,
        'width' => 720,
        'flex_width ' => false,
        'flex_height ' => false,
    ) ) );

    // =============================================================================================
    // Theme options
    $wp_customize->add_section(
        "section_contact", 
        array(
            'title' => __("Contact Options", "ws24h"),
            'priority' => 130,
            'description' => __( 'Description Custom Theme Options here' ),
        )
    );

    // Contact name
    $wp_customize->add_setting('company_name');
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_name',
    array(
        'label' => 'Company name',
        'section' => 'section_contact',
        'settings' => 'company_name',
        'type' => 'text'
    ) ) );

     // Contact address
     $wp_customize->add_setting('contact_address');
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_address',
     array(
         'label' => 'Contact address',
         'section' => 'section_contact',
         'settings' => 'contact_address',
         'type' => 'text'
     ) ) );

     // Contact email
     $wp_customize->add_setting('contact_email');
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_email',
     array(
         'label' => 'Contact email',
         'section' => 'section_contact',
         'settings' => 'contact_email',
         'type' => 'text'
     ) ) );

     // Contact Phone
     $wp_customize->add_setting('contact_phone');
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_phone',
     array(
         'label' => 'Contact phone',
         'section' => 'section_contact',
         'settings' => 'contact_phone',
         'type' => 'text'
     ) ) );

     // Contact Hotline
     $wp_customize->add_setting('contact_hotline');
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_hotline',
     array(
         'label' => 'Contact hotline',
         'section' => 'section_contact',
         'settings' => 'contact_hotline',
         'type' => 'text'
     ) ) );

     // Contact copyright
     $wp_customize->add_setting('setting_copyright');
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'setting_copyright',
     array(
         'label' => 'Setting copyright',
         'section' => 'section_contact',
         'settings' => 'setting_copyright',
         'type' => 'text'
     ) ) );


     // ================================== SOCIALS =================================
     // Theme Socials link
    $wp_customize->add_section(
        "section_socials", 
        array(
            'title' => __("Socials Options", "ws24h"),
            'priority' => 131,
            'description' => __( 'Description Custom Socials Options here' ),
        )
    );

    // Facebook fanpage
    $wp_customize->add_setting('facebook_link');
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_link',
    array(
        'label' => 'Facebook link Fanpage',
        'section' => 'section_socials',
        'settings' => 'facebook_link',
        'type' => 'text'
    ) ) );

    // Youtube link channel
    $wp_customize->add_setting('youtube_link');
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_link',
    array(
        'label' => 'Youtube link channel',
        'section' => 'section_socials',
        'settings' => 'youtube_link',
        'type' => 'text'
    ) ) );

    // Zalo link channel
    $wp_customize->add_setting('zalo_link');
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'zalo_link',
    array(
        'label' => 'Zalo link page',
        'section' => 'section_socials',
        'settings' => 'zalo_link',
        'type' => 'text'
    ) ) );

    // Google plus channel
    $wp_customize->add_setting('google_plus_link');
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_plus_link',
    array(
        'label' => 'Google plus link page',
        'section' => 'section_socials',
        'settings' => 'google_plus_link',
        'type' => 'text'
    ) ) );

    // Twitter link channel
    $wp_customize->add_setting('twitter_link');
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter_link',
    array(
        'label' => 'Twitter link page',
        'section' => 'section_socials',
        'settings' => 'twitter_link',
        'type' => 'text'
    ) ) );

    // ================================== Layout =================================
     // Theme Socials link
     $wp_customize->add_section(
        "section_layout", 
        array(
            'title' => __("Layout Options", "ws24h"),
            'priority' => 133,
            'description' => __( 'Description Custom layout Options here' ),
        )
    );

    // Facebook fanpage
    $wp_customize->add_setting('footer_layout',
        array(
            'default' => '3c',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_layout',
    array(
        'label' => 'Footer Layout',
        'section' => 'section_layout',
        'settings' => 'footer_layout',
        'type' => 'select',
        'choices' => array(
            '1c' => __('1 Col'),
            '2c' => __('2 cols'),
            '3c' => __('3 cols'),
            '4c' => __('4 cols'),
            'wide-2' => __('Wide - 2 cols'),
            '2-wide' => __('2 cols - Wide'),
            'col-wide-col' => __('col - Wide - col')
        ),
    ) ) );

    // Facebook fanpage
    $wp_customize->add_setting('home_layout',
        array(
            'default' => '1c',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_layout',
    array(
        'label' => 'Home Layout',
        'section' => 'section_layout',
        'settings' => 'home_layout',
        'type' => 'select',
        'choices' => array(
            '1c' => __('1 Col'),
            '2c' => __('2 cols'),
            '3c' => __('3 cols')
        ),
    ) ) );

}
add_action( 'customize_register', 'your_theme_new_customizer_settings' );

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function ws24hnews_customize_preview_js() {
	wp_enqueue_script( 'ws24hnews-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'ws24hnews_customize_preview_js' );
  

// class ThemeMods {
//     private $themeMods; 
//     public function __construct() {
//         $this->themeMods = get_theme_mods();
//     }

//     public function getMods($modName = '') {
//         if (!$modName)
//             return null;
//         return $this->themeMods[$modName];
//     }
// }
// $themeMods = new ThemeMods();

// print_r($themeMods);