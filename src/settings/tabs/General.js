import {
	BaseControl,
	Button,
	TextControl,
	TextareaControl,
	ToggleControl,
	SelectControl,
} from "@wordpress/components";
import { withSelect, useDispatch } from '@wordpress/data';
import { useState } from "@wordpress/element";
import { compose } from '@wordpress/compose';
import { __ } from "@wordpress/i18n";

const General = ( props ) => {
	if ( 'object' !== typeof props.options || 0 === Object.keys( props.options ).length ) {
		return <>{ __( 'Loading...', 'smart-docs' ) }</>;
	}

	const [ options, setOptions ] = useState( props.options );

	const pageList = [];

	// Build a list of pages.
	if ( props.pages ) {
		pageList.push( { label: __( 'Select a page', 'smart-docs' ), value: null } );
		props.pages.forEach( ( page ) => {
			pageList.push( { value: page.id, label: page.title.rendered } );
		});
	} else {
		pageList.push( { label: __( 'Loading...', 'smart-docs' ), value: null } );
	}

	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);
	
	/**
	 * Button Saving state
	 *
	 * @since 1.0.0
	 */
	const [saving, setSaving] = useState(false);
	
	const handleSaveSettings = () => {
		setSaving( true );

		wp.data
			.dispatch("core")
			.saveSite( options )
			.then(function () {
				createSuccessNotice( __( 'Settings Saved!', 'smart-docs' ), {
					type: "snackbar",
				});
	
				// Flush rewrite rules on settings save.
				wp.ajax.post( 'smartdocs_on_settings_save', {} );
			})
			.catch(function (e) {
				createErrorNotice(
					__( "There was some error saving settings! \nCheck console for more information on error.", 'smart-docs' ),
					{
						type: "snackbar",
					}
				);
				console.log(e);
			});
	
			setSaving( false );
	};

	return (
		<>
			<ToggleControl
				className="mt-2 mb-2"
				label={ __( 'Use built-in Docs archive', 'smart-docs' ) }
				help={__(
					'Note: If you disable built-in documentation archive, you can use shortcode or page builder widgets to design your own documentation page.',
					'smart-docs'
				)}
				checked={ options.smartdocs_use_built_in_doc_archive }
				onChange={ ( value ) => { setOptions( { ...options, smartdocs_use_built_in_doc_archive: value } ) } }
			/>

			{ ! options.smartdocs_use_built_in_doc_archive && (
				<BaseControl
					label={ __( 'Select Custom Page', 'smart-docs' ) }
					className="mb-3"
				>
					<SelectControl
						className="mt-2 block mb-2"
						labelPosition="top"
						options={ pageList }
						value={ options.smartdocs_custom_doc_page }
						onChange={ ( value ) => setOptions( { ...options, smartdocs_custom_doc_page: value } ) }
					/>
				</BaseControl>
			) }

			<BaseControl
				label={ __( 'Hero Title', 'smart-docs' ) }
				help={ __( 'Edit to change the default title for the header section.', 'smart-docs' ) }
				className="mb-3"
			>
				<TextControl
					className="mt-2 block mb-2"
					placeholder={ __( 'Documentation', 'smart-docs' ) }
					value={ options.smartdocs_archive_page_title }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_archive_page_title: value } ) }
				/>
			</BaseControl>
			<BaseControl
				label={ __( 'Rewrite Archive Slug', 'smart-docs' ) }
				help={ __( 'Edit to change the default slug for the documentation archive page.', 'smart-docs' ) }
				className="mb-3"
			>
				<TextControl
					className="mt-2 block mb-2"
					placeholder={ __( 'Defaults to "docs"', 'smart-docs' ) }
					value={ options.smartdocs_archive_page_slug }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_archive_page_slug: value } ) }
				/>
			</BaseControl>
			<BaseControl
				label={ __( 'Rewrite Category Slug', 'smart-docs' ) }
				help={ __( 'Edit to change the default slug for the documentation category page.', 'smart-docs' ) }
				className="mb-3"
			>
				<TextControl
					className="mt-2 block mb-2"
					placeholder={ __( 'Defaults to "docs-category"', 'smart-docs' ) }
					value={ options.smartdocs_category_slug }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_category_slug: value } ) }
				/>
			</BaseControl>
			<BaseControl
				label={ __( 'Rewrite Tag Slug', 'smart-docs' ) }
				help={ __( 'Edit to change the default slug for the documentation tag.', 'smart-docs' ) }
			>
				<TextControl
					className="mt-2 block mb-2"
					placeholder={ __( 'Defaults to "docs-tag"', 'smart-docs' ) }
					value={ options.smartdocs_tag_slug }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_tag_slug: value } ) }
				/>
			</BaseControl>
			<BaseControl
				className="mt-3 mb-3"
				id="smartdocs-custom-templates"
				label={ __( 'Template', 'smart-docs' ) }
			>
				<ToggleControl
					className="mt-2 mb-2"
					label={ __( 'Use built-in template for Docs single page', 'smart-docs' ) }
					checked={ options.smartdocs_enable_single_template }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_enable_single_template: value } ) }
				/>
				<ToggleControl
					className="mt-2 mb-2"
					label={ __( 'Use built-in template for Docs category page', 'smart-docs' ) }
					checked={ options.smartdocs_enable_category_and_tag_template }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_enable_category_and_tag_template: value } ) }
				/>
			</BaseControl>
			<Button
				className="mt-6 mb-3"
				isPrimary="true"
				isBusy={ saving }
				onClick={ handleSaveSettings }
			>
				{ __( 'Save Changes', 'smart-docs' ) }
			</Button>
		</>
	);
}

export default compose(
	withSelect( ( select ) => {
		const optionKeys = [
			'smartdocs_use_built_in_doc_archive',
			'smartdocs_custom_doc_page',
			'smartdocs_archive_page_title',
			'smartdocs_archive_page_slug',
			'smartdocs_category_slug',
			'smartdocs_tag_slug',
			'smartdocs_enable_single_template',
			'smartdocs_enable_category_and_tag_template',
		];
		
		const settings = select( 'core' ).getEntityRecord( 'root', 'site' );
		const options = {};

		if ( settings ) {
			optionKeys.forEach( ( key ) => {
				if ( settings[key] ) {
					options[key] = settings[key];
				}
			} );
		}

		return {
			pages: select( 'core' ).getEntityRecords( 'postType', 'page' ),
			options
		};
	} )
)( General );