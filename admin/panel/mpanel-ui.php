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
		'post' => 'Default post'
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

					<?php
					foreach ($posttypes as $k => $item) {
						$relatedId = 'related_'.$k;
						$relatedName = $item;
						?>
						<div class="tiepanel-item">
							<h3>Related <?= $item ?> Settings</h3>
							<?php
								tie_options(
									array(	"name" => "Related ".$relatedName,
											"id" => $relatedId,
											"type" => "checkbox"));
								tie_options(
									array(	"name" => "Related ".$relatedName." Box Title",
											"id" => $relatedId."_title",
											"std" => "Related ".$relatedName,
											"type" => "text")); 
								tie_options(
									array(	"name" => "Display",
											"id" => $relatedId."_display",
											"help" => "will appears in all archives pages like categories / tags / search and in homepage blog style .",
											"type" => "select",
											"std" => "grid",
											"options" => array( "grid"=>"As Grid",
																"list"=>"As List"
															)));
								tie_options(
									array( 	"name" => "Show cols",
											"id" => $relatedId."_cols",
											"std" => 3,
											"type" => "short-text"));
											
								tie_options(
									array(	"name" => "Number of posts to show",
											"id" => $relatedId."_number",
											"std" => 3,
											"type" => "short-text"));
											
								tie_options(
									array(	"name" => "Query Type",
											"id" => $relatedId."_query",
											"std" => "category",
											"options" => array( "category"=>"Category" ,
																"tag"=>"Tag",
																"author"=>"Author" ),
											"type" => "radio")); 
							?>
						</div>
						<?php
					}
					?>

				</div>
				<!-- Article Settings -->

				<?php
				$listArchives = $posttypes;
				unset($listArchives['post']);
				$listArchives['category'] = 'Danh mục';
				$listArchives['search'] = 'Tìm kiếm';
				$listArchives['tag'] = 'Thẻ';
				?>
				<div id="tab12" class="tab_content tabs-wrap">
					<h2>Archives Settings</h2>	<?php echo $save ?>	
					
					<?php
					foreach ($listArchives as $k => $item) {
						$archiveId = 'archive_'.$k;
						?>
						<div class="tiepanel-item">
							<h3>Settings <?= $item ?></h3>
							<!-- <p class="tie_message_hint">Following settings will applies on the archive List template .</p> -->
							<?php
								tie_options(
									array(	"name" => "Display",
											"id" => $archiveId."_display",
											"help" => "will appears in all archives pages like categories / tags / search and in homepage blog style .",
											"type" => "select",
											"std" => ARCHIVE_DISPLAY_AS,
											"options" => array( "grid"=>"As Grid",
																"list"=>"As List"
															)));
								tie_options(
									array( 	"name" => "Show cols",
											"id" => $archiveId."_cols",
											"std" => ARCHIVE_DISPLAY_COLS,
											"type" => "short-text"));
								tie_options(
									array(	"name" => "Author Meta",
											"id" => $archiveId."_meta_author",
											"type" => "checkbox")); 			
								tie_options(
									array(	"name" => "Date Meta",
											"id" => $archiveId."_meta_date",
											"type" => "checkbox"));
								tie_options(
									array(	"name" => "Readmore Meta",
											"id" => $archiveId."_meta_readmore",
											"type" => "checkbox"));
							?>
						</div>
						<?php
					}
					?>

					<!-- <div class="tiepanel-item">
						<h3>Archives Posts Meta</h3>
						<p class="tie_message_hint">Following settings will applies on blog List template .</p>
						<?php	
							// tie_options(
							// 	array(	"name" => "Author Meta",
							// 			"id" => "arc_meta_author",
							// 			"type" => "checkbox")); 			
							// tie_options(
							// 	array(	"name" => "Date Meta",
							// 			"id" => "arc_meta_date",
							// 			"type" => "checkbox"));
							// tie_options(
							// 	array(	"name" => "Readmore Meta",
							// 			"id" => "arc_meta_readmore",
							// 			"type" => "checkbox"));
						?>
					</div> -->

				</div>
				<!-- Archives -->

				<div id="tab22" class="tabs-wrap">
					<?php require_once ('home-builder/customhome.php'); ?>
				</div> <!-- Custom Homepage Settings -->

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
