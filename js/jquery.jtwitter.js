/*
 * jTwitter 1.1.1 - Twitter API abstraction plugin for jQuery
 *
 * Copyright (c) 2009 jQuery Howto
 *
 * Licensed under the GPL license:
 *   http://www.gnu.org/licenses/gpl.html
 *
 * URL:
 *   http://jquery-howto.blogspot.com
 *
 * Author URL:
 *   http://jquery-howto.blogspot.com
 *
 */
(function( $ ){
	$.extend( {
		jTwitter: function( username, numPosts, hashtag,  fnk ) {
			var info = {};
			
			// If no arguments are sent or only username is set
			if( username == 'undefined' || numPosts == 'undefined' ) {
				return;
			} else if( $.isFunction( numPosts ) ) {
				// If only username and callback function is set
				fnk = numPosts;
				numPosts = 5;
			}
			
			if(hashtag == 'status'){
				var url = "http://search.twitter.com/search.json?q=+from%3Ascarlenn";
			}
			if( hashtag == 'update'){
				var url = "http://search.twitter.com/search.json?q=+from%3Ascarlenn";
			}
			if( hashtag == 'geen'){
				var url = "http://search.twitter.com/search.json?q=+from%3Ascarlenn";
			}
			
			$.ajax({
  				url: url,
  				dataType: "jsonp",
  				success: function(data){
				if( $.isFunction( fnk ) ) {
					fnk.call( this, data );
				}
				}
			});
			
			/*$.getJSON( url, function( data ){
				if( $.isFunction( fnk ) ) {
					fnk.call( this, data );
				}
			});*/
		}
	});
})( jQuery );