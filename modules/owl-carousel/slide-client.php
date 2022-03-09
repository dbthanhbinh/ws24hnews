<?php
$postId = get_theme_mod('show_client');
$custom = null;
if($postId > -1)
	$custom = get_post_custom($postId);

if($custom && isset($custom["custom_clients"]) && isset($custom["custom_clients"][0]) ){
	$sliders = unserialize( $custom["custom_clients"][0] );
	$number = count($sliders);
	$isNav = false;
	if( $sliders && $number > 0 )
	{
		if($number > 6)
			$isNav = true;
		?>
		<div class="group-clients">
			<div class="container">
				<div class="row">
					<div class="owl-carousel owl-carousel-client owl-theme">
						<?php
						$loop=1;
						foreach( $sliders as $slide )
						{
							$thumb2 = wp_get_attachment_image_src($slide['id'],'');
							?>	
							<div class="item">
								<a href="<?= $slide['link'] ? $slide['link'] : get_bloginfo('url');?>"> 
									<img alt="<?= $slide['title'] ? $slide['title'] : get_bloginfo('name');?>" src="<?php echo $thumb2[0];?>" />
								</a>
							</div>
							<?php
							$loop++;
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<?php if($number > 1){?>
			<script>
				$(document).ready(function() {
					$(".owl-carousel-client").owlCarousel({
						items : 6, //10 items above 1000px browser width
						autoPlay: 3000, //Set AutoPlay to 3 seconds
						responsiveClass:true,
						itemsDesktop : [1000,5], //5 items between 1000px and 901px
						itemsDesktopSmall : [900,3], // betweem 900px and 601px
						itemsTablet: [600,2], //2 items between 600 and 0
						itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
						responsive: {
							0:{
								items:1,
								nav:true
							},
							600:{
								items:3,
								nav:false
							},
							1000:{
								items:6,
								nav:true,
								loop:false
							}
						},
						dots: false,
						loop: true
					});
				});
			</script>
		<?php }?>
		<?php
	}
}