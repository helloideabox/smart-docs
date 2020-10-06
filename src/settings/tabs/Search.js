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

	function handleSaveSettings() {
		setSaving(true);

		const status = wp.data
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
	}

	// 1. Array to store previously selected post types

	const [types, setTypes] = useState(postTypes);
	//let types = postTypes;

	console.log(types);

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
					{Object.keys(sd_vars.post_types).map((item, index) => (
						<li key={index}>
							<CheckboxControl
								label={sd_vars.post_types[item]}
								checked={types.some((value) => value === item)}
								onChange={(isChecked) => {
									if (isChecked) {
										//console.log(isChecked);
										//console.log(types);
										//types.push(item);
										setTypes([...types, item]);
										//console.log(types);
									} else {
										//console.log("Unchecked" + isChecked);
										//console.log(types);
										let itemIndex = types.indexOf(item);
										types.splice(itemIndex, 1);
										setTypes([...types, types]);
										console.log("Types:");
										console.log(types);

										console.log("Post Types:");
										console.log(postTypes);
									}
									//console.log(types);
									//console.log(postTypes);
									setPostTypes(types);
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
