<?php
$districts = [
    [
        "name" => "Q.12",
        "type" => "quan",
        "slug" => "quan-12",
    ],
    [
        "name" => "Q.1",
        "type" => "quan",
        "slug" => "quan-1",
    ],
    [
        "name" => "Q.2",
        "type" => "quan",
        "slug" => "quan-2",
    ],
    [
        "name" => "Q.3",
        "type" => "quan",
        "slug" => "quan-3",
    ],
    [
        "name" => "Q.4",
        "type" => "quan",
        "slug" => "quan-4",
    ],
    [
        "name" => "Q.5",
        "type" => "quan",
        "slug" => "quan-5",
    ],
    [
        "name" => "Q.6",
        "type" => "quan",
        "slug" => "quan-6",
    ],
    [
        "name" => "Q.7",
        "type" => "quan",
        "slug" => "quan-7",
    ],
    [
        "name" => "Q.8",
        "type" => "quan",
        "slug" => "quan-8",
    ],
    [
        "name" => "Q.9",
        "type" => "quan",
        "slug" => "quan-9",
    ],
    [
        "name" => "Q.10",
        "type" => "quan",
        "slug" => "quan-10",
    ],
    [
        "name" => "Q.11",
        "type" => "quan",
        "slug" => "quan-11",
    ],
    [
        "name" => "Thủ Đức",
        "type" => "quan",
        "slug" => "thu-duc",
    ],
    [
        "name" => "Gò Vấp",
        "type" => "quan",
        "slug" => "go-vap",
    ],
    [
        "name" => "Bình Thạnh",
        "type" => "quan",
        "slug" => "binh-thanh",
    ],
    [
        "name" => "Tân Bình",
        "type" => "quan",
        "slug" => "tan-binh",
    ],
    [
        "name" => "Tân Phú",
        "type" => "quan",
        "slug" => "tan-phu",
    ],
    [
        "name" => "Phú Nhuận",
        "type" => "quan",
        "slug" => "phu-nhuan",
    ],
    [
        "name" => "Bình Tân",
        "type" => "quan",
        "slug" => "binh-tan",
    ],
    [
        "name" => "Củ Chi",
        "type" => "huyen",
        "slug" => "cu-chi",
    ],
    [
        "name" => "Hóc Môn",
        "type" => "huyen",
        "slug" => "hoc-mon",
    ],
    [
        "name" => "Bình Chánh",
        "type" => "huyen",
        "slug" => "binh-chanh",
    ],
    [
        "name" => "Nhà Bè",
        "type" => "huyen",
        "slug" => "nha-be",
    ],
    [
        "name" => "Cần Giờ",
        "type" => "huyen",
        "slug" => "can-gio",
    ]
];

$enum_layout = [
    'full'  => [
        'sidebar'   => false,
        'second'    => false,
        'main'      => 'main-content col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12',
        'key'       => 'full-width'
    ],
    'left-sidebar'  => [
        'sidebar'   => 'sidebar col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3',
        'second'    => false,
        'main'      => 'main-content col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9',
        'key'       => 'left-sidebar'
    ],
    'right-sidebar' => [
        'sidebar'   => 'sidebar col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3',
        'second'    => false,
        'main'      => 'main-content col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9',
        'mainfull'  => 'main-content col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9',
        'key'       => 'right-sidebar'
    ],
    'wide-2cols'    => [
        'sidebar'   => 'sidebar col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4',
        'second'    => 'second-sidebar col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3',
        'main'      => 'main-content col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5',
        'key'       => 'wide-2cols'
    ],
    '2cols-wide'     => [
        'sidebar'   => 'sidebar col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3',
        'second'    => 'second-sidebar col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3',
        'main'      => 'main-content col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6',
        'key'       => '2cols-wide'
    ],
    'col-wide-col'  => [
        'sidebar'   => 'sidebar col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3',
        'second'    => 'second-sidebar col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3',
        'main'      => 'main-content col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6',
        'key'       => 'col-wide-col'
    ]
];