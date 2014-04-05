<?php
/**
 * Page metaboxes
 */

/**
 * Add a metabox to pages
 */
function mfcs_2014_register_meta_boxes() {
	add_meta_box( 'mfcs_colors', 'Header Color', 'mfcs_2014_metabox_color', 'page', 'side' );
}
add_action( 'add_meta_boxes', 'mfcs_2014_register_meta_boxes' );

/**
 * Display the color input metabox
 */
function mfcs_2014_metabox_color() {
	$meta_key = 'mfcs_header_color';
	$add_text = 'Color';
	$color    = mfcs_header_color();

	wp_nonce_field( 'save-page-color', '_mfcs_header_color' );

	?>
	<style>
	.form-field.color {
		margin-bottom: 15px;
	}

	.form-field.color label {
		display: block;
		width: 100%;
		margin-right: 10px;
		line-height: 26px;
		vertical-align: top;
	}

	.form-field.color input.wp-picker-default,
	.form-field.color input.wp-picker-clear {
		width: auto;
	}
	</style>
	<div class="form-field color">
		<label for="<?php echo $meta_key; ?>"><?php echo $add_text; ?></label>
		<input type="text" class="color-picker" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo esc_attr( $color ); ?>" data-default-color="#faf6f2" />
		<script>
		jQuery( document ).ready( function( $ ) {
			$( document.getElementById('mfcs_header_color') ).wpColorPicker();
		} );
		</script>
	</div>
	<?php
}

/**
 * Sanitize and save the header color
 */
function mfcs_save_page( $post_id, $post ) {

	if ( ! isset( $_POST['_mfcs_header_color'] ) || ! wp_verify_nonce( $_POST['_mfcs_header_color'], 'save-page-color' ) )
		return;

	if ( isset( $_POST['mfcs_header_color'] ) && preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $_POST['mfcs_header_color'] ) ) {
		update_post_meta( $post_id, 'mfcs_header_color', $_POST['mfcs_header_color'] );
	} else {
		delete_post_meta( $post_id, 'mfcs_header_color' );
	}

}
add_action( 'pre_post_update', 'mfcs_save_page', 5, 2 );

/**
 * Get the header color
 */
function mfcs_header_color( $default = '#faf6f2' ) {

	$color = get_post_meta( get_the_ID(), 'mfcs_header_color', true );
	if ( ! $color ) $color = $default;

	return $color;
}
