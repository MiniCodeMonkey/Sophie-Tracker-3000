$('#list-button').fastClick(function() {
	if ($('.card').hasClass('flipped')) {
		// Flip back
		$('.card').removeClass('flipped');

		// Clear existing data
		$('.face.back table').html('');

		// Update flip button icon
		$(this).find('i').removeClass('icon-arrow-left').addClass('icon-list');
	} else {
		// Flip
		$('.card').addClass('flipped');

		// Update flip button icon
		$(this).find('i').removeClass('icon-list').addClass('icon-arrow-left');

		// Clear existing data
		$('.face.back table').html('');

		// Fetch list of events
		$.get('/track/list', function (events) {
			$.each(events, function (index, event) {
				var row = $('<tr>');

				var formattedEvent = formatEvent(event);
				row.append($('<td>').html($('<i>').addClass(event.type.icon)).append(' ' + event.type.name));
				row.append($('<td>').html(event.time));
				row.append($('<td>').html(formattedEvent.description));
				row.append($('<td>').html(formattedEvent.value));

				$('.face.back table').append(row);
			});
		});
	}

	return false;
});

function formatEvent(event) {
	var result = {};

	switch (event.type.name) {
		case 'Feed':
			result.description = event.type.name + ' (' + event.subtype + ')';
			result.value = (event.subtype == 'left' || event.subtype == 'right') ? event.value + ' min.' : event.value + ' oz';
			break;

		case 'Pump':
			result.description = 'Pumped ' + event.subtype;
			result.value = event.value + ' oz';
			break;

		case 'Diaper':
			result.description = 'Changed ' + (event.subtype == 'both' ? 'wet and dirty' : event.subtype) + ' diaper';
			result.value = '';
			break;

		case 'Sleep':
			result.description = (event.subtype == 'start') ? 'Started sleeping' : 'Stopped sleeping';
			break;

		case 'Activity':
			result.description = event.subtype + ' activity';
			result.value = event.value + ' min.';
			break;

		case 'Medicine':
		case 'Milestone':
		case 'Note':
			result.description = event.subtype;
			break;

		case 'Bath':
			result.description = 'A nice, refreshing bath';
			break;

		case 'Supplies':
			result.description = event.subtype;
			result.value = event.value + ' items.';
			break;
	}

	// Upper case first letter
	result.description = result.description.charAt(0).toUpperCase() + result.description.substr(1);

	return result;
}