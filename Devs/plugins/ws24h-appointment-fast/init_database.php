<?php
function appointment_create_db() {
    global $wpdb, $tableName;
    $charset_collate = $wpdb->get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   
    //* Create the teams table
    $table_name = $wpdb->prefix . $tableName;
    $sql = "CREATE TABLE $table_name (
        id INTEGER NOT NULL AUTO_INCREMENT,
        full_name varchar(255) NOT NULL,
        phone varchar(255) NOT NULL,
        note TEXT NULL,
        timeset datetime NOT NULL,
        service_id INTEGER NOT NULL,
        is_new boolean NOT NULL DEFAULT 1,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta( $sql );
}
appointment_create_db();