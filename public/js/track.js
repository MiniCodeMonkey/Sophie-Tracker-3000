function trackEvent(activeModal, type, subtype, value)
{
	// Create and add loading indicator
	var spinner = $('<i>')
		.addClass('icon-spinner')
		.addClass('icon-spin')
		.addClass('icon-2x');
	activeModal.find('.modal-body').append(spinner);

	// Perform AJAX request
	$.post('track/new', {
		type: type,
		subtype: subtype,
		value: value
	}, function (response) {
		// Remove loading indicator
		spinner.remove();

		// Show response
		if (response.success && response.success == true) {
			showNotification(type);
			activeModal.modal('hide');
			updateLastEvent(); // Update the last feed/pump/diaper stats
		} else {
			showNotification(type, true);
		}
	});
}