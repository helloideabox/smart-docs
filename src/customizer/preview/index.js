(function ($) {
	/* Archive Title Color */
	wp.customize("smartdocs_archive_title_color", function (value) {
		value.bind(function (new_value) {
			$(".sd-archive-post-head").css("color", new_value);
		});
	});

	/**
	 * Archive Item Title & Post Count Color
	 */
	wp.customize("smartdocs_archive_list_item_title_color", function (
		value
	) {
		value.bind(function (new_value) {
			console.log(new_value);
			$(".sd-archive-cat-title").css("color", new_value);
		});
	});

	wp.customize(
		"smartdocs_archive_list_item_post_count_color",
		function (value) {
			value.bind(function (new_value) {
				$(".sd-archive-post-count").css("color", new_value);
			});
		}
	);

	wp.customize("smartdocs_archive_list_item_bg_color", function (
		value
	) {
		value.bind(function (new_value) {
			$(".sd-sub-archive-categories-post").css("background", new_value);
		});
	});
})(jQuery);
