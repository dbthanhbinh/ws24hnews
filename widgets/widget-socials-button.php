<?php
register_widget( 'ws24h_social_buttons' );
class ws24h_social_buttons extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'ws24h_social_buttons',
			'description' => 'Ws24h social buttons',
		);
		parent::__construct( 'ws24h_social_buttons', 'Ws24h social buttons', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		extract( $args );

		$title = (isset($instance['title']) && $instance['title']) ? $instance['title'] : '';
		$facebookLink = get_theme_mod('facebook_link');
		$googleLink = get_theme_mod('google_plus_link');
		$youtubeLink = get_theme_mod('youtube_link');
		$twitterLink = get_theme_mod('twitter_link');

		$before_widget = $args['before_widget'];
		echo $before_widget; //$args['before_widget'];
		/*------- Code display front-end ------*/
		?>
		<div class="ws24h-support-group support-socials-list" rel="nofollow">
			<?php
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
			}
			?>
			<ul class="socials-link-list">
				<li><a href="<?= $facebookLink ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i><span class="hd-text">Facebook</span></a></li>
				<li><a href="<?= $youtubeLink ?>"><i class="fa fa-youtube-square" aria-hidden="true"></i><span class="hd-text">Youtube</span></a></li>
				<li><a href="<?= $twitterLink ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i><span class="hd-text">Twitter</span></a></li>
			</ul>
		</div>
		<?php
		/*------- End Code display front-end ------*/
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = (isset($instance['title']) && !empty($instance['title'])) ?  $instance['title'] : __('Liên kết mạng xã hội');
		?>
		<p>
    		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Heading:',THEME_NAME ); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['title'] = (isset($new_instance['title']) && !empty($new_instance['title'])) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}