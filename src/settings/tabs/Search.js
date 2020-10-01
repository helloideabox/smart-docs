import { Fragment, useState } from "@wordpress/element";
import {
	BaseControl,
	__experimentalRadio as Radio,
	__experimentalRadioGroup as RadioGroup,
	ToggleControl,
	SelectControl,
	Button,
	CheckboxControl,
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

	/**
	 * State object for post types.
	 */

	// 1. Array to store checkbox data-value

	const checkedTypes = postTypes;

	console.log(postTypes)

	const types = [];

	Object.keys(sd_vars.post_types).map((item) => {
		types.push({
			value: item,
			label: item,
		});
	});

	// 2. Function to check array and set isChecked on callaback

	function getChecked(type) {
		if (checkedTypes.indexOf(type)) {
			return true;
		} else {
			return false;
		}
	}

	//3. fill checkedTypes array


	//4. handle save settings

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
				{types.map((item) => (
					<CheckboxControl label={item.label} data-value={item.value} />
				))}
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
