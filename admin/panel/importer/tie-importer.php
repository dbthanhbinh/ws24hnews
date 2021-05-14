<?php
function tie_clean_options_htmlspecialchars_decode(&$value){
	$value = htmlspecialchars_decode($value);
}

function tie_set_demo_data(){
	include TEMPLATEPATH . '/widgets/defined.php';
	$theme_options = get_option( 'tie_options' );
	
	$localUrl = 'http://demo05.webseo24h.com';
	$currentUrl = site_url();
	$unserializeData = '';
	require('advanced.php');

	if($advanced){
		$importData = base64_decode($advanced);
		if($importData){
			$myImportData = str_replace($localUrl, $currentUrl, $importData);
			if($myImportData){
				$unserializeData = unserialize($myImportData);
			}
		}
	}
	
	$default_data = null;
	if( !empty($unserializeData) ){
		array_walk_recursive( $unserializeData , 'tie_clean_options_htmlspecialchars_decode');
		$default_data = $unserializeData;
	}

	tie_save_settings($default_data);

	//Import Menus
	$footer = get_term_by('slug', 'footer-menu', 'nav_menu');
	$primary = get_term_by('slug', 'primary-menu', 'nav_menu');
	set_theme_mod( 'nav_menu_locations' , array('footer' => $footer->term_id , 'primary' => $primary->term_id ) );
	
	// Import theme mod section_contact
	global $Customize;
	$themeModInit = [];
	if(count($Customize) > 0){
		foreach ($Customize as $key => $val){
			$themeModInit[$key] = $val;
		}
	}
	
	foreach($themeModInit as $k=>$v){
		set_theme_mod($k, $v);
	}
	
	//Import Widgets
	update_option('sidebars_widgets', '');
	$widgetPopular = [
		'title' => $defaultsValues['title'],
		'background_color' => $defaultsValues['background_color'],
		'title_color' => $defaultsValues['title_color'],
		'border_top_color' => $defaultsValues['border_top_color'],
		'span_color' => $defaultsValues['span_color'],
		'icon_color' => $defaultsValues['icon_color'],
		'cats_id' => $defaultsValues['cats_id'],
		'latest' => $defaultsValues['latest'],
		'excerpt_len' => $defaultsValues['excerpt_len'],
		'excerpt_hidden' => $defaultsValues['excerpt_hidden'],
		'no_of_posts' => $defaultsValues['no_of_posts'],
		'thumb' => $defaultsValues['thumb'],
		'thumb_full' => $defaultsValues['thumb_full']
	];
	tie_addWidgetToSidebar( 'sidebar-1' , 'ws24h_socials', 0, ['title' => 'Liên kết mạng xã hội']);
	tie_addWidgetToSidebar( 'sidebar-1' , 'ws24h_fanpage', 0, ['fanpage_url' => 'https://www.facebook.com/webseo24h']);
	tie_addWidgetToSidebar( 'sidebar-1' , 'ws24h_popular', 0, $widgetPopular);
	tie_addWidgetToSidebar( 'sidebar-1' , 'tag_cloud', 0, ['title' => 'Tags']);
	tie_addWidgetToSidebar( 'sidebar-1' , 'media_image', 0, [
		'title' => 'Image',
		'image_title' => 'Image',
		'loading' => "lazy",
		'alt' => 'Image',
		'url' => get_template_directory_uri().'/assets/images/widgets/blog-t1.jpg'
	]);
	tie_addWidgetToSidebar( 'sidebar-1' , 'ws24h_contact', 0, array('title' => '')); // ws24h_contact

	tie_addWidgetToSidebar( 'footer-1' , 'ws24h_contact', 0, array('title' => '')); // ws24h_contact
	tie_addWidgetToSidebar( 'footer-2' , 'pages', 0, [
		'title' => 'Về chúng tôi?'
	]);
	tie_addWidgetToSidebar( 'footer-3' , 'tag_cloud', 0, ['title' => 'Tags']);
}

function tie_addWidgetToSidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array()){
	$sidebarOptions = get_option('sidebars_widgets');
	if(!$sidebarOptions)
		$sidebarOptions = [];

	if(!isset($sidebarOptions[$sidebarSlug])){
		$sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
	}
	$newWidget = get_option('widget_'.$widgetSlug);
	if(!is_array($newWidget))$newWidget = array();
	$count = count($newWidget)+1+$countMod;
	$sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

	$newWidget[$count] = $widgetSettings;

	update_option('sidebars_widgets', $sidebarOptions);
	update_option('widget_'.$widgetSlug, $newWidget);
}

function tie_demo_installer() {?>  
	<div id="icon-tools" class="icon32"><br></div>
	<h2>Import Demo Data</h2>
	<div style="background-color: #F5FAFD; margin:10px 0;padding: 10px;color: #0C518F;border: 3px solid #CAE0F3; claer:both; width:90%; line-height:18px;">
		<p class="tie_message_hint">Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme. It will
		allow you to quickly edit everything instead of creating content from scratch. When you import the data following things will happen:</p>
	  
	  <ul style="padding-left: 20px;list-style-position: inside;list-style-type: square;}">
		  <li>No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified .</li>
		  <li>No WordPress settings will be modified .</li>
		  <li>About 10 posts, a few pages, 10+ images, some widgets and two menus will get imported .</li>
		  <li>Images will be downloaded from our server, these images are copyrighted and are for demo use only .</li>
		  <li>please click import only once and wait, it can take a couple of minutes</li>
	  </ul>
	 </div>
	<form method="post">
		<input type="hidden" name="demononce" value="<?php echo wp_create_nonce('tie-demo-code'); ?>" />
		<input name="reset" class="mpanel-save" type="submit" value="Import Demo Data" />
		<input type="hidden" name="action" value="demo-data" />
	</form>
	<br />
	<br />	
	<?php
	if(  'demo-data' == $_REQUEST['action'] && check_admin_referer('tie-demo-code' , 'demononce')){
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			require_once ABSPATH . 'wp-admin/includes/import.php';
			$importer_error = false;
			if ( !class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
				if ( file_exists( $class_wp_importer ) ){
					require_once($class_wp_importer);
				}
				else{
					$importer_error = true;
				}
			}
			
		if ( !class_exists( 'WP_Import' ) ) {
			$class_wp_import = get_template_directory() . '/admin/panel/importer/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) )
				require_once($class_wp_import);
			else
				$importerError = true;
		}
		if($importer_error){
			die("Error in import :(");
		}else{
			if(!is_file( get_template_directory() . '/admin/panel/importer/sample.xml')){
				echo "The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ";
			}
			else{
				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = true;
				$wp_import->import( get_template_directory() . '/admin/panel/importer/sample.xml');
		  }
	  }
		tie_set_demo_data();
	}
}
?>