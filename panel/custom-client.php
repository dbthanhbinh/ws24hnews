<?php
	add_action('init', 'tie_slider_client_register');
	function tie_slider_client_register() {
		$labels = array(
			'name' => 'Custom Clients',
			'singular_name' => 'clients',
			'add_new_item' => 'Add New Client',
		);
	
		$args = array(
			'labels' => $labels,
			'public' => false,
			'show_ui' => true,
			'menu_icon' => get_template_directory_uri().'/panel/images/slideshow.png',
			'can_export' => true,
			'exclude_from_search' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 7,
			'rewrite' => array('slug' => 'clients'),
			'supports' => array('title')
		); 
		register_post_type( 'tie_clients' , $args );
	}


	add_action("admin_init", "tie_slider_client_init");
	function tie_slider_client_init(){
		add_meta_box("tie_slider_client", "Clients", "tie_slider_client", "tie_clients", "normal", "high");
	}

	function tie_slider_client(){
		global $post;
		$custom = get_post_custom($post->ID);
		$slider = null;

		if(isset($custom["custom_clients"]) && isset($custom["custom_clients"][0]) && !empty($custom["custom_clients"][0]))
			$slider = unserialize( $custom["custom_clients"][0] );
	
		wp_enqueue_script( 'tie-admin-slider-client' );  
		wp_print_scripts('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		?>
		<script>
			jQuery(document).ready(function() {
				jQuery(function() {
					jQuery( "#tie-slider-items" ).sortable({placeholder: "ui-state-highlight"});
				});
				function custom_slider_uploader(field) {
					var button = "#upload_"+field;
					jQuery(button).click(function() {
						window.restore_send_to_editor = window.send_to_editor;
						tb_show('', 'media-upload.php?referer=tie-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
						tie_set_slider_img(field);
						return false;
					});
				}
				function tie_set_slider_img(field) {
					window.send_to_editor = function(html) {
						imgurl = jQuery('img',html).attr('src');
						
						if(typeof imgurl == 'undefined') // Bug fix By Fouad Badawy
							imgurl = jQuery(html).attr('src');
						
						
						classes = jQuery('img', html).attr('class');
						if(typeof classes != 'undefined')
							id = classes.replace(/(.*?)wp-image-/, '');
						
						if(typeof classes == 'undefined'){ // Bug fix By Fouad Badawy
							classes = jQuery(html).attr('class');
							if(typeof classes != 'undefined')
								id = classes.replace(/(.*?)wp-image-/, '');
						}
							
						jQuery('#tie-slider-items').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-content option-item"><div class="slider-img"><img src="'+imgurl+'" alt=""></div><label for="custom_clients['+ nextCell +'][title]"><span>Slide Title :</span><input id="custom_clients['+ nextCell +'][title]" name="custom_clients['+ nextCell +'][title]" value="" type="text" /></label><label for="custom_clients['+ nextCell +'][link]"><span>Slide Link :</span><input id="custom_clients['+ nextCell +'][link]" name="custom_clients['+ nextCell +'][link]" value="" type="text" /></label><label for="custom_clients['+ nextCell +'][caption]"><span style="float:left" >Slide Caption :</span><textarea name="custom_clients['+ nextCell +'][caption]" id="custom_clients['+ nextCell +'][caption]"></textarea></label><input id="custom_clients['+ nextCell +'][id]" name="custom_clients['+ nextCell +'][id]" value="'+id+'" type="hidden" /><a class="del-cat"></a></div></li>');
						nextCell ++ ;
						tb_remove();
						window.send_to_editor = window.restore_send_to_editor;
					}
				};
				
				custom_slider_uploader("add_slide");
				
			});
		</script>

		<input id="upload_add_slide" type="button" class="mpanel-save" value="Add New client">
		<ul id="tie-slider-items">
			<?php
				if( $slider ){
					$i=0;
					foreach( $slider as $slide ):
						$i++; ?>
						<li id="listItem_<?php echo $i ?>"  class="ui-state-default">
							<div class="widget-content option-item">
								<div class="slider-img"><?php echo wp_get_attachment_image( $slide['id'] , 'thumbnail' );  ?></div>
								<label for="custom_clients[<?php echo $i ?>][title]"><span>Slide Title :</span><input id="custom_clients[<?php echo $i ?>][title]" name="custom_clients[<?php echo $i ?>][title]" value="<?php  echo stripslashes( $slide['title'] )  ?>" type="text" /></label>
								<label for="custom_clients[<?php echo $i ?>][link]"><span>Slide Link :</span><input id="custom_clients[<?php echo $i ?>][link]" name="custom_clients[<?php echo $i ?>][link]" value="<?php  echo stripslashes( $slide['link'] )  ?>" type="text" /></label>
								<label for="custom_clients[<?php echo $i ?>][caption]"><span style="float:left" >Slide Caption :</span><textarea name="custom_clients[<?php echo $i ?>][caption]" id="custom_clients[<?php echo $i ?>][caption]"><?php echo stripslashes($slide['caption']) ; ?></textarea></label>
								<input id="custom_clients[<?php echo $i ?>][id]" name="custom_clients[<?php echo $i ?>][id]" value="<?php  echo $slide['id']  ?>" type="hidden" />
								<a class="del-cat"></a>
							</div>
						</li>
					<?php endforeach; 
				} else {
					echo ' <p> Use the button above to add Slides !</p>';
				}
			?>
		</ul>
		<script> var nextCell = <?php echo $i+1 ?> ;</script>
	<?php
	}

	add_action('save_post', 'save_slide_client');
	function save_slide_client(){
		global $post;
		if( isset($_POST['custom_clients']) && !empty( $_POST['custom_clients'] ) && $_POST['custom_clients'] != "" ){
			update_post_meta($post->ID, 'custom_clients' , $_POST['custom_clients']);		
		} else {
			if( isset($post->ID) ) delete_post_meta($post->ID, 'custom_clients' );
		}
	}

	add_filter("manage_edit-tie_client_columns", "tie_client_edit_columns");
	function tie_client_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Title",
		"slides" => "Number of client",
		"date" => "Date",
	);
	return $columns;
	}

	add_action("manage_tie_client_posts_custom_column",  "tie_client_custom_columns");
	function tie_client_custom_columns($column){
		global $post;
		
		switch ($column) {
			case "clients":
				$custom_slider_args = array( 'post_type' => 'tie_clients', 'p' => $post->ID, 'no_found_rows' => 1  );
				$custom_slider = new WP_Query( $custom_slider_args );

				while ( $custom_slider->have_posts() ) {
					$number =0;
					$custom_slider->the_post();
					$custom = get_post_custom($post->ID);
					if( isset($custom["custom_clients"]) && isset($custom["custom_clients"][0]) && !empty($custom["custom_clients"][0])){
						$slider = unserialize( $custom["custom_clients"][0] );
						echo $number = count($slider);
					}
					else echo 0;
				}
			break;
		}
	}
?>