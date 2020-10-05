import { useDispatch } from "@wordpress/data";

/**
 * Button Saving state
 *
 * @since 1.0.0
 */

const [saving, setSaving] = useState(false);

export default function SaveSettings(settings) {

    
	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	setSaving(true);

	const status = wp.data
		.dispatch("core")
		.saveSite(settings)
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
