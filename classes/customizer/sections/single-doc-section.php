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
			'smartdocs_single_doc_display_breadcrumbs',
			array(
				'default'    => 'yes',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			'smartdocs_single_doc_display_breadcrumbs_control',
			array(
				'label'       => __( 'Display Breadcrumbs', 'smart-docs' ),
				'description' => __( 'Show breadcrumbs on the single doc page.', 'smart-docs' ),
				'section'     => 'smartdocs_single_doc_settings',
				'settings'    => 'smartdocs_single_doc_display_breadcrumbs',
				'type'        => 'select',
				'choices'     => array(
					'yes' => __( 'Yes', 'smart-docs' ),
					'no' => __( 'No', 'smart-docs' ),
				),
			)
		);

		$wp_customize->add_setting(
			'smartdocs_single_doc_display_last_updated_on',
			array(
				'default'    => 'after_content',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			'smartdocs_single_doc_display_last_updated_on_control',
			array(
				'label'       => __( 'Last Updated On', 'smart-docs' ),
				'section'     => 'smartdocs_single_doc_settings',
				'settings'    => 'smartdocs_single_doc_display_last_updated_on',
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
				'label'       => __( 'Action Section', 'smart-docs' ),
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
				'label'       => __( 'Feedback Section', 'smart-docs' ),
				'section'     => 'smartdocs_single_doc_settings',
				'settings'    => 'smartdocs_single_doc_display_feedback_section',
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
