(function ($) {
	/**
	 * Hero Section
	 */
	wp.customize("smartdocs_archive_hero_background_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-inner").css("background-color", new_value);
		});
	});

	/* Archive Title Color */
	wp.customize("smartdocs_archive_title_color", function (value) {
		value.bind(function (new_value) {
			$(".smartdocs-docs-archive-title").css("color", new_value);
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

	wp.customize("smartdocs_archive_columns_gap", function (value) {
		value.bind(function (new_value) {
			console.log(new_value);
			$(".smartdocs-archive-categories").css("gap", new_value + "px");
		});
	});
})(jQuery);
