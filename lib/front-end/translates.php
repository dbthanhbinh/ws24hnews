<?php
$translates = [
    'search_btn' => 'Tìm'
    'search_placeholder' => 'Tìm...'
];

function getTranslateByKey($key){
    return (isset($translates) && isset($translates[$key])) ? $translates[$key] : null;
}