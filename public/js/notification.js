function showNotification(name, error) {
	error = error || false;

	var selector = error ? '#error-notification' : '#success-notification';

	// Set notification name
	$(selector + ' .event-type').html(name);

	// Set default CSS, show and animate down
	$(selector)
		.stop()
		.css('top', '-500px')
		.show()
		.animate({ top: '0px' })
		.delay(8000) // Hide after 8 seconds
		.animate({ top: '-500px' });
}