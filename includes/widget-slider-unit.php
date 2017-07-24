<?php  
add_action( 'widgets_init', 'qiaomi_widgets' );

function qiaomi_widgets() {
	register_widget( 'Slider_Unit_Widget' );
}

function ctUp_wdScript(){
	wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'ctUp_wdScript');


function widgets_scripts( $hook ) {
	if ( 'widgets.php' != $hook ) {
		return;
	}
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'widgets_scripts' );

/**
 * 滑动幻灯片Widget
 * Class qiaomi_widget
 */
class Slider_Unit_Widget extends WP_Widget {
	private $defaults= array(
		'title' => '',
		'bg_color' => '#ffffff',
		'img' => '',
        'img_link' => '',
		'caption' => '',
        'height' => '350px',
        'is_full' => '',
	);

	function __construct()
	{
		parent::__construct(false, 'Slider Unit', array('description' => 'Add this unit to index slider'));
	}

	function widget( $args, $instance ) {
		extract( $args );
        extract($instance);

		apply_filters('widget_name', $instance['title']);

        $text = $before_widget;
        $text .= "<div class='w-100' style='background-color:$bg_color;height:$height'>";

        if (isset($is_full) && $is_full) {
            $text .= '<div class="w-100 h-100">';
        } else {
            $text .= '<div class="container h-100">';
        }

        $text .= $img_link ? "<a href='$img_link' class='w-100 h-100'>" : '';

        $img_url = wp_get_attachment_image_src($img, 'full')[0];
        $text .= $img ? "<img class='d-block mh-100 mw-100 img-fluid' src='$img_url' />" : '';

        $text .= $img_link ? '</a>' : '';

        if ($caption) {
            $text .= '<div class="carousel-caption  d-md-block">';
            $text .= $caption;
            $text .= '</div>';
        }

        $text .= '</div></div>';

        $text .= $after_widget;

        echo $text;
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, $this->defaults);
?>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title', 'qiaomi' ); ?>
            </label>
            <input class="widefat" type="text"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>">
                <?php esc_attr_e('Background color', 'qiaomi' ); ?>
            </label>
            <br />
            <input class="color-picker" type="text"
                   id="<?php echo esc_attr( $this->get_field_id( 'bg_color' ) ); ?>"
                   name="<?php echo $this->get_field_name('bg_color'); ?>"
                   value="<?php echo $instance['bg_color']; ?>" />
		</p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
                <?php esc_attr_e('Height', 'qiaomi' ); ?>
            </label>
            <input class="widefat" type="text"
                   id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>"
                   value="<?php echo esc_attr( $instance['height'] ); ?>" />
        </p>

		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'img' ) ); ?>">
                <?php esc_attr_e('Image', 'qiaomi' ); ?>
            </label>
			<br />
			<span class="custom-img-container">
				<img src="<?php echo wp_get_attachment_image_src( $instance['img'], 'full' )[0]; ?>"
					 style="max-width: 100%;" />
			</span>
			<input class="widefat custom-img-id" type="hidden"
                   id="<?php echo esc_attr( $this->get_field_id( 'img' ) ); ?>"
                   name="<?php echo $this->get_field_name('img'); ?>"
                   value="<?php echo $instance['img']; ?>" />
			<a class="button upload-custom-img"><?php _e( 'Select Image' ); ?></a>
			<a class="button delete-custom-img <?php echo $instance['img'] ?'':'hidden'; ?>">
                <?php _e( 'Remove Image'); ?>
            </a>
		</p>

		<p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'caption' ) ); ?>">
                    <?php esc_attr_e('Caption', 'qiaomi' ); ?>
                </label>
				<textarea class="widefat"
                          id="<?php echo esc_attr( $this->get_field_id( 'caption' ) ); ?>"
                          name="<?php echo $this->get_field_name('caption'); ?>" rows="6" ><?php echo esc_textarea($instance['caption']); ?></textarea>
		</p>
        
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'img_link' ) ); ?>">
                <?php esc_attr_e('Link', 'qiaomi' ); ?>
            </label>
            <input  class="widefat" type="text"
                    id="<?php echo esc_attr( $this->get_field_id( 'img_link' ) ); ?>"
                    name="<?php echo $this->get_field_name('img_link'); ?>"
                    value="<?php echo $instance['img_link']; ?>" />
		</p>

        <p>
            <input  class="widefat" type="checkbox"
                    id="<?php echo esc_attr( $this->get_field_id( 'is_full' ) ); ?>"
                    name="<?php echo $this->get_field_name('is_full'); ?>"
                    value="1"
                    <?php echo $instance['is_full'] ? 'checked' : ''; ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'is_full' ) ); ?>">
                <?php esc_attr_e('Full width', 'qiaomi' ); ?>
            </label>
        </p>

		<script>
			jQuery(function($){
				$('.upload-custom-img').on('click', function(e) {
					e.preventDefault();
					var self = $(this),
						parent = self.parent('p'),
						delImgLink = parent.find('.delete-custom-img'),
						imgContainer = parent.find('.custom-img-container'),
						imgIdInput = parent.find('.custom-img-id');

					var custom_uploader = wp.media({
						title: 'Select Image',
						button: {
							text: 'Use this image'
						},
						multiple: false  // Set this to true to allow multiple files to be selected
					})
						.on('select', function() {
							var attachment = custom_uploader.state().get('selection').first().toJSON();
							imgContainer.html( '<img src="'+attachment.url+'" alt="" style="max-width:100%;"/>' );
							// imgInput.val(attachment.url);
							imgIdInput.val(attachment.id);

							// Unhide the remove image link
							delImgLink.removeClass( 'hidden' );
						})
						.open();
				});

				// DELETE IMAGE LINK
				$('.delete-custom-img').on( 'click', function( event ){
					event.preventDefault();
					var self = $(this),
						parent = self.parent('p'),
						delImgLink = parent.find('.delete-custom-img'),
						imgContainer = parent.find('.custom-img-container'),
						imgIdInput = parent.find('.custom-img-id');
					// Clear out the preview image
					imgContainer.html( '' );
					// Un-hide the add image link
					addImgLink.removeClass( 'hidden' );
					// Hide the delete image link
					delImgLink.addClass( 'hidden' );
					// Delete the image id from the hidden input
					imgIdInput.val( '' );
				});

				$('#widgets-right .color-picker, .inactive-sidebar .color-picker').wpColorPicker();

				// Executes wpColorPicker function after AJAX is fired on saving the widget
				$(document).ajaxComplete(function() {
					$('#widgets-right .color-picker, .inactive-sidebar .color-picker').wpColorPicker();
				});
			});

		</script>
<?php
	}
}

?>