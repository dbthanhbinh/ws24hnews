<?php
## WIDGET POPULAR ------------------------------------------ #
register_widget( 'FreeTheme_fanpage_widget' );
class FreeTheme_fanpage_widget extends WP_Widget
{
    /**
	 * Register widget with
	 */
	function __construct() {
		// This is where we add the style and script
		add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );
		parent::__construct(
			'FreeTheme_fanpage', // Base ID
			__( 'FreeTheme fanpage', THEME_NAME ), // Name
			array( 'description' => __( 'A FreeTheme Fanpage Widget', THEME_NAME ), ) // Args
		);
	}

	function my_custom_load() {    
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );    
    }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		global $post;
        echo $args['before_widget'];         
        /*------- Code display front-end ------*/           
            echo '<div class="ms-box-content widget-fanpage-content">';
            echo '
			<div class="fb-page" 
			data-href="'.$instance['fanpage_url'].'"
			data-width="" data-height="" 
			data-hide-cover="false"
			data-show-facepile="false"></div>
			';
            echo '</div>';
        	
        /*------- End Code display front-end ------*/
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$defaults = array(
			'fanpage_url' => get_theme_mod('facebook_link')
        );
        // Merge the user-selected arguments with the defaults
        $instance = wp_parse_args( (array) $instance, $defaults );
		?>
			<p>
				<label for="<?php echo $this->get_field_id('fanpage_url'); ?>"><?php _e( 'Fanpage url', THEME_NAME ); ?></label>
				<input class="set_fanpage_url"
					type="text"
					id="<?php echo $this->get_field_id('fanpage_url'); ?>"
					name="<?php echo $this->get_field_name('fanpage_url'); ?>"
					value="<?php echo esc_attr($instance['fanpage_url']); ?>" />
			</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
    {
		$instance = array();
		$instance['fanpage_url'] = (!empty($new_instance['fanpage_url'])) ? strip_tags($new_instance['fanpage_url']) : '';
		return $instance;
	}	

}
// End Support Popular widget