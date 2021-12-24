<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Không tìm thấy', THEMENAME); ?></h1>
	</header>
	<div class="page-content page-search-notfound">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', THEMENAME ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php else : ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', THEMENAME); ?></p>
			<?php
				get_search_form();
		endif; ?>
	</div>
</section>
