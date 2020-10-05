import { Fragment, useState } from "@wordpress/element";
import { BaseControl, Button, CheckboxControl, ToggleControl } from "@wordpress/components";
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

	/**
	 * State object for post types.
	 */

	// 1. Array to store checkbox data-value

	const types = [];

	Object.keys(sd_vars.post_types).map((item) => {
		types.push({
			value: item,
			label: item,
		});
	});

	return (
		<Fragment>
			{/* <SelectControl
				multiple
				label={__("Select Post Types:")}
				value={postTypes} // e.g: value = [ 'a', 'c' ]
				onChange={setPostTypes}
				options={types}
			/> */}
			<BaseControl
				id="textarea-1"
				label="Select Post Types"
				help="Select post types to search in."
				className="mb-3"
			>
				<ul>
					{Object.keys(sd_vars.post_types).map((item, index) => (
						<li key={index}>
							<ToggleControl
								label={sd_vars.post_types[item]}
								checked={postTypes.some((value) => value === item)}
								onChange={(isChecked) => {
									console.log(isChecked);
									if (isChecked) {
										console.log('isChecked');
										postTypes.push(item);
										console.log(postTypes);
									} else {
										console.log(item);
										console.log(postTypes);
										let itemIndex = postTypes.indexOf(item);
										postTypes.splice(itemIndex, 1);
										console.log(postTypes);
									}

									setPostTypes(postTypes);
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
