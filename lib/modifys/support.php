<?php

    // the example below removes all Dashboard Widgets
	add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
   	function my_custom_dashboard_widgets() 
   	{
            global $wp_meta_boxes;
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            wp_add_dashboard_widget('custom_feed_widget', 'Tin tức webseo24h.com', 'custom_dashboard_feed');
            wp_add_dashboard_widget('custom_support_widget', 'Support', 'custom_dashboard_support');

	        unregister_sidebar( 'primary-widget-area' );
			unregister_sidebar( 'secondary-widget-area' );
			unregister_sidebar( 'first-footer-widget-area' );
			unregister_sidebar( 'second-footer-widget-area' );
			unregister_sidebar( 'third-footer-widget-area' );
			unregister_sidebar( 'fourth-footer-widget-area' );
     }

     
	function custom_dashboard_feed()
	{
		$url_feed = 'http://webseo24h.com/feed';
		echo '<ul>';
		$rss = fetch_feed($url_feed);
		if(!is_wp_error($rss))
		{
		    $maxitems = $rss->get_item_quantity(5);
		    $rss_items = $rss->get_items(0, $maxitems);
		}
		
		if($maxitems == 0) echo '<li>View news<a target="_blank" style="font-weight:normal;" href="'.str_replace('feed', '', $url_feed).'">webseo24h.com</a>.</li>';
		else 
		{
			foreach($rss_items as $item) 
			{
				
				echo '<li><h3><a target="_blank" style="font-weight:normal;" href="'.esc_url($item->get_permalink()) .'">' . esc_html($item->get_title()).'</a> - <a href="'.esc_url($item->get_permalink()) .'"> Chi tiết</a></h3> ' ;
			}
		}
		echo '</ul>';
	}
	
	function custom_dashboard_support()
	{
		?>
		<style>
		#custom_support_widget .input-text-wrap, #dashboard_quick_press .textarea-wrap {
			margin: 0 0 1em 5em;
		}
		#custom_support_widget h4 {
			font-family: sans-serif;
			float: left;
			width: 5.5em;
			clear: both;
			font-weight: normal;
			text-align: right;
			padding-top: 5px;
			font-size: 12px;
		}
		#custom_support_widget h4 label {
			margin-right: 10px;
		}
		#custom_support_widget .input-text-wrap, #custom_support_widget .textarea-wrap {
			margin: 0 0 1em 5em;
		}
		</style>
		
		
		<hr>
		<form action="" method="post">
			<p><strong>
			<?php 
			if(wp_verify_nonce($_POST['support'], 'submit'))
			{
				// REQUEST
				$support_name = $_POST['support_name'];
				$support_mail = $_POST['support_mail'];
				$support_phone = $_POST['support_phone'];
				$support_title = $_POST['support_title'];
				$support_content = $_POST['support_content'];
				// CHECK
				if(!$support_name) echo 'Please enter name!<br>';
				elseif(!$support_mail) echo 'Please enter email!<br>';
				elseif(!is_email($support_mail)) echo 'Email invalid!';
				elseif(!$support_phone) echo 'Please enter phone number!<br>';
				elseif(!$support_title) echo 'Please enter title!<br>';
				elseif(!$support_content) echo 'Please enter content!<br>';
				else 
				{
					$message = "Name: $support_name
					Email: $support_mail
					Tel: $support_phone
					Title: $support_title
					Content: $support_content";
                    
                    
                    $to = 'dbthanhbinh@gmail.com';
                	$subject = 'Admin Contact Support - ' . get_bloginfo('name');
                
                	$headers = "From: " . get_option('admin_email') . "\r\n";
                	$headers .= "Reply-To: ". get_option('admin_email') . "\r\n";
                
                	$headers .= "MIME-Version: 1.0\r\n";
                	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
                	$message = '<html><body>';
                
                	$message .= '<h1 style="font-size:15px;">Admin Contact Support - '.get_bloginfo('name').'</h1>';
                	$message .= '<div><strong>Name:</strong> '.$support_name.'</div>';
                	$message .= '<div><strong>Email:</strong> '.$support_mail.'</div>';                
                    $message .= '<div><strong>Tel:</strong> '.$support_phone.'</div>';
                    $message .= '<div><strong>Title:</strong> '.$support_title.'</div>';                    
                	$message .= '<div><strong>Content:</strong> '.$support_content.'</div>';
                    
                	$message .= '</body></html>';
                    
                    if(wp_mail($to, $subject, $message,$headers))
                    {
                        echo 'Gửi email thành công!';
                    }
                    else
                        echo 'Gửi email thất bại!';
                    
				}			
			}
			else 
			{
				echo 'Please fill full text !';
			}
			?>
			</strong></p>
			<h4><label for="support_name">Name</label></h4> 
			<div class="input-text-wrap"> 
				<input type="text" name="support_name" id="support_name" tabindex="1" autocomplete="off" value="<?php echo $_POST['support_name']; ?>" /> 
			</div> 
			 
			<h4><label for="support_mail">Email</label></h4> 
			<div class="input-text-wrap"> 
				<input type="text" name="support_mail" id="support_mail" tabindex="2" autocomplete="off" value="<?php bloginfo('admin_email'); ?>" /> 
			</div> 
			 
			<h4><label for="support_phone">Tel</label></h4> 
			<div class="input-text-wrap"> 
				<input type="text" name="support_phone" id="support_phone" tabindex="3" autocomplete="off" value="<?php echo $_POST['support_phone']; ?>" /> 
			</div>  
			 
			<h4><label for="support_title">Title</label></h4> 
			<div class="input-text-wrap"> 
				<input type="text" name="support_title" id="support_title" tabindex="4" autocomplete="off" value="Support website: <?php  bloginfo('home'); ?>" /> 
			</div> 
	 
			<h4><label for="support_content">Content</label></h4> 
			<div class="textarea-wrap"> 
				<textarea name="support_content" id="support_content" class="mceEditor" rows="3" cols="15" tabindex="5"><?php echo $_POST['support_content']; ?></textarea> 
			</div> 
	 
			<p class="submit"> 
				<span id="publishing-action"> 
					<input type="submit" name="support_submit" id="support_submit" accesskey="p" tabindex="6" value="Send" /> 
				</span> 
				<br class="clear" />
				<?php wp_nonce_field('submit', 'support'); ?> 
			</p> 
	 
		</form>
		<?php 
	}