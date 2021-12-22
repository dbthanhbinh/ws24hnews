<?php
	// process args
	$cols = DISPLAY_COLS_NUMBER;
	$isGrid = (isset($args['isGrid']) && $args['isGrid']) ? $args['isGrid'] : false;
	$cols = (isset($args['cols']) && $args['cols']) ? $args['cols'] : DISPLAY_COLS_NUMBER;
	$layout = (isset($args['layout']) && $args['layout']) ? $args['layout'] : LAYOUT_RIGHT_SIDEBAR;
	$content_type = (isset($args['content_type']) && $args['content_type']) ? $args['content_type'] : null;
	$tagHeader = 'h2';
	$cardColClass = getColsLayout($isGrid, $cols);
?>
<article class="<?= $cardColClass ?>">
	<?php if(has_post_thumbnail()){ ?>
		<div class="shine-effect post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(getThumbSize($layout, $cols), ['alt' => esc_html(get_the_title()), 'title' => esc_html(get_the_title())]); ?>
			</a>
		</div>
	<?php } ?>
	<?php
		$hasBadge = true;
	?>
	<div class="entry-content <?= $hasBadge ? HAS_BADGE_CLASS : '' ?>">
		<header class="entry-header">
			<?php
				if(is_single()) $tagHeader = 'h1';
				elseif (is_front_page() && is_home()) $tagHeader = 'h4';
				if ((isset($content_type) && $content_type == 'related')) $tagHeader = 'h6';
				the_title('<'.$tagHeader.' class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></'.$tagHeader.'>');
			?>
		</header>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

		<?php
			if ($hasBadge) {
				?>
					<div class="badge absolute top post-date badge-square">
						<div class="badge-inner">
							<span class="post-date-day">21</span>
							<span class="post-date-month is-xsmall">Th7</span>
						</div>
					</div>
				<?php
			}
		?>
	</div>
</article>