import {
	BaseControl,
	Button,
	TextControl,
	ToggleControl,
	SelectControl,
} from "@wordpress/components";
import { Fragment, useState } from "@wordpress/element";
import { useEntityProp } from "@wordpress/core-data";
import { __, sprintf } from "@wordpress/i18n";
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
		"ibx_sd_archive_page_title"
	);
	const [archiveSlug, setArchiveSlug] = useEntityProp(
		"root",
		"site",
		"ibx_sd_archive_page_slug"
	);
	const [categorySlug, setCategorySlug] = useEntityProp(
		"root",
		"site",
		"ibx_sd_category_slug"
	);
	const [tagSlug, setTagSlug] = useEntityProp(
		"root",
		"site",
		"ibx_sd_tag_slug"
	);
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
	const [customDocPage, setCustomDocPage] = useEntityProp(
		"root",
		"site",
		"smartdocs_custom_doc_page"
	);

	const [enableCustomDocPage, setEnableCustomDocPage] = useEntityProp(
		"root",
		"site",
		"smartdocs_custom_doc_page_enable"
	);

	const [pageList, setPageList] = useState([
		{ label: "Select docs page from the list", value: null },
	]);

	const postList = [{ label: "Select docs page from the list", value: null }];

	/**Fetch all the pages */
	wp.apiFetch({
		path: "/wp/v2/pages",
	})
		.then((pages) => {
			jQuery.each(pages, function (key, val) {
				postList.push({ label: val.title.rendered, value: val.id });
			});
			setPageList(postList);
		})
		.catch((e) => {
			console.log(e);
		});

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
				ibx_sd_archive_page_title: title,
				ibx_sd_archive_page_slug: archiveSlug,
				ibx_sd_category_slug: categorySlug,
				ibx_sd_tag_slug: tagSlug,
				ibx_sd_enable_single_template: singleTemplate,
				ibx_sd_enable_category_and_tag_template: archiveTax,
				smartdocs_custom_doc_page_enable: enableCustomDocPage,
				smartdocs_custom_doc_page: customDocPage,
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
			<ToggleControl
				className="mt-2 mb-2"
				label={__("Use built-in Doc archive")}
				help={__(
					"Note: if you disable built-in documentation archive, you can use shortcode or page builder widgets to design your documentation page."
				)}
				checked={enableCustomDocPage}
				onChange={setEnableCustomDocPage}
			/>
			<>
				{ ! enableCustomDocPage && (
					<SelectControl
						label={__("Select Custom Doc Page")}
						labelPosition="top"
						id="smartdocs-option_select-custom-doc-page"
						options={pageList}
						value={customDocPage}
						onChange={setCustomDocPage}
					/>
				) }
			</>
			<BaseControl
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
				label="Documentation Archive Slug"
				help="Edit to change the default slug for the documentation page."
				className="mb-3"
			>
				<TextControl
					id="sd_option-doc_homepage_slug"
					className="mt-2 block mb-2"
					value={archiveSlug}
					placeholder={__("Add documentation archive/home page slug")}
					onChange={setArchiveSlug}
				/>
			</BaseControl>
			<BaseControl
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
				className="mt-3 mb-3"
				id="smartdocs-custom-templates"
				label={__("Custom Templates")}
			>
				<ToggleControl
					className="mt-2 mb-2"
					label={__("Use built-in template for Docs single page")}
					checked={singleTemplate}
					onChange={setSingleTemplate}
				/>
				<ToggleControl
					className="mt-2 mb-2"
					label={__("Use built-in template for Docs archive page")}
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
