$(function() {
	var feedType;

	$('#milkModal').on('hidden.bs.modal', function () {
		// Reset all button states
		$('#milkModal .feed-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Hide all sub options
		$('#milkModal .bottle-options').addClass('hide');
		$('#milkModal .time-options').addClass('hide');
	});

	$('#milkModal .feed-types button').fastClick(function () {
		// Reset all button states
		$('#milkModal .feed-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Make this button primary
		$(this).removeClass('btn-info').addClass('btn-primary');

		if ($(this).data('value') == 'left' || $(this).data('value') == 'right') {
			$('#milkModal .time-options').removeClass('hide');
			$('#milkModal .bottle-options').addClass('hide');
		} else {
			$('#milkModal .bottle-options').removeClass('hide');
			$('#milkModal .time-options').addClass('hide');
		}

		feedType = $(this).data('value');

		return false;
	});

	$('#milkModal button.save').fastClick(function () {
		trackEvent($('#milkModal'), 'Milk', feedType, $(this).parent().find('.spinner').data('value'));
		return false;
	});
});