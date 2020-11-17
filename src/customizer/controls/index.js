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
	//setPreview("smartdocs_homepage_settings");
	//setPreview("smartdocs_test_settings");
	//setPreview("smartdocs_search_settings");
	//setPreview("smartdocs_single_doc_settings");
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

(function ($) {
	/**
	 * WP_Customize JS Object.
	 * Internal shorthand.
	 */
	var api = wp.customize;

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @since 1.0.0
	 * @class SmartCustomizer
	 */
	var SmartCustomizer = {
		/**
		 * Initializer
		 *
		 * @since 1.0.0
		 * @method init
		 */
		init: function () {
			console.log("Class Initialized");
			SmartCustomizer._toggleResponsiveControls();
			SmartCustomizer._initResponsiveToggle();
			SmartCustomizer._initPreview();
			SmartCustomizer._initBackgroundControl();
		},

		/**
		 * Initializes responsive toggle icon for each control.
		 */
		_toggleResponsiveControls: function () {
			/**
			 * Hide controls initially based on device type.
			 */
			var mode = api.previewedDevice();
			mode === undefined ? (mode = "desktop") : mode;

			if ("desktop" === mode) {
				$(".customize-control.tablet").css("display", "none");
				$(".customize-control.mobile").css("display", "none");
				$(".customize-control.desktop").css("display", "list-item");
			} else if ("tablet" === mode) {
				$(".customize-control.desktop").css("display", "none");
				$(".customize-control.mobile").css("display", "none");
				$(".customize-control.tablet").css("display", "list-item");
			} else if ("mobile" === mode) {
				$(".customize-control.tablet").css("display", "none");
				$(".customize-control.mobile").css("display", "list-item");
				$(".customize-control.desktop").css("display", "none");
			}
		},

		/**
		 * Handle visibility of Responsive Controls
		 */
		_initResponsiveToggle: function () {
			var devices = $(".devices");

			devices.find(".preview-desktop").on("click", function () {
				SmartCustomizer._toggleResponsiveControls();
			});
			devices.find(".preview-tablet").on("click", function () {
				SmartCustomizer._toggleResponsiveControls();
			});
			devices.find(".preview-mobile").on("click", function () {
				SmartCustomizer._toggleResponsiveControls();
			});
		},

		/**
		 * Handle preview URLs
		 */
		_setPreview: function (setting) {
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
		},

		/**
		 * Set Preview URLs
		 */
		_initPreview: function () {
			SmartCustomizer._setPreview("smartdocs_homepage_settings");
			SmartCustomizer._setPreview("smartdocs_test_settings");
			SmartCustomizer._setPreview("smartdocs_search_settings");
			SmartCustomizer._setPreview("smartdocs_single_doc_settings");
		},

		/**
		 * Hero Section Background Control Controller
		 */
		_initBackgroundControl: function () {
			var val = api.settings.settings.smartdocs_archive_hero_section_bg.value;

			if ("color" === val) {
				$("#customize-control-smartdocs_archive_title_color_control").css(
					"display",
					"list-item"
				);
				$("#customize-control-smartdocs_archive_title_bg_image_control").css(
					"display",
					"none"
				);
			} else if ("image" === val) {
				$("#customize-control-smartdocs_archive_title_color_control").css(
					"display",
					"none"
				);
				$("#customize-control-smartdocs_archive_title_bg_image_control").css(
					"display",
					"list-item"
				);
			}

			api("smartdocs_archive_hero_section_bg", function (value) {
				value.bind(function (newValue) {
					if ("color" === newValue) {
						$("#customize-control-smartdocs_archive_title_color_control").css(
							"display",
							"list-item"
						);
						$(
							"#customize-control-smartdocs_archive_title_bg_image_control"
						).css("display", "none");
					} else if ("image" === newValue) {
						$("#customize-control-smartdocs_archive_title_color_control").css(
							"display",
							"none"
						);
						$(
							"#customize-control-smartdocs_archive_title_bg_image_control"
						).css("display", "list-item");
					}
				});
			});
		},
	};
	api.bind("ready", SmartCustomizer.init);
})(jQuery);
