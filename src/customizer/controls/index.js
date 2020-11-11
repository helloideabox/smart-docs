import { __ } from "@wordpress/i18n";

wp.customize.bind("ready", function () {
	//Add Preview URL

	/* var api = wp.customize;

	api.section("smartdocs_homepage_settings", function (section) {
		section.expanded.bind(function (isExpanded) {
			var url;
			if (isExpanded) {
				url = api.settings.url.home + "smart-docs";
				api.previewer.previewUrl.set(url);
			}
		});
	}); */

	setPreview("smartdocs_homepage_settings");
	setPreview("smartdocs_test_settings");
	setPreview("smartdocs_search_settings");
	setPreview("smartdocs_single_doc_settings");
});

function setPreview(setting) {
	var api = wp.customize;
	var slug = null;

	var sectionURLs = {
		smartdocs_homepage_settings: "smart-docs",
		smartdocs_test_settings: "smart-docs",
		smartdocs_search_settings: "smart-docs",
		smartdocs_single_doc_settings: "smart-docs/how-to-update-smart-docs-2/",
	};

	api.section(setting, function (section) {
		_.each(sectionURLs, function (value, key) {
			if (setting === key) {
				slug = value;
			}
		});

		var previousUrl, clearPreviousUrl, previewUrlValue;
		previewUrlValue = api.previewer.previewUrl;
		clearPreviousUrl = function () {
			previousUrl = null;
		};

		section.expanded.bind(function (isExpanded) {
			var url;
			if (isExpanded) {
				url = api.settings.url.home + slug;
				previousUrl = previewUrlValue.get();
				previewUrlValue.set(url);
				previewUrlValue.bind(clearPreviousUrl);
			} else {
				previewUrlValue.unbind(clearPreviousUrl);
				if (previousUrl) {
					previewUrlValue.set(previousUrl);
				}
			}
		});
	});
}
