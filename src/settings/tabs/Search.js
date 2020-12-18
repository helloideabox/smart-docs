import { Fragment, useState } from "@wordpress/element";
import {
	BaseControl,
	Button,
	ToggleControl,
} from "@wordpress/components";
import { compose } from '@wordpress/compose';
import { useEntityProp } from "@wordpress/core-data";
import { withSelect, useDispatch } from "@wordpress/data";
import { __ } from "@wordpress/i18n";

const Search = ( props ) => {
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	const [postTypes, setPostTypes] = useEntityProp(
		"root",
		"site",
		"ibx_sd_search_post_types"
	);

	const allPostTypes = [];

	if ( props.postTypes ) {
		props.postTypes.forEach( (type) => {
			if ( type.viewable && 'attachment' !== type.slug ) {
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
		setSaving(true);
		wp.data
			.dispatch("core")
			.saveSite({
				ibx_sd_search_post_types: postTypes,
			})
			.then(function () {
				createSuccessNotice("Settings Saved!", {
					type: "snackbar",
				});
			})
			.catch(function (e) {
				createErrorNotice(
					"There was some error saving settings! \nCheck console for more information on error.",
					{
						type: "snackbar",
					}
				);
				console.log(e);
			});

		setSaving(false);
	};

	// Function to get values from toggle
	return (
		<Fragment>
			<BaseControl
				id="textarea-1"
				label="Select Post Types"
				help="Select post types to search in."
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
										let types = selectedTypes.filter((type) => type !== item.value);
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
				isBusy={saving}
				onClick={handleSaveSettings}
			>
				Save Changes
			</Button>
		</Fragment>
	);
}

export default compose(
	withSelect( ( select ) => {
		return {
			postTypes: select( 'core' ).getPostTypes()
		};
	} )
)( Search );