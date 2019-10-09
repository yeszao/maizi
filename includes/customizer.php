<?php
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'maizi_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function maizi_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'maizi_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'maizi_customizer_live_preview' ) ) {
    /**
     * Setup JS integration for custom live previewing,
     * These is just for settings which transport is `postMessage`.
     */
    function maizi_customizer_live_preview() {
        wp_enqueue_script( 'theme-customizer-js', get_template_directory_uri() . '/assets/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '', true );
    }
}
add_action( 'customize_preview_init', 'maizi_customizer_live_preview' );


if ( ! function_exists( 'load_checkbox_multiple_controls' ) ) {
    function load_checkbox_multiple_controls()
    {
        require trailingslashit(get_template_directory()) . 'includes/control-checkbox-multiple.php';
    }
}
add_action( 'customize_register', 'load_checkbox_multiple_controls', 0 );


if ( ! function_exists( 'maizi_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function maizi_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section( 'maizi_theme_layout_options', array(
			'title'       => __( 'Layout Settings', 'maizi' ),
			'capability'  => 'edit_theme_options',
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'maizi_container_type', array(
			'default'           => 'container',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'container_type', array(
					'label'       => __( 'Container Width', 'maizi' ),
					'section'     => 'maizi_theme_layout_options',
					'settings'    => 'maizi_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width', 'maizi' ),
						'container-fluid' => __( 'Full width', 'maizi' ),
					),
					'priority'    => '10',
				)
			) );

        // Container width
        $wp_customize->add_setting( 'maizi_container_max_width', array(
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'container_max_width', array(
                    'label'       => __( 'Container max width while width is FIXED', 'maizi' ),
                    'description' => __(  'For example: <code>1200</code> in px, left empty to use Bootstrap max container.' , 'maizi'),
                    'section'     => 'maizi_theme_layout_options',
                    'settings'    => 'maizi_container_max_width',
                    'type'        => 'number',
                    'priority'    => '15',
                )
            ) );

		// Sidebar position settings
		$wp_customize->add_setting( 'maizi_sidebar_position', array(
			'default'           => 'left',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'sidebar_position', array(
					'label'       => __( 'Sidebar Position', 'maizi' ),
					'section'     => 'maizi_theme_layout_options',
					'settings'    => 'maizi_sidebar_position',
					'type'        => 'select',
					'choices'     => array(
						'left'  => __( 'Left', 'maizi' ),
						'right' => __( 'Right', 'maizi' ),
						'none'  => __( 'No sidebar', 'maizi' ),
					),
					'priority'    => '20',
				)
			) );

		// Post list type
		$wp_customize->add_setting( 'maizi_post_list_type', array(
			'default'           => 'none',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'post_list_type', array(
					'label'       => __( 'Post List Type', 'maizi' ),
					'section'     => 'maizi_theme_layout_options',
					'settings'    => 'maizi_post_list_type',
					'type'        => 'select',
					'choices'     => array(
					    'title' => __('Only title', 'maizi'),
					    'meta' => __('Only title and meta', 'maizi'),
					    'excerpt' => __('Display title, meta and excerpt', 'maizi'),
						'thumbnail' => __( 'Display title, meta, excerpt and thumbnail', 'maizi' ),
					),
					'priority'    => '20',
				)
			) );

        // Post list metas
        $wp_customize->add_setting( 'maizi_post_list_meta', array(
            'default'           => array('date', 'category', 'author', 'submit_comment'),
            'sanitize_callback' => 'sanitize_multiple_checkbox',
            'capability'        => 'edit_theme_options',
            //'transport'         => 'postMessage',
        ) );

        $wp_customize->add_control(
            new Customize_Control_Checkbox_Multiple(
                $wp_customize,
                'post_list_meta', array(
                    'label'       => __( 'Post meta items to display', 'maizi' ),
                    'section'     => 'maizi_theme_layout_options',
                    'settings'    => 'maizi_post_list_meta',
                    'choices' => array(
                        'date'          => __( 'Date',      'maizi' ),
                        'author'        => __( 'Author',    'maizi' ),
                        'pv'            => __( 'PV (need plugin Postviews Plus)',   'maizi' ),
                        'category'      => __( 'Category',  'maizi' ),
                        'tags'          => __( 'Tags',      'maizi' ),
                        'comment_link'  => __( 'Comment Link',   'maizi' )
                    ),
                    'priority'    => '20',
                )
            ) );

        // Excerpt word number
        $wp_customize->add_setting( 'maizi_excerpt_word_number', array(
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
            //'transport'         => 'postMessage',
        ) );

        $wp_customize->add_control(
            new Customize_Control_Checkbox_Multiple(
                $wp_customize,
                'excerpt_word_number', array(
                    'label'       => __( 'Excerpt word number', 'maizi' ),
                    'section'     => 'maizi_theme_layout_options',
                    'settings'    => 'maizi_excerpt_word_number',
                    'type'        => 'number',
                    'priority'    => '20',
                )
            ) );

	}
} // endif function_exists( 'maizi_theme_customize_register' ).
add_action( 'customize_register', 'maizi_theme_customize_register' );

/**
 * Change navbar color
 */
if ( ! function_exists( 'maizi_customize_colors' ) ) {
    function maizi_customize_colors($wp_customize)
    {
        $wp_customize->add_setting('maizi_link_color', array(
            'default' => '#428BD1',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'maizi_link_color',
                array(
                    'label' => 'Link Color',
                    'section' => 'colors',
                    'settings' => 'maizi_link_color',
                ))
        );

        $wp_customize->add_setting('maizi_link_hover_color', array(
            'default' => '#3071A9',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'maizi_link_hover_color',
                array(
                    'label' => 'Link Hover Color',
                    'section' => 'colors',
                    'settings' => 'maizi_link_hover_color',
                ))
        );

        $wp_customize->add_setting('maizi_list_bottom_border_color', array(
            'default' => '#ffffff',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'maizi_list_bottom_border_color',
                array(
                    'label' => 'List Bottom Border Color',
                    'section' => 'colors',
                    'settings' => 'maizi_list_bottom_border_color',
                ))
        );

        $wp_customize->add_setting('maizi_navbar_bg_color', array(
            'default' => '#000000',
            'type' => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability' => 'edit_theme_options',
        ));
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'maizi_navbar_bg_color',
                array(
                    'label' => 'Navbar Background Color',
                    'section' => 'colors',
                    'settings' => 'maizi_navbar_bg_color',
                )
            )
        );

		$wp_customize->add_setting('maizi_navbar_text_color', array(
			'default' => '#ffffff',
			'type' => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'maizi_navbar_text_color',
				array(
					'label' => 'Navbar Text Color',
					'section' => 'colors',
					'settings' => 'maizi_navbar_text_color',
				)
			)
		);

		$wp_customize->add_setting('maizi_button_color', array(
			'default' => '#0275d8',
			'type' => 'theme_mod',
			'sanitize_callback' => 'esc_textarea',
			'capability' => 'edit_theme_options',
		));
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'maizi_button_color',
				array(
					'label' => 'Button Color',
					'section' => 'colors',
					'settings' => 'maizi_button_color',
				)
			)
		);

    }
}
add_action( 'customize_register', 'maizi_customize_colors' );


function mytheme_customize_css()
{
    ?>
    <style type="text/css">
        <?php if ( get_theme_mod('maizi_container_type') == 'container'
                    && get_theme_mod('maizi_container_max_width') ): ?>
        @media (min-width: <?php echo get_theme_mod('maizi_container_max_width') ?>px) {
            .container {
                max-width: <?php echo get_theme_mod('maizi_container_max_width'); ?>px;
            }
        }
        <?php endif; ?>

        #primaryMenu.navbar,
        #primaryMenu .dropdown-menu {
			background-color: <?php echo get_theme_mod('maizi_navbar_bg_color', '#000000'); ?> !important;
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
			color: <?php echo get_theme_mod('maizi_navbar_text_color', '#ffffff'); ?> !important;
		}
        a, h2, h3, h4, h5, h6 {
			color: <?php echo get_theme_mod('maizi_link_color', '#428BD1'); ?>;
		}
        a:focus, a:hover {
			color: <?php echo get_theme_mod('maizi_link_hover_color', '#3071A9'); ?>
		}
		.btn-outline-primary, .btn-primary:active, .btn-outline-primary:disabled{
			color: <?php echo get_theme_mod('maizi_button_color', '#0275d8'); ?>;
			border-color: <?php echo get_theme_mod('maizi_button_color', '#0275d8'); ?>;
		}
		.btn-primary,.btn-primary:hover,.btn-primary:active, .btn-primary:focus,
		.btn-primary.disabled, .btn-primary:disabled,
		.btn-outline-primary:hover,.btn-outline-primary:active, .btn-outline-primary:focus,
		.page-item.active .page-link{
			color: #fff;
			box-shadow: none;
			background-color: <?php echo get_theme_mod('maizi_button_color', '#0275d8'); ?>;
			border-color: <?php echo get_theme_mod('maizi_button_color', '#0275d8'); ?>;
		}
		.form-control:focus {
			border-color: <?php echo get_theme_mod('maizi_button_color', '#0275d8'); ?>;
		}
		.page-link, .page-link:focus, .page-link:hover{
			color: <?php echo get_theme_mod('maizi_button_color', '#0275d8'); ?>;
		}
        .home article, .archive article {
            border-bottom: 1px solid <?php echo get_theme_mod('maizi_list_bottom_border_color', '#fff'); ?>;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'mytheme_customize_css');


if ( ! function_exists( 'maizi_ad_register' ) ) {
    /**
     * Register individual settings through customizer's API.
     *
     * @param WP_Customize_Manager $wp_customize Customizer reference.
     */
    function maizi_ad_register( $wp_customize ) {

        $wp_customize->add_section( 'maizi_ad_options', array(
            'title'       => __( 'Ad Settings', 'maizi' ),
            'capability'  => 'edit_theme_options',
            'priority'    => 180,
        ) );

        // Global ad under nav bar
        $wp_customize->add_setting( 'maizi_ad_under_nav_bar', array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ad_under_nav_bar', array(
                    'label'       => __( '#1. Global Ad under nav bar', 'maizi' ),
					'description' => __( '<code>[url]</code> is short code of current page link'),
                    'section'     => 'maizi_ad_options',
                    'settings'    => 'maizi_ad_under_nav_bar',
                    'type'        => 'textarea',
                    'priority'    => '10',
                )
            ) );

        // Ad before content
        $wp_customize->add_setting( 'maizi_ad_before_content', array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ad_before_content', array(
                    'label'       => __( '#2. Ad before content', 'maizi' ),
					'description' => __( '<code>[url]</code> is short code of current page link'),
                    'section'     => 'maizi_ad_options',
                    'settings'    => 'maizi_ad_before_content',
                    'type'        => 'textarea',
                    'priority'    => '20',
                )
            ) );

        // Show ad before content option
        $wp_customize->add_setting( 'maizi_ad_before_content_option', array(
            'default'           => 'both',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ad_before_content_option', array(
                    'label'       => __( 'Show #2 ad in: ', 'maizi' ),
                    'section'     => 'maizi_ad_options',
                    'settings'    => 'maizi_ad_before_content_option',
                    'type'        => 'select',
                    'choices'     => array(
                        'both'  => __( 'Page and Post', 'maizi' ),
						'post' => __( 'Only Post', 'maizi' ),
                        'page' => __( 'Only Page', 'maizi' ),
                        'none' => __( 'Neither', 'maizi' ),
                    ),
                    'priority'    => '20',
                )
            ) );

        // Ad after content
        $wp_customize->add_setting( 'maizi_ad_after_content', array(
            'default'           => '',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ad_after_content', array(
                    'label'       => __( '#3. Ad after content content', 'maizi' ),
					'description' => __( '<code>[url]</code> is short code of current page link'),
                    'section'     => 'maizi_ad_options',
                    'settings'    => 'maizi_ad_after_content',
                    'type'        => 'textarea',
                    'priority'    => '20',
                )
            ) );

        // Show ad before content option
        $wp_customize->add_setting( 'maizi_ad_after_content_option', array(
            'default'           => 'both',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'esc_textarea',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'ad_after_content_option', array(
                    'label'       => __( 'Show #3 ad in: ', 'maizi' ),
                    'section'     => 'maizi_ad_options',
                    'settings'    => 'maizi_ad_after_content_option',
                    'type'        => 'select',
                    'choices'     => array(
                        'both'  => __( 'Page and Post', 'maizi' ),
						'post' => __( 'Only Post', 'maizi' ),
                        'page' => __( 'Only Page', 'maizi' ),
                        'none' => __( 'Neither', 'maizi' ),
                    ),
                    'priority'    => '20',
                )
            ) );

        // Disable display in these ids
		$wp_customize->add_setting( 'maizi_ad_disable_ids', array(
			'default'           => '',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'ad_disable_ids_option', array(
					'label'       => __( 'Post or page ids DONOT display ad', 'maizi' ),
					'description' => __( 'eg: <code>1,2,3</code>'),
					'section'     => 'maizi_ad_options',
					'settings'    => 'maizi_ad_disable_ids',
					'type'        => 'text',
					'priority'    => '20',
				)
			) );
    }
} // endif function_exists( 'maizi_ad_register' ).
add_action( 'customize_register', 'maizi_ad_register' );