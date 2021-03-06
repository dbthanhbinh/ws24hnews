<?php
$p = tie_get_option('slider_custom');
$custom_slider_args = array( 'post_type' => 'tie_slider', 'p' => $p,'no_found_rows' => 1);
$custom_slider = new WP_Query($custom_slider_args);
$number = 0;
if($custom_slider->have_posts()):
?>
<div id="wrapper-slider">
	<div class="wrapper">
			<?php
			$custom_slider->the_post();
			$custom = get_post_custom($post->ID);
			$slider = (isset($custom["custom_slider"]) && isset($custom["custom_slider"][0])) ? unserialize( $custom["custom_slider"][0] ) : null;
			$number = $slider ? count($slider) : 0;
			$owlCarousel = 'owl-carousel';
			if($number <=1){
				$owlCarousel = '';
			}
			?>
			<div id="owl-demo" class="<?= $owlCarousel ?> owl-theme">
			<?php
			if( $slider && $number > 0 )
			{
				$tamp=1;
				foreach( $slider as $slide ){
					$thumb2 = wp_get_attachment_image_src($slide['id'],'');
					?>	
					<div class="item"><a href="<?php echo $slide['link']; ?>"> 
						<img alt="<?php echo $slide['title']?$slide['title']:get_bloginfo('name');?>" src="<?php echo $thumb2[0];?>" /> </a>						
					</div>
					<?php 
				
					$tamp++;
				}
			}
        	?>
			</div>

		<?php if($number > 1){?>
			<script type="text/javascript">
				$(document).ready(function() {
					$("#owl-demo").owlCarousel({
						autoplay:true,
						loop:true,		
						navigation : true, // Show next and prev buttons
						slideSpeed : 300,
						paginationSpeed : 400,
						items : 1,
						singleItem:true
						// "singleItem:true" is a shortcut for:
						// items : 1, 
						// itemsDesktop : false,
						// itemsDesktopSmall : false,
						// itemsTablet: false,
						// itemsMobile : false
					});
					
				});
			</script>
		<?php } ?>
	</div>
</div>
<?php
endif;
