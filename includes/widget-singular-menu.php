<?php
/**
 * Declaring widgets
 *
 * @package maizi
 */
add_action( 'widgets_init', function(){
	register_widget( 'Sidebar_Singular_Menu_Widget' );
});

class Sidebar_Singular_Menu_Widget extends WP_Widget {
	private $defaults= array(
		'title' => '',
		'page_id' => '',
		'category_id' => '',
	);

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'sidebar_menu_widget',
			'description' => esc_html__('Add custom menu to specific category sidebar', 'maizi'),
		);
		parent::__construct( 'Sidebar_Singular_Menu_Widget', esc_html__('Category Sidebar Menu', 'maizi'), $widget_ops );
	}

    public function isPage( $page_id ) {
        global $post;
        if (is_page() && (in_array($post->post_parent, $page_id) || is_page($page_id))) {
            return true;
        }
        return false;
    }

    public function isCategory( $category_id ) {
        if ( is_category($category_id) || ( is_single() && in_category( $category_id, get_the_ID() ) ) ) {
            return true;
        }
        return false;
    }

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if (empty($instance['page_id']) && empty($instance['category_id'])) {
			return ;
		}

		$page_id = explode(',', trim($instance['page_id']));
		$category_id = explode(',', trim($instance['category_id']));
		if ( ! $this->isCategory($category_id) && ! $this->isPage( $page_id ) ) {
			return ;
		}

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu
		);
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		global $wp_customize;
		$instance = wp_parse_args((array)$instance, $this->defaults);
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'maizi' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php esc_attr_e( 'Page IDs, Separated by commas:', 'maizi' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_id' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['page_id'] ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category_id' ) ); ?>"><?php esc_attr_e( 'Category IDs, Separated by commas:', 'maizi' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category_id' ) ); ?>" type="text" value="<?php echo esc_attr(
				$instance['category_id']	); ?>">
		</p>
		<?php
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
					<button type="button" class="button"><?php _e( 'Edit Menu' ) ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['page_id'] = ( ! empty( $new_instance['page_id'] ) ) ? strip_tags( $new_instance['page_id'] )
            : '';
		$instance['category_id'] = ( ! empty( $new_instance['category_id'] ) ) ? strip_tags( $new_instance['category_id'] ) : '';
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}
}
