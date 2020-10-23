import { ToggleControl, Button } from "@wordpress/components";
import { Fragment, useState } from "@wordpress/element";
import { useEntityProp } from "@wordpress/core-data";
import { __ } from "@wordpress/i18n";
import { useDispatch } from "@wordpress/data";

export default function DocPage() {
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	/**
	 * [Getter, Setter] for SmartDocs Settings
	 *
	 * @since 1.0.0
	 */
	const [showSidebar, setShowSidebar] = useEntityProp(
		"root",
		"site",
		"ibx_sd_single_page_sidebar"
	);
	const [showPermalink, setShowPermalink] = useEntityProp(
		"root",
		"site",
		"ibx_sd_single_page_permalink"
	);
	const [showBreadcrumbs, setShowBreadcrumbs] = useEntityProp(
		"root",
		"site",
		"ibx_sd_single_page_breadcrumbs"
	);
	const [showComments, setShowComments] = useEntityProp(
		"root",
		"site",
		"ibx_sd_single_page_comments"
	);
	const [showSocialShare, setShowSocialShare] = useEntityProp(
		"root",
		"site",
		"ibx_sd_single_page_social_share_options"
	);
	const [showRatings, setShowRatings] = useEntityProp(
		"root",
		"site",
		"ibx_sd_single_ratings"
	);

	const [saving, setSaving] = useState(false);

	function handleSaveSettings() {
		setSaving(true);

		const status = wp.data
			.dispatch("core")
			.saveSite({
				ibx_sd_single_page_sidebar: showSidebar,
				ibx_sd_single_page_permalink: showPermalink,
				ibx_sd_single_page_breadcrumbs: showBreadcrumbs,
				ibx_sd_single_page_comments: showComments,
				ibx_sd_single_page_social_share_options: showSocialShare,
				ibx_sd_single_ratings: showRatings,
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
				label="Show or Hide Sidebar"
				checked={showSidebar}
				onChange={setShowSidebar}
			/>
			<ToggleControl
				label="Show or Hide Doc Title Permalink Copy Icon"
				checked={showPermalink}
				onChange={setShowPermalink}
			/>
			<ToggleControl
				label="Show or Hide Breadcrumbs"
				checked={showBreadcrumbs}
				onChange={setShowBreadcrumbs}
			/>
			<ToggleControl
				label="Show or Hide Comments"
				checked={showComments}
				onChange={setShowComments}
			/>
			<ToggleControl
				label="Show or Hide Social Share options"
				checked={showSocialShare}
				onChange={setShowSocialShare}
			/>
			<ToggleControl
				label="Show or Hide Ratings Buttons"
				checked={showRatings}
				onChange={setShowRatings}
			/>
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
