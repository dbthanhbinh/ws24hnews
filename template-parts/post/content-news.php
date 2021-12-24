<?php
	// process args
	$cols = DISPLAY_COLS_NUMBER;
	if(isset($args)){
		$isGrid = (isset($args['isGrid']) && $args['isGrid']) ? $args['isGrid'] : false;
		$cols = (isset($args['cols']) && $args['cols']) ? $args['cols'] : DISPLAY_COLS_NUMBER;
	}
	$layout = (isset($args['layout']) && $args['layout']) ? $args['layout'] : LAYOUT_RIGHT_SIDEBAR;
	$content_type = (isset($args['content_type']) && $args['content_type']) ? $args['content_type'] : '';
	$archiveAuthor = (isset($args['author']) && $args['author']) ? $args['author'] : false;
	$archiveDate = (isset($args['date']) && $args['date']) ? $args['date'] : false;
	$archiveReadMore = (isset($args['readMore']) && $args['readMore']) ? $args['readMore'] : false;
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

	<div class="entry-content <?= $archiveDate ? HAS_BADGE_CLASS : '' ?>">
		<header class="entry-header">
			<?php
				if ((isset($content_type) && $content_type == 'related')) $tagHeader = 'h4';
				elseif(is_single()) $tagHeader = 'h1';
				elseif (is_front_page() && is_home()) $tagHeader = 'h4';
				the_title('<'.$tagHeader.' class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></'.$tagHeader.'>');
			?>
		</header>
		<div class="entry-summary">
			<?= get_excerpt(150, $archiveReadMore); ?>
		</div>

		<?php
			if ($archiveDate) {
				// Format date = '20-11'
				echo displayBadgeDayMonth(get_the_date('d-m'));
			}
		?>
	</div>
</article>