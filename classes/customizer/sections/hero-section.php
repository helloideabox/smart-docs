<?php
/**
 * SmartDocs Customizer Controls for Hero/Header layout.
 *
 * @package SmartDocs\Classes\Customizer
 * @since 1.0.0
 */

use SmartDocs\Customizer_Control;

// Hero/Header Section.
$wp_customize->add_section(
	'smartdocs_hero_section',
	array(
		'title'    => __( 'Hero Section', 'smart-docs' ),
		'priority' => 1,
	)
);

$wp_customize->add_setting(
	'smartdocs_hero_bg_type',
	array(
		'default'    => 'color',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_hero_bg_type_control',
	array(
		'label'       => __( 'Background Type', 'smart-docs' ),
		'description' => __( 'Select background type.', 'smart-docs' ),
		'section'     => 'smartdocs_hero_section',
		'settings'    => 'smartdocs_hero_bg_type',
		'type'        => 'select',
		'choices'     => array(
			'color' => __( 'Color', 'smart-docs' ),
			'image' => __( 'Image', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_hero_background_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_hero_background_color_control',
		array(
			'label'    => __( 'Background Color', 'smart-docs' ),
			'section'  => 'smartdocs_hero_section',
			'settings' => 'smartdocs_hero_background_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_hero_bg_image',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'smartdocs_hero_bg_image_control',
		array(
			'label'    => __( 'Background Image', 'smart-docs' ),
			'section'  => 'smartdocs_hero_section',
			'settings' => 'smartdocs_hero_bg_image',
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_hero_bg_image_overlay_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_hero_bg_image_overlay_color_control',
		array(
			'label'    => __( 'Overlay Color', 'smart-docs' ),
			'section'  => 'smartdocs_hero_section',
			'settings' => 'smartdocs_hero_bg_image_overlay_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_hero_title_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_hero_title_color_control',
		array(
			'label'    => __( 'Title Color', 'smart-docs' ),
			'section'  => 'smartdocs_hero_section',
			'settings' => 'smartdocs_hero_title_color',
			'type'     => 'smartdocs-color',
			'choices'  => array(
				'alpha' => true,
			),
		)
	)
);

$wp_customize->add_setting(
	'smartdocs_hero_description_color',
	array(
		'default'    => '',
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_hero_description_color_control',
		array(
			'label'    => __( 'Description Color', 'smart-docs' ),
			'section'  => 'smartdocs_hero_section',
			'settings' => 'smartdocs_hero_description_color',
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
$wp_customize->get_section( 'smartdocs_hero_section' )->panel = 'smartdocs_style_options';
