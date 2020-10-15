import {
	BaseControl,
	Button,
	TextControl,
	ToggleControl,
} from "@wordpress/components";
import { Fragment, useState } from "@wordpress/element";
import { useEntityProp } from "@wordpress/core-data";
import { __ } from "@wordpress/i18n";
import { useDispatch } from "@wordpress/data";

export default function General() {
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	/**
	 * [Getter, Setter] for SmartDocs Settings
	 *
	 * @since 1.0.0
	 */
	const [title, setTitle] = useEntityProp(
		"root",
		"site",
		"sd_archive_page_title"
	);
	const [titleSlug, setTitleSlug] = useEntityProp(
		"root",
		"site",
		"sd_archive_page_slug"
	);
	const [categorySlug, setCategorySlug] = useEntityProp(
		"root",
		"site",
		"sd_category_slug"
	);
	const [tagSlug, setTagSlug] = useEntityProp("root", "site", "sd_tag_slug");
	const [singleTemplate, setSingleTemplate] = useEntityProp(
		"root",
		"site",
		"ibx_sd_enable_single_template"
	);
	const [archiveTax, setArchiveTax] = useEntityProp(
		"root",
		"site",
		"ibx_sd_enable_category_and_tag_template"
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
				sd_archive_page_title: title,
				sd_archive_page_slug: titleSlug,
				sd_category_slug: categorySlug,
				sd_tag_slug: tagSlug,
				ibx_sd_enable_single_template: singleTemplate,
				ibx_sd_enable_category_and_tag_template: archiveTax,
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
			<BaseControl
				id="textarea-1"
				label="Documentation Page Title"
				help="Edit to change the default title for the documentation page."
				className="mb-3"
			>
				<TextControl
					id="sd_option-doc_homepage_title"
					className="mt-2 block mb-2"
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
					className="mt-2 block mb-2"
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
					className="mt-2 block mb-2"
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
					className="mt-2 block mb-2"
					value={tagSlug}
					placeholder={__("Add custom tag slug")}
					onChange={setTagSlug}
				/>
			</BaseControl>
			<BaseControl
				className=" mt-3 mb-3"
				id="smartdocs-custom-templates"
				label={__("Custom Templates")}
			>
				<ToggleControl
					className="mt-2 mb-2"
					label={__("Enable Custom Single Doc Template")}
					checked={singleTemplate}
					onChange={setSingleTemplate}
				/>
				<ToggleControl
					className="mt-2 mb-2"
					label={__("Enable Custom Template for Tag and Category Archives")}
					checked={archiveTax}
					onChange={setArchiveTax}
				/>
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
