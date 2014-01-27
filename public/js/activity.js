$(function() {
	var activityType;

	$('#activityModal').on('hidden.bs.modal', function () {
		// Remove temporary buttons
		$('#activityModal .activity-types button.temporary').remove();

		// Reset all button states
		$('#activityModal .activity-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Hide all sub options
		$('#activityModal .activity-options').addClass('hide');
	});

	$('#activityModal .activity-types button').fastClick(function () {
		// Reset all button states
		$('#activityModal .activity-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');
			
		if ($(this).data('value') == 'Other') {
			// Prompt for activity name
			var name = prompt('Enter activity name:');

			if (!name) {
				return false;
			}

			// Create button
			var button = $('<button>').attr('type', 'button')
				.addClass('btn')
				.addClass('btn-lg')
				.addClass('btn-primary')
				.addClass('temporary')
				.data('value', name)
				.html('<i class="icon-star"></i> ' + name);

			// Add button to the DOM
			button.insertBefore($(this));

			// Store activity type
			activityType = name;
		} else {
			// Make this button primary
			$(this).removeClass('btn-info').addClass('btn-primary');

			// Store activity type
			activityType = $(this).data('value');
		}

		// Show secondary options
		$('#activityModal .activity-options').removeClass('hide');

		return false;
	});

	$('#activityModal button.save').fastClick(function () {
		trackEvent($('#activityModal'), 'Activity', activityType, $(this).parent().find('.spinner').data('value'));
		return false;
	});
});