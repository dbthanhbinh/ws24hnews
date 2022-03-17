<?php
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