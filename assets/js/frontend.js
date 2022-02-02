;(function($) {

	var initSearch = function() {
		if ( $( '.smartdocs-search-form' ).length === 0 ) {
			return;
		}

		var lastValue = '',
			timeout = null,
			subtypes = [],
			searchUrl = '';

		smartdocs.search_subtypes.forEach(function(type) {
			if ( 'undefined' !== typeof type ) {
				subtypes.push( 'subtype[]=' + type );
			}
		});

		searchUrl = smartdocs.resturl + 'wp/v2/search?' + subtypes.join('&') + '&per_page=' + smartdocs.search_perpage + '&orderby=relevance&order=asc';

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
				var url = searchUrl + '&search=' + query;
				if ( timeout ) {
					clearTimeout( timeout );
				}
				timeout = setTimeout( function() {
					var result = $.getJSON( url, function( response ) {
						$input.removeClass( 'loading' );
						$input.parent().removeClass( 'smartdocs-no-result' );
						$input.parent().find( '.smartdocs-search-result' ).remove();
						$input.parent().append( $('<ul class="smartdocs-search-result" />') );

						if ( response.length > 0 ) {
							response.forEach(function(item) {
								if ( 'undefined' !== typeof item ) {
									var $item = '<li><a href="' + item.url + '" rel="bookmark">' + item.title + '</a></li>';
									$input.parent().find( '.smartdocs-search-result' ).append( $item );
								}
							});
						} else {
							$input.parent().addClass( 'smartdocs-no-result' );

							var $item = '<li>' + smartdocs.search_no_result + '</li>';
							$input.parent().find( '.smartdocs-search-result' ).append( $item );
						}
					} )
						.fail( function( xhr ) {
							$input.removeClass( 'loading' );
							$input.parent().find( '.smartdocs-search-result' ).remove();
						} );

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

	var initToc = function() {
		if ( $( '.smartdocs-toc' ).length === 0 ) {
			return;
		}

		$('.smartdocs-toc.toc-collapsible .smartdocs-toc-title').on('click', function() {
			$('.smartdocs-toc-anchors').slideToggle();
			$('.smartdocs-toc-open').toggleClass('toc-opened')
			$('.smartdocs-toc-close').toggleClass('toc-closed');
		});
	}

	$( document ).ready( function() {
		initSearch();
		initFeedback();
		initToc();
	} );

})(jQuery);
