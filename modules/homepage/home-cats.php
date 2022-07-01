<?php
function showBoxTitle($boxTitle, $showTitle, $description, $showDescription){
	?>
	<div class="row">
		<div class="<?= getDefaultFullLayout() ?>">
			<div class="home-box-title">
				<?php if($showTitle){?><h3 class="section-title"><?= $boxTitle ?></h3><?php }?>
				<?php if($showDescription){?><p><?= html_entity_decode($description) ?></p><?php }?>
				<div class="header-section-icon-container"> <span class='header-section-fa-icon'><i class="fa fa-leaf" aria-hidden="true"></i></span></div>
			</div>
		</div>
	</div>
	<?php
}

function get_home_recent( $cat_data ) {
	$showBox = (isset($cat_data['show_box']) && $cat_data['show_box']) ? $cat_data['show_box'] : 'y';
	if($showBox == 'y') {
		$cat_include 	= (isset($cat_data['include']) && $cat_data['include']) ? $cat_data['include'] : null;
		$numberPost 	= $cat_data['number'] ? $cat_data['number'] : 5;
		$boxTitle 		= $cat_data['title'] ? $cat_data['title'] : null;
		$showTitle 	= (isset($cat_data['show_title']) && $cat_data['show_title']) ? $cat_data['show_title'] : null;
		$description 	= $cat_data['description'] ? $cat_data['description'] : null;
		$showDescription 	= (isset($cat_data['show_description']) && $cat_data['show_description']) ? $cat_data['show_description'] : null;

		echo '<div class="section home-section animated recent-posts">';
		?>
		<div class="container">
			<?php
			if($cat_data['posttype'] == 'posts')
				$postQuery = new WP_Query(['category__in' => $cat_include, 'posts_per_page' => $numberPost]);
			else
				$postQuery = new WP_Query(['category__in' => $cat_include, 'post_type' => $cat_data['posttype'], 'posts_per_page' => $numberPost]);

			if($postQuery->have_posts()):
				$pos = 1;
				$args = [
					'isGrid' => isset($cat_data['display']) && $cat_data['display'] == 'grid' ? true : false,
					'cols' => $cat_data['grid_cols'],
					'layout' => 'full-width'
				];
				$showLayout = (isset($cat_data['show_layout']) && $cat_data['show_layout'] && $cat_data['show_layout'] == 'temp-1') ? 'temp-1' : '';
				echo '<div class="'.mainLayoutTemplate($args['isGrid']).'">';
				showBoxTitle($boxTitle, $showTitle, $description, $showDescription);

				echo '<div class="row">';
					while ($postQuery->have_posts()): $postQuery->the_post();
						$args['pos'] = $pos;
						$args['post_count'] = $postQuery->post_count;
						get_template_part('template-parts/post/content', $showLayout, $args);
						$pos++;
					endwhile;
				echo '</div>';
				echo '</div>';
			endif;
			?>
		</div>
		<?php
		echo '</div>';
	}
}

function get_home_videos($cat_data){
	$showBox = (isset($cat_data['show_box']) && $cat_data['show_box']) ? $cat_data['show_box'] : 'y';
	if($showBox == 'y') {
		$boxTitle 		= $cat_data['title'] ? $cat_data['title'] : null;
		$showTitle 	= (isset($cat_data['show_title']) && $cat_data['show_title']) ? $cat_data['show_title'] : null;
		$description 	= $cat_data['description'] ? $cat_data['description'] : null;
		$showDescription 	= (isset($cat_data['show_description']) && $cat_data['show_description']) ? $cat_data['show_description'] : null;
		$numberPost 	= $cat_data['number'] ? $cat_data['number'] : 3;

		$isGrid = isset($cat_data['display']) && $cat_data['display'] == 'grid' ? true : false;
		$cols = (isset($cat_data['grid_cols']) && $cat_data['grid_cols']) ? $cat_data['grid_cols'] : 3;
		$args = [
			'isGrid' => $isGrid,
			'cols' => $cols,
			'layout' => 'full-width'
		];

		echo '<div class="section home-section animated video-list '.mainLayoutTemplate($args['isGrid']).'">';
		echo '<div class="container">';
		showBoxTitle($boxTitle, $showTitle, $description, $showDescription);
		
		$postQuery = new WP_Query(['post_type' => 'custom-video', 'posts_per_page' => $numberPost]);
		if($postQuery->have_posts()):
		?>
		<div class="row">
		<div class="<?= getDefaultFullLayout() ?> home-video-section">
			<div class="row">
				<?php
				$cardColClass = getColsLayout($isGrid, $cols);

				while ($postQuery->have_posts()):
					$postQuery->the_post();
					$postId = get_the_ID();
					$customMeta = get_post_custom($postId);
					$youtube_video_link = null;
					$youtube_video_id = null;
					if($customMeta && $customMeta['youtube_video_link'] && $customMeta['youtube_video_link'][0])
						$youtube_video_link = $customMeta['youtube_video_link'][0];
					if ($youtube_video_link) {
						$youtube_video_id = get_youtube_id_from_url($youtube_video_link);
					}
					?>
					<div class="<?= $cardColClass ?> home-video-item">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?= $youtube_video_id ?>?feature=oembed&amp;start&amp;end&amp;wmode=opaque&amp;loop=0&amp;controls=1&amp;mute=0&amp;rel=0&amp;modestbranding=0" allowfullscreen></iframe>
						</div>
					</div>
					<?php
				endwhile;
				?>
			</div>
		</div>
		</div>
		<?php
		endif;
		echo '</div>';
		echo '</div>';
	}
}

function get_home_group_template( $cat_data ) {
	$showBox = (isset($cat_data['show_box']) && $cat_data['show_box']) ? $cat_data['show_box'] : 'y';
	if($showBox == 'y') {
		$boxTitle = (isset($cat_data['title']) && $cat_data['title']) ? $cat_data['title'] : null;
		$subTitle = (isset($cat_data['subtitle']) && $cat_data['subtitle']) ? $cat_data['subtitle'] : '';
		$show_title = (isset($cat_data['show_title']) && $cat_data['show_title']) ? $cat_data['show_title'] : 'y';
		$description = (isset($cat_data['description']) && $cat_data['description']) ? $cat_data['description'] : '';
		$showDescription = (isset($cat_data['show_description']) && $cat_data['show_description']) ? $cat_data['show_description'] : 'y';
		$homeGroupTemplate = (isset($cat_data['home_group']) && $cat_data['home_group']) ? $cat_data['home_group'] : 'home_group_1';
		$order = (isset($cat_data['order']) && $cat_data['order']) ? $cat_data['order'] : 1;

		$groupUploadBig = tie_get_option($homeGroupTemplate . '_upload_big');
		$groupName = tie_get_option($homeGroupTemplate . '_name');//
		$groupSubName = tie_get_option($homeGroupTemplate . '_subname');//
		$groupDescription = tie_get_option($homeGroupTemplate . '_description');//
		require($homeGroupTemplate.'.php');
	}
}