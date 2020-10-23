import { useDispatch } from "@wordpress/data";
import { useState } from "@wordpress/element";

export default function SaveSettings(settings) {

	const { createSuccessNotice, createErrorNotice } = useDispatch(
		"core/notices"
	);

	wp.data
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
}
