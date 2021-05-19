<?php
## WIDGET POPULAR ------------------------------------------ #
register_widget( 'ws24h_video_widget' );
class ws24h_video_widget extends WP_Widget
{
    /**
	 * Register widget with
	 */
	function __construct() {
		// This is where we add the style and script
		add_action( 'load-widgets.php', array(&$this, 'my_custom_load') );
		parent::__construct(
			'ws24h_video', // Base ID
			__( 'Ws24h video', THEME_NAME ), // Name
			array( 'description' => __( 'A Ws24h youtobe video Widget', THEME_NAME ), ) // Args
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

		$background_color = (isset($instance['background_color']) && $instance['background_color']) ? $instance['background_color'] : null;
		$title_color = (isset($instance['title_color']) && $instance['title_color']) ? $instance['title_color'] : null;

		if($background_color) $args['before_title'] = str_replace( '<h2', '<h2 style="background:'.$background_color.'"', $args['before_title'] );
		if($title_color) $args['before_title'] = str_replace( '<label>', '<label style="color:'.$title_color.'; border-color:'.$title_color.'">', $args['before_title'] );

        echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
        if(!empty($instance['source']))
            $source = $instance['source'];
        else
            $source = '';
        
        if(!empty($instance['video_width']))
            $video_width = 'width="'.$instance['video_width'].'"';
        else
            $video_width = '';
            
        if(!empty($instance['video_height']))
            $video_height = 'height="'.$instance['video_height'].'"';
        else
            $video_height = '';               
        /*------- Code display front-end ------*/           
            echo '<div class="ms-box-content widget-video-content">';
            if(!empty($source)):
            
            $pathinfo = pathinfo($source);
            if($pathinfo['dirname']=='https://youtu.be')
                $source = str_ireplace("https://youtu.be","",$source);
            else if($pathinfo['dirname']=='https://www.youtube.com')
                $source = str_ireplace("https://www.youtube.com/watch?v=","",$source);
            else 
                $source = '';
                ?>
                    <iframe <?php echo $video_width;?> <?php echo $video_height;?> src="https://www.youtube.com/embed/<?php echo $source;?>" frameborder="0" allowfullscreen></iframe>
                <?php
            endif;
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Widget video title', THEME_NAME );
		$defaults = array(
			'background_color' => '#f1f1f1',
			'title_color' => '#000000'
        );
        // Merge the user-selected arguments with the defaults
        $instance = wp_parse_args( (array) $instance, $defaults );
		?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.set_background_color').wpColorPicker();
				$('.set_title_color').wpColorPicker();
            });
		</script> 
		<p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Header background color', THEME_NAME ); ?></label>
            <input class="set_background_color" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />
		</p>
		<p>
            <label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e( 'Title color', THEME_NAME ); ?></label>
            <input class="set_title_color" type="text" id="<?php echo $this->get_field_id( 'title_color' ); ?>" name="<?php echo $this->get_field_name( 'title_color' ); ?>" value="<?php echo esc_attr( $instance['title_color'] ); ?>" />
        </p>
		<p>
    		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:',THEME_NAME ); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
    		<label for="<?php echo $this->get_field_id( 'source' ); ?>"><?php echo __( 'Source video:',THEME_NAME ); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'source' ); ?>" name="<?php echo $this->get_field_name( 'source' ); ?>" type="text" value="<?php echo $instance['source']; ?>">
		</p>        
        <p>
			<label for="<?php echo $this->get_field_id( 'video_width' ); ?>"> <?php echo __('Video width:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'video_width' ); ?>" name="<?php echo $this->get_field_name( 'video_width' ); ?>" value="<?php echo $instance['video_width']; ?>" type="text" size="3" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'video_height' ); ?>"> <?php echo __('Video Height:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'video_height' ); ?>" name="<?php echo $this->get_field_name( 'video_height' ); ?>" value="<?php echo $instance['video_height']; ?>" type="text" size="3" />
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['background_color'] = strip_tags( $new_instance['background_color'] );
		$instance['title_color'] = strip_tags( $new_instance['title_color'] );
        $instance['source'] = strip_tags( $new_instance['source'] );
        $instance['video_height'] = strip_tags( $new_instance['video_height'] );
        $instance['video_width'] = strip_tags( $new_instance['video_width'] );
		return $instance;
	}	

}
// End Support Popular widget