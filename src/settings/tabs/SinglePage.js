import { Fragment } from "@wordpress/element";
import { ToggleControl } from "@wordpress/components";

export default function DocPage() {
	return (
		<Fragment>
			<ToggleControl label="Show or Hide Sidebar" />
			<ToggleControl label="Show or Hide Doc Title Permalink Copy Icon" />
			<ToggleControl label="Show or Hide Breadcrumbs" />
			<ToggleControl label="Show or Hide Comments" />
			<ToggleControl label="Show or Hide Social Share options" />
			<ToggleControl label="Show or Hide Ratings Buttons" />
		</Fragment>
	);
}
