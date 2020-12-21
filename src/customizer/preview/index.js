(function ($) {
	/**
	 * Hero Section
	 */
	wp.customize("smartdocs_hero_background_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-header").css("background-color", new_value);
		});
	});
	wp.customize("smartdocs_hero_bg_image_overlay_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-header:before").css("background-color", new_value);
		});
	});

	/* Archive Title Color */
	wp.customize("smartdocs_hero_title_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-header smartdocs-hero-title").css("color", new_value);
		});
	});

	/* Archive Description Color */
	wp.customize("smartdocs_hero_description_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-header p").css("color", new_value);
		});
	});

	/**
	 * Category columns
	 */
	wp.customize("smartdocs_archive_columns", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-categories").css(
				"grid-template-columns",
				"repeat( " + new_value + ", 1fr)"
			);
		});
	});

	wp.customize("smartdocs_archive_columns_tablet", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-categories").css(
				"grid-template-columns",
				"repeat( " + new_value + ", 1fr)"
			);
		});
	});

	wp.customize("smartdocs_archive_columns_mobile", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-categories").css(
				"grid-template-columns",
				"repeat( " + new_value + ", 1fr)"
			);
		});
	});

	/**
	 * Spacing
	 */
	wp.customize("smartdocs_archive_columns_gap", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-categories").css("gap", new_value + "px");
		});
	});

	/**
	 * Category title
	 */
	wp.customize("smartdocs_archive_category_title_font_size", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("font-size", new_value + "px");
		});
	});

	wp.customize("smartdocs_archive_category_title_font_size_tablet", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("font-size", new_value + "px");
		});
	});

	wp.customize("smartdocs_archive_category_title_font_size_mobile", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("font-size", new_value + "px");
		});
	});

	wp.customize("smartdocs_archive_category_title_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("color", new_value);
		});
	});

	/**
	 * Category description
	 */
	wp.customize("smartdocs_archive_category_description_font_size", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-description").css("font-size", new_value + "px");
		});
	});

	wp.customize(
		"smartdocs_archive_category_description_font_size_tablet",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-category-description").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize(
		"smartdocs_archive_category_description_font_size_mobile",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-category-description").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize("smartdocs_archive_category_description_color", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-description").css("color", new_value);
		});
	});

	/**
	 * Category actions.
	 */
	wp.customize("smartdocs_archive_category_action_font_size", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-categories .smartdocs-posts-info").css("font-size", new_value + "px");
		});
	});

	wp.customize(
		"smartdocs_archive_category_action_font_size_tablet",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-categories .smartdocs-posts-info").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize(
		"smartdocs_archive_category_action_font_size_mobile",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-categories .smartdocs-posts-info").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize("smartdocs_archive_category_action_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-categories .smartdocs-posts-info a").css("color", new_value);
		});
	});

	wp.customize("smartdocs_archive_category_action_bg_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-categories .smartdocs-posts-info").css("background-color", new_value);
		});
	});

	wp.customize("smartdocs_archive_category_action_border_color", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-categories .smartdocs-posts-info").css("border-top-color", new_value);
		});
	});

})(jQuery);
