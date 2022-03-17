<?php
/**
 * Plugin Name: Ws24h Support
 * Description: This is my plugin! It makes social support
 * Author: leotrinh
 * Version: 1.0
 */

// Activation #Activation
// To set up an activation hook, use the register_activation_hook() function:
register_activation_hook(__FILE__, 'ws24h_support_activation_hook');
function ws24h_support_activation_hook(){}

register_deactivation_hook( __FILE__, 'ws24h_support_deactivation_hook' );
function ws24h_support_deactivation_hook(){}

define('PLUGIN_NAME', __("Ws24h Support"));
define('PLUGIN_DES', __("Description Custom Ws24h Support Options here"));
define('PLUGIN_PREF', 'ws24h_');

add_action( 'customize_register', 'ws24h_support_new_customizer_settings' );
function ws24h_support_new_customizer_settings($wp_customize){
    
    // Create section
    $supportSection = PLUGIN_PREF . 'support_section';
    $wp_customize->add_section (
        $supportSection,
        array(
            'title' => PLUGIN_NAME,
            'priority' => 131,
            'description' => PLUGIN_DES,
        )
    );

    // Hotline number
    $hotlineNumber = PLUGIN_PREF . 'hotline_number';
    $wp_customize->add_setting($hotlineNumber, ['default' => '0909874825']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $hotlineNumber,
    array(
        'label' => 'Hotline: ex: 0909874825',
        'section' => $supportSection,
        'settings' => $hotlineNumber,
        'type' => 'text'
    ) ) );

    // Zalo number
    $zaloNumber = PLUGIN_PREF . 'zalo_number';
    $wp_customize->add_setting($zaloNumber, ['default' => '0909874825']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $zaloNumber,
    array(
        'label' => 'Zalo number: ex: 0909874825',
        'section' => $supportSection,
        'settings' => $zaloNumber,
        'type' => 'text'
    ) ) );

    // SMS number
    $smsNumber = PLUGIN_PREF . 'sms_number';
    $wp_customize->add_setting($smsNumber, ['default' => '0909874825']);
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, $smsNumber,
    array(
        'label' => 'SMS number: ex: 0909874825',
        'section' => $supportSection,
        'settings' => $smsNumber,
        'type' => 'text'
    ) ) );
}

function ws24h_supportload_scripts($hook) {
    $default = 'default';
    $templateVersion = get_theme_mod('template_version');
    if(isset($templateVersion) && $templateVersion && $templateVersion != 'default') {
        $default = 'ws24h.plugin.' . $templateVersion;
    }

    wp_register_style('ws24h_supportload_style', plugins_url('assets/css/' . $default . '.min.css',__FILE__ ));
    wp_register_style('ws24h_supportload_style_default', plugins_url('assets/css/style.min.css',__FILE__ ));

    wp_enqueue_style('ws24h_supportload_style');
    wp_enqueue_style('ws24h_supportload_style_default');
}
add_action('wp_enqueue_scripts', 'ws24h_supportload_scripts');

require_once ('modules/index.php');