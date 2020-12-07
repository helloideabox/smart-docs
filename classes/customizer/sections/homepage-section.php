<?php

use SmartDocs\Styler_Customizer_Control;

		// Docs page Settings.

		$wp_customize->add_section(
			'smartdocs_homepage_settings',
			array(
				'title'    => __( 'Docs Archive', 'smart-docs' ),
				'priority' => 90,
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_cat_list_section',
			array(
				'default'    => __( 'Grid Items', 'smart-docs' ),
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_cat_list_section_control',
				array(
					'label'    => __( 'Grid Items', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_cat_list_section',
					'type'     => 'styler-section',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_layout_section',
			array(
				'default'    => '',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_layout_section_control',
				array(
					'label'    => __( 'Layout', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_layout_section',
					'type'     => 'styler-sub-section',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_layout_setting',
			array(
				'default'    => 'list',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			'smartdocs_archive_layout_setting_control',
			array(
				'description' => __( 'Select layout type.', 'smart-docs' ),
				'section'     => 'smartdocs_homepage_settings',
				'settings'    => 'smartdocs_archive_layout_setting',
				'type'        => 'select',
				'choices'     => array(
					'list' => __( 'List', 'smart-docs' ),
					'grid' => __( 'Grid', 'smart-docs' ),
				),
			)
		);

		/**
		 * Grid Settings
		 */
		$wp_customize->add_setting(
			'smartdocs_archive_columns',
			array(
				'default'    => 3,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_columns_control',
				array(
					'label'    => __( 'Grid Columns', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_columns',
					'type'     => 'styler-slider',
					'classes'  => array( 'desktop', 'layout-grid', 'smartdocs-responsive-customize-control', 'desktop' ),
					'choices'  => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_columns_tablet',
			array(
				'default'    => 2,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_columns_tablet_control',
				array(
					'label'    => __( 'Grid Columns', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_columns_tablet',
					'type'     => 'styler-slider',
					'classes'  => array( 'tablet', 'layout-grid', 'smartdocs-responsive-customize-control', 'tablet' ),
					'choices'  => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_columns_mobile',
			array(
				'default'    => 1,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_columns_control_mobile',
				array(
					'label'    => __( 'Grid Columns', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_columns_mobile',
					'type'     => 'styler-slider',
					'classes'  => array( 'mobile', 'layout-grid', 'smartdocs-responsive-customize-control', 'mobile' ),
					'choices'  => array(
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_columns_gap',
			array(
				'default'    => 20,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_columns_gap_control',
				array(
					'label'    => __( 'Spacing (px)', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_columns_gap',
					'type'     => 'styler-slider',
					'classes'  => array( 'layout-grid' ),
					'choices'  => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_item_padding',
			array(
				'default'    => array(
					'top'    => 14,
					'bottom' => 15,
					'left'   => 13,
					'right'  => 33,
				),
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_item_padding_control',
				array(
					'label'    => __( 'Padding', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_item_padding',
					'type'     => 'styler-dimension',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
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
			'smartdocs_archive_item_padding_tablet',
			array(
				'default'    => array(
					'top'    => 14,
					'bottom' => 15,
					'left'   => 13,
					'right'  => 33,
				),
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_item_padding_tablet_control',
				array(
					'label'    => __( 'Padding', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_item_padding_tablet',
					'type'     => 'styler-dimension',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
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
			'smartdocs_archive_item_padding_mobile',
			array(
				'default'    => array(
					'top'    => 14,
					'bottom' => 15,
					'left'   => 13,
					'right'  => 33,
				),
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_item_padding_mobile_control',
				array(
					'label'    => __( 'Padding', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_item_padding_mobile',
					'type'     => 'styler-dimension',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
					'choices'  => array(
						'top'    => __( 'Top', 'smart-docs' ),
						'right'  => __( 'Right', 'smart-docs' ),
						'bottom' => __( 'Bottom', 'smart-docs' ),
						'left'   => __( 'Left', 'smart-docs' ),
					),
				)
			)
		);

		/**
		 * Grid Settings End
		 */

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_title_wrapper',
			array(
				'default'    => 'h2',
				'type'       => 'option',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			'smartdocs_archive_list_item_title_wrapper_control',
			array(
				'label'       => __( 'Title Wrapper', 'smart-docs' ),
				'description' => __( 'Select wrapper element for the category title.', 'smart-docs' ),
				'section'     => 'smartdocs_homepage_settings',
				'settings'    => 'smartdocs_archive_list_item_title_wrapper',
				'type'        => 'select',
				'choices'     => array(
					'h2' => __( 'H2', 'smart-docs' ),
					'h3' => __( 'H3', 'smart-docs' ),
					'h4' => __( 'H4', 'smart-docs' ),
					'h5' => __( 'H5', 'smart-docs' ),
					'h6' => __( 'H6', 'smart-docs' ),
				),
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_title_font_size',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_title_font_size_control',
				array(
					'label'    => __( 'Category Title Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_title_font_size',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_title_font_size_tablet',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_title_font_size_control_tablet',
				array(
					'label'    => __( 'Category Title Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_title_font_size_tablet',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_title_font_size_mobile',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_title_font_size_control_mobile',
				array(
					'label'    => __( 'Category Title Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_title_font_size_mobile',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_title_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_title_color_control',
				array(
					'label'    => __( 'Category Title Color', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_title_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_title_bg_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_title_bg_color_control',
				array(
					'label'    => __( 'Background Color', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_title_bg_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_description_font_size',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_description_font_size_control',
				array(
					'label'    => __( 'Category Description Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_description_font_size',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_description_font_size_tablet',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_description_font_size_control_tablet',
				array(
					'label'    => __( 'Category Description Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_description_font_size_tablet',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_description_font_size_mobile',
			array(
				'default'    => 16,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_description_font_size_control_mobile',
				array(
					'label'    => __( 'Category Description Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_description_font_size_mobile',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_description_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_description_color_control',
				array(
					'label'    => __( 'Category Description Font Color', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_description_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_post_count_divider',
			array(
				'default'    => '',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_post_count_divider_control',
				array(
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_post_count_divider',
					'type'     => 'styler-line',
					'classes'  => array( 'smart-docs', 'smartdocs-section-divider' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_post_info_font_size',
			array(
				'default'    => 14,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_post_info_font_size_control',
				array(
					'label'    => __( 'Category Info Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_post_info_font_size',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_post_info_font_size_tablet',
			array(
				'default'    => 14,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_post_info_font_size_control_tablet',
				array(
					'label'    => __( 'Category Info Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_post_info_font_size_tablet',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_post_info_font_size_mobile',
			array(
				'default'    => 14,
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_post_info_font_size_control_mobile',
				array(
					'label'    => __( 'Category Info Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_post_info_font_size_mobile',
					'type'     => 'styler-slider',
					'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_category_info_text_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_category_info_text_color_control',
				array(
					'label'    => __( 'Category Info Text Color', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_category_info_text_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_category_info_bg_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_category_info_bg_color_control',
				array(
					'label'    => __( 'Category Info Background Color', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_category_info_bg_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_bg_settings_divider',
			array(
				'default'    => '',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_bg_settings_divider_control',
				array(
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_bg_settings_divider',
					'type'     => 'styler-line',
					'classes'  => array( 'smart-docs', 'smartdocs-section-divider' ),
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_archive_list_item_info_divider_color',
			array(
				'default'    => '#0c0c0c',
				'capability' => 'edit_theme_options',
				'transport'  => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'smartdocs_archive_list_item_info_divider_color_control',
				array(
					'label'    => __( 'Divider Color', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_archive_list_item_info_divider_color',
					'type'     => 'styler-color',
					'choices'  => array(
						'alpha' => true,
					),
				)
			)
		);
		/**
		 * Register Sections.
		 */
		$wp_customize->get_section( 'smartdocs_homepage_settings' )->panel = 'smartdocs_style_options';
