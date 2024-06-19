//snippet from stackoverflow to prevent auto submission of form after refresh
if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}