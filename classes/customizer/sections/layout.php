<?php
/**
 * SmartDocs Customizer Controls for Single Doc layout.
 *
 * @package SmartDocs\Classes\Customizer
 * @since 1.0.0
 */

use SmartDocs\Customizer_Control;

// Single doc.
$wp_customize->add_section(
	'smartdocs_layout_settings',
	array(
		'title'    => __( 'Layout', 'smart-docs' ),
		'priority' => 0,
	)
);

$wp_customize->add_setting(
	'smartdocs_container_width',
	array(
		'default'    => 1200,
		'capability' => 'edit_theme_options',
		'transport'  => 'postMessage',
	)
);

$wp_customize->add_control(
	new Customizer_Control(
		$wp_customize,
		'smartdocs_container_width_control',
		array(
			'label'    => __( 'Container Width', 'smart-docs' ),
			'section'  => 'smartdocs_layout_settings',
			'settings' => 'smartdocs_container_width',
			'type'     => 'smartdocs-slider',
			'classes'  => array( 'smartdocs-responsive-customize-control' ),
			'choices'  => array(
				'min'  => 1,
				'max'  => 5000,
				'step' => 100,
			),
		)
	)
);

/**
 * Register Sections.
 */
$wp_customize->get_section( 'smartdocs_layout_settings' )->panel = 'smartdocs_style_options';
