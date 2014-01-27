$(function() {
	$('#medicineModal .medicine-types button').fastClick(function () {
		var medicineType;

		var refresh = false;
		if ($(this).data('value') == 'Other') {
			medicineType = prompt('Enter name:');
			refresh = true;

			if (!medicineType) {
				return false;
			}
		} else {
			medicineType = $(this).data('value');
		}

		trackEvent($('#medicineModal'), 'Medicine', medicineType, '', refresh);

		return false;
	});
});