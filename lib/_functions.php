<?php
require_once ('front-end/template-tags.php');
$enum_layout = [
    'full'  => [
        'sidebar'   => false,
        'second'    => false,
        'main'      => 'main-content col-lg-12',
        'key'       => 'full-width'
    ],
    'left-sidebar'  => [
        'sidebar'   => 'sidebar col-lg-3',
        'second'    => false,
        'main'      => 'main-content col-lg-9',
        'key'       => 'left-sidebar'
    ],
    'right-sidebar' => [
        'sidebar'   => 'sidebar col-lg-3',
        'second'    => false,
        'main'      => 'main-content col-lg-9',
        'key'       => 'right-sidebar'
    ],
    'wide-2cols'    => [
        'sidebar'   => 'sidebar col-lg-4',
        'second'    => 'second-sidebar col-lg-2',
        'main'      => 'main-content col-lg-6',
        'key'       => 'wide-2cols'
    ],
    '2cols-wide'     => [
        'sidebar'   => 'sidebar col-lg-3',
        'second'    => 'second-sidebar col-lg-3',
        'main'      => 'main-content col-lg-6',
        'key'       => '2cols-wide'
    ],
    'col-wide-col'  => [
        'sidebar'   => 'sidebar col-lg-3',
        'second'    => 'second-sidebar col-lg-3',
        'main'      => 'main-content col-lg-6',
        'key'       => 'col-wide-col'
    ]
];
function get_layout () {
    global $enum_layout;
    // full
    // left-sidebar
    // right-sidebar
    // wide 2 cols
    // 2 cols wide
    // col wide col
    return $enum_layout['wide-2cols'];    
}

function get_main_sidebar () {
    return get_layout()['sidebar'];
}

function get_second_sidebar () {
    return get_layout()['second'];
}

function get_main_layout () {
    return get_layout()['main'];
}

function get_main_layout_key () {
    return get_layout()['key'];
}