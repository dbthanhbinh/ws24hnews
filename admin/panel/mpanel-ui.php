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
			<input name="save" class="mpanel-save" type="submit" value="'.__('Save Changes', THEMENAME).'" />    
		</div>'; 
	?>
	<div id="save-alert"></div>

	<div class="mo-panel">
		<div class="mo-panel-tabs">
			<div class="logo"></div>
			<ul>
				<li class="tie-tabs general"><a href="#tab1"><span></span><?= __('General Settings', THEMENAME) ?></a></li>
				<li class="tie-tabs homepage"><a href="#tab2"><span></span><?= __('Home page', THEMENAME)?></a></li>
				<li class="tie-tabs homepage2"><a href="#tab22"><span></span><?= __('Custom Home page', THEMENAME) ?></a></li>
				<li class="tie-tabs archives"><a href="#tab12"><span></span><?= __('Archives Settings', THEMENAME) ?></a></li>
				<li class="tie-tabs article"><a href="#tab6"><span></span><?= __('Article Settings', THEMENAME) ?></a></li>
				<li class="tie-tabs slideshow"><a href="#tab5"><span></span><?= __('Slider Settings', THEMENAME) ?></a></li>
			</ul>
			<div class="clear"></div>
		</div>
				
		<div class="mo-panel-content">
			<form action="/" name="tie_form" id="tie_form">
				<div id="tab1" class="tabs-wrap">
					<h2><?= __('General Settings', THEMENAME) ?></h2> <?php echo $save ?>
					<div class="tiepanel-item">
						<h3><?= __('Header Code', THEMENAME) ?></h3>
						<div class="option-item">
							<small><?= __('The following code will add to the &lt;head&gt; tag. Useful if you need to add additional scripts such as CSS or JS.', THEMENAME) ?></small>
							<textarea id="header_code" name="tie_options[header_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('header_code'));  ?></textarea>
						</div>
					</div>					
					<div class="tiepanel-item">
						<h3><?= __('Footer Code', THEMENAME) ?></h3>
						<div class="option-item">
							<small><?= __('The following code will add to the footer before the closing  &lt;/body&gt; tag. Useful if you need to Javascript or tracking code.', THEMENAME) ?></small>
							<textarea id="footer_code" name="tie_options[footer_code]" style="width:100%" rows="7"><?php echo htmlspecialchars_decode(tie_get_option('footer_code'));  ?></textarea>				
						</div>
					</div>					
				</div>

				<div id="tab2" class="tabs-wrap">
					<?php require_once ('home-builder/setting.php'); ?>
				</div> <!-- Homepage Settings -->

				<div id="tab5" class="tab_content tabs-wrap">
					<h2><?= __('Slider Settings', THEMENAME) ?></h2> <?php echo $save; ?>
					<div class="tiepanel-item">
						<h3><?= __('Slider Settings', THEMENAME) ?></h3>
						<?php
							tie_options(
								array(	"name" => __('Enable', THEMENAME),
										"id" => "slider",
										"type" => "checkbox"));
						?>
					</div>
										
					<div class="tiepanel-item">
						<h3><?= __('Query Settings', THEMENAME) ?></h3>
						<?php
							tie_options(
								array(	"name" => __("Number Of Posts To Show", THEMENAME),
										"id" => "slider_number",
										"std" => 5,
										"type" => "short-text"));
										
							tie_options(
								array(	"name" => __("Query Type", THEMENAME),
										"id" => "slider_query",
										"options" => array("custom"=>"Custom Slider"),
										"type" => "radio"));
							tie_options(
								array(	"name" => __("Custom Slider", THEMENAME),
										"help" => "Choose your custom slider",
										"id" => "slider_custom",
										"type" => "select",
										"options" => $sliders));
						?>
					
					</div>
				</div>
				<!-- Slideshow -->					
				
				<div id="tab6" class="tab_content tabs-wrap">
					<h2><?= __('Article Settings', THEMENAME) ?></h2> <?php echo $save ?>

					<?php
					foreach ($posttypes as $k => $item) {
						$relatedId = 'related_'.$k;
						$relatedName = $item;
						?>
						<div class="tiepanel-item">
							<h3><?= __('Related Settings:', THEMENAME) ?> <?= $item ?></h3>
							<?php
								tie_options(
									array(	"name" => __("Related: ", THEMENAME).$relatedName,
											"id" => $relatedId,
											"type" => "checkbox"));
								tie_options(
									array(	"name" => __("Related title: ", THEMENAME).$relatedName,
											"id" => $relatedId."_title",
											"std" => "Related ".$relatedName,
											"type" => "text")); 
								tie_options(
									array(	"name" => __("Display", THEMENAME),
											"id" => $relatedId."_display",
											"help" => __("will appears in all archives pages like categories / tags / search and in homepage blog style .", THEMENAME),
											"type" => "select",
											"std" => "grid",
											"options" => array( "grid"=>"As Grid",
																"list"=>"As List"
															)));
								tie_options(
									array( 	"name" => __("Show cols", THEMENAME),
											"id" => $relatedId."_cols",
											"std" => 3,
											"type" => "short-text"));
											
								tie_options(
									array(	"name" => __("Number of posts to show", THEMENAME),
											"id" => $relatedId."_number",
											"std" => 3,
											"type" => "short-text"));
											
								tie_options([
									"name" => __("Query Type", THEMENAME),
									"id" => $relatedId."_query",
									"std" => "category",
									"options" => [
										"category" => __("Category", THEMENAME),
										"tag" => __("Tag", THEMENAME),
										"author" => __("Author", THEMENAME)
									],
									"type" => "radio"
								]); 
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
				$listArchives['category'] = __("Category", THEMENAME);
				$listArchives['search'] = __("Search", THEMENAME);
				$listArchives['tag'] = __("Tag", THEMENAME);
				?>
				<div id="tab12" class="tab_content tabs-wrap">
					<h2><?= __('Archives Settings', THEMENAME) ?></h2>	<?php echo $save ?>
					<?php
					foreach ($listArchives as $k => $item) {
						$archiveId = 'archive_'.$k;
						?>
						<div class="tiepanel-item">
							<h3><?= __('Settings', THEMENAME) ?> <?= $item ?></h3>
							<!-- <p class="tie_message_hint">Following settings will applies on the archive List template .</p> -->
							<?php
								tie_options(
									array(	"name" => __("Display", THEMENAME),
											"id" => $archiveId."_display",
											"help" => __("will appears in all archives pages like categories / tags / search and in homepage blog style .", THEMENAME),
											"type" => "select",
											"std" => ARCHIVE_DISPLAY_AS,
											"options" => array( "grid"=>"As Grid",
																"list"=>"As List"
															)));
								tie_options(
									array( 	"name" => __("Show cols", THEMENAME),
											"id" => $archiveId."_cols",
											"std" => ARCHIVE_DISPLAY_COLS,
											"type" => "short-text"));
								tie_options(
									array(	"name" => __("Author Meta", THEMENAME),
											"id" => $archiveId."_meta_author",
											"type" => "checkbox")); 			
								tie_options(
									array(	"name" => __("Date Meta", THEMENAME),
											"id" => $archiveId."_meta_date",
											"type" => "checkbox"));
								tie_options(
									array(	"name" => __("Readmore Meta", THEMENAME),
											"id" => $archiveId."_meta_readmore",
											"type" => "checkbox"));
							?>
						</div>
						<?php
					}
					?>
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
					<input name="reset" class="mpanel-reset-button" type="submit" onClick="if(confirm('All settings will be rest .. Are you sure ?')) return true ; else return false; " value="<?= __('Reset All Settings', THEMENAME) ?>" />
					<input type="hidden" name="action" value="reset" />
				</div>
			</form>
		</div><!-- .mo-panel-content -->
		<div class="clear"></div>
	</div>
<?php 
}
?>
