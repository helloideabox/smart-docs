;(function($) {

	var initSearch = function() {
		if ( $( '.smartdocs-search-form' ).length === 0 ) {
			return;
		}

		var lastValue = '';
		var timeout = null;

		$( '.smartdocs-search-form' ).on( 'submit', function( e ) {
			e.preventDefault();
		} );

		$( '.smartdocs-search-form input.smartdocs-search-input' ).on( 'keyup', function() {
			// Disable our AJAX search when the search form is associated with SearchWP live.
			if ( $(this).data( 'swp-live' ) ) {
				return;
			}

			var $input = $(this);

			if ( $input.val().length >= 3 && $input.val() !== lastValue ) {
				$input.addClass( 'loading' );
				var query = $input.val();
				if ( timeout ) {
					clearTimeout( timeout );
				}
				timeout = setTimeout( function() {
					$.post(
						smartdocs.ajaxurl,
						{
							query: query,
							nonce: smartdocs.nonce,
							action: 'smartdocs_search_results'
						},
						function( response ) {
							if ( response.success ) {
								$input.removeClass( 'loading' );
								$input.parent().find( '.smartdocs-search-result' ).remove();
								$input.parent().append( $( response.data ) );
							}
						}
					);
				}, 250 );
				lastValue = query;
			}
		} ).on( 'focus click', function() {
			var $input = $(this);
			if ( '' !== $input.val() ) {
				if ( $input.parent().find( '.smartdocs-search-result' ).length === 0 ) {
					$input.trigger( 'keyup' );
				} else {
					setTimeout( function() {
						$input.parent().find( '.smartdocs-search-result' ).show();
					}, 10 );
				}
			}
		} );

		$( document ).on( 'click', function(e) {
			if ( $( e.target ).parents( '.smartdocs-search' ).length === 0 ) {
				$( '.smartdocs-search-result' ).hide();
			}
		} );
	};

	var initFeedback = function() {
		$( '.smartdocs-doc-feedback' ).on( 'click', 'a[data-id]', function(e) {
			e.preventDefault();

			var $wrapper = $( e.delegateTarget ),
				$this = $( this );

			$this.addClass( 'disabled' );

			$.post(
				smartdocs.ajaxurl,
				{
					nonce: smartdocs.feedback_nonce,
					action: 'smartdocs_doc_feedback',
					post_id: $this.data( 'id' ),
					type: $this.hasClass( 'doc-upvote' ) ? 'upvote' : 'downvote'
				},
				function( response ) {
					$this.removeClass( 'disabled' );
					if ( ! response.success && '' !== response.data ) {
						$wrapper.html( '<div class="doc-feedback-failed">' + response.data + '</div>' );
					}
					if ( response.success && '' !== response.data ) {
						$wrapper.html( '<div class="doc-feedback-success">' + response.data + '</div>' );
					}
				}
			);
		} );
	};

	var initCopyLink = function () {

		if ( 0 === $('.smartdocs-copy-link').length ) {
			return;
		}

		$('.smartdocs-copy-link').on('click', function (e) {

			e.preventDefault();
			var copyText = $(this).data('clipboard-text');

			document.addEventListener('copy', function (e) {
				e.clipboardData.setData('text/plain', copyText);
				e.preventDefault();
			}, true);

			try {
				document.execCommand('copy');

				var tooltip = $(this).append('<div class="smartdocs-tooltip ">Copied</div>');

				$(this).children('.smartdocs-tooltip').fadeOut(
					1000,
					function () {
						$(this).remove();
					}
				);
			}
			catch (e) {
				console.log("Error in copying link. Please check the error below for reference");
				console.log(e);
			}
		});
	}

	$( document ).ready( function() {
		initSearch();
		initFeedback();
		initCopyLink();
	} );

})(jQuery);
