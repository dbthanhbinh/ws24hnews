<?php
function appointment_create_db() {
    global $wpdb, $appointmentsTableName, $timesheetsTableName, $optionsTableName, $categorysTableName, $ourservicesTableName;
    $charset_collate = $wpdb->get_charset_collate();
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    //* Create the appointment table
    $sql = "CREATE TABLE $appointmentsTableName (
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
    maybe_create_table($appointmentsTableName, $sql);

    
    //* Create the timesheets table
    $sql = "CREATE TABLE $timesheetsTableName (
        id INTEGER NOT NULL AUTO_INCREMENT,
        scope INTEGER NOT NULL,
        is_active boolean NOT NULL DEFAULT 1,
        ordering INTEGER NULL,
        slots INTEGER NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    maybe_create_table($timesheetsTableName, $sql);

    //* Create the options table
    $sql = "CREATE TABLE $optionsTableName (
        id INTEGER NOT NULL AUTO_INCREMENT,
        key_name varchar(255) NOT NULL,
        option_name varchar(255) NOT NULL,
        option_value TEXT NULL,
        is_active boolean NOT NULL DEFAULT 1,
        PRIMARY KEY (id)
    ) $charset_collate;";
    maybe_create_table($optionsTableName, $sql);

    //* Create the category table
    $sql = "CREATE TABLE $categorysTableName (
        id INTEGER NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        summaries varchar(255) NOT NULL,
        ordering INTEGER NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    maybe_create_table($categorysTableName, $sql);

    
    //* Create the ourservices table
    $sql = "CREATE TABLE $ourservicesTableName (
        id INTEGER NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        summaries varchar(255) NOT NULL,
        price FLOAT NULL,
        discount FLOAT NULL,
        ordering INTEGER NOT NULL,
        category_id INTEGER NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    maybe_create_table($ourservicesTableName, $sql);
}
appointment_create_db();