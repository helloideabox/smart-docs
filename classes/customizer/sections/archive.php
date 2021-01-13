<?php
/**
 * SmartDocs Customizer Controls for Archive layout.
 *
 * @package SmartDocs\Classes\Customizer
 * @since 1.0.0
 */

use SmartDocs\Customizer_Control;

// Archive.
$wp_customize->add_section(
	'smartdocs_archive_settings',
	array(
		'title'    => __( 'Docs Archive', 'smart-docs' ),
		'priority' => 2,
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_articles_setting',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_archive_category_articles_control',
	array(
		'label'       => __( 'Show Docs List', 'smart-docs' ),
		'section'     => 'smartdocs_archive_settings',
		'settings'    => 'smartdocs_archive_category_articles_setting',
		'type'        => 'select',
		'choices'     => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no' => __( 'No', 'smart-docs' ),
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
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_columns_control',
		array(
			'label'    => __( 'Columns', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_columns',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
			'choices'  => array(
				'min'  => 1,
				'max'  => 12,
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
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_columns_tablet_control',
		array(
			'label'    => __( 'Columns', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_columns_tablet',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
			'choices'  => array(
				'min'  => 1,
				'max'  => 12,
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
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_columns_control_mobile',
		array(
			'label'    => __( 'Columns', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_columns_mobile',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
			'choices'  => array(
				'min'  => 1,
				'max'  => 12,
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
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_columns_gap_control',
		array(
			'label'    => __( 'Spacing (px)', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_columns_gap',
			'type'     => 'smartdocs-slider',
			'choices'  => array(
				'min'  => 1,
				'max'  => 50,
				'step' => 1,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_bg_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_bg_color_control',
		array(
			'label'    => __( 'Category Background Color', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_bg_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_title_tag',
	array(
		'default'    => 'h5',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_archive_category_title_tag_control',
	array(
		'label'       => __( 'Category Title HTML Tag', 'smart-docs' ),
		'description' => __( 'Select HTML tag for the category title.', 'smart-docs' ),
		'section'     => 'smartdocs_archive_settings',
		'settings'    => 'smartdocs_archive_category_title_tag',
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
	'smartdocs_archive_category_title_font_size',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_title_font_size_control',
		array(
			'label'    => __( 'Category Title Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_title_font_size',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_title_font_size_tablet',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_title_font_size_control_tablet',
		array(
			'label'    => __( 'Category Title Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_title_font_size_tablet',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_title_font_size_mobile',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_title_font_size_control_mobile',
		array(
			'label'    => __( 'Category Title Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_title_font_size_mobile',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_title_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_title_color_control',
		array(
			'label'    => __( 'Category Title Color', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_title_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_description_font_size',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_description_font_size_control',
		array(
			'label'    => __( 'Category Description Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_description_font_size',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_description_font_size_tablet',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_description_font_size_control_tablet',
		array(
			'label'    => __( 'Category Description Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_description_font_size_tablet',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_description_font_size_mobile',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_description_font_size_control_mobile',
		array(
			'label'    => __( 'Category Description Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_description_font_size_mobile',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_description_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_description_color_control',
		array(
			'label'    => __( 'Category Description Color', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_description_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_action_divider',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_action_divider_control',
		array(
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_action_divider',
			'type'     => 'smartdocs-line',
			'classes'  => array( 'smart-docs', 'smartdocs-section-divider' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_action_font_size',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_action_font_size_control',
		array(
			'label'    => __( 'Category Action Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_action_font_size',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'desktop' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_action_font_size_tablet',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_action_font_size_control_tablet',
		array(
			'label'    => __( 'Category Action Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_action_font_size_tablet',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'tablet' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_action_font_size_mobile',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_action_font_size_control_mobile',
		array(
			'label'    => __( 'Category Action Font Size', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_action_font_size_mobile',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control', 'mobile' ),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_action_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_action_color_control',
		array(
			'label'    => __( 'Category Action Text Color', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_action_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_action_bg_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_action_bg_color_control',
		array(
			'label'    => __( 'Category Action Background Color', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_action_bg_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_archive_category_action_border_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_archive_category_action_border_color_control',
		array(
			'label'    => __( 'Separator Color', 'smart-docs' ),
			'section'  => 'smartdocs_archive_settings',
			'settings' => 'smartdocs_archive_category_action_border_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);
/**
 * Register Sections.
 */
$wp_customize->get_section( 'smartdocs_archive_settings' )->panel = 'smartdocs_style_options';
