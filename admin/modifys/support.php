<?php

    // The example below removes all Dashboard Widgets
	// add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
   	function my_custom_dashboard_widgets() 
   	{
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

		unregister_sidebar( 'primary-widget-area' );
		unregister_sidebar( 'secondary-widget-area' );
		unregister_sidebar( 'first-footer-widget-area' );
		unregister_sidebar( 'second-footer-widget-area' );
		unregister_sidebar( 'third-footer-widget-area' );
		unregister_sidebar( 'fourth-footer-widget-area' );
    }

	add_action('wp_dashboard_setup', 'my_custom_dashboard_support');
	function my_custom_dashboard_support(){
		wp_add_dashboard_widget('custom_feed_widget', 'Tin tức webseo24h.com', 'custom_dashboard_feed');
	 	wp_add_dashboard_widget('custom_support_widget', 'Support', 'custom_dashboard_support');
	}

	function custom_dashboard_feed()
	{
		$url_feed = 'http://webseo24h.com/feeds';
		echo '<ul>';
		$rss = fetch_feed($url_feed);
		if(!is_wp_error($rss))
		{
		    $maxitems = $rss->get_item_quantity(10);
		    $rss_items = $rss->get_items(0, $maxitems);
		}
		
		if($maxitems == 0) echo '<li>View news<a target="_blank" rel="noopener" style="font-weight:normal;" href="'.str_replace('feed', '', $url_feed).'">webseo24h.com</a>.</li>';
		else 
		{
			foreach($rss_items as $item) 
			{
				
				echo '<li><h3><a target="_blank" rel="noopener" style="font-weight:normal;" href="'.esc_url($item->get_permalink()) .'">' . esc_html($item->get_title()).'</a> - <a href="'.esc_url($item->get_permalink()) .'"> Chi tiết</a></h3> ' ;
			}
		}
		echo '</ul>';
	}
	
	function custom_dashboard_support()
	{
		?>
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
				if(!$support_name) echo '<span style="color: #ff0000;">Please enter name!<br></span>';
				elseif(!$support_mail) echo '<span style="color: #ff0000;">Please enter email!<br></span>';
				elseif(!is_email($support_mail)) echo '<span style="color: #ff0000;">Email invalid!<br/></span>';
				elseif(!$support_phone) echo '<span style="color: #ff0000;">Please enter phone number!<br></span>';
				elseif(!$support_title) echo '<span style="color: #ff0000;">Please enter title!<br>';
				elseif(!$support_content) echo '<span style="color: #ff0000;">Please enter content!<br></span>';
				else 
				{
					$message = "Name: $support_name
					Email: $support_mail
					Tel: $support_phone
					Title: $support_title
					Content: $support_content";
                    
                    
                    $to = 'dbthanhbinh@gmail.com';
                	$subject = 'Request Support - ' . get_bloginfo('name');
                
                	$headers = "From: " . get_option('admin_email') . "\r\n";
                	$headers .= "Reply-To: ". get_option('admin_email') . "\r\n";
                
                	$headers .= "MIME-Version: 1.0\r\n";
                	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
                	$message = '<html><body>';
                
                	$message .= '<h1 style="font-size:15px;">Request Support - '.get_bloginfo('name').'</h1>';
                	$message .= '<div><strong>Name:</strong> '.$support_name.'</div>';
                	$message .= '<div><strong>Email:</strong> '.$support_mail.'</div>';                
                    $message .= '<div><strong>Tel:</strong> '.$support_phone.'</div>';
                    $message .= '<div><strong>Title:</strong> '.$support_title.'</div>';                    
                	$message .= '<div><strong>Content:</strong> '.$support_content.'</div>';
                    
                	$message .= '</body></html>';
                    
                    if(wp_mail($to, $subject, $message,$headers))
                    {
						echo '<span style="color: #ff0000;"> Gửi email thành công! </span>';
                    }
                    else
                        echo '<span style="color: #ff0000;"> Gửi email thất bại! </span>';
                    
				}			
			}
			else 
			{
				echo '<span style="color: #ff0000;">Please fill full text !</span>';
			}
			?>
			</strong></p>
			
			<div class="input-text-wrap">
				<label for="support_name">Name</label>
				<input type="text" name="support_name" id="support_name" placeholder="Your name!" value="<?php echo $_POST['support_name']; ?>" /> 
			</div> 
			 
			<div class="input-text-wrap"> 
				<label for="support_mail">Email</label>
				<input type="text" name="support_mail" id="support_mail" placeholder="Your email!" value="<?php bloginfo('admin_email'); ?>" /> 
			</div> 
			 
			<div class="input-text-wrap">
				<label for="support_phone">Tel</label>
				<input type="text" name="support_phone" id="support_phone" placeholder="Your phone!" value="<?php echo $_POST['support_phone']; ?>" /> 
			</div>  
			 
			<div class="input-text-wrap"> 
				<label for="support_title">Title</label>
				<input type="text" name="support_title" id="support_title" value="Support website: <?php  bloginfo('home'); ?>" /> 
			</div> 
	 
			<div class="textarea-wrap"> 
				<label for="support_content">Content</label>
				<textarea name="support_content" id="support_content" rows="5" cols="15" placeholder="Your request!"><?php echo $_POST['support_content']; ?></textarea> 
			</div> 
	 
			<div class="textarea-wrap">
				<?php wp_nonce_field('submit', 'support'); ?> 
				<input type="submit" name="support_submit" id="support_submit" value="Send request" /> 
			</div>	 
		</form>
		<?php 
	}