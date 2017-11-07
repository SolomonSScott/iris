import 'jquery';

// Handle Menu toggle
const $navToggle = $( '.navbar-burger' );

$navToggle.on( 'click', function ( e ) {
	e.preventDefault();
	$( this ).toggleClass( 'is-active' );
	const $target = $( this ).data( 'target' );
	$( '#' + $target ).toggleClass( 'is-active' );
} );
