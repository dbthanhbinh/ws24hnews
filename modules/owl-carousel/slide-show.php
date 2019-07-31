<?php
$custom_slider_args = array( 'post_type' => 'tie_slider','no_found_rows' => 1  );
$custom_slider = new WP_Query( $custom_slider_args );
$number = 0;

if($custom_slider->have_posts()):
?>  
<!-- slider -->
<div id="wrapper-slider">
	<div class="wrapper">		
		<div id="owl-demo" class="owl-carousel owl-theme"> 
			<?php
	        while($custom_slider->have_posts()): $custom_slider->the_post();
	        $custom = get_post_custom($post->ID);
	 		$slider = unserialize( $custom["custom_slider"][0] );			                        	   	 		
			$number = count($slider);
			if( $slider && $number > 0 )
			{
				$tamp=1;
				foreach( $slider as $slide )
				{
					//$thumb = wp_get_attachment_image_src($slide['id'],'slider-thumb');  
					$thumb2 = wp_get_attachment_image_src($slide['id'],'');
					?>	
					<div class="item"><a href="<?php echo $slide['link']; ?>"> 
						<img alt="<?php echo $slide['title']?$slide['title']:get_bloginfo('name');?>" src="<?php echo $thumb2[0];?>" /> </a>						
					</div>
					<?php 
				
					$tamp++;
				}
			}
        endwhile;
        ?>

		</div>
<?php if($number > 1){?>		
		<!-- Script -->
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
<!-- End slider -->
<?php
endif;
