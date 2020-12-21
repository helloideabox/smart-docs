<?php

use SmartDocs\Customizer_Control;

		$wp_customize->add_section(
			'smartdocs_breakpoints_section',
			array(
				'title'    => __( 'Breakpoints', 'smart-docs' ),
				'priority' => 6,
			)
		);

		$wp_customize->add_setting(
			'smartdocs_breakpoint_medium',
			array(
				'default'    => 1024,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'smartdocs_breakpoint_medium_control',
				array(
					'label'          => __( 'Medium/Tablet (px)', 'smart-docs' ),
					'section'        => 'smartdocs_breakpoints_section',
					'settings'       => 'smartdocs_breakpoint_medium',
					'type'           => 'number',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_breakpoint_small',
			array(
				'default'    => 768,
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'smartdocs_breakpoint_small_control',
				array(
					'label'          => __( 'Small/Mobile (px)', 'smart-docs' ),
					'section'        => 'smartdocs_breakpoints_section',
					'settings'       => 'smartdocs_breakpoint_small',
					'type'           => 'number',
				)
			)
		);

		/**
		 * Register Sections.
		 */
		$wp_customize->get_section( 'smartdocs_breakpoints_section' )->panel = 'smartdocs_style_options';
