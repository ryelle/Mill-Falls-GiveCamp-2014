<?php
/**
 * Widgets
 */

class MFCS_ImageWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'mfcs_2014_homepage',
			'Text Widget with Image',
			array( 'description' => '' )
		);
	}

	public function widget( $args, $instance ) {
		$title = isset( $instance['title'] )? $instance['title']: '';
		$content = isset( $instance['content'] )? $instance['content']: '';
		$image = isset( $instance['image'] )? $instance['image']: '';

		echo $args[ 'before_widget' ];
		?>

		<h3><?php echo esc_html( $title ); ?></h3>
		<div class="widget-image">
			<?php echo wp_get_attachment_image( $image, 'widget' ); ?>
		</div>
		<p><?php echo $content; ?></p>

		<?php
		echo $args[ 'after_widget' ];
	}

	public function update( $new_instance, $old_instance ) {

		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['content'] = wp_kses_post( $new_instance['content'] );
		$instance['image'] = absint( $new_instance['image'] );

		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] )? $instance['title']: '';
		$content = isset( $instance['content'] )? $instance['content']: '';
		$image = isset( $instance['image'] )? $instance['image']: '';

		$html = '';
		if ( $image && $image > 0 ) {
			$html = wp_get_attachment_image( $image, 'widget' );
		}
		?>
		<style>
			.media-container .preview {
				float: none;
			}
			.preview img {
				max-width: 100%;
				height: auto;
			}
			.remove_sponsor_image {
				float:right;
			}
			.hide-if-no-image {
				display: none;
			}
		</style>
		<p>
			<label for='<?php echo $this->get_field_id('title'); ?>'>Title</label>
			<input type='text' class='widefat' id='<?php echo $this->get_field_id('title'); ?>' name='<?php echo $this->get_field_name('title'); ?>' value='<?php echo esc_attr( $title ); ?>' />
		</p>

		<div class="media-container">
			<p><label for="<?php echo $this->get_field_id('content'); ?>">Image</label></p>
			<div class="preview"><?php echo $html; ?></div>

			<?php if ( $html ) : ?>
				<a href="#" class="button upload_image_button" data-editor="content" title="Change Image"><span class="wp-media-buttons-icon"></span> Change Image</a>
				<a href="#" class="remove_sponsor_image">Remove Image</a>
			<?php else : ?>
				<a href="#" class="button upload_image_button" data-editor="content" title="Add Image"><span class="wp-media-buttons-icon"></span> Add Image</a>
				<a href="#" class="hide-if-no-image remove_sponsor_image">Remove Image</a>
			<?php endif; ?>

			<input type="hidden" class="bg-image" name='<?php echo $this->get_field_name('image'); ?>' value='<?php echo esc_attr( $image ); ?>' />
		</div>

		<p>
			<label for='<?php echo $this->get_field_id('content'); ?>'>Content</label>
			<textarea class='widefat' id='<?php echo $this->get_field_id('content'); ?>' name='<?php echo $this->get_field_name('content'); ?>'><?php echo esc_textarea( $content ); ?></textarea>
		</p>

		<?php
	}

}

class MFCS_MenuWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'mfcs_2014_submenus',
			'Page Submenus',
			array( 'description' => '' )
		);
	}

	public function widget( $args, $instance ) {
		// Bail if we're not a page
		if ( !is_page() )
			return;

		$locations = get_nav_menu_locations();
		$menu = $locations[ 'primary' ];
		$items = wp_get_nav_menu_items( $menu );
		$this_page = wp_list_filter( $items, array( 'object_id' => get_the_ID() ) );

		if ( is_array( $this_page ) )
			$this_page = current( $this_page );

		// If we don't can't find ourself, we should leave.
		if ( ! is_a( $this_page, 'WP_Post' ) )
			return;

		if ( '0' === $this_page->menu_item_parent ) {
			$parent_id = $this_page->ID;
		} else {
			$parent_id = $this_page->menu_item_parent;
		}

		$parent = wp_list_filter( $items, array( 'ID' => $parent_id ) );
		if ( is_array( $parent ) )
			$parent = current( $parent );

		$siblings = wp_list_filter( $items, array( 'menu_item_parent' => $parent_id ) );

		// If we don't have a valid parent, or there are no siblings, let's bail.
		if ( ! is_a( $parent, 'WP_Post' ) || empty( $siblings ) )
			return;

		echo $args[ 'before_widget' ];

		echo '<ul>';

		foreach ( $siblings as $menu_item ){
			$class = '';
			if ( get_the_ID() == $menu_item->object_id ){
				$class = 'class="current-page"';
			}

			printf( '<li><a href="%1$s" %3$s>%2$s</a></li>', $menu_item->url, $menu_item->title, $class );
		}

		echo '</ul>';

		echo $args[ 'after_widget' ];
	}

}

function mfcs_2014_register_widgets() {
	register_widget( 'MFCS_ImageWidget' );
	register_widget( 'MFCS_MenuWidget' );
}
add_action( 'widgets_init', 'mfcs_2014_register_widgets' );
