<?php
## WIDGET POPULAR ------------------------------------------ #
register_widget( 'ws24h_contact_widget' );
class ws24h_contact_widget extends WP_Widget
{
    /**
	 * Register widget with
	 */
	function __construct() {
		parent::__construct(
			'ws24h_contact_info', // Base ID
			__( 'Ws24h contact info', THEMENAME ), // Name
			array( 'description' => __('Ws24h contact infomation', THEMENAME ), ) // Args
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
		extract( $args );

		$companyName = get_theme_mod('company_footer_name');
		$contactAddress = get_theme_mod('contact_address');
		$contactEmail = get_theme_mod('contact_email');
		$contactPhone = get_theme_mod('contact_phone');

		if($companyName || $contactAddress || $contactEmail || $contactPhone){
			$before_widget = $args['before_widget'];
			echo $before_widget; //$args['before_widget'];
			/*------- Code display front-end ------*/
			$facebookLink = get_theme_mod('facebook_link');
			$facebookName = get_theme_mod('facebook_name');
			?>
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="ws24h-support-group support-contact" rel="nofollow">
						<?php
						if (!empty($companyName)){
							echo $args['before_title'] . apply_filters( 'widget_title', $companyName ). $args['after_title'];
						}
						?>
						<?php if($contactAddress || $contactEmail || $contactPhone){?>
						<ul class="contact-list">
							<?php if($contactAddress){?><li><b>ĐC:</b> <?= $contactAddress ?></li><?php }?>
							<?php if($contactPhone){?><li><b>ĐT:</b> <a href="tel:<?= $contactPhone ?>"> <?= $contactPhone ?></a></li><?php }?>
							<?php if($contactEmail){?><li><b>Email:</b> <a href="mailto:<?= $contactEmail ?>"> <?= $contactEmail ?></a></li><?php }?>
							<?php if($facebookLink){?><li><b>FB:</b> <a rel="noopener" target="_blank" href="<?= $facebookLink ?>"> <?= $facebookName ? $facebookName : $facebookLink ?></a></li><?php }?>
						</ul>
						<?php }?>
					</div>
				</div>
			</div>
			<?php
			/*------- End Code display front-end ------*/
			echo $args['after_widget'];
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
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
		return $old_instance;
	}	

}
// End Support contact_widget