import { Fragment, useState } from "@wordpress/element";
import {
	BaseControl,
	__experimentalRadio as Radio,
	__experimentalRadioGroup as RadioGroup,
	ToggleControl,
	Button,
} from "@wordpress/components";

import { useEntityProp } from "@wordpress/core-data";
import { useDispatch } from "@wordpress/data";

import ListLayoutSettings from "./sections/layout/ListLayoutSettings";
import GridLayoutSettings from "./sections/layout/GridLayoutSettings";

export default function DocPage() {
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	/**
	 * [Getter, Setter] for SmartDocs Settings
	 *
	 * @since 1.0.0
	 */

	/**
	 * Documentation Page Layout Key
	 */
	const [layout, setLayout] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_layout"
	);

	/**
	 * Show number of docs count.
	 *
	 * @type boolean
	 */

	const [docsCount, setDocsCount] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_count"
	);

	/**
	 * Show Authors.
	 *
	 * @type boolean
	 */

	const [showAuthors, setShowAuthors] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_authors"
	);

	/**
	 * Show number of docs count.
	 *
	 * @type boolean
	 */

	const [showSearch, setShowSearch] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_search"
	);

	/**
	 * Button Saving state
	 *
	 * @since 1.0.0
	 */

	const [saving, setSaving] = useState(false);

	/**
	 * Fetching settings for List and Grid layout
	 */

	const [showIcon] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_list_layout_icon"
	);

	const [listColumns] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_list_layout_columns"
	);

	const [gridShowIcon] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_grid_layout_icon"
	);

	const [gridColumns] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_grid_layout_columns"
	);

	/**
	 * Save settings.
	 * 
	 * Save settings to the WordPress Database.
	 * 
	 * @since 1.0.0
	 */

	function handleSaveSettings() {
		setSaving(true);

		let settings = {
			ibx_sd_doc_page_layout: layout,
			ibx_sd_doc_page_authors: showAuthors,
			ibx_sd_doc_page_search: showSearch,
			ibx_sd_doc_page_count: docsCount,
			ibx_sd_doc_page_list_layout_icon: showIcon,
			ibx_sd_doc_page_list_layout_columns: listColumns,
			ibx_sd_doc_page_grid_layout_icon: gridShowIcon,
			ibx_sd_doc_page_grid_layout_columns: gridColumns,

		};

		const status = wp.data
			.dispatch("core")
			.saveSite(settings)
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
			<BaseControl label="Documentation Page Layout">
				<RadioGroup
					id="sd_option-doc-homepage-layout"
					className="m-5"
					label="Documentation Page Layout"
					checked={layout}
					onChange={setLayout}
				>
					<Radio value="list">List</Radio>
					<Radio value="grid">Grid</Radio>
				</RadioGroup>
			</BaseControl>
			<ToggleControl
				label="Show or Hide Docs Count"
				checked={docsCount}
				onChange={setDocsCount}
			/>
			<ToggleControl
				label="Show or Hide Docs Authors"
				checked={showAuthors}
				onChange={setShowAuthors}
			/>
			<ToggleControl
				label="Show or Hide Docs Authors"
				checked={showSearch}
				onChange={setShowSearch}
			/>
			<div>{"list" === layout ? <ListLayoutSettings /> : null}</div>
			<div>{"grid" === layout ? <GridLayoutSettings /> : null}</div>
			<Button isPrimary="true" isBusy={saving} onClick={handleSaveSettings}>
				Save Changes
			</Button>
		</Fragment>
	);
}
