<?php
$defaultsValues = array(
    'title' => '',
    'background_color' => '#f1f1f1',
    'title_color' => '#000000',
    'icon_color' => '#f1f1f1',
    'span_color' => '#f1f1f1',
    'border_top_color' => '#f1f1f1',
    'cats_id' => null,
    'latest' => true,
    'excerpt_len' => 150,
    'excerpt_hidden' => false,
    'no_of_posts' => 5,
    'thumb' => true,
    'thumb_full' => false
);

$defaultItems = [
    'background_color' => [
        'title' => __('Background color', THEMENAME),
        'color' => $defaultsValues['background_color'],
        'class' => 'set_background_color'
    ],
    'title_color' => [
        'title' => __('Title color', THEMENAME),
        'color' => $defaultsValues['title_color'],
        'class' => 'set_title_color'
    ],
    'icon_color' => [
        'title' => __('Icon color', THEMENAME),
        'color' => $defaultsValues['icon_color'],
        'class' => 'set_icon_color'
    ],
    'span_color' => [
        'title' => __('Span color', THEMENAME),
        'color' => $defaultsValues['span_color'],
        'class' => 'set_span_color'
    ],
    'border_top_color' => [
        'title' => __('Border top color', THEMENAME),
        'color' => $defaultsValues['border_top_color'],
        'class' => 'set_border_top_color'
    ]
];