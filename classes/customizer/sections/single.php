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
	'smartdocs_single_doc_toc',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_toc_control',
	array(
		'label'    => __( 'Show Table of Contents', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_single_doc_toc',
		'type'     => 'select',
		'choices'  => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_toc_collapsible',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_toc_collapsible_control',
	array(
		'label'       => __( 'Collapsible Table of Contents', 'smart-docs' ),
		'description' => __( 'Enable to make Table of Contents collapsible on click and by default when document is loaded.', 'smart-docs' ),
		'section'     => 'smartdocs_single_doc_settings',
		'settings'    => 'smartdocs_toc_collapsible',
		'type'        => 'select',
		'choices'     => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_toc_title',
	array(
		'default'    => 'Table of Contents',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_toc_title_control',
	array(
		'label'    => __( 'Table of Contents Title', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_toc_title',
		'type'     => 'text',
	)
);

$wp_customize->add_setting(
	'smartdocs_single_doc_display_print_button',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_display_print_button_control',
	array(
		'label'    => __( 'Show Print Button', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_single_doc_display_print_button',
		'type'     => 'select',
		'choices'  => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
		),
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
		'label'    => __( 'Show Meta Data', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_single_doc_display_meta',
		'type'     => 'select',
		'choices'  => array(
			'after_content' => __( 'After Content', 'smart-docs' ),
			'after_title'   => __( 'After Title', 'smart-docs' ),
			'hide'          => __( 'Hide', 'smart-docs' ),
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
		'label'    => __( 'Show Action Content', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_single_doc_display_action_section',
		'type'     => 'select',
		'choices'  => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
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
		'label'    => __( 'Show Feedback Content', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_single_doc_display_feedback_section',
		'type'     => 'select',
		'choices'  => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_single_doc_related_articles',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_related_articles_control',
	array(
		'label'    => __( 'Show Related Articles', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_single_doc_related_articles',
		'type'     => 'select',
		'choices'  => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
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
		'description' => __( 'Add anchor links to headings in content for readers to easily share them.', 'smart-docs' ),
		'section'     => 'smartdocs_single_doc_settings',
		'settings'    => 'smartdocs_single_doc_anchor_links',
		'type'        => 'select',
		'choices'     => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_single_doc_navigation_links',
	array(
		'default'    => 'yes',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_single_doc_navigation_links_control',
	array(
		'label'       => __( 'Show Navigation Links', 'smart-docs' ),
		'description' => __( 'Add navigation links for readers to access the next or previous article easily.', 'smart-docs' ),
		'section'     => 'smartdocs_single_doc_settings',
		'settings'    => 'smartdocs_single_doc_navigation_links',
		'type'        => 'select',
		'choices'     => array(
			'yes' => __( 'Yes', 'smart-docs' ),
			'no'  => __( 'No', 'smart-docs' ),
		),
	)
);

$wp_customize->add_setting(
	'smartdocs_sidebar',
	array(
		'default'    => 'right',
		'capability' => 'edit_theme_options',
	)
);

$wp_customize->add_control(
	'smartdocs_sidebar_control',
	array(
		'label'    => __( 'Display Sidebar', 'smart-docs' ),
		'section'  => 'smartdocs_single_doc_settings',
		'settings' => 'smartdocs_sidebar',
		'type'     => 'select',
		'choices'  => array(
			'none'  => __( 'No Sidebar', 'smart-docs' ),
			'left'  => __( 'Left', 'smart-docs' ),
			'right' => __( 'Right', 'smart-docs' ),
		),
	)
);

/**
 * Register Sections.
 */
$wp_customize->get_section( 'smartdocs_single_doc_settings' )->panel = 'smartdocs_style_options';
