<article <?php post_class(); ?>>
	<?php if ( (isset($content_type) && $content_type == 'related') || ('' !== get_the_post_thumbnail() && ! is_single()) ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('thumbnail', ['alt' => esc_html(get_the_title()), 'title' => esc_html(get_the_title())]); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<header class="entry-header entry-page-header">
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
		</header>
		<!-- .entry-header -->

		<?php
			the_content();
		?>
	</div><!-- .entry-content -->
</article>