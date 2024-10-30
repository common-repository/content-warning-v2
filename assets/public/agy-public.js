jQuery( document ).ready( function( $ ) {

	/* show or hide box if cookie set */
	if ( 'accepted' !== Cookies.get('agy') || 'on' === options.is_debug ) {
		$( '.agy' ).css( 'display', 'table' );
		$( '.overlay-verify' ).css( 'display', 'block' );
	} else {
		$( options.blur_container ).css('filter', 'blur(0px)');
	}

	/* exit button */
	$( '#agy-exit' ).on( 'click',function() {
			window.location.href = options.exit_url;
	} );

	/* age verification modes */

	/* yes or no */
	if ( 'age-submit' == options.display_mode ) {
		$( '#agy-accept' ).on( 'click',function() {
			$( '.agy' ).hide();
			$( '.overlay-verify' ).hide();
			/* set cookie */
			if( 'on' !== options.is_debug ) {
				Cookies.set('agy', 'accepted', { expires: parseInt( options.cookie_lifetime ) });
			}
			/* remove blur */
			$( options.blur_container ).css('filter', 'blur(0px)');
		} );
	}

	/* date selection */
	if ( 'age-select' == options.display_mode ) {
		$( '#age-check' ).on( 'click', ( function() {

			var day    = $( '#agy-day' ).val();
			var month  = $( '#agy-month' ).val();
			var year   = $( '#agy-year' ).val();
			var age    = options.age;
			var mydate = new Date();

			mydate.setFullYear( year, month - 1, day);

			var currdate = new Date();

			currdate.setFullYear( currdate.getFullYear() - age );

			/* check if selection is empty */
			if( '' == day || '' == month  ||'' == year ) {
				$( '.age-message' ).html( '<p>' + options.error_message + '</p>' );
				return false;
			}
		
			/* check if date is valid */
			if ( ( currdate - mydate ) < 0 )  {
				$( '.age-message' ).html( '<p>' + options.error_message + '</p>' );
				return false;
			}

			$( '.agy' ).hide();
			$( '.overlay-verify' ).hide();
			/* set cookie */
			if( 'on' !== options.is_debug ) {
				Cookies.set('agy', 'accepted', { expires: parseInt( options.cookie_lifetime ) });
			}
			/* remove blur */
			$( options.blur_container ).css('filter', 'blur(0px)');
		
		} ) );
	}

	/* range slider */
	if ( 'age-slider' == options.display_mode ) {
		
		var rangeSlider = function(){
			var slider = $('.range-slider'),
				range = $('.range-slider__range'),
				value = $('.range-slider__value');
				
			slider.each(function(){
				value.each(function(){
				var value = $(this).prev().attr('value');
				$(this).html(value);
				});

				range.on('input', function(){
				$(this).next(value).html(this.value);
				});
			});
		};

		rangeSlider();

		$( '#age-check' ).on( 'click', ( function() {
				var age = $('#rangeslider').val();
		
				if( options.age <= age ) {
					$( '.agy' ).hide();
					$( '.overlay-verify' ).hide();
					/* set cookie */
					if( 'on' !== options.is_debug ) {
						Cookies.set('agy', 'accepted', { expires: parseInt( options.cookie_lifetime ) });
					}
					/* remove blur */
					$( options.blur_container ).css('filter', 'blur(0px)');
				} else {
					$( '.age-message' ).html( '<p>' + options.error_message + '</p>' );
				}
			})
		);
	}

	/* check if IE */
	if( navigator.userAgent.indexOf('MSIE')!==-1 || navigator.appVersion.indexOf('Trident/') > 0 ) {
		$('.agy .box').css('width','100%');
		$('.agy .box').css('height','55%');
		$('.agy .box').css('display','block');
	}
} );
