$('#list-button').click(function() {
	if ($('.card').hasClass('flipped')) {
		$('.card').removeClass('flipped');
		$(this).find('i').removeClass('icon-arrow-left').addClass('icon-list');
	} else {
		$('.card').addClass('flipped');

		$(this).find('i').removeClass('icon-list').addClass('icon-arrow-left');

		$('.face.back table').html(''); // Clear existing data
		$.get('/track/list', function (events) {
			$.each(events, function (index, event) {
				var row = $('<tr>');

				var formattedEvent = formatEvent(event);
				row.append($('<td>').html($('<i>').addClass(event.type.icon)));
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

		case 'Diaper':
			result.description = 'Changed ' + (event.subtype == 'both' ? 'wet and dirty' : event.subtype) + ' diaper';
			result.value = '';
			break;

		case 'Pump':
			result.description = 'Pumped ' + event.subtype;
			result.value = event.value + ' oz';
			break;
	}

	return result;
}