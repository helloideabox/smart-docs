(function ($) {
	var api = wp.customize;

	api.bind("pane-contents-reflowed", function () {
		// Reflow sections
		var sections = [];

		api.section.each(function (section) {
			if (
				"smartdocs-nested" !== section.params.type ||
				"undefined" === typeof section.params.section
			) {
				return;
			}

			sections.push(section);
		});

		sections.sort(api.utils.prioritySort).reverse();

		$.each(sections, function (i, section) {
			var parentContainer = $(
				"#sub-accordion-section-" + section.params.section
			);

			parentContainer.children(".section-meta").after(section.headContainer);
		});

		// Reflow panels
		var panels = [];

		api.panel.each(function (panel) {
			if (
				"smartdocs-nested" !== panel.params.type ||
				"undefined" === typeof panel.params.panel
			) {
				return;
			}

			panels.push(panel);
		});

		panels.sort(api.utils.prioritySort).reverse();

		$.each(panels, function (i, panel) {
			var parentContainer = $("#sub-accordion-panel-" + panel.params.panel);

			parentContainer.children(".panel-meta").after(panel.headContainer);
		});
	});

	// Extend Panel
	var _panelEmbed = wp.customize.Panel.prototype.embed;
	var _panelIsContextuallyActive =
		wp.customize.Panel.prototype.isContextuallyActive;
	var _panelAttachEvents = wp.customize.Panel.prototype.attachEvents;

	wp.customize.Panel = wp.customize.Panel.extend({
		attachEvents: function () {
			if (
				"smartdocs-nested" !== this.params.type ||
				"undefined" === typeof this.params.panel
			) {
				_panelAttachEvents.call(this);

				return;
			}

			_panelAttachEvents.call(this);

			var panel = this;

			panel.expanded.bind(function (expanded) {
				var parent = api.panel(panel.params.panel);

				if (expanded) {
					parent.contentContainer.addClass("current-panel-parent");
				} else {
					parent.contentContainer.removeClass("current-panel-parent");
				}
			});

			panel.container
				.find(".customize-panel-back")
				.off("click keydown")
				.on("click keydown", function (event) {
					if (api.utils.isKeydownButNotEnterEvent(event)) {
						return;
					}

					event.preventDefault(); // Keep this AFTER the key filter above

					if (panel.expanded()) {
						api.panel(panel.params.panel).expand();
					}
				});
		},

		embed: function () {
			if (
				"smartdocs-nested" !== this.params.type ||
				"undefined" === typeof this.params.panel
			) {
				_panelEmbed.call(this);

				return;
			}

			_panelEmbed.call(this);

			var panel = this;
			var parentContainer = $("#sub-accordion-panel-" + this.params.panel);

			parentContainer.append(panel.headContainer);
		},

		isContextuallyActive: function () {
			if ("smartdocs-nested" !== this.params.type) {
				return _panelIsContextuallyActive.call(this);
			}

			var panel = this;
			var children = this._children("panel", "section");

			api.panel.each(function (child) {
				if (!child.params.panel) {
					return;
				}

				if (child.params.panel !== panel.id) {
					return;
				}

				children.push(child);
			});

			children.sort(api.utils.prioritySort);

			var activeCount = 0;

			_(children).each(function (child) {
				if (child.active() && child.isContextuallyActive()) {
					activeCount += 1;
				}
			});

			return activeCount !== 0;
		},
	});

	// Extend Section
	var _sectionEmbed = wp.customize.Section.prototype.embed;
	var _sectionIsContextuallyActive =
		wp.customize.Section.prototype.isContextuallyActive;
	var _sectionAttachEvents = wp.customize.Section.prototype.attachEvents;

	wp.customize.Section = wp.customize.Section.extend({
		attachEvents: function () {
			if (
				"smartdocs-nested" !== this.params.type ||
				"undefined" === typeof this.params.section
			) {
				_sectionAttachEvents.call(this);

				return;
			}

			_sectionAttachEvents.call(this);

			var section = this;

			section.expanded.bind(function (expanded) {
				var parent = api.section(section.params.section);

				if (expanded) {
					parent.contentContainer.addClass("current-section-parent");
				} else {
					parent.contentContainer.removeClass("current-section-parent");
				}
			});

			section.container
				.find(".customize-section-back")
				.off("click keydown")
				.on("click keydown", function (event) {
					if (api.utils.isKeydownButNotEnterEvent(event)) {
						return;
					}

					event.preventDefault(); // Keep this AFTER the key filter above

					if (section.expanded()) {
						api.section(section.params.section).expand();
					}
				});
		},

		embed: function () {
			if (
				"smartdocs-nested" !== this.params.type ||
				"undefined" === typeof this.params.section
			) {
				_sectionEmbed.call(this);

				return;
			}

			_sectionEmbed.call(this);

			var section = this;
			var parentContainer = $("#sub-accordion-section-" + this.params.section);

			parentContainer.append(section.headContainer);
		},

		isContextuallyActive: function () {
			if ("smartdocs-nested" !== this.params.type) {
				return _sectionIsContextuallyActive.call(this);
			}

			var section = this;
			var children = this._children("section", "control");

			api.section.each(function (child) {
				if (!child.params.section) {
					return;
				}

				if (child.params.section !== section.id) {
					return;
				}

				children.push(child);
			});

			children.sort(api.utils.prioritySort);

			var activeCount = 0;

			_(children).each(function (child) {
				if ("undefined" !== typeof child.isContextuallyActive) {
					if (child.active() && child.isContextuallyActive()) {
						activeCount += 1;
					}
				} else {
					if (child.active()) {
						activeCount += 1;
					}
				}
			});

			return activeCount !== 0;
		},
	});
})(jQuery);

/**
 * WordPress Customizer Framework
 *
 * Copyright (c) 2018 PlugsDev
 */
(function ($) {
	/**
	 * Internal shorthand.
	 */
	var api = wp.customize;

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @since 1.0.0
	 * @class SmartDocsCustomizer
	 */
	SmartDocsCustomizer = {
		/**
		 * Initializes our custom logic for the Customizer.
		 *
		 * @since 1.0.0
		 * @method init
		 */
		init: function () {
			//SmartDocsCustomizer._initToggles();
			SmartDocsCustomizer._initControls();
		},

		/**
		 * Initializes the logic for showing and hiding controls
		 * when a setting changes.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _initToggles
		 */
		_initToggles: function () {
			if (Object.keys(smartdocs_customizer_toggles).length < 1) {
				return;
			}
			// Loop through each setting.
			$.each(smartdocs_customizer_toggles, function (settingId, toggles) {
				// Get the setting object.
				api(settingId, function (setting) {
					// Loop through the toggles for the setting.
					$.each(toggles, function (i, toggle) {
						// Loop through the controls for the toggle.
						$.each(toggle.controls, function (k, controlId) {
							// Get the control object.
							api.control(controlId, function (control) {
								// Define the visibility callback.
								var visibility = function (to) {
									control.container.toggle(
										SmartDocsCustomizer._matchValues(to, toggle.value)
									);
								};

								// Init visibility.
								visibility(setting.get());

								// Bind the visibility callback to the setting.
								setting.bind(visibility);
							});
						});
					});
				});
			});
		},

		_initControls: function () {
			// Initialize the slider control.
			api.controlConstructor["smartdocs-slider"] = api.Control.extend({
				ready: function () {
					SmartDocsCustomizer._initSliderControl(this);
				},
			});

			// Initialize the slider control.
			api.controlConstructor["smartdocs-slider-responsive"] = api.Control.extend({
				ready: function () {
					SmartDocsCustomizer._initResponsiveSliderControl(this);
				},
			});

			// Initialize the dimension control.
			api.controlConstructor["smartdocs-dimension"] = api.Control.extend({
				ready: function () {
					SmartDocsCustomizer._initDimensionControl();
				},
			});

			// Initialize the color control.
			api.controlConstructor["smartdocs-color"] = api.Control.extend({
				ready: function () {
					SmartDocsCustomizer._initColorControl(this);
				},
			});
		},

		/**
		 * Initializes the slider control.
		 *
		 * @since 1.0.0
		 * @method _initSliderControl
		 */
		_initSliderControl: function (control) {
			control.container.find(".smartdocs-slider-reset").on("click", function () {
				var $slider = $(this).closest("label").find(".smartdocs-range-input"),
					$text_input = $(this)
						.closest("label")
						.find(".smartdocs-range-value-input"),
					value = $text_input.val(),
					default_value = $slider.data("original");

				$slider.val(default_value);
				$text_input.val(default_value);
				$slider.change();
				$text_input.change();

				control.setting.set(default_value);

				//wp.customize.previewer.refresh();
			});

			$(".customize-control-smartdocs-slider input[type=range]").each(function () {
				var $slider = $(this),
					$text_input = $(this)
						.closest("label")
						.find(".smartdocs-range-value-input");

				(value = $slider.val()), (min = $slider.attr("min"));

				$slider.on("input", function () {
					value = $slider.val();
					$text_input.val(value).trigger('change');
				});
				
				$text_input.on("keyup change", function () {
					$slider.val($text_input.val());
					$slider.change();
				});

				$text_input.on("focusout", function () {
					if (parseInt($text_input.val()) < min) {
						$text_input.val(min);
						$slider.change();
					}
				});
			});
		},

		/**
		 * Initializes the slider control.
		 *
		 * @since 1.0.0
		 * @method _initSliderControl
		 */
		_initResponsiveSliderControl: function (control) {
			var $mode = ["desktop", "tablet", "mobile"];

			$mode.forEach(function ($mode) {
				control.container
					.find(".smartdocs-slider-reset-" + $mode)
					.on("click", function () {
						var $slider = $(this)
								.closest("label")
								.find(".smartdocs-range-input-" + $mode),
							$text_input = $(this)
								.closest("label")
								.find(".smartdocs-range-value-input-" + $mode),
							value = $text_input.val(),
							default_value = $slider.data("original");

						$slider.val(default_value);
						$text_input.val(default_value);
						$slider.change();
						$text_input.change();

						control.setting.set(default_value);

						//wp.customize.previewer.refresh();
					});
			});

			$(".customize-control-smartdocs-slider-responsive input[type=range]").each(
				function () {
					var $mode = ["desktop", "tablet", "mobile"];
					_this = this;

					$mode.forEach(function ($mode) {
						var $slider = $(_this),
							$text_input = $(_this)
								.closest("label")
								.find(".smartdocs-range-value-input" + $mode);
						(value = $slider.val()), (min = $slider.attr("min"));

						$slider.on("input", function () {
							value = $slider.val();
							$text_input.val(value);
						});

						$text_input.on("keyup change", function () {
							$slider.val($text_input.val());
							$slider.change();
						});

						$text_input.on("focusout", function () {
							if (parseInt($text_input.val()) < min) {
								$text_input.val(min);
								$slider.change();
							}
						});
					});
				}
			);
		},

		_initDimensionControl: function () {
			$(".customize-control-smartdocs-dimension .smartdocs-field input").on(
				"keyup change",
				function () {
					var $dimension = $(this)
							.closest("label")
							.find(".smartdocs-dimension-value"),
						value = $dimension.data("value"),
						choice = $(this).data("key");

					value[choice] = $(this).val();

					$dimension.val(JSON.stringify(value));
					$dimension.trigger("change");
				}
			);

			$(".customize-control-smartdocs-dimension .smartdocs-dimension-value").each(
				function () {
					var $dimension = $(this),
						value = $dimension.data("value");

					$dimension.val(JSON.stringify(value));
				}
			);
		},

		_initColorControl: function (control) {
			control.container.find(".smartdocs-color-control").wpColorPicker({
				change: function (event, ui) {
					var color = ui.color.toString();
					control.setting.set(color);
				},

				clear: function (event) {
					var element = $(event.target)
						.closest(".wp-picker-input-wrap")
						.find(".wp-color-picker")[0];
					var color = "";

					if (element) {
						control.setting.set(color);
					}
				},
			});
		},

		/**
		 * Match two values for toggle and return boolean.
		 *
		 * @since 1.0.0
		 * @access private
		 * @method _matchValues
		 */
		_matchValues: function (val1, val2) {
			return val1 === val2;
		},
	};

	SmartDocsCustomizer.init();
})(jQuery);
