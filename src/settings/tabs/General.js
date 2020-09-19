import { TextControl, BaseControl, Button } from "@wordpress/components";
import { Fragment } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import { useEntityProp } from "@wordpress/core-data";

export default function General() {
	const [title, setTitle] = useEntityProp(
		"root",
		"site",
		"ed_archive_page_title"
	);

	return (
		<Fragment>
			<BaseControl
				id="textarea-1"
				label="Documentation Page Title"
				help="Edit to change the default title for the documentation page."
				className="mb-3"
			>
				<TextControl
					id="ibx_ed_option-doc_homepage_title"
					className="mt-3 block mb-3"
					value={title}
					placeholder={__("Documentation")}
					onChange={setTitle}
				/>
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
			<Button
                               
                                onClick= { () => wp.data.dispatch( 'core' ).saveSite( { 'ed_archive_page_title' : title })}

                               >Save Changes</Button>
		</Fragment>
	);
}
