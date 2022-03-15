<?php
/**
 * Create new section Customizer
 **/
function your_theme_new_customizer_settings($wp_customize) {
    global $Customize;

    $choices = [
        '1' => __('Enable', THEMENAME),
        '0' => __('Disable', THEMENAME)
    ];

    $choicesLayout =  [
        'full-width' => __('Full width', THEMENAME),
        'left-sidebar' => __('Left sidebar', THEMENAME),
        'right-sidebar' => __('Right sidebar', THEMENAME)
    ];

    $headerVertion =  [
        'v1' => __('Header ver 1', THEMENAME),
        'v2' => __('Header ver 2', THEMENAME)
    ];

    $templateVertions =  [
        'default' => __('Style', THEMENAME),
        'pink' => __('Pink', THEMENAME),
        'red' => __('Red', THEMENAME),
        'nail' => __('Nail', THEMENAME),
        'green' => __('Green', THEMENAME)
    ];

    $pages = get_all_page_ids();
    $allPage = [];
    if(count($pages) > 0) {
        foreach($pages as $pageId)
        {
            $allPage[$pageId] = get_the_title($pageId);
        }
    }

    // add a setting for the site logo
    $wp_customize->add_setting('your_theme_logo');
    // Add a control to upload the logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'your_theme_logo',
    array(
        'label' => __('Upload your Logo', THEMENAME),
        'section' => 'title_tagline',
        'settings' => 'your_theme_logo',
        'flex_width ' => true,
        'flex_height ' => true,
    ) ) );

    $wp_customize->add_setting('top_banner');
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'top_banner',
    array(
        'label' => __('Upload top banner', THEMENAME) . " (720 x 90)",
        'section' => 'title_tagline',
        'settings' => 'top_banner',
        'height' => 80,
        'width' => 720,
        'flex_width ' => false,
        'flex_height ' => false,
    ) ) );

    $wp_customize->add_setting('top_banner_url');
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'top_banner_url',
    array(
        'label' => __('Top banner url', THEMENAME) . " Ex:(https://..)",
        'section' => 'title_tagline',
        'settings' => 'top_banner_url',
        'type' => 'text'
    )));

    $wp_customize->add_setting('custom_background');
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_background',
    array(
        'label' => __('Upload custom body background image', THEMENAME),
        'section' => 'title_tagline',
        'settings' => 'custom_background',
        'flex_width ' => false,
        'flex_height ' => false,
    ) ) );


    // ================================== Layout =================================
     // Theme Socials link
     $wp_customize->add_section(
        "section_layout", 
        array(
            'title' => __("Layout Options", THEMENAME),
            'priority' => 120,
            'description' => __('???', THEMENAME),
        )
    );

    $wp_customize->add_setting('template_version', ['default' => 'style']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'template_version',
    array(
        'label' => __('Theme template', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'template_version',
        'type' => 'select',
        'choices' => $templateVertions
    )));

    $wp_customize->add_setting('header_version', ['default' => LAYOUT_HEADER_VERSION]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_version',
    array(
        'label' => __('Header ver', THEMENAME) . "(V2=>show banner)",
        'section' => 'section_layout',
        'settings' => 'header_version',
        'type' => 'select',
        'choices' => $headerVertion
    )));

    $wp_customize->add_setting('show_top_header', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_top_header',
    array(
        'label' => __('Show top header', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'show_top_header',
        'type' => 'select',
        'choices' => $choices
    ) ) );

    $wp_customize->add_setting('show_header_banner', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_header_banner',
    array(
        'label' => __('Show header banner', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'show_header_banner',
        'type' => 'select',
        'choices' => $choices
    ) ) );

    $wp_customize->add_setting('show_breadcrumb', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_breadcrumb',
    array(
        'label' => __('Show breadcrumb', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'show_breadcrumb',
        'type' => 'select',
        'choices' => $choices
    ) ) );

    // Enable Slideshow
    $wp_customize->add_setting('show_main_slideshow', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_main_slideshow',
    array(
        'label' => __('Show Slide show', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'show_main_slideshow',
        'type' => 'select',
        'choices' => $choices
    ) ) );


    // Home layout
    $wp_customize->add_setting('home_layout', ['default' => 'full-width']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_layout',
    array(
        'label' => __('Home layout', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'home_layout',
        'type' => 'select',
        'choices' => $choicesLayout
    ) ) );

    // Home page intro select
    $wp_customize->add_setting('home_page_intro', ['default' => '']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_page_intro',
    array(
        'label' => __('Home page intro', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'home_page_intro',
        'type' => 'select',
        'choices' => $allPage
    ) ) );

    // Pages layout
    $wp_customize->add_setting('page_layout', ['default' => 'right-sidebar']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'page_layout',
    array(
        'label' => __('Pages Layout', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'page_layout',
        'type' => 'select',
        'choices' => $choicesLayout
    ) ) );

    // Single layout
    $wp_customize->add_setting('single_layout', ['default' => 'right-sidebar']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'single_layout',
    array(
        'label' => __('Single Layout', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'single_layout',
        'type' => 'select',
        'choices' => $choicesLayout
    ) ) );

    // Single layout
    $wp_customize->add_setting('archive_layout', ['default' => 'right-sidebar']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archive_layout',
    array(
        'label' => __('Archives Layout', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'archive_layout',
        'type' => 'select',
        'choices' => $choicesLayout
    ) ) );

    // Enable footer Layout
    $wp_customize->add_setting('show_footer_layout', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_footer_layout',
    array(
        'label' => __('Show footer layout', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'show_footer_layout',
        'type' => 'select',
        'choices' => $choices
    ) ) );

    $wp_customize->add_setting('footer_layout', ['default' => '3c']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_layout',
    array(
        'label' => __('Footer Layout', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'footer_layout',
        'type' => 'select',
        'choices' => array(
            '1c' => __('1 Col', THEMENAME),
            '2c' => __('2 cols', THEMENAME),
            '3c' => __('3 cols', THEMENAME),
            '4c' => __('4 cols', THEMENAME),
            'wide-2' => __('Wide - 2 cols', THEMENAME),
            'wide1' => __('Wide - 1 col', THEMENAME),
            '2-wide' => __('2 cols - Wide', THEMENAME),
            'col-wide-col' => __('col - Wide - col', THEMENAME)
        ),
    ) ) );

    // Enable footer copyright
    $wp_customize->add_setting('show_footer_copyright', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_footer_copyright',
    array(
        'label' => __('Show footer copyright', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'show_footer_copyright',
        'type' => 'select',
        'choices' => $choices
    ) ) );

    // Enable Client
    $customClientArgs = array( 'post_type' => 'tie_clients', 'no_found_rows' => 1  );
    $customClientSql = new WP_Query( $customClientArgs );
    $customClients = [];
    $customClients[-1] = __('Disable', THEMENAME);

    while ( $customClientSql->have_posts() ) {
        $customClientSql->the_post();
        $customClients[get_the_ID()] = get_the_title();
    }

    $wp_customize->add_setting('show_client', ['default' => -1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_client',
    array(
        'label' => __('Show client group', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'show_client',
        'type' => 'select',
        'choices' => $customClients
    ) ) );

    $wp_customize->add_setting('is_sticky_sidebar', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'is_sticky_sidebar',
    array(
        'label' => __('Sticky sidebar', THEMENAME),
        'section' => 'section_layout',
        'settings' => 'is_sticky_sidebar',
        'type' => 'select',
        'choices' => $choices
    ) ) );

    // ===============================================================================
    // Theme options
    $wp_customize->add_section(
        "section_contact", 
        array(
            'title' => __("Contact Options", THEMENAME),
            'priority' => 135,
            'description' => __('Description Custom Theme Options here', THEMENAME),
        )
    );

    // Contact name
    $wp_customize->add_setting('company_name', ['default' => $Customize['company_name']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_name',
    array(
        'label' => __('Company name', THEMENAME),
        'section' => 'section_contact',
        'settings' => 'company_name',
        'type' => 'text'
    ) ) );

    $wp_customize->add_setting('company_top_name', ['default' => $Customize['company_name']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_top_name',
    array(
        'label' => __('Company top name', THEMENAME),
        'section' => 'section_contact',
        'settings' => 'company_top_name',
        'type' => 'text'
    ) ) );

    // Contact name
    $wp_customize->add_setting('company_footer_name', ['default' => $Customize['company_footer_name']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'company_footer_name',
    array(
        'label' => __('Company footer name', THEMENAME),
        'section' => 'section_contact',
        'settings' => 'company_footer_name',
        'type' => 'text'
    ) ) );

     // Contact address
     $wp_customize->add_setting('contact_address', ['default' => $Customize['contact_address']]);
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_address',
     array(
         'label' => __('Contact address', THEMENAME),
         'section' => 'section_contact',
         'settings' => 'contact_address',
         'type' => 'text'
     ) ) );

     // Contact email
     $wp_customize->add_setting('contact_email', ['default' => $Customize['contact_email']]);
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_email',
     array(
         'label' => __('Contact email', THEMENAME),
         'section' => 'section_contact',
         'settings' => 'contact_email',
         'type' => 'text'
     ) ) );

     // Contact Phone
     $wp_customize->add_setting('contact_phone', ['default' => $Customize['contact_phone']]);
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_phone',
     array(
         'label' => __('Contact phone', THEMENAME),
         'section' => 'section_contact',
         'settings' => 'contact_phone',
         'type' => 'text'
     ) ) );

     // Contact Hotline
     $wp_customize->add_setting('contact_hotline', ['default' => $Customize['contact_hotline']]);
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'contact_hotline',
     array(
         'label' => __('Contact hotline', THEMENAME),
         'section' => 'section_contact',
         'settings' => 'contact_hotline',
         'type' => 'text'
     ) ) );

     // Contact copyright
     $wp_customize->add_setting('setting_copyright', ['default' => $Customize['setting_copyright']]);
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'setting_copyright',
     array(
         'label' => __('Setting copyright', THEMENAME),
         'section' => 'section_contact',
         'settings' => 'setting_copyright',
         'type' => 'text'
     ) ) );

     // Contact copyright
     $wp_customize->add_setting('setting_open_time', ['default' => $Customize['setting_open_time']]);
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'setting_open_time',
     array(
         'label' => __('Open time', THEMENAME),
         'section' => 'section_contact',
         'settings' => 'setting_open_time',
         'type' => 'text'
     ) ) );

     
     $wp_customize->add_setting('google_analytics_code', ['default' => $Customize['google_analytics_code']]);
     $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_analytics_code',
     array(
         'label' => __('Google Analytics Code', THEMENAME),
         'section' => 'section_contact',
         'settings' => 'google_analytics_code',
         'type' => 'text'
     ) ) );


    // ================================Verification======================================
    $wp_customize->add_section(
        "site_verification", 
        array(
            'title' => __("Site Verification", THEMENAME),
            'priority' => 137,
            'description' => __('Description Site verification here', THEMENAME),
        )
    );

    // Google site verification
    $wp_customize->add_setting('google_site_verification', ['default' => $Customize['google_site_verification']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_site_verification',
    array(
        'label' => __('Google site verification code', THEMENAME),
        'section' => 'site_verification',
        'settings' => 'google_site_verification',
        'type' => 'text'
    ) ) );

    // ================================== SOCIALS =================================
    // Theme Socials link
    $wp_customize->add_section(
        "section_socials", 
        array(
            'title' => __("Socials Options", THEMENAME),
            'priority' => 131,
            'description' => __('Description Custom Socials Options here', THEMENAME),
        )
    );

    // Facebook fanpage
    $wp_customize->add_setting('facebook_name', ['default' => $Customize['facebook_name']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_name',
    array(
        'label' => __('Facebook name Fanpage', THEMENAME),
        'section' => 'section_socials',
        'settings' => 'facebook_name',
        'type' => 'text'
    ) ) );

    $wp_customize->add_setting('facebook_link', ['default' => $Customize['facebook_link']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook_link',
    array(
        'label' => __('Facebook link Fanpage', THEMENAME),
        'section' => 'section_socials',
        'settings' => 'facebook_link',
        'type' => 'text'
    ) ) );

    // Youtube link channel
    $wp_customize->add_setting('youtube_link', ['default' => $Customize['youtube_link']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'youtube_link',
    array(
        'label' => __('Youtube link channel', THEMENAME),
        'section' => 'section_socials',
        'settings' => 'youtube_link',
        'type' => 'text'
    ) ) );

    // Zalo link channel
    $wp_customize->add_setting('zalo_link', ['default' => $Customize['zalo_link']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'zalo_link',
    array(
        'label' => __('Zalo link page', THEMENAME),
        'section' => 'section_socials',
        'settings' => 'zalo_link',
        'type' => 'text'
    ) ) );

    // Google plus channel
    $wp_customize->add_setting('google_plus_link', ['default' => $Customize['google_plus_link']]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google_plus_link',
    array(
        'label' => __('Google plus link page', THEMENAME),
        'section' => 'section_socials',
        'settings' => 'google_plus_link',
        'type' => 'text'
    ) ) );

    // Twitter link channel
    $wp_customize->add_setting('twitter_link', ['default' => $Customize['twitter_link']]);
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'twitter_link',
        array(
            'label' => __('Twitter link page', THEMENAME),
            'section' => 'section_socials',
            'settings' => 'twitter_link',
            'type' => 'text'
        ) 
    ) );

    $wp_customize->add_setting('show_face_fanpage_plugin', ['default' => 1]);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'show_face_fanpage_plugin',
    array(
        'label' => __('Show Facebook Fanpage', THEMENAME),
        'section' => 'section_socials',
        'settings' => 'show_face_fanpage_plugin',
        'type' => 'select',
        'choices' => $choices
    ) ) );

    // ================================== HEADER SETTINGS =================================
    $listColors[] = array(
        'slug' => 'header_background_color', 
        'default' => '#fff',
        'label' => __('Menu Background', THEMENAME)
    );

    $listColors[] = array(
        'slug'=>'header_background_color_fixed', 
        'default' => '#fff',
        'label' => __('Menu Background fixed', THEMENAME)
    );

    $listColors[] = array(
        'slug'=>'header_home_icon_color', 
        'default' => '#fff',
        'label' => __('Home icon color', THEMENAME)
    );

    $listColors[] = array(
        'slug'=>'header_link_color', 
        'default' => '#333',
        'label' => __('Menu Link color', THEMENAME)
    );
    $listColors[] = array(
        'slug'=>'header_hover_link_color', 
        'default' => '#333',
        'label' => __('Menu Color-on hover', THEMENAME)
    );

    $listColors[] = array(
        'slug'=>'header_background_submenu', 
        'default' => '#fff',
        'label' => __('Sub-menu Background', THEMENAME)
    );

    $listColors[] = array(
        'slug'=>'header_link_color_sub', 
        'default' => '#333',
        'label' => __('Sub-menu Link color', THEMENAME)
    );

    $listColors[] = array(
        'slug'=>'header_link_color_sub_hover', 
        'default' => '#333',
        'label' => __('Sub-menu Link on Hover', THEMENAME)
    );    

    $wp_customize->add_section(
        "section_header_settings", 
        array(
            'title' => __("Header colors", THEMENAME),
            'priority' => 122,
            'description' => __('Description Custom header setting', THEMENAME),
        )
    );

    // add the settings and controls for each color
    foreach( $listColors as $itemColor ) {
        // SETTINGS
        $wp_customize->add_setting(
            $itemColor['slug'], array(
                'default' => $itemColor['default']
            )
        );

        // CONTROLS
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $itemColor['slug'], 
                array(
                    'label' => $itemColor['label'], 
                    'section' => 'section_header_settings',
                    'settings' => $itemColor['slug']
                )
            )
        );
    }
}
add_action( 'customize_register', 'your_theme_new_customizer_settings' );

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function ws24h_customize_preview_js() {
	wp_enqueue_script( 'ws24h-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'ws24h_customize_preview_js' );