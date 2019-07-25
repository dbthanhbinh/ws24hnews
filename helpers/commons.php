<?php
function getConfigVersion(){ return 'v2'; }
function getHeaderClassConfigVersion(){ 
    return 'header-version-' . getConfigVersion();
}