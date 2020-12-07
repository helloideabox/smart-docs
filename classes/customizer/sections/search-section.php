<?php

use SmartDocs\Styler_Customizer_Control;

		// Search Settings

		$wp_customize->add_section(
			'smartdocs_search_settings',
			array(
				'title'    => __( 'Search Bar', 'smart-docs' ),
				'priority' => 4,
			)
		);

		$wp_customize->add_setting(
			'smartdocs_search_placeholder_text_color',
			array(
				'default'    => '#c0c0c0',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_search_placeholder_text_color_control',
				array(
					'label'    => __( 'Placeholder Text Color', 'smart-docs' ),
					'section'  => 'smartdocs_search_settings',
					'settings' => 'smartdocs_search_placeholder_text_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					)
				)
			)
        );
        
        $wp_customize->add_setting(
			'smartdocs_search_input_text_color',
			array(
				'default'    => '#c0c0c0',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_search_input_text_color_control',
				array(
					'label'    => __( 'Input Text Color', 'smart-docs' ),
					'section'  => 'smartdocs_search_settings',
					'settings' => 'smartdocs_search_input_text_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					)
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_search_input_font_size',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_search_input_font_size_control',
				array(
					'label'    => __( 'Search Input Font Size (in px)', 'smart-docs' ),
					'section'  => 'smartdocs_search_settings',
					'settings' => 'smartdocs_search_input_font_size',
					'type'     => 'styler-slider',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_search_box_border_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_search_box_border_color_control',
				array(
					'label'    => __( 'Border Color', 'smart-docs' ),
					'section'  => 'smartdocs_search_settings',
					'settings' => 'smartdocs_search_box_border_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					)
				)
			)
		);

		/**
		 * Register Sections.
		 */
		$wp_customize->get_section( 'smartdocs_search_settings' )->panel = 'smartdocs_style_options';