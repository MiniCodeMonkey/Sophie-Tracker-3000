$(function() {
	$('#noteModal button.save').fastClick(function () {
		var description = $('#noteModal textarea').val();

		if (description.length <= 0) {
			alert('Please enter a note');
			return false;
		} else if (description.length > 255) {
			alert('Max 255 characters, sorry!');
			return false;
		}

		trackEvent($('#noteModal'), 'Note', description);
		return false;
	});
});