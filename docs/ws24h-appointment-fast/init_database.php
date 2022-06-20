<?php
function appointment_create_db() {
    global $wpdb, $tableName;
    $charset_collate = $wpdb->get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   
    //* Create the appointment table
    $table_name = $wpdb->prefix . 'appointments';
    $sql = "CREATE TABLE $table_name (
        id INTEGER NOT NULL AUTO_INCREMENT,
        full_name varchar(255) NOT NULL,
        phone varchar(255) NOT NULL,
        custom_note TEXT NULL,
        admin_note TEXT NULL,
        set_year INTEGER NOT NULL,
        set_month INTEGER NOT NULL,
        set_date INTEGER NOT NULL,
        timeset varchar(50) NOT NULL,
        service_id INTEGER NOT NULL,
        is_new boolean NOT NULL DEFAULT 1,
        coupon varchar(50) NULL,
        created datetime NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta( $sql );

    
    //* Create the timeset table
    $table_name = $wpdb->prefix . 'appointment_timesets';
    $sql = "CREATE TABLE $table_name (
        id INTEGER NOT NULL AUTO_INCREMENT,
        scope INTEGER NOT NULL,
        is_active boolean NOT NULL DEFAULT 1,
        ordering INTEGER NULL,
        slots INTEGER NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta( $sql );

    //* Create the appointment options table
    $table_name = $wpdb->prefix . 'appointment_options';
    $sql = "CREATE TABLE $table_name (
        id INTEGER NOT NULL AUTO_INCREMENT,
        key_name varchar(255) NOT NULL,
        option_name varchar(255) NOT NULL,
        option_value TEXT NULL,
        is_active boolean NOT NULL DEFAULT 1,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta( $sql );

    //* Create the services options table
    $table_name = $wpdb->prefix . 'appointment_service';
    $sql = "CREATE TABLE $table_name (
        id INTEGER NOT NULL AUTO_INCREMENT,
        name_service varchar(255) NOT NULL,
        ordering INTEGER NULL,
        is_active boolean NOT NULL DEFAULT 1,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta( $sql );

    //* Create the scope time table
    $table_name = $wpdb->prefix . 'appointment_scope';
    $sql = "CREATE TABLE $table_name (
        id INTEGER NOT NULL AUTO_INCREMENT,
        name_service varchar(255) NOT NULL,
        ordering INTEGER NULL,
        is_active boolean NOT NULL DEFAULT 1,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta( $sql );
}
appointment_create_db();