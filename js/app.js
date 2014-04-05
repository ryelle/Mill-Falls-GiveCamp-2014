/**
 * Add media modal to widget screen
 */

var mfcs = {
	frame: false
};

jQuery( document ).ready( function( $ ) {

	/**
	 * Customize Media Uploader for category sponsor logos
	 */
	$('body').on('click', '.upload_image_button', function( event ){
		event.preventDefault();

		var $container = $( this ).parent();

		// If the media frame already exists, reopen it.
		if ( mfcs.frame ) {
			mfcs.frame.container = $container;
			mfcs.frame.open();
			return;
		}
		// Create the media frame.
		mfcs.frame = wp.media.frames.clearance_frame = wp.media({
			title: $( this ).data( 'uploader_title' ),
			button: {
				text: $( this ).data( 'uploader_button_text' )
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});
		mfcs.frame.container = $container;

		// When an image is selected, run a callback.
		mfcs.frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = mfcs.frame.state().get('selection').first().toJSON();

			var url = attachment.sizes.widget ? attachment.sizes.widget.url : attachment.url;

			mfcs.frame.container.find('.preview').html( $('<img>').attr( 'src', url ) );
			mfcs.frame.container.find('.bg-image').val( attachment.id );
			mfcs.frame.container.find('.upload_image_button').text('Change Image');
			mfcs.frame.container.find('.remove_sponsor_image').removeClass('hide-if-no-image');

		});

		// Finally, open the modal
		mfcs.frame.open();
	});

	// Remove image
	$('body').on('click', '.remove_sponsor_image', function( event ){
		event.preventDefault();

		var $container = $( this ).parent();

		$container.find('.preview').html( '' );
		$container.find('.bg-image').val( '' );
		$container.find('.upload_image_button').text('Add Image');
		$container.find('.remove_sponsor_image').addClass('hide-if-no-image');
	});

} );
