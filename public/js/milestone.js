$(function() {
	$('#milestoneModal button.save').fastClick(function () {
		var description = $('#milestoneModal textarea').val();

		if (description.length <= 0) {
			alert('Please enter a description');
			return false;
		} else if (description.length > 255) {
			alert('Max 255 characters, sorry!');
			return false;
		}

		trackEvent($('#milestoneModal'), 'Milestone', description);
		return false;
	});
});