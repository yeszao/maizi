<?php
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'qiaomi_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function qiaomi_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'qiaomi_customize_register' );

if ( ! function_exists( 'qiaomi_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function qiaomi_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section( 'qiaomi_theme_layout_options', array(
			'title'       => __( 'Layout Settings', 'qiaomi' ),
			'capability'  => 'edit_theme_options',
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'qiaomi_container_type', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'container_type', array(
					'label'       => __( 'Container Width', 'qiaomi' ),
					'section'     => 'qiaomi_theme_layout_options',
					'settings'    => 'qiaomi_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width', 'qiaomi' ),
						'container-fluid' => __( 'Full width', 'qiaomi' ),
					),
					'priority'    => '10',
				)
			) );


		// Sidebar position settings
		$wp_customize->add_setting( 'qiaomi_sidebar_position', array(
			'default'           => 'left',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_position', array(
					'label'       => __( 'Sidebar Position', 'qiaomi' ),
					'section'     => 'qiaomi_theme_layout_options',
					'settings'    => 'qiaomi_sidebar_position',
					'type'        => 'select',
					'choices'     => array(
						'left'  => __( 'Left', 'qiaomi' ),
						'right' => __( 'Right', 'qiaomi' ),
						'none'  => __( 'No sidebar', 'qiaomi' ),
					),
					'priority'    => '20',
				)
			) );

		// Post list type
		$wp_customize->add_setting( 'qiaomi_post_list_type', array(
			'default'           => 'none',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_list_type', array(
					'label'       => __( 'Post List Type', 'qiaomi' ),
					'section'     => 'qiaomi_theme_layout_options',
					'settings'    => 'qiaomi_post_list_type',
					'type'        => 'select',
					'choices'     => array(
						'none'  => __( 'Do not display thumbnail', 'qiaomi' ),
						'thumbnail' => __( 'Display thumbnail and placeholder image', 'qiaomi' ),
					),
					'priority'    => '20',
				)
			) );

        // Display or not author name in post
        $wp_customize->add_setting( 'qiaomi_display_author', array(
            'default'           => 'no',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'display_author', array(
                    'label'       => __( 'Display or not author name', 'qiaomi' ),
                    'section'     => 'qiaomi_theme_layout_options',
                    'settings'    => 'qiaomi_display_author',
                    'type'        => 'select',
                    'choices'     => array(
                        'no'  => __( 'Do not display author name', 'qiaomi' ),
                        'yes' => __( 'Yes, display author name', 'qiaomi' ),
                    ),
                    'priority'    => '20',
                )
            ) );

        // JS component
        $wp_customize->add_setting( 'qiaomi_code_highlight', array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'code_highlight', array(
                    'label'       => __( 'Enable Code highlight', 'qiaomi' ),
                    'section'     => 'qiaomi_theme_layout_options',
                    'settings'    => 'qiaomi_code_highlight',
                    'type'        => 'checkbox',
                    'value'       => '1',
                    'priority'    => '20',
                )
            ) );

	}
} // endif function_exists( 'qiaomi_theme_customize_register' ).
add_action( 'customize_register', 'qiaomi_theme_customize_register' );

/**
 * Change navbar color
 */
if ( ! function_exists( 'qiaomi_customize_colors' ) ) {
    function qiaomi_customize_colors($wp_customize)
    {
        $wp_customize->add_setting('qiaomi_link_color', array(
            'default' => '#428BD1',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'qiaomi_link_color',
                array(
                    'label' => 'Link Color',
                    'section' => 'colors',
                    'settings' => 'qiaomi_link_color',
                ))
        );

        $wp_customize->add_setting('qiaomi_link_hover_color', array(
            'default' => '#3071A9',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'qiaomi_link_hover_color',
                array(
                    'label' => 'Link Hover Color',
                    'section' => 'colors',
                    'settings' => 'qiaomi_link_hover_color',
                ))
        );

        $wp_customize->add_setting('qiaomi_navbar_bg_color', array(
            'default' => '#000000',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability' => 'edit_theme_options',
        ));
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'qiaomi_navbar_bg_color',
                array(
                    'label' => 'Navbar Background Color',
                    'section' => 'colors',
                    'settings' => 'qiaomi_navbar_bg_color',
                )
            )
        );

		$wp_customize->add_setting('qiaomi_navbar_text_color', array(
			'default' => '#ffffff',
			'type' => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'qiaomi_navbar_text_color',
				array(
					'label' => 'Navbar Text Color',
					'section' => 'colors',
					'settings' => 'qiaomi_navbar_text_color',
				)
			)
		);

		$wp_customize->add_setting('qiaomi_button_color', array(
			'default' => '#0275d8',
			'type' => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'qiaomi_button_color',
				array(
					'label' => 'Button Color',
					'section' => 'colors',
					'settings' => 'qiaomi_button_color',
				)
			)
		);

    }
}
add_action( 'customize_register', 'qiaomi_customize_colors' );


function mytheme_customize_css()
{
    ?>
    <style type="text/css">
        #primaryMenu.navbar,
        #primaryMenu .dropdown-menu {
			background-color: <?php echo get_theme_mod('qiaomi_navbar_bg_color', '#000000'); ?> !important;
		}
        #primaryMenu .navbar-brand a,
        #primaryMenu .nav-link:focus,
        #primaryMenu .nav-link:hover,
        #primaryMenu .nav-link,
        #primaryMenu .active>.nav-link,
        #primaryMenu .nav-link.active,
        #primaryMenu .nav-link.open,
        #primaryMenu .open>.nav-link,
        #primaryMenu .dropdown-item,
        #primaryMenu .dropdown-item.active,
        #primaryMenu .dropdown-item:active,
        #primaryMenu .dropdown-item:focus,
        #primaryMenu .dropdown-item:hover{
			color: <?php echo get_theme_mod('qiaomi_navbar_text_color', '#ffffff'); ?> !important;
		}
        a, h2, h3, h4, h5, h6 {
			color: <?php echo get_theme_mod('qiaomi_link_color', '#428BD1'); ?>;
		}
        a:focus, a:hover {
			color: <?php echo get_theme_mod('qiaomi_link_hover_color', '#3071A9'); ?>
		}
		.btn-outline-primary, .btn-primary:active, .btn-outline-primary:disabled{
			color: <?php echo get_theme_mod('qiaomi_button_color', '#0275d8'); ?>;
			border-color: <?php echo get_theme_mod('qiaomi_button_color', '#0275d8'); ?>;
		}
		.btn-primary,.btn-primary:hover,.btn-primary:active, .btn-primary:focus,
		.btn-primary.disabled, .btn-primary:disabled,
		.btn-outline-primary:hover,.btn-outline-primary:active, .btn-outline-primary:focus,
		.page-item.active .page-link{
			color: #fff;
			box-shadow: none;
			background-color: <?php echo get_theme_mod('qiaomi_button_color', '#0275d8'); ?>;
			border-color: <?php echo get_theme_mod('qiaomi_button_color', '#0275d8'); ?>;
		}
		.form-control:focus {
			border-color: <?php echo get_theme_mod('qiaomi_button_color', '#0275d8'); ?>;
		}
		.page-link, .page-link:focus, .page-link:hover{
			color: <?php echo get_theme_mod('qiaomi_button_color', '#0275d8'); ?>;
		}
    </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'qiaomi_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function qiaomi_customize_preview_js() {
		wp_enqueue_script( 'qiaomi_customizer', get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ), '20130508', true );
	}
}
//add_action( 'customize_preview_init', 'qiaomi_customize_preview_js' );
