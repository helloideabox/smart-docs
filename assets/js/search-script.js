/**
 * This document is for sending the data to the server and then recieving the response
 * from it.
 * 
 * It also has the loading spinner and timeout function to look for the user
 * to wait for sometime after typing and during that time spinner is loaded
 * and then dissapears.
 */
;(function($) {
	$( document ).ready( function() {
		// Init a timeout variable to be used below
		var timeout = null;
		var data;
		var search = $( '#sd-sq' );
		var lastValue = ''

		$( '#sd-sq' ).on( 'focus keyup click', function() {
			
			setTimeout( function() {
				if ( search.val() ){
					if( lastValue != search.val() ){
						// Clear the timeout if it has already been set.
						// This will prevent the previous task from executing
						// if it has been less than <MILLISECONDS>
						clearTimeout(timeout);

						

						$( '.sd-spinner' ).css( 'display', 'block' );

						// Send data to server. 
						data = 'action=sd_load_search_results&query=' + search.val() + '&security=' + sd_ajax_url.ajax_nonce;

						timeout = setTimeout( function(){
							// Ajax request.
							$.post( sd_ajax_url.url, data, function( response ) {
								$( '.sd-spinner' ).css( 'display', 'none' );
								$( '#sd-live-search' ).css( 'display', 'block' );
								$( '#sd-live-search' ).html( response );
							} );
						}, 300 );
						lastValue = search.val();
					}
				} else {
					$( '#sd-live-search' ).html('');
				}
			}, 100 );
		} );
	} );

	/**
	 * This documeent for creating the container for the search results to render
	 * in the body and align according to the seach box.
	 * 
	 * Also it dissapears the search results when clicked anywhere outside the
	 * search container.
	 */
	$( document ).ready( function() {
		$( '.sd-search-form' ).append( '<div id="sd-live-search"></div>');

		$( document ).on( 'click', function( e ) {
			if( e.target.className === 'sd-search-list' || e.target.className === 'sd-search-field' ) {
				$( '#sd-live-search' ).css( 'display', 'block' );
			} else {
				$( '#sd-live-search' ).css( 'display', 'none' );
			}
		} );
	} );

})(jQuery);
