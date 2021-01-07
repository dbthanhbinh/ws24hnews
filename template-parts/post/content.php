<?php
$cardClass = 'col-sm-6 col-md-4 col-lg-3';
?>
<article class="post-<?php the_ID(); ?> <?= $cardClass ?>">
	<?php if ( (isset($content_type) && $content_type == 'related') || ('' !== get_the_post_thumbnail() && ! is_single()) ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<header class="entry-header">
			<?php
				$tagHeader = 'h2';
				if ((isset($content_type) && $content_type == 'related')) $tagHeader = 'h4';
				elseif(is_single()) $tagHeader = 'h1';
				elseif (is_front_page() && is_home()) $tagHeader = 'h3';
				the_title('<'.$tagHeader.' class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></'.$tagHeader.'>');
			?>
		</header>

		<?php
		if ( is_category() || is_archive() || is_search() || is_home() || is_front_page() || (isset($content_type) && $content_type == 'related')) {
			the_excerpt ( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', THEME_NAME ),
				get_the_title()
			) );
		} else {
			the_content( sprintf(
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', THEME_NAME ),
				get_the_title()
			) );
			ws24h_posted_on ();
		}
		?>
	</div>
</article>