<?php
	// process args
	$cols = 4;
	if(isset($args)){
		$isGrid = (isset($args['isGrid']) && $args['isGrid']) ? $args['isGrid'] : false;
		$cols = (isset($args['cols']) && $args['cols']) ? $args['cols'] : 4;
	}
	$layout = (isset($args['layout']) && $args['layout']) ? $args['layout'] : LAYOUT_RIGHT_SIDEBAR;
	$content_type = (isset($args['content_type']) && $args['content_type']) ? $args['content_type'] : '';
	$tagHeader = 'h2';
	$cardColClass = getColsLayout($isGrid, $cols)
?>
<article class="<?= $cardColClass ?>">
	<?php if(has_post_thumbnail()){ ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(getThumbSize($layout, $cols), ['alt' => esc_html(get_the_title()), 'title' => esc_html(get_the_title())]); ?>
			</a>
		</div>
	<?php } ?>

	<div class="entry-content">
		<header class="entry-header">
			<?php
				if ((isset($content_type) && $content_type == 'related')) $tagHeader = 'h4';
				elseif(is_single()) $tagHeader = 'h1';
				elseif (is_front_page() && is_home()) $tagHeader = 'h4';
				the_title('<'.$tagHeader.' class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></'.$tagHeader.'>');
			?>
		</header>
		<?php the_excerpt(); ?>
	</div>
</article>