/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */
(function( $ ) {
	api = wp.customize;
	
	api("contact_name", function(value) {
		console.log('======',value)
		value.bind(function(newval) {
			$(".footer_text").html(newval);
		});
	});
	
	// Collect information from customize-controls.js about which panels are opening.
	wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load
		$( '.panel-placeholder' ).hide();

		
	});

} )( jQuery );
