$(function() {
	var suppliesType;

	$('#suppliesModal').on('hidden.bs.modal', function () {
		// Remove temporary buttons
		$('#suppliesModal .supplies-types button.temporary').remove();

		// Reset all button states
		$('#suppliesModal .supplies-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Hide all sub options
		$('#suppliesModal .supplies-options').addClass('hide');
	});

	$('#suppliesModal .supplies-types button').fastClick(function () {
		// Reset all button states
		$('#suppliesModal .supplies-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		if ($(this).data('value') == 'other') {
			// Prompt for supplies name
			var name = prompt('Enter name:');

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

			// Store supplies type
			suppliesType = name;
		} else {
			// Make this button primary
			$(this).removeClass('btn-info').addClass('btn-primary');

			// Store supplies type
			suppliesType = $(this).data('value');
		}

		// Show secondary options
		$('#suppliesModal .supplies-options').removeClass('hide');

		return false;
	});

	$('#suppliesModal button.save').fastClick(function () {
		trackEvent($('#suppliesModal'), 'Supplies', suppliesType, $(this).parent().find('.spinner').data('value'));
		return false;
	});
});