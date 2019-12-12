<?php
$post_id = get_theme_mod('show_client');
$custom = get_post_custom($post_id);
if($custom && isset($custom["custom_clients"]) && isset($custom["custom_clients"][0]) ){
	$sliders = unserialize( $custom["custom_clients"][0] );
	$number = count($sliders);
	// print_r($sliders);
	$isNav = false;
	if( $sliders && $number > 0 )
	{
		if($number > 6) $isNav = true;
		?>
		<style>
			#owl-demo2 .item{
				padding: 0px;
				margin: 0 10px;
				color: #FFF;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				text-align: center;
				}
				.customNavigation{
				text-align: center;
				}

				/* //use styles below to disable ugly selection */
			.customNavigation a{
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
				}
		</style>
		<div class="group-clients">
		<div class="container">
			<div class="row">
			<div id="owl-demo2" class="owl-carousel owl-theme">
				<?php
				$tamp=1;
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
					$tamp++;
				}
				?>
			</div>
			</div>
		</div>
		</div>
		<script>
			$(document).ready(function() {
				var owl = $("#owl-demo2");
				owl.owlCarousel({
					items : 6, //10 items above 1000px browser width
					autoPlay: 3000, //Set AutoPlay to 3 seconds
					responsiveClass:true,
					itemsDesktop : [1000,5], //5 items between 1000px and 901px
					itemsDesktopSmall : [900,3], // betweem 900px and 601px
					itemsTablet: [600,2], //2 items between 600 and 0
					itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
					responsive:{
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

				// Custom Navigation Events
				//  $(".next").click(function(){
				//    owl.trigger('owl.next');
				//  })
				//  $(".prev").click(function(){
				//    owl.trigger('owl.prev');
				//  })
				//  $(".play").click(function(){
				//    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
				//  })
				//  $(".stop").click(function(){
				//    owl.trigger('owl.stop');
				//  })

			});
		</script>
		<?php
	}
}