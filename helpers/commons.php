<?php
function getConfigVersion(){ 
    return '-v2';
    // return '';
}
function getHeaderClassConfigVersion(){
    $version = getConfigVersion();
    return $version ? 'header-version' . $version : 'header-version-default';
}