<?php
## WIDGET POPULAR ------------------------------------------ #
register_widget( 'FreeTheme_popular_widget' );
class FreeTheme_popular_widget extends WP_Widget
{
    /**
	 * Register widget with
	 */
	function __construct() {
		add_action( 'load-widgets.php', array( &$this ,'my_custom_load') );
		parent::__construct(
			'FreeTheme_popular', // Base ID
			__( 'FreeTheme Post popular', THEME_NAME ), // Name
			array( 'description' => __( 'FreeTheme Post popular', THEME_NAME ), ) // Args
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
	    wp_reset_query();
		extract( $args );
		global $post,$exclude_post, $wpdb;
		
		$background_color = (isset($instance['background_color']) && $instance['background_color']) ? $instance['background_color'] : null;
		$title_color = (isset($instance['title_color']) && $instance['title_color']) ? $instance['title_color'] : null;

		if($background_color) $args['before_title'] = str_replace( '<h2', '<h2 style="background:'.$background_color.'"', $args['before_title'] );
		if($title_color) $args['before_title'] = str_replace( '<label>', '<label style="color:'.$title_color.'; border-color:'.$title_color.'">', $args['before_title'] );

		$before_widget = $args['before_widget'];
		
        echo $before_widget; //$args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
            
        if(!empty($instance['no_of_posts']))
            $no_of_posts = $instance['no_of_posts'];
        else
            $no_of_posts = 5;
        
        if(!empty($instance['excerpt_len']))
            $excerpt_len = $instance['excerpt_len'];
        else
            $excerpt_len = 120;
              
		$cats_id = $instance['cats_id'];
        
        $excerpt_hidden = false;
        if(!empty($instance['excerpt_hidden']))
		  $excerpt_hidden = $instance['excerpt_hidden'];
        $thumb = $instance['thumb'];
        $thumb_full = $instance['thumb_full'];
        
        /*------- Code display front-end ------*/
        $exclude_post = get_the_ID();
        if(isset($instance['latest']) && $instance['latest'])
            $lastPosts = get_posts('category='.$cats_id.'&exclude='.$exclude_post.'&no_found_rows=1&suppress_filters=0&numberposts='.$no_of_posts);
        else    
            $lastPosts = get_posts('category='.$cats_id.'&exclude='.$exclude_post.'&orderby=meta_value_num&order=DESC&no_found_rows=1&suppress_filters=0&numberposts='.$no_of_posts);
    	        
        if(!empty($lastPosts)) {
            echo '<ul class="widget-box-list">';
            $count=1;
            foreach($lastPosts as $post): setup_postdata($post);            
				if($count==1)
					$firsts = 'ms-box-item-first';
				else
					$firsts = '';
				
				?>
				<li class="box-list-item <?php echo $firsts;?>">
					<?php 
					if($thumb=='true' && has_post_thumbnail()):
					?>
						<div class="<?= $thumb_full=='true' ? 'item-thumb-full' : 'item-thumb' ?>">
							<a href="<?php the_permalink();?>" title="<?php the_title();?>">
								<?php the_post_thumbnail($thumb_full=='true' ? 'medium' : 'thumbnail', ['alt' => esc_html(get_the_title()), 'title' => esc_html(get_the_title())]);?>
							</a>
						</div>
					<?php endif;?>
					<?php if($excerpt_hidden=='true'){}else{?>
						<div class="item-lead">
							<h5 class="item-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"> 
								<?php the_title();?> </a>
							</h5>
							<?php echo get_excerpt($excerpt_len);?>
						</div>
					<?php }?>
				</li>
				<?php
				$count++;
			endforeach;
			
            wp_reset_query();
            echo '</ul>';           
        }    	
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $categories_obj = get_categories();
		$categories = array();
        foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		
		// include init values
		require ('defined.php');

        // Merge the user-selected arguments with the defaults
        $instance = wp_parse_args( (array) $instance, $defaultsValues );
		?>
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
				<?php
				foreach($defaultItems as $k=>$item){
					?>
					$('.<?= $item['class'] ?>').wpColorPicker();	
					<?php
				}	
				?>
            });
		</script>
		<p><label><strong>For header style</strong></label></p>
		<?php
		foreach($defaultItems as $k=>$item){
			$style = 'width:110px; float: left;';
			?>
			<p>
				<label style="<?= $style ?>" for="<?= $this->get_field_id($k) ?>"><?= $item['title'] ?></label>
				<input class="<?= $item['class'] ?>"
					type="text"
					id="<?= $this->get_field_id($k) ?>"
					name="<?= $this->get_field_name($k) ?>"
					value="<?= esc_attr($instance[$k]) ?>" />
			</p>
			<?php
		}
		?>
				
		<p>
    		<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:', THEME_NAME); ?></label> 
    		<input class="widefat"
				id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>"
				type="text"
				value="<?php echo esc_attr($title); ?>">
		</p>
        <p>
			<?php if(isset($instance['cats_id'])) $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id('cats_id'); ?>"><?php echo  __('From category : (keep Ctrl and choosen multiple)',THEME_NAME); ?></label>
			<select class="widefat" multiple="multiple"
				id="<?php echo $this->get_field_id('cats_id'); ?>[]"
				name="<?php echo $this->get_field_name('cats_id'); ?>[]">
				<?php
				$pos = 1;
				foreach ($categories as $key => $option) {
					if(!$cats_id && $pos==1){
						$cats_id = [$key];
					}
					?>
					<option value="<?php echo $key ?>" <?php if (isset($cats_id) && in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php
				$pos++;
				} ?>
			</select>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'latest' ); ?>"><?php echo __('Latest news:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'latest' ); ?>"
				name="<?php echo $this->get_field_name( 'latest' ); ?>"
				value="true" <?php if(!$instance['latest'] || (!empty($instance['latest']) && $instance['latest'])) echo 'checked="checked"'; ?>
				type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'excerpt_len' ); ?>"> <?php echo __('Excerpt Len to show:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'excerpt_len' ); ?>"
				name="<?php echo $this->get_field_name( 'excerpt_len' ); ?>"
				value="<?= !empty($instance['excerpt_len']) ? $instance['excerpt_len'] : 150 ?>"
				type="text" size="3" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'excerpt_hidden' ); ?>"><?php echo __('Hidden excerpt:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'excerpt_hidden' ); ?>"
				name="<?php echo $this->get_field_name( 'excerpt_hidden' ); ?>"
				value="true" <?php if(!empty($instance['excerpt_hidden']) && $instance['excerpt_hidden'] ) echo 'checked="checked"'; ?>
				type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"> <?php echo __('Number to show:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"
				name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>"
				value="<?= !empty($instance['no_of_posts']) ? $instance['no_of_posts'] : 5 ?>"
				type="text" size="3" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php echo __('Show Thumbnail:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>"
				name="<?php echo $this->get_field_name( 'thumb' ); ?>"
				value="true" <?php if(!$instance['thumb'] || !empty($instance['thumb']) ) echo 'checked="checked"'; ?>
				type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'thumb_full' ); ?>"><?php echo __('Thumbnail Full:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'thumb_full' ); ?>"
				name="<?php echo $this->get_field_name( 'thumb_full' ); ?>"
				value="true" <?php if( !empty($instance['thumb_full']) ) echo 'checked="checked"'; ?>
				type="checkbox" />
		</p>
		<?php 	}

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
		$instance['background_color'] = strip_tags( $new_instance['background_color'] );
		$instance['title_color'] = strip_tags( $new_instance['title_color'] );
		$instance['border_top_color'] = strip_tags( $new_instance['border_top_color'] );
		$instance['span_color'] = strip_tags( $new_instance['span_color'] );
		$instance['icon_color'] = strip_tags( $new_instance['icon_color'] );
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['cats_id'] = implode(',' , $new_instance['cats_id']  );
        $instance['latest'] = strip_tags( $new_instance['latest'] );			
        $instance['excerpt_len'] = strip_tags( $new_instance['excerpt_len'] );
        $instance['excerpt_hidden'] = strip_tags( $new_instance['excerpt_hidden'] );
        $instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
        $instance['thumb'] = strip_tags( $new_instance['thumb'] );
        $instance['thumb_full'] = strip_tags( $new_instance['thumb_full'] );
		return $instance;
	}	

}
// End Support Popular widget