<article id="post-<?php the_ID(); ?>" <?php post_class('no-thumb'); ?>>
	<div class="entry-content">
		<header class="entry-header">
			<?php
			if ((isset($content_type) && $content_type == 'related')) {
				the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
			}
			elseif ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} elseif ( is_front_page() && is_home() ) {
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"> <i class="fa fa-angle-double-right" aria-hidden="true"></i>', '</a></h3>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			?>
		</header><!-- .entry-header -->
	</div><!-- .entry-content -->
</article>