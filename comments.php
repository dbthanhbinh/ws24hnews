<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'ws24h' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'ws24h'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h2>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => __( 'Reply', 'ws24h' ),
				) );
			?>
		</ul>

		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . __( 'Previous', 'ws24h' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'ws24h' ) . '</span>',
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'ws24h' ); ?></p>
	<?php
	endif;
	// function alter_comment_form_fields($fields){
	// 	//$fields['author'] = ''; //removes name field
	// 	$fields['email'] = '';  //removes email field
	// 	$fields['url'] = '';  //removes website field
	// 	$fields['cookies'] = '';
	// 	return $fields;
	// }	
	// add_filter('comment_form_default_fields','alter_comment_form_fields');
	// comment_form([]);



	add_filter( 'comment_form_defaults', 'so16856397_comment_form_defaults', 10, 1 );
	function so16856397_comment_form_defaults( $defaults )
	{
		$defaults['comment_field'] = '<p class="comment-form-comment"> <textarea id="comment" name="comment" placeholder="' . __( 'Comment (*)' ) . '" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></p>';
		return $defaults;
	}

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields =  array(
		//'comment_field' => '<p class="comment-form-comment"> <textarea id="comment" name="comment" placeholder="' . __( 'Comment' ) . ( $req ? ' (*)' : '' ) .'" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></p>',
		'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" placeholder="' . __( 'Name' ) . ( $req ? ' (*)' : '' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" placeholder="' . __( 'Email' ) . ( $req ? ' (*)' : '' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	);
	
	$comments_args = array(
		'fields' =>  $fields,
		'title_reply'=>'Please give us your valuable comment',
		'label_submit' => 'Send Comment'
	);
	
	comment_form($comments_args);
	?>

</div><!-- #comments -->
