$(function() {
	var feedType;

	$('#feedModal').on('hidden.bs.modal', function () {
		// Reset all button states
		$('#feedModal .feed-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Hide all sub options
		$('#feedModal .bottle-options').addClass('hide');
		$('#feedModal .time-options').addClass('hide');
	});

	$('#feedModal .feed-types button').click(function () {
		// Reset all button states
		$('#feedModal .feed-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Make this button primary
		$(this).removeClass('btn-info').addClass('btn-primary');

		if ($(this).data('value') == 'left' || $(this).data('value') == 'right') {
			$('#feedModal .time-options').removeClass('hide');
			$('#feedModal .bottle-options').addClass('hide');
		} else {
			$('#feedModal .bottle-options').removeClass('hide');
			$('#feedModal .time-options').addClass('hide');
		}

		feedType = $(this).data('value');

		return false;
	});

	$('#feedModal button.save').click(function () {
		trackEvent($('#feedModal'), 'Feed', feedType, $(this).parent().find('.spinner').data('value'));
		return false;
	});
});