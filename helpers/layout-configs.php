<?php
require_once ('enums.php');
$layout = 'full';
if(is_front_page() || is_home()){
   $layout = get_theme_mod('home_layout');
   $mainLayoutClass = $enum_layout[$layout]['main'];
} else if(is_page()){
   $layout = get_theme_mod('page_layout');
} else if(is_single()){
   $layout = get_theme_mod('single_layout');
} else if(is_archive() || is_search()){
   $layout = get_theme_mod('archive_layout');
} else {
    $layout = 'full';
}

$layoutOptions = (isset($enum_layout) && isset($enum_layout[$layout])) ? $enum_layout[$layout] : $enum_layout['full'];

function isPinLayout() { return false; }
function isMainSidebar() { global $layoutOptions; return $layoutOptions['sidebar'] ? $layoutOptions['sidebar'] : false; }
function isSecondSidebar() { global $layoutOptions; return $layoutOptions['second'] ? $layoutOptions['second'] : false; }
function mainLayoutClass() { global $layoutOptions; return $layoutOptions['main']; }
function mainLayoutKey() { global $layoutOptions; return $layoutOptions['key']; }
function mainLayoutTemplate() { return  isPinLayout() ? 'pinterest-template' : 'article-list'; }