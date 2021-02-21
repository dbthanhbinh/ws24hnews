<?php
 	add_action('login_head', 'custom_logo');
 	function custom_logo() 
 	{
    	echo '<style type="text/css">
    	.login h1 a {    
    		background-image:url('.get_bloginfo('template_directory').'/assets/images/logo.png) !important;
    		height:60px !important;
  		};
    	</style>';
    }

?>