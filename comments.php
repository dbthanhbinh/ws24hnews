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
			?>
			Danh sách bình luận :  <span><i class="fa fa-comments-o" aria-hidden="true"></i> (<?= $comments_number ?>) </span>
		</h2>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => __( 'Trả lời', 'FastSpa' ),
				) );
			?>
		</ul>

		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . __( 'Trước:', 'FastSpa' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Sau', 'FastSpa' ) . '</span>',
		) );

	endif;
	// Check for have_comments().
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'FastSpa' ); ?></p>
	<?php
	endif;

	add_filter( 'comment_form_defaults', 'so16856397_comment_form_defaults', 10, 1 );
	function so16856397_comment_form_defaults( $defaults ) {
		$defaults['comment_field'] = '<p class="comment-form-comment"> <textarea id="comment" name="comment" placeholder="' . getTranslateByKey('write_your_comments') . '" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></p>';
		return $defaults;
	}
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		//'comment_field' => '<p class="comment-form-comment"> <textarea id="comment" name="comment" placeholder="' . __( 'Comment' ) . ( $req ? ' (*)' : '' ) .'" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></p>',
		'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" placeholder="' . getTranslateByKey('comment_author') . ( $req ? ' (*)' : '' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" placeholder="' . getTranslateByKey('comment_author_email') . ( $req ? ' (*)' : '' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	);
	$comments_args = array(
		'fields' =>  $fields,
		'title_reply'=> '<i class="fa fa-comments fa-custom-size" aria-hidden="true"></i> '.getTranslateByKey('your_comments'),
		'label_submit' => getTranslateByKey('send_comment')
	);
	comment_form($comments_args);
	?>
</div>

