$(function() {
	$('#medicineModal .medicine-types button').fastClick(function () {
		var medicineType;

		if ($(this).data('value') == 'Other') {
			medicineType = prompt('Enter name:');
		} else {
			medicineType = $(this).data('value');
		}

		trackEvent($('#medicineModal'), 'Medicine', medicineType);

		return false;
	});

	$('#medicineModal button.save').fastClick(function () {
		trackEvent($('#medicineModal'), 'Medicine', medicineType);
		return false;
	});
});