import { TextControl, BaseControl, Button } from "@wordpress/components";
import { Fragment, useState } from "@wordpress/element";
import { __ } from "@wordpress/i18n";
import { useEntityProp } from "@wordpress/core-data";

export default function General() {
	/**
	 * [Getter, Setter] for SmartDocs Archive Page Title
	 *
	 * @since 1.0.0
	 */
	const [title, setTitle] = useEntityProp(
		"root",
		"site",
		"sd_archive_page_title"
	);

	/**
	 * [Getter, Setter] for SmartDocs Archive Page Slug
	 *
	 * @since 1.0.0
	 */
	const [titleSlug, setTitleSlug] = useEntityProp(
		"root",
		"site",
		"sd_archive_page_slug"
	);

	/**
	 * [Getter, Setter] for SmartDocs Category Slug
	 *
	 * @since 1.0.0
	 */
	const [categorySlug, setCategorySlug] = useEntityProp(
		"root",
		"site",
		"sd_category_slug"
	);

	/**
	 * [Getter, Setter] for SmartDocs Tag Slug
	 *
	 * @since 1.0.0
	 */
	const [tagSlug, setTagSlug] = useEntityProp("root", "site", "sd_tag_slug");

	/**
	 * Button Saving state
	 *
	 * @since 1.0.0
	 */

	const [pending, setPending] = useState(false);

	return (
		<Fragment>
			<BaseControl
				id="textarea-1"
				label="Documentation Page Title"
				help="Edit to change the default title for the documentation page."
				className="mb-3"
			>
				<TextControl
					id="sd_option-doc_homepage_title"
					className="mt-3 block mb-3"
					value={title}
					placeholder={__("Documentation")}
					onChange={setTitle}
				/>
			</BaseControl>
			<BaseControl
				id="textarea-2"
				label="Documentation Archive Slug"
				help="Edit to change the default slug for the documentation page."
				className="mb-3"
			>
				<TextControl
					id="sd_option-doc_homepage_slug"
					className="mt-3 block mb-3"
					value={titleSlug}
					placeholder={__("Add documentation archive/home page slug")}
					onChange={setTitleSlug}
				/>
			</BaseControl>
			<BaseControl
				id="textarea-3"
				label="Documentation Category Slug"
				help="Edit to change the default slug for the documentation category."
				className="mb-3"
			>
				<TextControl
					id="sd_option-doc_category_slug"
					className="mt-3 block mb-3"
					value={categorySlug}
					placeholder={__("Add custom category slug")}
					onChange={setCategorySlug}
				/>
			</BaseControl>
			<BaseControl
				id="textarea-3"
				label="Documentation Tag Slug"
				help="Edit to change the default slug for the documentation tag."
			>
				<TextControl
					id="sd_option-doc_tag_slug"
					className="mt-3 block mb-3"
					value={tagSlug}
					placeholder={__("Add custom tag slug")}
					onChange={setTagSlug}
				/>
			</BaseControl>
				<Button
					isPrimary="true"
					isBusy={ pending }
					onClick={(props) => {
						setPending(true);
						const { isResolving } = wp.data.select( 'core/data' );
						console.log(isResolving);
						wp.data.dispatch("core").saveSite({
							sd_archive_page_title: title,
							sd_archive_page_slug: titleSlug,
							sd_category_slug: categorySlug,
							sd_tag_slug: tagSlug,
						});
						setPending(false);
					}}
				>
					Save Changes
				</Button>
		</Fragment>
	);
}
