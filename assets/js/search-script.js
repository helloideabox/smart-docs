/**
 * This document is for sending the data to the server and then recieving the response
 * from it.
 * 
 * It also has the loading spinner and timeout function to look for the user
 * to wait for sometime after typing and during that time spinner is loaded
 * and then dissapears.
 */

jQuery( document ).ready( function() {
	// Init a timeout variable to be used below
	let timeout = null;
	var data;
	var search = jQuery( '#ed-sq' );
	var lastValue = '';

	jQuery( '#ed-sq' ).on( 'focus keyup', function() {
		console.log( search.val() );
		if ( search.val() ){
			if( lastValue != search.val() ){
			setTimeout( function() {
				// Clear the timeout if it has already been set.
				// This will prevent the previous task from executing
				// if it has been less than <MILLISECONDS>
				clearTimeout(timeout);

				jQuery( '.ed-spinner' ).css( 'display', 'block' );

				// Send data to server. 
				data = 'action=ed_load_search_results&query=' + search.val() + '&security=' + ed_ajax_url.ajax_nonce;

				timeout = setTimeout( function(){
					// Ajax request.
					jQuery.post( ed_ajax_url.url, data, function( response ) {
						jQuery( '.ed-spinner' ).css( 'display', 'none' );
						jQuery( '#jQuery-live-search' ).css( 'display', 'block' );
						jQuery( '#jQuery-live-search' ).html( response );
					} );
				}, 200 );

				lastValue = search.val();
			}, 400 );
			}
		} else {
			jQuery( '#jQuery-live-search' ).css( 'display', 'none' );
		}
	} );
} );



/**
 * This documeent for creating the container for the search results to render
 * in the body and align according to the seach box.
 * 
 * Also it dissapears the search results when clicked anywhere outside the
 * search container.
 */
jQuery( document ).ready( function() {
	jQuery( '.ed-search-form' ).append( '<div id="jQuery-live-search"></div>');
	jQuery( '#jQuery-live-search' ).css({
		'display' : 'none',
		'width'  : '943px',
		'position' : 'absolute',
	});

	jQuery( document ).on( 'click', function( e ) {
		if( e.target.className === 'ed-search-list' || e.target.className === 'ed-search-field' ) {
			jQuery( '#jQuery-live-search' ).css( 'display', 'block' );
		} else {
			jQuery( '#jQuery-live-search' ).css( 'display', 'none' );
		}
	} );
} );