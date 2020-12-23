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
	 * @class SmartDocsCustomizerControl
	 */
	var SmartDocsCustomizerControl = {
		/**
		 * Initializer
		 *
		 * @since 1.0.0
		 * @method init
		 */
		init: function () {
			SmartDocsCustomizerControl._toggleResponsiveControls();
			SmartDocsCustomizerControl._initResponsiveToggle();
			SmartDocsCustomizerControl._initPreview();
			SmartDocsCustomizerControl._initBackgroundControl();
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

			/**
			 * Init Toggle Switch for each responsive control
			 */

			$(".smartdocs-responsive-control-toggle").on("click", function () {
				var devices = $(".devices"),
					button = devices.find(".preview-desktop");

				if ($(this).hasClass("dashicons-desktop")) {
					button = devices.find(".preview-tablet");
				} else if ($(this).hasClass("dashicons-tablet")) {
					button = devices.find(".preview-mobile");
				}

				button.trigger("click");
			});

			devices.find(".preview-desktop").on("click", function () {
				SmartDocsCustomizerControl._toggleResponsiveControls();
			});
			devices.find(".preview-tablet").on("click", function () {
				SmartDocsCustomizerControl._toggleResponsiveControls();
			});
			devices.find(".preview-mobile").on("click", function () {
				SmartDocsCustomizerControl._toggleResponsiveControls();
			});
		},

		/**
		 * Handle preview URLs
		 */
		_setPreview: function (setting) {
			var previewUrl = null;

			var sectionURLs = {
				smartdocs_hero_section: smartdocs_customizer.cpt_slug,
				smartdocs_archive_settings: smartdocs_customizer.cpt_slug,
				smartdocs_search_settings: smartdocs_customizer.cpt_slug,
				smartdocs_single_doc_settings: smartdocs_customizer.single_doc_url,
			};

			api.section(setting, function (section) {
				_.each(sectionURLs, function (value, key) {
					if ( 'smartdocs_single_doc_settings' === setting ) {
						previewUrl = value;
					} else if (setting === key) {
						previewUrl = api.settings.url.home + value;
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
						url = previewUrl;
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
			SmartDocsCustomizerControl._setPreview("smartdocs_archive_settings");
			SmartDocsCustomizerControl._setPreview("smartdocs_search_settings");
			SmartDocsCustomizerControl._setPreview("smartdocs_single_doc_settings");
			SmartDocsCustomizerControl._setPreview("smartdocs_hero_section");
		},

		/**
		 * Hero Section Background Control Controller
		 */
		_initBackgroundControl: function () {
			var val = api.settings.settings.smartdocs_hero_bg_type.value;

			if ("color" === val) {
				$(
					"#customize-control-smartdocs_hero_background_color_control"
				).css("display", "list-item");
				$("#customize-control-smartdocs_hero_bg_image_control").css(
					"display",
					"none"
				);
				$("#customize-control-smartdocs_hero_bg_image_overlay_color_control").css(
					"display",
					"none"
				);
			} else if ("image" === val) {
				$(
					"#customize-control-smartdocs_hero_background_color_control"
				).css("display", "none");
				$("#customize-control-smartdocs_hero_bg_image_control").css(
					"display",
					"list-item"
				);
				$("#customize-control-smartdocs_hero_bg_image_overlay_color_control").css(
					"display",
					"list-item"
				);
				
			}

			api("smartdocs_hero_bg_type", function (value) {
				value.bind(function (newValue) {
					if ("color" === newValue) {
						$(
							"#customize-control-smartdocs_hero_background_color_control"
						).css("display", "list-item");
						$("#customize-control-smartdocs_hero_bg_image_control").css(
							"display",
							"none"
						);
						$("#customize-control-smartdocs_hero_bg_image_overlay_color_control").css(
							"display",
							"none"
						);
					} else if ("image" === newValue) {
						$(
							"#customize-control-smartdocs_hero_background_color_control"
						).css("display", "none");
						$("#customize-control-smartdocs_hero_bg_image_control").css(
							"display",
							"list-item"
						);
						$("#customize-control-smartdocs_hero_bg_image_overlay_color_control").css(
							"display",
							"list-item"
						);
					}
				});
			});
		},
	};
	/**Initiate JS */
	api.bind("ready", SmartDocsCustomizerControl.init);
})(jQuery);
