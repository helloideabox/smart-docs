;(function($) {

	$( document ).ready( function() {
		if ( $( '.smartdocs-search' ).length ) {
			var lastValue = '';
			var timeout = null;
			$( '.smartdocs-search input.smartdocs-search-input' ).on( 'keyup', function() {
				var $input = $(this);
				if ( '' === $input.val() ) {
					//$input.parent().find( '.smartdocs-search-result' ).remove();
				}
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
		}
	} );

})(jQuery);
