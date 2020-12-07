<?php
use SmartDocs\Styler_Customizer_Control;

		// Docs page Settings

		$wp_customize->add_section(
			'smartdocs_single_doc_settings',
			array(
				'title'    => __( 'Single Doc', 'smart-docs' ),
				'priority' => 3,
			)
		);

		$wp_customize->add_setting(
			'smartdocs_single_doc_title_color',
			array(
				'default'    => '#e0e0e0',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_single_doc_title_color_control',
				array(
					'label'    => __( 'Title Color', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_single_doc_title_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					),
				)
			)
		);

		/*
		 $wp_customize->add_setting(
			'smartdocs_homepage_title_header',
			array(
				'default'    => __('Hero Section & Title', 'smart-docs'),
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'homepage_title_heading',
				array(
					'label'    => __( 'Hero Section & Title', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_homepage_title_header',
					'type'     => 'styler-section',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_homepage_title_color',
			array(
				'default'    => 'Title',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'homepage_title_color',
				array(
					'label'    => __( 'Title Color', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_homepage_title_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					)
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_grid_items_header',
			array(
				'default'    => __('Grid Items', 'smart-docs'),
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'grid_items_heading',
				array(
					'label'    => __( 'Grid Items', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_grid_items_header',
					'type'     => 'styler-section',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_grid_items_font_size_cat_title',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'grid_items_cat_font_size',
				array(
					'label'    => __( 'Category Title Font Size (in px)', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_grid_items_font_size_cat_title',
					'type'     => 'styler-slider',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_grid_items_title_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_grid_items_title_color_control',
				array(
					'label'    => __( 'Category Title Color', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_grid_items_title_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					)
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_grid_items_font_size_cat_count',
			array(
				'default'    => 14,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'grid_items_cat_count_font_size',
				array(
					'label'    => __( 'Category Count Font Size (in px)', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_grid_items_font_size_cat_count',
					'type'     => 'styler-slider',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_grid_items_count_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_grid_items_count_color_control',
				array(
					'label'    => __( 'Docs Count Color', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_grid_items_count_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					)
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_grid_items_background_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_grid_items_background_color_control',
				array(
					'label'    => __( 'Background Color', 'smart-docs' ),
					'section'  => 'smartdocs_single_doc_settings',
					'settings' => 'smartdocs_grid_items_background_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					)
				)
			)
		); */

		/**
		 * Register Sections.
		 */
		$wp_customize->get_section( 'smartdocs_single_doc_settings' )->panel = 'smartdocs_style_options';
