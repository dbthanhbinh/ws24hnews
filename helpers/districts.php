<?php
require_once ('enums.php');
function getDistrictName($key){
	if(!$key) return null;
	global $districts;
	foreach ($districts as $key=>$item) {
		if($item['slug'] == $key)
			return $item['name'];
	}
	return null;
}