<?php
/**
 * Plugin Name: Ws24h Fast Appointment
 * Description: This is my plugin! It makes social support
 * Author: leotrinh
 * Version: 1.0
 */

#Defined
define('PLUGIN_NAME', __("Ws24h Fast Appointment"));
define('PLUGIN_DES', __("Description Custom Ws24h Fast Appointment Options here"));
define('PLUGIN_PREFIX', 'appointment_');
define('PLUGIN_DOMAIN', 'ws24h');

global $wpdb, $appointmentsTableName, $timesheetsTableName, $optionsTableName, $categorysTableName, $ourservicesTableName, $scopeResults;

$appointmentsTableName = $wpdb->prefix . PLUGIN_PREFIX . 'appointments';
$timesheetsTableName = $wpdb->prefix . PLUGIN_PREFIX . 'timesheets';
$optionsTableName = $wpdb->prefix . PLUGIN_PREFIX . 'options';
$categorysTableName = $wpdb->prefix . PLUGIN_PREFIX . 'categorys';
$ourservicesTableName = $wpdb->prefix . PLUGIN_PREFIX . 'ourservices';
$scopeResults = [
    10 => "8:00 AM-10:00 AM",
    12 => "10:00 AM-12:00 AM",
    14 => "12:00 AM-14:00 PM",
    16 => "14:00 PM-16:00 PM",
    18 => "16:00 PM-18:00 PM",
    20 => "18:00 PM-20:00 PM"
];

// Activation #Activation
register_activation_hook(__FILE__, 'ws24h_fast_appointment_activation_hook');
function ws24h_fast_appointment_activation_hook(){
    // Code here for init activation ...
    require_once('database/init_database.php' );
}

// Deactivation #Deactivation
register_deactivation_hook( __FILE__, 'ws24h_fast_appointment_deactivation_hook' );
function ws24h_fast_appointment_deactivation_hook(){
    // Code here for init deactivation ...
}

// Uninstall #Uninstall
register_uninstall_hook(__FILE__, 'delete_plugin_database_table');
function delete_plugin_database_table(){
    // Code here for delete plugin ...
    global $wpdb, $appointmentsTableName, $timesheetsTableName, $optionsTableName, $categorysTableName, $ourservicesTableName;
    $sql = "DROP TABLE IF EXISTS $appointmentsTableName";
    $wpdb->query($sql);

    $sql = "DROP TABLE IF EXISTS $timesheetsTableName";
    $wpdb->query($sql);

    $sql = "DROP TABLE IF EXISTS $optionsTableName";
    $wpdb->query($sql);

    $sql = "DROP TABLE IF EXISTS $categorysTableName";
    $wpdb->query($sql);

    $sql = "DROP TABLE IF EXISTS $ourservicesTableName";
    $wpdb->query($sql);
}

/**
 * Ajax process
 */
require_once('ajax_process.php' );

/**
 * Add options page
 */
add_action('admin_menu', 'appointment_admin_menu');
function appointment_admin_menu() {
    $page_title = 'Appointments';
    $menu_title = 'Appointments';
    $capability = 'manage_options';
    $menu_slug = 'appointments';
    $function = 'admin_appointment_appointments'; 
    $icon_url = '';
    $position = null;
    add_menu_page ($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);

    $parent_slug = 'appointments';
    $page_title = 'Category';
    $menu_title = 'Category';
    $capability = 'manage_options';
    $menu_slug = 'our-categories';
    $function = 'admin_appointment_categories';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);

    $parent_slug = 'appointments';
    $page_title = 'Our service';
    $menu_title = 'Our service';
    $capability = 'manage_options';
    $menu_slug = 'our-services';
    $function = 'admin_appointment_ourpricings';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);
    
    $parent_slug = 'appointments';
    $page_title = 'Time sheet';
    $menu_title = 'Time sheet';
    $capability = 'manage_options';
    $menu_slug = 'time-sheets';
    $function = 'admin_appointment_timesheets';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);

    // Sub menu setting
    $parent_slug = 'appointments';
    $page_title = 'Setting';
    $menu_title = 'Setting';
    $capability = 'manage_options';
    $menu_slug = 'appointment-setting';
    $function = 'admin_appointment_setting';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);
}

function admin_appointment_setting(){
    require_once('setting.php');
}

function admin_appointment_appointments(){
    require_once('appointments/admin/appointments.php' );
}

function admin_appointment_timesheets(){
    require_once('appointments/admin/timeSheetFormAdmin.php');
}

function admin_appointment_categories() {
    require('our-pricing/admin/ourPricingCategory.php');
}

function admin_appointment_ourpricings() {
    require('our-pricing/admin/ourPricingForm.php');
}

add_action('act_appointment_form', 'on_act_appointment_form');
function on_act_appointment_form(){
    require_once('appointments/appointment.php' );
}

// For Frontend UI
add_action('wp_head', 'ws24h_plugin_appointment_style');
function ws24h_plugin_appointment_style(){
    ?>
    <link rel="stylesheet" type="text/css" href="<?= plugin_dir_url(__FILE__) . 'assets/jquery.datetimepicker.css'?>"/>
    <link rel="stylesheet" type="text/css" href="<?= plugin_dir_url(__FILE__) . 'assets/css/ws24h.plugin.min.css'?>"/>
    <script type="text/javascript">
        var adminAjax = '<?php echo admin_url('admin-ajax.php');?>';
    </script>
    <?php
}

add_action('wp_footer', 'ws24h_plugin_appointment_script', 100);
function ws24h_plugin_appointment_script(){
    ?>
        <script type="text/javascript" src="<?= plugin_dir_url(__FILE__) . 'assets/jquery.datetimepicker.js'?>"></script>
        <script type="text/javascript" src="<?= plugin_dir_url(__FILE__) . 'assets/js/ws24h.plugin.min.js'?>"></script>
    <?php
}

// For admin
add_action('admin_head', 'admin_appointment_style_function');
function admin_appointment_style_function(){
    ?>
    <link rel="stylesheet" type="text/css" href="<?= plugin_dir_url(__FILE__) . 'assets/css/admin.ws24h.plugin.min.css'?>"/>
    <script type="text/javascript">
        var adminAjax = '<?php echo admin_url('admin-ajax.php');?>';
    </script>
    <?php
}

function admin_appointment_footer_function() {
    ?>
    <script type="text/javascript" src="<?= plugin_dir_url(__FILE__) . 'dev/admin/js/jquery.admin.ourpricing.js'?>"></script>
    <?php
}
add_action('admin_footer', 'admin_appointment_footer_function', 100);