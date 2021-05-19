<?php
 	add_filter('admin_footer_text', 'change_footer_admin');
  	function  change_footer_admin () 
  	{  		
    	echo 'Copyright @ <a href="http://webseo24h.com">webseo24h.com</a><br/>Theme by : dbthanhbinh';
  	}
?>