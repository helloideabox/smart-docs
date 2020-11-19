jQuery(function ($) {

	$('body').on('click', '#upload_taxonomy_thumbnail_button', function (e) {
		e.preventDefault();

		var button = $(this),
			pp_uploader = wp.media({
				title: 'Select Image',
				library: {
					uploadedTo: wp.media.view.settings.post.id,
					type: 'image'
				},
				multiple: false
			}).on('select', function () {
				var attachment = pp_uploader.state().get('selection').first().toJSON();
				$('#taxonomy_thumbnail_id').val(attachment.id);
				if (attachment.url.toString().length > 0) {
					$('#taxonomy_thumbnail_preview').html('<img id="taxonomy_thumbnail_preview_img" src="' + attachment.url + '" width="150" height="150">');
					$("#delete_taxonomy_thumbnail_button").css('display', 'inline-block');
				}
			})
				.open();
	});

	$('body').on('click', '#delete_taxonomy_thumbnail_button', function (e) {
		e.preventDefault();
		$('#taxonomy_thumbnail_id').val('');
		$('#taxonomy_thumbnail_preview').html('');
		$(this).css('display', 'none');
	});

	$('form#addtag #submit').on('click', function (e) {
		$('#taxonomy_thumbnail_preview').html('');
		$('#delete_taxonomy_thumbnail_button').css('display', 'none');
		setTimeout(function () { $('#taxonomy_thumbnail_id').val(''); }, 5000);
	});
});