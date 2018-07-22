<?php
## WIDGET POPULAR ------------------------------------------ #
register_widget( 'ws24h_popular_widget' );
class ws24h_popular_widget extends WP_Widget
{
    /**
	 * Register widget with
	 */
	function __construct() {
		parent::__construct(
			'ws24h_popular', // Base ID
			__( 'Widget Ws24h Post', THEME_NAME ), // Name
			array( 'description' => __( 'A Ws24h Post Widget', THEME_NAME ), ) // Args
		);
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
        global $post,$exclude_post;
        
        $color_full = ''; 
               
        $style_color = 'none';
        if(!empty($instance['style_color']))
            $style_color = $instance['style_color'];  
            
        if(!empty($instance['color_full']))
            $color_full = 'ms-block-color-full-'.$style_color;
            
        if($style_color!='none')
            $before_widget = str_ireplace('class="ms-block-item','class="ms-block-style-'.$style_color.' ms-block-item '.$color_full,$args['before_widget']);
        else
            $before_widget = $args['before_widget'];
        
        echo $before_widget; //$args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
            
        if(!empty($instance['no_of_posts']))
            $no_of_posts = $instance['no_of_posts'];
        else
            $no_of_posts = 2;
        
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
		$datetime = $instance['datetime'];
        $comment = $instance['comment']; 
        
        /*------- Code display front-end ------*/
        $exclude_post = get_the_ID();
        if(isset($instance['latest']) && $instance['latest'])
            $lastPosts = get_posts('category='.$cats_id.'&exclude='.$exclude_post.'&orderby=modified&order=DESC&no_found_rows=1&suppress_filters=0&numberposts='.$no_of_posts);
        else    
            $lastPosts = get_posts('category='.$cats_id.'&meta_key='.$wpdb->prefix.'showpostview&exclude='.$exclude_post.'&orderby=meta_value_num&order=DESC&no_found_rows=1&suppress_filters=0&numberposts='.$no_of_posts);
    	        
        if(!empty($lastPosts))
        {
            echo '<div class="ms-box-content">';
            $count=1;
            foreach($lastPosts as $post): setup_postdata($post);            
            if($count==1)
                $firsts = 'ms-box-item-first';
            else
                $firsts = '';
            
            ?>
            <div class="ms-box-item left-thumb-item <?php echo $firsts;?>">									
				<div class="title_news"><a href="<?php the_permalink();?>" title="<?php the_title();?>"> 
                    <?php the_title();?> </a>
                    <?php if($comment=='true'):?>
                    <label><span class="cm-icon"></span><?php comments_number('0','1','%');?></label>
                    <?php endif;?>
                    </div>
	               <?php 
                   if($thumb=='true' && has_post_thumbnail()):
                   ?>
    			<div class="item-thumb" <?php if($thumb_full=='true') echo 'style="width:100%; max-width:100%;"';?>>
					<a href="<?php the_permalink();?>" title="<?php the_title();?>">
					   <?php the_post_thumbnail('thumbnail');?>
					</a>
				</div>
                <?php endif;?>
                <?php if($excerpt_hidden=='true'){}else{?>
				<div class="item-lead">																
					<?php echo db_shortDesc(get_the_excerpt(),$excerpt_len);?>
				</div>
				<?php }?>
			</div>
            <?php
            $count++;
            endforeach;
            wp_reset_query();
            echo '</div>';           
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
        
		?>
        
		<p>
    		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:',THEME_NAME ); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
			<?php if(isset($instance['cats_id'])) $cats_id = explode ( ',' , $instance['cats_id'] ) ; ?>
			<label for="<?php echo $this->get_field_id( 'cats_id' ); ?>"><?php echo  __('Category : (keep Ctrl and choosen multiple)',THEME_NAME); ?></label>
			<select class="widefat" multiple="multiple" id="<?php echo $this->get_field_id( 'cats_id' ); ?>[]" name="<?php echo $this->get_field_name( 'cats_id' ); ?>[]">
				<?php foreach ($categories as $key => $option) { ?>
				<option value="<?php echo $key ?>" <?php if (isset($cats_id) && in_array( $key , $cats_id ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'latest' ); ?>"><?php echo __('Latest news:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'latest' ); ?>" name="<?php echo $this->get_field_name( 'latest' ); ?>" value="true" <?php if(!empty($instance['latest']) && $instance['latest'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'excerpt_len' ); ?>"> <?php echo __('Excerpt Len to show:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'excerpt_len' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_len' ); ?>" value="<?php if(!empty($instance['excerpt_len'])) echo $instance['excerpt_len']; ?>" type="text" size="3" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'excerpt_hidden' ); ?>"><?php echo __('Hidden excerpt:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'excerpt_hidden' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_hidden' ); ?>" value="true" <?php if(!empty($instance['excerpt_hidden']) && $instance['excerpt_hidden'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"> <?php echo __('Number of posts to show:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php if(!empty($instance['no_of_posts'])) echo $instance['no_of_posts']; ?>" type="text" size="3" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'thumb' ); ?>"><?php echo __('Display Thumbnail:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'thumb' ); ?>" name="<?php echo $this->get_field_name( 'thumb' ); ?>" value="true" <?php if( !empty($instance['thumb']) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'thumb_full' ); ?>"><?php echo __('Thumbnail Full:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'thumb_full' ); ?>" name="<?php echo $this->get_field_name( 'thumb_full' ); ?>" value="true" <?php if( !empty($instance['thumb_full']) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'datetime' ); ?>"><?php echo __('Display date:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'datetime' ); ?>" name="<?php echo $this->get_field_name( 'datetime' ); ?>" value="true" <?php if( !empty($instance['datetime']) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'comment' ); ?>"><?php echo __('Display comment:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'comment' ); ?>" name="<?php echo $this->get_field_name( 'comment' ); ?>" value="true" <?php if( !empty($instance['comment']) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'color_full' ); ?>"><?php echo __('Title full color:',THEME_NAME);?> </label>
			<input id="<?php echo $this->get_field_id( 'color_full' ); ?>" name="<?php echo $this->get_field_name( 'color_full' ); ?>" value="true" <?php if( !empty($instance['color_full']) ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        <hr />
        <h3>Style Color</h3>
        
        <p>
            <?php 
            $color_list = ws24h_widget_color();
            ?>
        
            <label><span style="background-color: #fff; padding:2px 5px;">none</span></label>
            <input id="<?php echo $this->get_field_id( 'none' ); ?>" name="<?php echo $this->get_field_name( 'style_color' ); ?>" value="none" type="radio" <?php if(empty($instance['style_color']) || $instance['style_color']=='none') echo 'checked="checked"';?>/> 
            <?php 
            foreach ($color_list as $color)
            {
                $checked = '';
                if(!empty($instance['style_color']) && $instance['style_color']==$color)
                    $checked = 'checked="checked"';
                
                ?>
                <label><span style="background-color: #<?php echo $color;?>; padding:2px 5px; display: inline-block; width: 10px; height: 15px;"></span></label>
                <input id="<?php echo $this->get_field_id( $color ); ?>" name="<?php echo $this->get_field_name( 'style_color' ); ?>" value="<?php echo $color;?>" type="radio" <?php echo $checked;?>/>
                <?php
            }
            ?>            
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
        $instance['cats_id'] = implode(',' , $new_instance['cats_id']  );
        $instance['latest'] = strip_tags( $new_instance['latest'] );			
        $instance['excerpt_len'] = strip_tags( $new_instance['excerpt_len'] );
        $instance['excerpt_hidden'] = strip_tags( $new_instance['excerpt_hidden'] );
        $instance['no_of_posts'] = strip_tags( $new_instance['no_of_posts'] );
        $instance['thumb'] = strip_tags( $new_instance['thumb'] );
        $instance['thumb_full'] = strip_tags( $new_instance['thumb_full'] );
        $instance['datetime'] = strip_tags( $new_instance['datetime'] );
        $instance['comment'] = strip_tags( $new_instance['comment'] );
        $instance['color_full'] = strip_tags( $new_instance['color_full'] );	
        $instance['style_color'] = strip_tags( $new_instance['style_color'] );

		return $instance;
	}	

}
// End Support Popular widget