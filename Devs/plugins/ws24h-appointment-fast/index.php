<?php
/**
 * Plugin Name: Ws24h Fast Appointment
 * Description: This is my plugin! It makes social support
 * Author: leotrinh
 * Version: 1.0
 */

#defined
$tableName = 'appointment';

// Activation #Activation
// To set up an activation hook, use the register_activation_hook() function:
register_activation_hook(__FILE__, 'ws24h_fast_appointment_activation_hook');
function ws24h_fast_appointment_activation_hook(){
    // Code here for init activation ...
    require_once('init_database.php' );
}

register_deactivation_hook( __FILE__, 'ws24h_fast_appointment_deactivation_hook' );
function ws24h_fast_appointment_deactivation_hook(){
    // Code here for init deactivation ...
}

register_uninstall_hook(__FILE__, 'delete_plugin_database_table');
function delete_plugin_database_table(){
    // Code here for delete plugin ...
    global $wpdb, $tableName;
    $table_name = $wpdb->prefix . $tableName;
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);
}

define('PLUGIN_NAME', __("Ws24h Fast Appointment"));
define('PLUGIN_DES', __("Description Custom Ws24h Fast Appointment Options here"));
define('PLUGIN_PREF', 'ws24h_');

add_action( 'customize_register', 'ws24h_fast_appointment_new_customizer_settings' );
function ws24h_fast_appointment_new_customizer_settings($wp_customize){
    
    // Create section
    $supportSection = PLUGIN_PREF . 'fast_appointment_section';
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

function ws24h_fast_appointment_load_scripts($hook) {
    // Code here for load scripts
}
add_action('wp_enqueue_scripts', 'ws24h_fast_appointment_load_scripts');

add_action( 'wp_footer', 'ws24h_fast_appointment_online' );
function ws24h_fast_appointment_online(){
    ?>
    <div class="support-online" rel="nofollow">
        <div class="support-content-call">
            <a href='tel:<?= get_theme_mod(PLUGIN_PREF . 'hotline_number')?>' class="call-now">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <div class="animated infinite zoomIn kenit-alo-circle"></div>
                <div class="animated infinite pulse kenit-alo-circle-fill"></div>
                <span>Call: <?= get_theme_mod(PLUGIN_PREF . 'hotline_number')?></span>
            </a>
            <a class="zalo" href="http://zalo.me/<?= get_theme_mod(PLUGIN_PREF . 'zalo_number')?>">
                <img alt="Zalo" src="<?= plugins_url( '/assets/images/zalo_icon.png', __FILE__ ) ?>">
                <span>Zalo: <?= get_theme_mod(PLUGIN_PREF . 'zalo_number')?></span>
            </a>
            <a class="sms" href="sms:<?= get_theme_mod(PLUGIN_PREF . 'sms_number')?>?body=<?= get_the_title()?>">
                <i class="fa fa-comments" aria-hidden="true"></i>
                <span>SMS: <?= get_theme_mod(PLUGIN_PREF . 'sms_number')?></span>
            </a>
        </div>
    </div>
    <?php
}