import 'jquery';

const IrisNav = (function() {
	'use strict';

	let primaryNav;

	// Handle Primary Menu toggle
	primaryNav = function() {
		const $navToggle = $( '.navbar-burger' );

		$navToggle.on( 'click', function ( e ) {
			e.preventDefault();
			$( this ).toggleClass( 'is-active' );
			const $target = $( this ).data( 'target' );
			$( '#' + $target ).toggleClass( 'is-active' );
		} );
	};

	return {
		primaryNav: primaryNav
	};
})();

IrisNav.primaryNav();
