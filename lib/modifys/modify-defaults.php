<?php
	// Change logo header in Admin
    function custom_admin_logo() 
    {
        echo '<style type="text/css">#header-logo { background-image: url('.get_bloginfo('template_directory').'/favicon.ico) !important;}</style>';
    }
    add_action('admin_head', 'custom_admin_logo');
 	add_filter('admin_footer_text', 'change_footer_admin');
 	
  	function  change_footer_admin () 
  	{  		
    	echo 'copyright @ <a href="http://webseo24h.com">webseo24h.com</a><br/>Theme by : webseo24h.com';
  	}

 	add_action('login_head', 'custom_logo');
 	function custom_logo() 
 	{
    	echo '<style type="text/css">
    	h1 a {    
    		background-image:url('.WP_MYSITE_TEMPLATE_URL.'/images/logo.png) !important;
    		height:90px !important;
  		};
    	</style>';
    }

?>