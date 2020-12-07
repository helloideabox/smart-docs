<?php

use SmartDocs\Styler_Customizer_Control;

		// Docs page Settings

		// $sd_customizer->register_section(
		// 	$wp_customize,
		// 	'smartdocs_test_settings',
		// 	array(
		// 		'title'    => __( 'Test Section', 'smart-docs' ),
		// 		'priority' => 100,
		// 	),
		// );

		// $sd_customizer->register_control(
		// 	$wp_customize,
		// 	'smartdocs_homepage_grid_items_heading',
		// 	array(
		// 		'setting' => array(
		// 			'default'    => 'Grid Items',
		// 			'capability' => 'edit_theme_options',
		// 		),
		// 		'control' => array(
		// 			'label'    => \__( 'Section Title Control', 'smart-docs' ),
		// 			'section'  => 'smartdocs_test_settings',
		// 			'type'     => 'styler-section'
		// 		)
		// 	)
		// );

		$wp_customize->add_section(
			'smartdocs_test_settings',
			array(
				'title'    => __( 'Test Section', 'smart-docs' ),
				'priority' => 5,
			)
		);

		$wp_customize->add_setting(
			'smartdocs_homepage_grid_items_heading',
			array(
				'default'    => 'Grid Items',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'docs_section_divider',
				array(
					'label'    => \__( 'Section Title Control', 'smart-docs' ),
					'section'  => 'smartdocs_test_settings',
					'settings' => 'smartdocs_homepage_grid_items_heading',
					'type'     => 'styler-section',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_range_slider',
			array(
				'default'    => 0,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_range_slider_control',
				array(
					'label'    => __( 'Slider Control', 'smart-docs' ),
					'section'  => 'smartdocs_test_settings',
					'settings' => 'smartdocs_range_slider',
					'type'     => 'styler-slider',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_homepage_test_control',
			array(
				'default'    => array(
					'desktop' => array(
						'value' => 10,
						'unit'  => 'px',
					),
					'tablet'  => array(
						'value' => 20,
						'unit'  => 'em',
					),
					'mobile'  => array(
						'value' => 10,
						'unit'  => 'px',
					),
				),
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'test_two_control',
				array(
					'label'    => __( 'Slider Control', 'smart-docs' ),
					'section'  => 'smartdocs_test_settings',
					'settings' => 'smartdocs_homepage_test_control',
					'type'     => 'styler-slider-responsive',
					'classes'  => array('desktop'),
				)
			)
		);

		$wp_customize->add_setting(
			'dimension_control',
			array(
				'default'    => array(
					'top'    => 0,
					'bottom' => 10,
					'left'   => 20,
					'right'  => 50,
				),
				'capability' => 'edit_theme_options',
			),
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'dimension_1_control',
				array(
					'label'    => __( 'Dimension Control', 'smart-docs' ),
					'section'  => 'smartdocs_test_settings',
					'settings' => 'dimension_control',
					'type'     => 'styler-dimension',
					'choices'  => array(
						'top'    => __( 'Top', 'smart-docs' ),
						'right'  => __( 'Right', 'smart-docs' ),
						'bottom' => __( 'Bottom', 'smart-docs' ),
						'left'   => __( 'Left', 'smart-docs' ),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'color_control',
			array(
				'default'    => '#ffffff',
				'capability' => 'edit_theme_options',
			),
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'styler_color_control',
				array(
					'label'    => __( 'Color Control', 'smart-docs' ),
					'section'  => 'smartdocs_test_settings',
					'settings' => 'color_control',
					'type'     => 'styler-color',
					'choices'  => array( 'alpha' => true ),
				),
			)
		);

		$wp_customize->add_setting(
			'section_control',
			array(
				'default'    => 'Section Control',
				'capability' => 'edit_theme_options',
			),
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'styler_section_control',
				array(
					'label'    => __( 'Section Control', 'smart-docs' ),
					'section'  => 'smartdocs_test_settings',
					'settings' => 'section_control',
					'type'     => 'styler-section',
				),
			)
		);

		/**
		 * Register Sections.
		 */
		$wp_customize->get_section( 'smartdocs_test_settings' )->panel = 'smartdocs_style_options';
