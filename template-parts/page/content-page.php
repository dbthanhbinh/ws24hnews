<article id="post-<?php the_ID(); ?>" <?php post_class('entry-content'); ?>>
	<!-- <header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header> -->
	<div class="entry-content <?= $contactClass ?>">
		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __('Pages:'),
				'after'  => '</div>',
			) );
		?>
	</div>
</article>