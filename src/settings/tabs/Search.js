import { Fragment, useState } from "@wordpress/element";
import {
	BaseControl,
	Button,
	CheckboxControl,
	ToggleControl,
} from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import { useEntityProp } from "@wordpress/core-data";
import { useDispatch } from "@wordpress/data";

export default function Search() {
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	const [postTypes, setPostTypes] = useEntityProp(
		"root",
		"site",
		"ibx_sd_search_post_types"
	);

	/**
	 * Button Saving state
	 *
	 * @since 1.0.0
	 */

	const [saving, setSaving] = useState(false);

	// 1. Array to store previously selected post types

	const [types, setTypes] = useState(postTypes);

	/**
	 * Update postTypes array when value of types is changes
	 */

	if (types !== postTypes) {
		setPostTypes(types);
	}

	const settings = {
		ibx_sd_search_post_types: postTypes,
	};

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
				<ul>
					{Object.keys(smartdocs_admin.post_types).map((item, index) => (
						<li key={index}>
							<CheckboxControl
								label={smartdocs_admin.post_types[item]}
								checked={types.some((value) => value === item)}
								onChange={(isChecked) => {
									if (isChecked) {
										setTypes((types) => [...types, item]);
									} else {
										let u = [];
										u = types.filter((type) => type !== item);
										setTypes(u);
									}
								}}
							/>
						</li>
					))}
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
