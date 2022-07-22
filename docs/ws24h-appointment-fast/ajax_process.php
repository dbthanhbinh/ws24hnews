<?php
add_action( 'wp_ajax_our_app_updatequickedit', 'our_app_updatequickedit_init' );
add_action( 'wp_ajax_nopriv_our_app_updatequickedit', 'our_app_updatequickedit_init' );
function our_app_updatequickedit_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $action = $_REQUEST['action'];
    $updateId = $_REQUEST['updateId'];
    $prefix = $_REQUEST['prefix'];
    $appTypeof = $_REQUEST['appTypeof'];
    $dataObjs = $_REQUEST['dataObjs'];
    $tablename = $_REQUEST['table'];

    $data = null;
    if ($appTypeof == 'app-ourtimesheet') {
        $data = [
            'scope' => $dataObjs['scope'],
            'slots' => $dataObjs['slots'],
            'ordering' => $dataObjs['ordering'],
        ];
    } else if ($appTypeof == 'app-ourservice') {
        $data = [
            'title' => $dataObjs['title'],
            'price' => $dataObjs['price'],
            'discount' => $dataObjs['discount'],
            'category_id' => $dataObjs['category'],
            'ordering' => $dataObjs['ordering']
        ];
    } else if ($appTypeof == 'app-ourcategory') {
        $data = [
            'title' => $dataObjs['title'],
            'summaries' => $dataObjs['summaries'],
            'ordering' => $dataObjs['ordering']
        ];
    }
    if ($appTypeof && $tablename && $data) {
        $wpdb->update($tablename, 
            $data,
            ['id' => $updateId]
        );
    }

    $result = ob_get_clean();
    wp_send_json_success($result);
 
    die();//bắt buộc phải có khi kết thúc
}

add_action( 'wp_ajax_ourpricing_cat_updatequickedit', 'ourpricing_cat_quickeditupdatequickedit_init' );
add_action( 'wp_ajax_nopriv_ourpricing_cat_updatequickedit', 'ourpricing_cat_quickeditupdatequickedit_init' );
function ourpricing_cat_quickeditupdatequickedit_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $action = $_REQUEST['action'];
    $updateId = $_REQUEST['updateId'];
    $prefix = $_REQUEST['prefix'];
    $dataObjs = $_REQUEST['dataObjs'];

    $data = [
        'title' => $dataObjs['title'],
        'summaries' => $dataObjs['summaries'],
        'ordering' => $dataObjs['ordering']
    ];

    $tablename = $_REQUEST['table'];
    $wpdb->update($tablename,
        $data,
        ['id' => $updateId]
    );
    
    $result = ob_get_clean();
    wp_send_json_success($result);
 
    die();//bắt buộc phải có khi kết thúc
}

add_action( 'wp_ajax_timesheet_updatequickedit', 'timesheet_updatequickedit_init' );
add_action( 'wp_ajax_nopriv_timesheet_updatequickedit', 'timesheet_updatequickedit_init' );
function timesheet_updatequickedit_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    $action = $_REQUEST['action'];
    $updateId = $_REQUEST['updateId'];
    $prefix = $_REQUEST['prefix'];
    $dataObjs = $_REQUEST['dataObjs'];
    
    $data = [
        'scope' => $dataObjs['scope'],
        'slots' => $dataObjs['slots'],
        'ordering' => $dataObjs['ordering'],
    ];

    $tablename = $_REQUEST['table'];
    $wpdb->update($tablename, 
        $data,
        ['id' => $updateId]
    );
    
    $result = ob_get_clean();
    wp_send_json_success($result);
 
    die();//bắt buộc phải có khi kết thúc
}

// Delete itemset
add_action( 'wp_ajax_ourpricing_deleteitemset', 'ourpricing_deleteitemset_init' );
add_action( 'wp_ajax_nopriv_ourpricing_deleteitemset', 'ourpricing_deleteitemset_init' );
function ourpricing_deleteitemset_init() {
    ob_start(); //bắt đầu bộ nhớ đệm
    global $wpdb;
    
    $delId = $_REQUEST['delId'];
    $tablename = $_REQUEST['table'];
    $wpdb->delete( $tablename, array( 'id' => $delId ) );
    $result = ob_get_clean(); //cho hết bộ nhớ đệm vào biến $result
    wp_send_json_success($result); // trả về giá trị dạng json
 
    die();//bắt buộc phải có khi kết thúc
}