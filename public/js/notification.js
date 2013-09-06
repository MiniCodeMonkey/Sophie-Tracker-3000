function showNotification(event, error) {
	error = error || false;

	var formattedEvent = formatEvent(event);
	var selector = error ? '#error-notification' : '#success-notification';

	if (!error) {
		if (event.reverted) {
			$(selector + ' .lead strong').html('Reverted:');
			$(selector + ' .undo').hide();
			$(selector).removeClass('alert-info')
				.addClass('alert-warning');
		} else {
			$(selector + ' .lead strong').html('Saved:');
			$(selector + ' .undo').show();
			$(selector).removeClass('alert-warning')
				.addClass('alert-info');
		}
	}

	// Set notification name
	$(selector + ' .event-type').html(formattedEvent.description);

	// Set event id
	$(selector).data('event-id', event.id);

	// Set default CSS, show and animate down
	$(selector)
		.stop()
		.css('top', '-500px')
		.show()
		.animate({ top: '0px' })
		.delay(8000) // Hide after 8 seconds
		.animate({ top: '-500px' });
}

$('#success-notification .undo').fastClick(function () {
	deleteEvent($('#success-notification').data('event-id'));

	return false;
});

$('#detailsModal button.save').fastClick(function () {
	updateEvent($('#success-notification').data('event-id'), $(this).parent().find('.spinner').data('value'));
	$('#detailsModal').modal('hide');
	
	return false;
});