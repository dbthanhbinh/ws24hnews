<?php
function change_post_menu_label() 
{
	global $menu;
	global $submenu;
	$menu[5][0] = __('Sản phẩm',THEMENAME);
	$submenu['edit.php'][5][0] = __('Tất cả Sản phẩm',THEMENAME);
	$submenu['edit.php'][10][0] = __('Sản phẩm mới',THEMENAME);
	//$submenu['edit.php'][15][0] = 'Category';
	//$submenu['edit.php'][16][0] = 'Tag';
	echo '';
}
function change_post_object_label() 
{
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = __('Sản phẩm',THEMENAME);
	$labels->singular_name = __('Sản phẩm',THEMENAME);
	$labels->add_new = __('Thêm mới Sản phẩm',THEMENAME);
	$labels->add_new_item = __('Thêm mới',THEMENAME);
	$labels->edit_item = __('Sửa Sản phẩm',THEMENAME);
	$labels->new_item = __('Sản phẩm mới',THEMENAME);
	$labels->view_item = __('Xem Sản phẩm',THEMENAME);
	$labels->search_items = __('Tìm Sản phẩm',THEMENAME);
	$labels->not_found = __('Không tìm thấy Sản phẩm',THEMENAME);
	$labels->not_found_in_trash = __('Không tìm thấy Sản phẩm',THEMENAME);
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

