import { Fragment, useState } from "@wordpress/element";
import {
	BaseControl,
	ToggleControl,
	Button,
	__experimentalRadio as Radio,
	__experimentalRadioGroup as RadioGroup,
} from "@wordpress/components";
import { useEntityProp } from "@wordpress/core-data";
import { __ } from "@wordpress/i18n";
import { useDispatch } from "@wordpress/data";

export default function DocPage() {
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	/**
	 * [Getter, Setter] for SmartDocs Settings
	 *
	 * @since 1.0.0
	 */
	const [showSidebar, setShowSidebar] = useEntityProp(
		"root",
		"site",
		"ibx_sd_archive_sidebar"
	);
	const [layout, setLayout] = useEntityProp(
		"root",
		"site",
		"ibx_sd_archive_layout"
	);
	const [showSearch, setShowSearch] = useEntityProp(
		"root",
		"site",
		"ibx_sd_archive_search"
	);
	const [showSuggestedArticles, setShowSuggestedArticles] = useEntityProp(
		"root",
		"site",
		"ibx_sd_archive_suggested"
	);

	const [saving, setSaving] = useState(false);

	function handleSaveSettings() {
		setSaving(true);

		const status = wp.data
			.dispatch("core")
			.saveSite({
				ibx_sd_archive_sidebar: showSidebar,
				ibx_sd_archive_layout: layout,
				ibx_sd_archive_search: showSearch,
				ibx_sd_archive_suggested: showSuggestedArticles,
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
	return (
		<Fragment>
			<BaseControl label="Archive Page Layout">
				<RadioGroup
					id="sd_option-doc-archive-layout"
					className="ml-5"
					label="Documentation Archive Page Layout"
					checked={layout}
					onChange={setLayout}
				>
					<Radio value="list">List</Radio>
					<Radio value="grid">Grid</Radio>
				</RadioGroup>
			</BaseControl>
			<ToggleControl
				label="Show or Hide Sidebar"
				checked={showSidebar}
				onChange={setShowSidebar}
			/>
			<ToggleControl
				label="Show or Hide Search Bar"
				checked={showSearch}
				onChange={setShowSearch}
			/>
			<ToggleControl
				label="Show or Hide Suggested Articles"
				checked={showSuggestedArticles}
				onChange={setShowSuggestedArticles}
			/>
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
