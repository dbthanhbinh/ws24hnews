<?php
function showBoxTitle ($boxTitle) {
	?>
	<div class="col-lg-12">
		<div class="home-box-title">
			<h2 class="home-box-header"><a href="#"><?= $boxTitle ?></a></h2>
		</div>
	</div>
	<?php
}

function get_home_recent( $cat_data ) {
	$cat_include 	= (isset($cat_data['include']) && $cat_data['include']) ? $cat_data['include'] : null;
	$numberPost 	= $cat_data['number'] ? $cat_data['number'] : 5;
	$boxTitle 		= $cat_data['title'] ? $cat_data['title'] : null;
	$show_title 	= (isset($cat_data['show_title']) && $cat_data['show_title']) ? $cat_data['show_title'] : null;

	$postQuery = new WP_Query(['category__in' => $cat_include, 'posts_per_page' => $numberPost]);
	if($postQuery->have_posts()):
		$pos = 1;
		$cat_style = (isset($cat_data['style']) && $cat_data['style']) ? $cat_data['style'] : '12';
		while ($postQuery->have_posts()): $postQuery->the_post();
			if($pos == 1){
				($show_title == 'y') ? showBoxTitle ($boxTitle) : '';
			}
			get_template_part('template-parts/post/content', '');
			
			$pos++;
		endwhile;
	endif;
}