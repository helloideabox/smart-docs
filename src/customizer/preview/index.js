(function ($) {
	/**
	 * Hero Section
	 */
	wp.customize("smartdocs_hero_background_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-header .smartdocs-inner").css("background-color", new_value);
		});
	});
	wp.customize("smartdocs_hero_bg_image_overlay_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-header .smartdocs-inner::before").css("background-color", new_value);
		});
	});

	/* Archive Title Color */
	wp.customize("smartdocs_hero_title_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-hero-title").css("color", new_value);
		});
	});

	/* Archive Description Color */
	wp.customize("smartdocs_hero_description_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-header p").css("color", new_value);
		});
	});

	/**
	 * Archive Item Title & Post Count Color
	 */
	wp.customize("smartdocs_archive_list_item_title_color", function (value) {
		value.bind(function (new_value) {
			console.log(new_value);
			$(".smartdocs-archive-cat-title").css("color", new_value);
		});
	});

	wp.customize("smartdocs_archive_list_item_post_count_color", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-archive-post-count").css("color", new_value);
		});
	});

	wp.customize("smartdocs_archive_list_item_bg_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-sub-archive-categories-post").css("background", new_value);
		});
	});

	/**
	 * Columns Control for Grid Layout - Start
	 */

	/**
	 * Spacing
	 */
	wp.customize("smartdocs_archive_columns_gap", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-categories").css("gap", new_value + "px");
		});
	});

	/**
	 * Responsive Columns for Grid
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
	 * Columns Control - End
	 */

	wp.customize("smartdocs_archive_list_item_title_font_size", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("font-size", new_value + "px");
		});
	});

	wp.customize("smartdocs_archive_list_item_title_font_size_tablet", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("font-size", new_value + "px");
		});
	});

	wp.customize("smartdocs_archive_list_item_title_font_size_mobile", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("font-size", new_value + "px");
		});
	});

	wp.customize("smartdocs_archive_list_item_title_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-category-title").css("color", new_value);
		});
	});

	/**
	 * Category Description Controls - Start
	 */

	wp.customize("smartdocs_archive_list_item_description_font_size", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-description").css("font-size", new_value + "px");
		});
	});

	wp.customize(
		"smartdocs_archive_list_item_description_font_size_tablet",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-category-description").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize(
		"smartdocs_archive_list_item_description_font_size_mobile",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-category-description").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize("smartdocs_archive_list_item_description_color", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-category-description").css("color", new_value);
		});
	});

	/**
	 * Category Description Controls - End
	 */

	wp.customize("smartdocs_archive_list_item_post_count_font_size", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-posts-info").css("font-size", new_value + "px");
		});
	});

	wp.customize("smartdocs_archive_list_item_title_bg_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-category-info").css("background", new_value);
		});
	});

	wp.customize("smartdocs_archive_list_item_post_info_font_size", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-posts-info").css("font-size", new_value + "px");
		});
	});

	wp.customize(
		"smartdocs_archive_list_item_post_info_font_size_tablet",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-posts-info").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize(
		"smartdocs_archive_list_item_post_info_font_size_mobile",
		function (value) {
			value.bind(function (new_value) {
				$(".smartdocs-posts-info").css("font-size", new_value + "px");
			});
		}
	);

	wp.customize("smartdocs_archive_category_info_text_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-posts-info").css("color", new_value);
		});
	});

	wp.customize("smartdocs_archive_category_info_bg_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-posts-info").css("background-color", new_value);
			$(".smartdocs-posts-info").css("border-top-color", new_value);
		});
	});

	wp.customize("smartdocs_archive_list_item_info_divider_color", function (
		value
	) {
		value.bind(function (new_value) {
			$(".smartdocs-posts-info").css("border-top-color", new_value);
		});
	});

})(jQuery);
