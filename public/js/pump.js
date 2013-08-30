$(function() {
	var pumpType;

	$('#pumpModal').on('hidden.bs.modal', function () {
		// Reset all button states
		$('#pumpModal .pump-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Hide all sub options
		$('#pumpModal .pump-options').addClass('hide');
	});

	$('#pumpModal .pump-types button').click(function () {
		// Reset all button states
		$('#pumpModal .pump-types button')
			.removeClass('btn-primary')
			.removeClass('btn-info')
			.addClass('btn-info');

		// Make this button primary
		$(this).removeClass('btn-info').addClass('btn-primary');

		$('#pumpModal .pump-options').removeClass('hide');

		pumpType = $(this).data('value');

		return false;
	});

	$('#pumpModal .pump-options button').click(function () {
		trackEvent($('#pumpModal'), 'Pump', pumpType, $(this).data('value'));
		return false;
	});
});