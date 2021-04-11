<?php
register_widget( 'Ws24h_contact' );
class Ws24h_contact extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'ws24h_contact',
			'description' => 'Ws24h contact is awesome',
		);
		parent::__construct( 'ws24h_contact', 'Ws24h contact', $widget_ops );
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
						<!-- <?php if($companyName){?><h5><?= $companyName ?></h5><?php }?> -->
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
							<?php if($facebookLink){?><li><b>FB:</b> <a target="_blank" href="<?= $facebookLink ?>"> <?= $facebookName ? $facebookName : $facebookLink ?></a></li><?php }?>
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
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}