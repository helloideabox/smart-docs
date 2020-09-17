import { TextControl, BaseControl } from "@wordpress/components";
import { Fragment } from "@wordpress/element";

export default function General() {
	return (
		<Fragment>
			<BaseControl
				id="textarea-1"
				label="Documentation Page Title"
				help="Edit to change the default title for the documentation page."
				className="mb-3"
			>
				<TextControl className="mt-3 block mb-3" />
			</BaseControl>
			<BaseControl
				id="textarea-2"
				label="Documentation Slug"
				help="Edit to change the default slug for the documentation page."
				className="mb-3"
			>
				<TextControl className="mt-3 block mb-3" />
			</BaseControl>
			<BaseControl
				id="textarea-3"
				label="Documentation Category Slug"
				help="Edit to change the default slug for the documentation category."
				className="mb-3"
			>
				<TextControl className="mt-3 block mb-3" />
			</BaseControl>
			<BaseControl
				id="textarea-3"
				label="Documentation Tag Slug"
				help="Edit to change the default slug for the documentation tag."
			>
				<TextControl className="mt-3 block mb-3" />
			</BaseControl>
		</Fragment>
	);
}
