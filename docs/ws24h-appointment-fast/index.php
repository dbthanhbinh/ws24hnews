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
define('PLUGIN_PREF', 'ws24h_');
define('PLUGIN_DOMAIN', 'ws24h');

// Activation #Activation
register_activation_hook(__FILE__, 'ws24h_fast_appointment_activation_hook');
function ws24h_fast_appointment_activation_hook(){
    // Code here for init activation ...
    require_once('init_database.php' );
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
    global $wpdb;
    $tableName = $wpdb->prefix . 'appointments';
    $sql = "DROP TABLE IF EXISTS $tableName";
    $wpdb->query($sql);

    $tableName = $wpdb->prefix . 'appointment_timesets';
    $sql = "DROP TABLE IF EXISTS $tableName";
    $wpdb->query($sql);

    $tableName = $wpdb->prefix . 'appointment_options';
    $sql = "DROP TABLE IF EXISTS $tableName";
    $wpdb->query($sql);

    $tableName = $wpdb->prefix . 'appointment_service';
    $sql = "DROP TABLE IF EXISTS $tableName";
    $wpdb->query($sql);

    $tableName = $wpdb->prefix . 'appointment_scope';
    $sql = "DROP TABLE IF EXISTS $tableName";
    $wpdb->query($sql);
}

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
    $function = 'create_admin_appointment'; 
    $icon_url = '';
    $position = null;
    add_menu_page ($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);

    $parent_slug = 'appointments';
    $page_title = 'Services';
    $menu_title = 'Services';
    $capability = 'manage_options';
    $menu_slug = 'services';
    $function = 'create_admin_services';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);

    $parent_slug = 'appointments';
    $page_title = 'Scope';
    $menu_title = 'Scope';
    $capability = 'manage_options';
    $menu_slug = 'scopes';
    $function = 'create_admin_scopes';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);

    $parent_slug = 'appointments';
    $page_title = 'Range time';
    $menu_title = 'Range time';
    $capability = 'manage_options';
    $menu_slug = 'range_time';
    $function = 'create_admin_range_time';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);

    // Sub menu setting
    $parent_slug = 'appointments';
    $page_title = 'Setting';
    $menu_title = 'Setting';
    $capability = 'manage_options';
    $menu_slug = 'appointment-setting';
    $function = 'create_admin_appointment_setting';
    $position = null;
    add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function, $position);
}

function create_admin_appointment(){
    require_once('appointments.php' );
}

function create_admin_range_time(){
    require_once('range_time_form_admin.php');
}

function create_admin_appointment_setting(){
    require_once('setting.php');
}

function create_admin_services(){
    require_once('service_form_admin.php');
}

function create_admin_scopes(){
    require_once('scopeTimes.php');
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

add_action('act_appointment_form', 'on_act_appointment_form');
function on_act_appointment_form(){
    require_once('appointment.php' );
}


// For admin
add_action('admin_head', 'appointment_admin_style_function');
function appointment_admin_style_function(){
    ?>
    <link rel="stylesheet" type="text/css" href="<?= plugin_dir_url(__FILE__) . 'assets/css/admin.ws24h.plugin.min.css'?>"/>
    <script type="text/javascript">
        var adminAjax = '<?php echo admin_url('admin-ajax.php');?>';
    </script>
    <?php
}

function appointment_admin_footer_function() {
    ?>
    <script type="text/javascript" src="<?= plugin_dir_url(__FILE__) . 'assets/js/admin.ws24h.plugin.min.js'?>"></script>
    <?php
}
add_action('admin_footer', 'appointment_admin_footer_function', 100);