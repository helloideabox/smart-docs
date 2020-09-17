import { Fragment } from "@wordpress/element";
import {
	BaseControl,
	ToggleControl,
	__experimentalNumberControl as NumberControl,
} from "@wordpress/components";

export default function DocPage() {
	return (
		<Fragment>
			<BaseControl label="Number of docs to show per page">
				<NumberControl />
			</BaseControl>
			<ToggleControl label="Show or Hide Sidebar" />
			<ToggleControl label="Show or Hide Search Bar" />
			<ToggleControl label="Show or Hide Suggested Articles" />
		</Fragment>
	);
}
