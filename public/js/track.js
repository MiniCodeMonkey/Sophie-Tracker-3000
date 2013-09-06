function trackEvent(activeModal, type, subtype, value)
{
	type = type || '';
	subtype = subtype || '';
	value = value || '';

	if (activeModal) {
		// Create and add loading indicator
		var spinner = $('<i>')
			.addClass('icon-spinner')
			.addClass('icon-spin')
			.addClass('icon-2x');

			activeModal.find('.modal-body').append(spinner);
	}

	// Perform AJAX request
	$.post('track/new', {
		type: type,
		subtype: subtype,
		value: value
	}, function (response) {
		// Remove loading indicator
		if (spinner)
			spinner.remove();

		// Show response
		if (response.success && response.success == true) {
			showNotification(response.event);
			
			if (activeModal)
				activeModal.modal('hide');
			
			updateLastEvent(); // Update the last feed/pump/diaper stats
		} else {
			showNotification(type, true);
		}
	});
}

function deleteEvent(eventId)
{
	// Perform AJAX request
	$.post('track/delete', {
		id: eventId
	}, function (response) {
		// Show response
		if (response.success && response.success == true) {
			showNotification(response.event);
			
			updateLastEvent(); // Update the last feed/pump/diaper stats
		} else {
			showNotification(type, true);
		}
	});
}