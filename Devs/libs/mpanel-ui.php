<?php
add_action( 'admin_enqueue_scripts', 'wptuts_add_color_picker' );
function wptuts_add_color_picker( $hook ) {
    if( is_admin() ) { 
        // Add the color picker css file 		
		wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' ); 
    }
}

function panel_options() {
	?>
	<script>
		(function( $ ) {
			$(function() {
				// Add Color Picker to all inputs that have 'color-field' class
				$( '.cpa-color-picker' ).wpColorPicker();
				
			});
		})( jQuery );
	</script>
	<?php

	// Default all register posttypes
	global $rg_posttypes;
	$excludePosttypes = ['custom-video'];
	$posttypes = [
		'posts' => 'Default post'
	];
	if($rg_posttypes && count($rg_posttypes) > 0){
		foreach($rg_posttypes as $k=>$posttype) {
			if(!@in_array( $posttype['posttype'] , $excludePosttypes))
				$posttypes[$posttype['posttype']] = $posttype['postname'];
		}
	}
	// End Default all register posttypes

	$categories_obj = get_categories('hide_empty=0');
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}

	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}
	
	$save='
		<div class="mpanel-submit">
			<input type="hidden" name="action" value="test_theme_data_save" />
			<input type="hidden" name="security" value="'. wp_create_nonce("test-theme-data").'" />
			<input name="save" class="mpanel-save" type="submit" value="Save Changes" />    
		</div>'; 
	?>
	<div id="save-alert"></div>

	<div class="mo-panel">
		<div class="mo-panel-tabs">
			<div class="logo"></div>
			<ul>
				<li class="tie-tabs general"><a href="#tab1"><span></span>General Settings</a></li>
				<li class="tie-tabs homepage"><a href="#tab2"><span></span>Homepage</a></li>
				<li class="tie-tabs homepage2"><a href="#tab22"><span></span>Custom Homepage</a></li>
				<li class="tie-tabs archives"><a href="#tab12"><span></span>Archives Settings</a></li>
				<li class="tie-tabs article"><a href="#tab6"><span></span>Article Settings</a></li>
				<li class="tie-tabs slideshow"><a href="#tab5"><span></span>Slider Settings</a></li>
				<li class="tie-tabs advanced"><a href="#tab10"><span></span>Advanced</a></li>
			</ul>
			<div class="clear"></div>
		</div>
				
		<div class="mo-panel-content">
			<form action="/" name="tie_form" id="tie_form">
				<div id="tab1" class="tabs-wrap">
					<h2>General Settings</h2> <?php echo $save ?>
					<div class="tiepanel-item">
						<h3>Header Code</h3>
						<div class="option-item">
							<small>The following code will add to the &lt;head&gt; tag. Useful if you need to add additional scripts such as CSS or JS.</small>
							<textarea id="header_code" name="tie_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('header_code'));  ?></textarea>				
						</div>
					</div>					
					<div class="tiepanel-item">
						<h3>Footer Code</h3>
						<div class="option-item">
							<small>The following code will add to the footer before the closing  &lt;/body&gt; tag. Useful if you need to Javascript or tracking code.</small>

							<textarea id="footer_code" name="tie_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('footer_code'));  ?></textarea>				
						</div>
					</div>					
				</div>

				<div id="tab2" class="tabs-wrap">
					<?php require_once ('home-builder/setting.php'); ?>
				</div> <!-- Homepage Settings -->

				<div id="tab5" class="tab_content tabs-wrap">
					<h2>Slider Settings</h2> <?php echo $save; ?>
					<div class="tiepanel-item">
						<h3>Slider Settings</h3>
						<?php
							tie_options(
								array(	"name" => "Enable",
										"id" => "slider",
										"type" => "checkbox"));
						?>
					</div>
										
					<div class="tiepanel-item">
						<h3>Query Settings</h3>
						<?php
							tie_options(
								array(	"name" => "Number Of Posts To Show",
										"id" => "slider_number",
										"std" => 5,
										"type" => "short-text"));
										
							tie_options(
								array(	"name" => "Query Type",
										"id" => "slider_query",
										"options" => array("custom"=>"Custom Slider"),
										"type" => "radio"));
							tie_options(
								array(	"name" => "Custom Slider",
										"help" => "Choose your custom slider",
										"id" => "slider_custom",
										"type" => "select",
										"options" => $sliders));
						?>
					
					</div>
				</div>
				<!-- Slideshow -->					
				
				<div id="tab6" class="tab_content tabs-wrap">
					<h2>Article Settings</h2> <?php echo $save ?>

					<div class="tiepanel-item">

						<h3>Related Posts Settings</h3>
						<?php
							tie_options(
								array(	"name" => "Related Posts",
										"id" => "related_post",
										"std" => true,
										"type" => "checkbox"));
							tie_options(
								array(	"name" => "Related Posts Box Title",
										"id" => "related_title",
										"std" => "Related Posts",
										"type" => "text")); 
							tie_options(
								array(	"name" => "Display",
										"id" => "related_display",
										"help" => "will appears in all archives pages like categories / tags / search and in homepage blog style .",
										"type" => "select",
										"std" => "grid",
										"options" => array( "grid"=>"As Grid",
															"list"=>"As List"
														)));
							tie_options(
								array( 	"name" => "Show cols",
										"id" => "related_cols",
										"std" => 3,
										"type" => "short-text"));
										
							tie_options(
								array(	"name" => "Number of posts to show",
										"id" => "related_number",
										"std" => 3,
										"type" => "short-text"));
										
							tie_options(
								array(	"name" => "Query Type",
										"id" => "related_query",
										"std" => "category",
										"options" => array( "category"=>"Category" ,
															"tag"=>"Tag",
															"author"=>"Author" ),
										"type" => "radio")); 
						?>
					</div>

				</div>
				<!-- Article Settings -->

				<div id="tab12" class="tab_content tabs-wrap">
					<h2>Archives Settings</h2>	<?php echo $save ?>	
					
					<div class="tiepanel-item">
						<h3>General Settings</h3>
						<p class="tie_message_hint">Following settings will applies on the blog List template .</p>
						<?php
							tie_options(
								array(	"name" => "Display",
										"id" => "archive_display",
										"help" => "will appears in all archives pages like categories / tags / search and in homepage blog style .",
										"type" => "select",
										"std" => ARCHIVE_DISPLAY_AS,
										"options" => array( "grid"=>"As Grid",
															"list"=>"As List"
														)));
							tie_options(
								array( 	"name" => "Show cols",
										"id" => "archive_cols",
										"std" => ARCHIVE_DISPLAY_COLS,
										"type" => "short-text"));
						?>
					</div>

					<div class="tiepanel-item">
						<h3>Archives Posts Meta</h3>
						<p class="tie_message_hint">Following settings will applies on blog List template .</p>
						<?php	
							tie_options(
								array(	"name" => "Author Meta",
										"id" => "arc_meta_author",
										"type" => "checkbox")); 			
							tie_options(
								array(	"name" => "Date Meta",
										"id" => "arc_meta_date",
										"type" => "checkbox"));
							tie_options(
								array(	"name" => "Readmore Meta",
										"id" => "arc_meta_readmore",
										"type" => "checkbox"));
						?>
					</div>

				</div>
				<!-- Archives -->

				<div id="tab22" class="tabs-wrap">
					<?php require_once ('home-builder/customhome.php'); ?>
				</div> <!-- Custom Homepage Settings -->

				<div id="tab10" class="tab_content tabs-wrap">
					<h2>Advanced Settings</h2>	<?php echo $save ?>	

					<div class="tiepanel-item">
						<h3>Disable the Responsiveness</h3>
						<?php
							tie_options(
								array(	"name" => "Disable Responsive",
										"id" => "disable_responsive",
										"type" => "checkbox"));
						?>
						<p class="tie_message_hint">This option works only on Tablets and Phones .. to disable the responsiveness action on the desktop .. edit style.css file and remove all Media Quries from the end of the file .</p>
					</div>	
					
					<div class="tiepanel-item">
						<h3>Disable Theme [Gallery] Shortcode</h3>
						<?php
							tie_options(
								array(	"name" => "Disable Theme [Gallery]",
										"id" => "disable_gallery_shortcode",
										"type" => "checkbox"));
						?>
						<p class="tie_message_hint">Set it to <strong>ON</strong> if you want to use the Jetpack Tiled Galleries or if you use a custom lightbox plugin for [Gallery] shortcode .</p>
					</div>	
					
					<div class="tiepanel-item">
						<h3>Twitter API OAuth settings</h3>
						<p class="tie_message_hint">This information will uses in Social counter and Twitter Widget .. You need to create <a href="https://dev.twitter.com/apps" rel="noopener" target="_blank">Twitter APP</a> to get this info .. check this <a href="https://vimeo.com/59573397" rel="noopener" target="_blank">Video</a> .</p>

						<?php
							tie_options(
								array(	"name" => "Twitter Username",
										"id" => "twitter_username",
										"type" => "text"));

							tie_options(
								array(	"name" => "Consumer key",
										"id" => "twitter_consumer_key",
										"type" => "text"));
										
							tie_options(
								array(	"name" => "Consumer secret",
										"id" => "twitter_consumer_secret",
										"type" => "text"));	
										
							tie_options(
								array(	"name" => "Access token",
										"id" => "twitter_access_token",
										"type" => "text"));	
										
							tie_options(
								array(	"name" => "Access token secret",
										"id" => "twitter_access_token_secret",
										"type" => "text"));
						?>
					</div>	
					
					<div class="tiepanel-item">
						<h3>Image Resizing</h3>
						
						<?php
							tie_options(
								array(	"name" => "TimThumb <small style='font-weight:bold;'>(Not Recommended)</small>",
										"id" => "timthumb",
										"type" => "checkbox"));
						?>
					</div>	
						
					<div class="tiepanel-item">
						<h3>Theme Updates</h3>
						<?php
							tie_options(
								array(	"name" => "Notify On Theme Updates",
										"id" => "notify_theme",
										"type" => "checkbox"));
						?>
					</div>

					<div class="tiepanel-item">
						<h3>Wordpress Login page Logo</h3>
						<?php
							tie_options(
								array(	"name" => "Worpress Login page Logo",
										"id" => "dashboard_logo",
										"type" => "upload"));

							tie_options(
								array(	"name" => "Worpress Login page Logo URL",
										"id" => "dashboard_logo_url",
										"type" => "text"));
						?>
					
					</div>
					<?php
						global $array_options ;
						
						$current_options = array();
						foreach( $array_options as $option ){
							if( get_option( $option ) )
								$current_options[$option] =  get_option( $option ) ;
						}
					?>
					
					<div class="tiepanel-item">
						<h3>Export</h3>
						<div class="option-item">
							<textarea style="width:100%" rows="7"><?php echo $currentsettings = base64_encode( serialize( $current_options )); ?></textarea>
						</div>
					</div>
					<div class="tiepanel-item">
						<h3>Import</h3>
						<div class="option-item">
							<textarea id="tie_import" name="tie_import" style="width:100%" rows="7"></textarea>
						</div>
					</div>


				</div> <!-- Advanced -->

				<div class="mo-footer">
					<?php echo $save; ?>
			</form>

			<form method="post">
				<div class="mpanel-reset">
					<input type="hidden" name="resetnonce" value="<?php echo wp_create_nonce('reset-action-code'); ?>" />
					<input name="reset" class="mpanel-reset-button" type="submit" onClick="if(confirm('All settings will be rest .. Are you sure ?')) return true ; else return false; " value="Reset All Settings" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div><!-- .mo-panel-content -->
		<div class="clear"></div>
	</div>
<?php 
}
?>
