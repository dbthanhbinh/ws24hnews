<?php
function checkAvailableSlots($year, $month, $date, $timesetId) {
    global $wpdb;
    // Appointments
    $tableAppointments = $wpdb->prefix.'appointments';
    $timesheetTb = $wpdb->prefix.'appointment_timesheet';
    
    $query = "
    SELECT atb.*, ttb.range_name as rangeName, ttb.slots as slots
        FROM $tableAppointments as atb
        LEFT JOIN $timesheetTb as ttb
        ON atb.timeset = ttb.id
        WHERE atb.set_year = $year AND atb.set_month = $month AND atb.set_date = $date AND atb.timeset = $timesetId
    ";
    return $wpdb->get_results( $query, OBJECT);
}

// ===============================================
add_action( 'wp_ajax_addappointment', 'addappointment_init' );
add_action( 'wp_ajax_nopriv_addappointment', 'addappointment_init' );
function addappointment_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $tablename = $wpdb->prefix.'appointments';
    $setDate = $_REQUEST['setDate'];
    $setDates = explode("-", $setDate);

    $slots = -1;
    $rs = checkAvailableSlots($setDates[0], $setDates[1], $setDates[2], $_REQUEST['timeSetId']);
    if($rs) {
        $slots = $rs[0]->slots;
    }

    $result = [
        "error" => false,
        "errorMsg" => ""
    ];

    if($rs && $slots != -1 && count($rs) >= $slots) {
        $result["error"] = true;
        $result["errorMsg"] = "Đã hết chỗ!";
        wp_send_json_success($result); // trả về giá trị dạng json
    } else {
        $data=array(
            'full_name' => $_REQUEST['fullName'],
            'phone' => $_REQUEST['phone'],
            'custom_note' => $_REQUEST['customNote'],
            'admin_note' => '',
            'set_year' => $setDates[0],
            'set_month' => $setDates[1],
            'set_date' => $setDates[2],
            'timeset' => $_REQUEST['timeSetId'],
            'service_id' => $_REQUEST['serviceId'],
            'is_new' => 1,
            'coupon' => $_REQUEST['coupon'],
            'created' => date("Y-m-d H:i:s") // 2021-09-14 14:48:11
        );
        $wpdb->insert( $tablename, $data);
        $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
        wp_send_json_success($result); // trả về giá trị dạng json
    }

    die();//bắt buộc phải có khi kết thúc
}

// load timeset
add_action( 'wp_ajax_loadtimeset', 'loadtimeset_init' );
add_action( 'wp_ajax_nopriv_loadtimeset', 'loadtimeset_init' );
function loadtimeset_init() {
    // ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb, $scopeTimes;

    $setDate = $_REQUEST['setDate'];
    $setDates = explode("-", $setDate);
    // timesheet
    // $tablename = $wpdb->prefix.'appointment_timesheet';
    // $timesheet = $wpdb->get_results(
    //     "SELECT * FROM $tablename"
    // );

    $timesheetTb = $wpdb->prefix . 'appointment_timesheet';
    $scopeTb = $wpdb->prefix . 'appointment_scope';
    $query = "
        SELECT atb_time.*, scope_tb.name_service as range_name
        FROM $timesheetTb as atb_time
        LEFT JOIN $scopeTb as scope_tb
        ON scope_tb.id = atb_time.scope
    ";
    $timesheet = $wpdb->get_results($query);

    // Appointments
    $tableAppointments = $wpdb->prefix.'appointments';
    $appointments = $wpdb->get_results(
        "SELECT DISTINCT COUNT(*) as count, `timeset`
            FROM $tableAppointments
            WHERE set_year=".$setDates[0]." AND set_month=".$setDates[1]." AND set_date=".$setDates[2]."
            GROUP BY `timeset`"
    );
    $dicAppointments = [];
    if($appointments && count($appointments) > 0){
        foreach($appointments as $appointment){
            $dicAppointments[$appointment->timeset] = (int)$appointment->count;
        }
    }

    if($timesheet && count($timesheet) > 0){
        date_default_timezone_set("Asia/Bangkok"); /////
        $currentHour = date("G");
        $currentDate = date("d");
        foreach($timesheet as $timeset){
            // in day
            if($setDates[2] == $currentDate) {
                if($currentHour <= 15) {
                    if($timeset->slots <= 0){
                        $timeset->available = true;
                    } else {
                        $timeset->available = (isset($dicAppointments[$timeset->id]) && $dicAppointments[$timeset->id] >= $timeset->slots) ? false : true;
                    }
                }
                else {
                    $timeset->available = false;
                } 
            }
            else { // other day
                if($timeset->slots <= 0){
                    $timeset->available = true;
                } else {
                    $timeset->available = (isset($dicAppointments[$timeset->id]) && $dicAppointments[$timeset->id] >= $timeset->slots) ? false : true;
                }
            }
        }
    }
    wp_send_json_success($timesheet);
    die();
}

add_action( 'wp_ajax_deletetimeset', 'deletetimeset_init' );
add_action( 'wp_ajax_nopriv_deletetimeset', 'deletetimeset_init' );
function deletetimeset_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $tablename = $wpdb->prefix.'appointment_timesheet';
    $delId = $_REQUEST['delId'];
    $wpdb->delete( $tablename, array( 'id' => $delId ) );
    $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    wp_send_json_success($result); // trả về giá trị dạng json
 
    die();//bắt buộc phải có khi kết thúc
}

add_action( 'wp_ajax_updatequickedit', 'quickeditupdatequickedit_init' );
add_action( 'wp_ajax_nopriv_updatequickedit', 'quickeditupdatequickedit_init' );
function quickeditupdatequickedit_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $updateId = $_REQUEST['updateId'];
    $quickEditName = $_REQUEST['quickEditName'];
    $quickedittypeof = $_REQUEST['quickedittypeof'];
    $quickEditSlots = $_REQUEST['quickEditSlots'];
    $quickEditScope = $_REQUEST['quickEditScope'];
    $quickEditOrdering = $_REQUEST['quickEditOrdering'];

    if($quickedittypeof == 'app-service') {
        $tablename = $wpdb->prefix.'appointment_service';
        $wpdb->update( $tablename, ['name_service' => $quickEditName, 'ordering' => $quickEditOrdering], ['id' => $updateId]);
    } else {
        $tablename = $wpdb->prefix.'appointment_timesheet';
        $wpdb->update( $tablename, ['range_name' => $quickEditName, 'slots' => $quickEditSlots, 'scope' => $quickEditScope, 'ordering' => $quickEditOrdering], ['id' => $updateId]);
    }
    
    $result = ob_get_clean();
    wp_send_json_success($result);
 
    die();//bắt buộc phải có khi kết thúc
}

// ---------------------
add_action( 'wp_ajax_quickupdateappointment', 'quickupdateappointment_init' );
add_action( 'wp_ajax_nopriv_quickupdateappointment', 'quickupdateappointment_init' );
function quickupdateappointment_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $tablename = $wpdb->prefix.'appointments';
    $updateId = $_REQUEST['updateId'];
    $quickEditName = $_REQUEST['quickEditName'];
    $quickEditPhone = $_REQUEST['quickEditPhone'];
    $quickEditCustomerNote = $_REQUEST['quickEditCustomerNote'];
    $quickEditAdminNote = $_REQUEST['quickEditAdminNote'];
    $quickEditCoupon = $_REQUEST['quickEditCoupon'];

    $wpdb->update( $tablename, 
        [
            'full_name' => $quickEditName,
            'phone' => $quickEditPhone,
            'custom_note' => $quickEditCustomerNote,
            'admin_note' => $quickEditAdminNote,
            'coupon' => $quickEditCoupon
        ],
        ['id' => $updateId]
    );
    $result = ob_get_clean();
    wp_send_json_success($result);
 
    die();//bắt buộc phải có khi kết thúc
}

// Delete appointment
add_action( 'wp_ajax_deleteappointment', 'deleteappointment_init' );
add_action( 'wp_ajax_nopriv_deleteappointment', 'deleteappointment_init' );
function deleteappointment_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $tablename = $wpdb->prefix.'appointments';
    $delId = $_REQUEST['delId'];
    $wpdb->delete( $tablename, array( 'id' => $delId ) );
    $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    wp_send_json_success($result); // trả về giá trị dạng json
 
    die();//bắt buộc phải có khi kết thúc
}