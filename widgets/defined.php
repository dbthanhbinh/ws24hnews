<?php
$defaultsColors = array(
    'background_color' => '#f1f1f1',
    'title_color' => '#000000',
    'icon_color' => '#f1f1f1',
    'span_color' => '#f1f1f1',
    'border_top_color' => '#f1f1f1'
);

$defaultItems = [
    'background_color' => [
        'title' => __('Background color', THEME_NAME),
        'color' => $defaultsColors['background_color'],
        'class' => 'set_background_color'
    ],
    'title_color' => [
        'title' => __('Title color', THEME_NAME),
        'color' => $defaultsColors['title_color'],
        'class' => 'set_title_color'
    ],
    'icon_color' => [
        'title' => __('Icon color', THEME_NAME),
        'color' => $defaultsColors['icon_color'],
        'class' => 'set_icon_color'
    ],
    'span_color' => [
        'title' => __('Span color', THEME_NAME),
        'color' => $defaultsColors['span_color'],
        'class' => 'set_span_color'
    ],
    'border_top_color' => [
        'title' => __('Border top color', THEME_NAME),
        'color' => $defaultsColors['border_top_color'],
        'class' => 'set_border_top_color'
    ]
];