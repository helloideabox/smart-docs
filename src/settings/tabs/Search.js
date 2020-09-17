import { Fragment } from "@wordpress/element";
import {
	BaseControl,
	__experimentalRadio as Radio,
	__experimentalRadioGroup as RadioGroup,
	ToggleControl,
} from "@wordpress/components";

export default function Search() {
	return (
		<Fragment>
			<BaseControl label="Documentation Page Layout">
				<RadioGroup label="Width" defaultchecked="50" className="block">
					<Radio value="list">List</Radio>
					<Radio value="grid">Grid</Radio>
				</RadioGroup>
			</BaseControl>
			<ToggleControl label="Show or Hide Docs Count" />
			<ToggleControl label="Show or Hide Docs Authors" />
			<ToggleControl label="Show or Hide Docs Authors" />
		</Fragment>
	);
}
