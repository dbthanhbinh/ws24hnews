<?php
if (post_password_required()) {
	return false;
}
?>

<div id="comments" class="comments-area">
	<?php
	if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();			
			?>
			<?=  __('List_of_comments', THEMENAME) ?>
			<span><i class="fa fa-comments-o" aria-hidden="true"></i> (<?= $comments_number ?>) </span>
		</h2>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => __('Reply_text', THEMENAME),
				) );
			?>
		</ul>

		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . __('Prev_text', THEMENAME) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __('Next_text', THEMENAME) . '</span>',
		) );
	endif;
	
	// Check for have_comments().
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?= __('Comments_are_closed', THEMENAME) ?></p>
	<?php
	endif;

	add_filter( 'comment_form_defaults', 'wc_comment_form_defaults', 10, 1 );
	function wc_comment_form_defaults( $defaults ) {
		$defaults['comment_notes_before'] = '<p class="comment-notes">'. __('Comment_notes_before', THEMENAME) .'</p>';
		$defaults['comment_field'] = '<p class="comment-form-comment"> <textarea id="comment" name="comment" placeholder="' . __('Write_your_comments', THEMENAME) . '" aria-describedby="form-allowed-tags" aria-required="true" required="required"></textarea></p>';
		return $defaults;
	}

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$fields =  array (
		'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" placeholder="' . __('Comment_author', THEMENAME) . ( $req ? ' (*)' : '' ) .'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" placeholder="' . __('Comment_author_email', THEMENAME) . ( $req ? ' (*)' : '' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	);

	$comments_args = array (
		'fields' =>  $fields,
		'title_reply'=> '<i class="fa fa-comments fa-custom-size" aria-hidden="true"></i> '. __('Your_comments', THEMENAME),
		'label_submit' => __('Send_comment', THEMENAME)
	);

	comment_form($comments_args);
	?>
</div>

