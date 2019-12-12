<?php
add_action('init', 'tie_static_register');
 
function tie_static_register() {
 
	$labels = array(
		'name' => 'Static Block',
		'singular_name' => 'Static',
		'add_new_item' => 'Add New Static',
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
		'menu_position' => 6,
		'rewrite' => array('slug' => 'static'),
		'supports' => array('title','excerpt')
	  ); 
 	   
	register_post_type( 'tie_static' , $args );
}


add_action("admin_init", "tie_static_init");
 
function tie_static_init(){
  add_meta_box("tie_static_slides", "Statics", "tie_static_slides", "tie_static", "normal", "high");
}
 

function tie_static_slides(){
	global $post;
	$custom = get_post_custom($post->ID);
    if(isset($custom["custom_static"][0]))
	   $slider = unserialize( $custom["custom_static"][0] );
  
	wp_enqueue_script( 'tie-admin-static' );  
	wp_print_scripts('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');	
  ?>
  <script>
  jQuery(document).ready(function() {
  
	jQuery(function() {
		jQuery( "#tie-static-items" ).sortable({placeholder: "ui-state-highlight"});
	});

	function custom_static_uploader(field) {
		var button = "#upload_"+field;
		jQuery(button).click(function() {
			window.restore_send_to_editor = window.send_to_editor;
			tb_show('', 'media-upload.php?referer=tie-settings&amp;type=image&amp;TB_iframe=true&amp;post_id=0');
			tie_set_static_img(field);
			return false;
		});

	}
	function tie_set_static_img(field) {
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
				
			jQuery('#tie-static-items').append('<li id="listItem_'+ nextCell +'" class="ui-state-default"><div class="widget-content option-item"><div class="static-img"><img src="'+imgurl+'" alt=""></div><label for="custom_static['+ nextCell +'][title]"><span>Slide Title :</span><input id="custom_static['+ nextCell +'][title]" name="custom_static['+ nextCell +'][title]" value="" type="text" /></label><label for="custom_static['+ nextCell +'][link]"><span>Slide Link :</span><input id="custom_static['+ nextCell +'][link]" name="custom_static['+ nextCell +'][link]" value="" type="text" /></label><label for="custom_static['+ nextCell +'][caption]"><span style="float:left" >Slide Caption :</span><textarea name="custom_static['+ nextCell +'][caption]" id="custom_static['+ nextCell +'][caption]"></textarea></label><input id="custom_static['+ nextCell +'][id]" name="custom_static['+ nextCell +'][id]" value="'+id+'" type="hidden" /><a class="del-cat"></a></div></li>');
			nextCell ++ ;
			tb_remove();
			window.send_to_editor = window.restore_send_to_editor;
		}
	};
	
	custom_static_uploader("add_slide");
	
});

  </script>
  
 <input id="upload_add_slide" type="button" class="mpanel-save" value="Add New Slide">  Alias Shortcode: <?php echo '[static-'.$post->post_name.' postid="'.$post->ID.'" type="'.get_post_meta($post->ID,$wpdb->prefix . 'custom_static_type',true).'"]';?>
 
 <select id="custom_static_type" name="custom_static_type">
    <option value="1">Style 1</option>
    <option value="2">Style 2</option>
    <option value="3">Style 3</option>
 </select>
 
	<ul id="tie-static-items">
	<?php
	if( $slider ){
	$i=0;
	foreach( $slider as $slide ):
		$i++; ?>
		<li id="listItem_<?php echo $i ?>"  class="ui-state-default">
			<div class="widget-content option-item">
				<div class="slider-img"><?php echo wp_get_attachment_image( $slide['id'] , 'thumbnail' );  ?></div>
				<label for="custom_static[<?php echo $i ?>][title]"><span>Slide Title :</span><input id="custom_static[<?php echo $i ?>][title]" name="custom_static[<?php echo $i ?>][title]" value="<?php  echo stripslashes( $slide['title'] )  ?>" type="text" /></label>
				<label for="custom_static[<?php echo $i ?>][link]"><span>Slide Link :</span><input id="custom_static[<?php echo $i ?>][link]" name="custom_static[<?php echo $i ?>][link]" value="<?php  echo stripslashes( $slide['link'] )  ?>" type="text" /></label>
				<label for="custom_static[<?php echo $i ?>][caption]"><span style="float:left" >Slide Caption :</span>
                <textarea name="custom_static[<?php echo $i ?>][caption]" id="custom_static[<?php echo $i ?>][caption]"><?php echo stripslashes($slide['caption']) ; ?></textarea>                
                </label>
				<input id="custom_static[<?php echo $i ?>][id]" name="custom_static[<?php echo $i ?>][id]" value="<?php  echo $slide['id']  ?>" type="hidden" />
				<a class="del-cat"></a>
			</div>
		</li>
	<?php endforeach; 
	}else{
		echo ' <p> Use the button above to add Slides !</p>';
	}?>
	</ul>
	<script> var nextCell = <?php echo $i+1 ?> ;</script>

  <?php
}
 


add_action('save_post', 'save_slide');
function save_slide(){
  global $post;
  
  	if( !empty( $_POST['custom_static'] ) && $_POST['custom_static'] != "" ){
		update_post_meta($post->ID, 'custom_static' , $_POST['custom_static']);		
	}
	else{
		if( isset($post->ID) )
			delete_post_meta($post->ID, 'custom_static' );
	}
    
    update_post_meta($post->ID, 'custom_static' , $_POST['custom_static']);	
    
    $custom_data = get_option('custom_static_block_shortcode');
    $custom_data[$post->ID] =  '[static-'.$post->post_name.' postid="'.$post->ID.'" type="'.$_POST["custom_static_type"].'"]';
    update_option('custom_static_block_shortcode',$custom_data);
}


add_filter("manage_edit-tie_static_columns", "tie_static_edit_columns");
function tie_static_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
	"slides" => "Number of Slides",
    "date" => "Date",
  );
 
  return $columns;
}


add_action("manage_tie_static_posts_custom_column",  "tie_static_custom_columns");
function tie_static_custom_columns($column){
	global $post;
	
	switch ($column) {
		case "slides":
			$custom_slider_args = array( 'post_type' => 'tie_static', 'p' => $post->ID, 'no_found_rows' => 1  );
			$custom_slider = new WP_Query( $custom_slider_args );
			while ( $custom_slider->have_posts() ) {
				$number =0;
				$custom_slider->the_post();
				$custom = get_post_custom($post->ID);
				if( !empty($custom["custom_static"][0])){
					$slider = unserialize( $custom["custom_static"][0] );
					echo $number = count($slider);
				}
				else echo 0;
			}
		break;
	}
}

?>