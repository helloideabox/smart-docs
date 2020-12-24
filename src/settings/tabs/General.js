import {
	BaseControl,
	Button,
	TextControl,
	TextareaControl,
	ToggleControl,
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

	const allPostTypes = [];
	const savedPostTypes = options.smartdocs_search_post_types;
	const excludeTypes = [ 'attachment', 'fl-builder-template', 'elementor_library' ];

	if ( props.postTypes ) {
		props.postTypes.forEach( (type) => {
			if ( type.viewable && ! excludeTypes.includes( type.slug ) ) {
				allPostTypes.push( { value: type.slug, label: type.name } );
			}
		});
	}

	const [ selectedTypes, setSelectedTypes ] = useState( savedPostTypes || [] );

	if ( selectedTypes !== savedPostTypes ) {
		setPostTypes( selectedTypes );
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
			<BaseControl
				label={ __( 'Hero Title', 'smart-docs' ) }
				help={ __( 'Edit to change the default title for the header section.', 'smart-docs' ) }
				className="mb-3"
			>
				<TextControl
					className="mt-2 block mb-2"
					placeholder={ __( 'Documentation', 'smart-docs' ) }
					value={ options.smartdocs_hero_title }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_hero_title: value } ) }
				/>
			</BaseControl>

			<BaseControl
				label={ __( 'Search', 'smart-docs' ) }
				className="mb-3"
			>
				<p className="components-base-control__help">{ __( 'Select post type(s) to include their articles in search result.', 'smart-docs' ) }</p>
				<ul className="post-types-list">
					{ 0 !== allPostTypes.length && allPostTypes.map( ( item ) => (
						<li key={ item.value }>
							<ToggleControl
								label={ item.label }
								checked={ 'object' === typeof selectedTypes && selectedTypes.includes( item.value ) }
								onChange={ ( isChecked ) => {
									if ( isChecked ) {
										setSelectedTypes( types => [ ...types, item.value ] );
									} else {
										let types = selectedTypes.filter( ( type ) => type !== item.value );
										setSelectedTypes( types );
									}
								} }
							/>
						</li>
					) ) }
					{
						0 === allPostTypes.length && <li>{ __( 'Loading...', 'smart-docs' ) }</li>
					}
				</ul>
			</BaseControl>

			<BaseControl
				label=""
				className="mt-3 smartdocs-field--customize"
			>
				<div className="col-1">
					<span className="components-base-control__label">{ __( 'Style & Customize', 'smart-docs' ) }</span>
					<p className="components-base-control__help">
						{ __( 'You can style and customize the docs elements to suit your needs.', 'smart-docs' ) }
					</p>
				</div>
				<div className="col-2">
					<a href={ smartdocs_admin.customizer_url } className="components-button is-secondary" target="_blank">{ __( 'Customize', 'smart-docs' ) }</a>
				</div>
			</BaseControl>

			<BaseControl
				label={ __( 'Your Support Page URL', 'smart-docs' ) }
				help={ __( 'Please enter your support or contact page URL.', 'smart-docs' ) }
				className="smartdocs-field--support-page"
			>
				<TextControl
					className="mt-2 block mb-2"
					placeholder={ __( 'https://example.com/contact/', 'smart-docs' ) }
					value={ options.smartdocs_support_page_url }
					onChange={ ( value ) => setOptions( { ...options, smartdocs_support_page_url: value } ) }
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
			'smartdocs_hero_title',
			'smartdocs_search_post_types',
			'smartdocs_support_page_url',
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
			postTypes: select( 'core' ).getPostTypes(),
			options
		};
	} )
)( General );
