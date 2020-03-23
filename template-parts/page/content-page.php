<article id="post-<?php the_ID(); ?>" <?php post_class('entry-content'); ?>>
	<?php
	$slug = get_queried_object()->post_name;
	$contactClass = null;
	if ($slug == 'lien-he' || $slug == 'contact') {
		$contactClass = 'contact-page-content';
	}
	if (!$contactClass) {
	?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php }?>
	<div class="entry-content <?= $contactClass ?>">
		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ws24h' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
