import {
	BaseControl,
	Button,
	ToggleControl,
} from "@wordpress/components";
import { useEntityProp } from "@wordpress/core-data";
import { withSelect, useDispatch } from "@wordpress/data";
import { useState } from "@wordpress/element";
import { compose } from '@wordpress/compose';
import { __ } from "@wordpress/i18n";

const Search = ( props ) => {
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	const [postTypes, setPostTypes] = useEntityProp(
		"root",
		"site",
		"smartdocs_search_post_types"
	);

	const allPostTypes = [];
	const excludeTypes = [ 'attachment', 'fl-builder-template', 'elementor_library' ];

	if ( props.postTypes ) {
		props.postTypes.forEach( (type) => {
			if ( type.viewable && ! excludeTypes.includes( type.slug ) ) {
				allPostTypes.push( { value: type.slug, label: type.name } );
			}
		});
	}

	const [ selectedTypes, setSelectedTypes ] = useState( postTypes || [] );

	if ( selectedTypes !== postTypes ) {
		setPostTypes( selectedTypes );
	}

	/**
	 * Button Saving state
	 *
	 * @since 1.0.0
	 */
	const [saving, setSaving] = useState(false);

	function handleSaveSettings() {
		setSaving( true );
		wp.data
			.dispatch("core")
			.saveSite({
				smartdocs_search_post_types: postTypes,
			})
			.then(function () {
				createSuccessNotice( __( 'Settings Saved!', 'smart-docs' ), {
					type: "snackbar",
				});
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
				label={ __( 'Select Post Types', 'smart-docs' ) }
				help={ __( 'Select post type(s) to include their articles in search result.', 'smart-docs' ) }
				className="mb-3"
			>
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
		return {
			postTypes: select( 'core' ).getPostTypes()
		};
	} )
)( Search );
