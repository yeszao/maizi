<?php
add_action( 'widgets_init', 'maizi_widgets' );

function maizi_widgets() {
	register_widget( 'Slider_Unit_Widget' );
}

function wp_media_script() {
	wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'wp_media_script' );


function widgets_scripts( $hook ) {
	if ( 'widgets.php' != $hook ) {
		return;
	}
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'maizi-admin-js', get_template_directory_uri() . '/assets/js/maizi-admin.js', array(
		'jquery'
	), false, true );
}

add_action( 'admin_enqueue_scripts', 'widgets_scripts' );


/**
 * 滑动幻灯片Widget
 * Class maizi_widget
 */
class Slider_Unit_Widget extends WP_Widget {
	private $defaults = array(
		'title'    => '',
		'bg_color' => '#ffffff',
		'img'      => '',
		'img_link' => '',
		'caption'  => '',
		'height'   => '350px',
		'is_full'  => '',
	);

	function __construct() {
		parent::__construct( false, 'Slider Unit', array( 'description' => 'Add this unit to index slider' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		apply_filters( 'widget_name', $instance['title'] );

		$text = $before_widget;
		$text .= "<div class='w-100' style='background-color:$bg_color;max-height:$height'>";

		if ( isset( $is_full ) && $is_full ) {
			$text .= '<div class="w-100 h-100">';
		} else {
			$text .= '<div class="container h-100">';
		}

		$text .= $img_link ? "<a href='$img_link' class='w-100 h-100'>" : '';

		$img_url = wp_get_attachment_image_src( $img, 'full' )[0];
		$text    .= $img ? "<img class='d-block w-100 h-100 img-fluid' src='$img_url' />" : '';

		$text .= $img_link ? '</a>' : '';

		if ( $caption ) {
			$text .= '<div class="carousel-caption  d-md-block">';
			$text .= $caption;
			$text .= '</div>';
		}

		$text .= '</div></div>';

		$text .= $after_widget;

		echo $text;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php _e( 'Title' ); ?>
            </label>
            <input class="widefat" type="text"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>">
				<?php _e( 'Background color' ); ?>
            </label>
            <br/>
            <input class="color-picker" type="text"
                   id="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>"
                   name="<?php echo $this->get_field_name( 'bg_color' ); ?>"
                   value="<?php echo $instance['bg_color']; ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
				<?php _e( 'Height' ); ?>
            </label>
            <input class="widefat" type="text"
                   id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>"
                   value="<?php echo esc_attr( $instance['height'] ); ?>"/>
        </p>

        <div class="upload-img-box">
            <label for="<?php echo esc_attr( $this->get_field_id( 'img' ) ); ?>">
				<?php _e( 'Image' ); ?>
            </label>
            <div class="media-widget-control">
                <div class="media-widget-preview">
                    <div class="attachment-media-view custom-img-container">
						<?php if ( $instance['img'] ) { ?>
                            <img src="<?php echo wp_get_attachment_image_src( $instance['img'], 'full' )[0]; ?>"
                                 style="max-width: 100%;"/>
						<?php } else { ?>
                            <div class="placeholder">
								<?php _e( 'No image selected' ); ?>
                            </div>
						<?php } ?>
                    </div>
                </div>
            </div>
            <input class="widefat custom-img-id" type="hidden"
                   id="<?php echo esc_attr( $this->get_field_id( 'img' ) ); ?>"
                   name="<?php echo $this->get_field_name( 'img' ); ?>"
                   value="<?php echo $instance['img']; ?>"/>
            <a class="button upload-custom-img"><?php _e( 'Select Image' ); ?></a>
            <a class="button delete-custom-img<?php echo $instance['img'] ? '' : ' hidden'; ?>">
				<?php _e( 'Remove Image' ); ?>
            </a>
        </div>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'caption' ) ); ?>">
				<?php _e( 'Caption' ); ?>
            </label>
            <textarea class="widefat"
                      id="<?php echo esc_attr( $this->get_field_id( 'caption' ) ); ?>"
                      name="<?php echo $this->get_field_name( 'caption' ); ?>"
                      rows="6"><?php echo esc_textarea( $instance['caption'] ); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'img_link' ) ); ?>">
				<?php _e( 'Links' ); ?>
            </label>
            <input class="widefat" type="text"
                   id="<?php echo esc_attr( $this->get_field_id( 'img_link' ) ); ?>"
                   name="<?php echo $this->get_field_name( 'img_link' ); ?>"
                   value="<?php echo $instance['img_link']; ?>"/>
        </p>

        <p>
            <input class="widefat" type="checkbox"
                   id="<?php echo esc_attr( $this->get_field_id( 'is_full' ) ); ?>"
                   name="<?php echo $this->get_field_name( 'is_full' ); ?>"
                   value="1"
				<?php echo $instance['is_full'] ? 'checked' : ''; ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'is_full' ) ); ?>">
				<?php _e( 'Full width' ); ?>
            </label>
        </p>
		<?php
	}
}

?>