import { Fragment, useState } from "@wordpress/element";
import {
	BaseControl,
	ToggleControl,
	__experimentalNumberControl as NumberControl,
} from "@wordpress/components";

import { __ } from "@wordpress/i18n";
import { useEntityProp } from "@wordpress/core-data";

export default function ListLayoutSettings() {
	/**
	 * [Getter, Setter] for SmartDocs Settings
	 *
	 * @since 1.0.0
	 */

	/**
	 * Documentation Page Doc Icon.
	 *
	 * Show/hide documentation category icon.
	 */
	const [showIcon, setShowIcon] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_list_layout_icon"
	);

	/**
	 * Documentation Page Columns.
	 *
	 * Set number of columns.
	 */
	const [listColumns, setListColumns] = useEntityProp(
		"root",
		"site",
		"ibx_sd_doc_page_list_layout_columns"
	);

	return (
		<Fragment>
			<hr className="my-5"/>
			<h3 className="my-3 font-semibold">List Layout Settings</h3>
			<NumberControl
				className="my-3"
				isShiftStepEnabled={true}
				onChange={setListColumns}
				shiftStep={1}
				value={listColumns}
			/>
			<ToggleControl
				className="my-3"
				label="Show or Hide Doc Category Icon"
				checked={showIcon}
				onChange={setShowIcon}
			/>
		</Fragment>
	);
}
