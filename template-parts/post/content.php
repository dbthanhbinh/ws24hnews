<article id="post-<?php the_ID(); ?>" <?php //post_class(); ?>>
	<?php if ( (isset($content_type) && $content_type == 'related') || ('' !== get_the_post_thumbnail() && ! is_single()) ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'thumbnail' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<header class="entry-header">
			<?php
			if ((isset($content_type) && $content_type == 'related')) {
				the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			}
			elseif ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} elseif ( is_front_page() && is_home() ) {
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->

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

			// =============			
			ws24h_posted_on ();
		}
		?>
	</div><!-- .entry-content -->
</article>