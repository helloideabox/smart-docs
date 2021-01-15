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
	'smartdocs_single_doc_settings',
	array(
		'title'    => __( 'Docs Single', 'smart-docs' ),
		'priority' => 3,
	)
);

$wp_customize->add_setting(
	'smartdocs_single_doc_display_meta',
	array(
		'default'    => 'after_content',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_display_meta_control',
	array(
		'label'       => __( 'Show Meta Data', 'smart-docs' ),
		'section'     => 'smartdocs_single_doc_settings',
		'settings'    => 'smartdocs_single_doc_display_meta',
		'type'        => 'select',
		'choices'     => array(
			'after_content' => __( 'After Content', 'smart-docs' ),
			'after_title' => __( 'After Title', 'smart-docs' ),
			'hide' => __( 'Hide', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_single_doc_display_action_section',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_display_action_section_control',
	array(
		'label'       => __( 'Show Action Content', 'smart-docs' ),
		'section'     => 'smartdocs_single_doc_settings',
		'settings'    => 'smartdocs_single_doc_display_action_section',
		'type'        => 'select',
		'choices'     => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no' => __( 'No', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_single_doc_display_feedback_section',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_display_feedback_section_control',
	array(
		'label'       => __( 'Show Feedback Content', 'smart-docs' ),
		'section'     => 'smartdocs_single_doc_settings',
		'settings'    => 'smartdocs_single_doc_display_feedback_section',
		'type'        => 'select',
		'choices'     => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no' => __( 'No', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_single_doc_anchor_links',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_anchor_links_control',
	array(
		'label'       => __( 'Show Anchor Links', 'smart-docs' ),
		'description' => __( 'Add anchor links to heading for readers to easily share them.', 'smart-docs' ),
		'section'     => 'smartdocs_single_doc_settings',
		'settings'    => 'smartdocs_single_doc_anchor_links',
		'type'        => 'select',
		'choices'     => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no' => __( 'No', 'smart-docs' ),
		),
	)
);

/**
 * Register Sections.
 */
$wp_customize->get_section( 'smartdocs_single_doc_settings' )->panel = 'smartdocs_style_options';
