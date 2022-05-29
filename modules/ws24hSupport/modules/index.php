<?php
$isSupportOnline = get_theme_mod('is_support_online');

if (isset($isSupportOnline) && $isSupportOnline) {
    add_action( 'wp_footer', 'ws24h_support_online' );
}

function ws24h_support_online () {
    $template = 2;
    switch($template) {
        case 1:
            require ('template1.php');
            break;
        case 2:
            require ('template2.php');
            break;
        default:
            require ('template1.php');
    }
}