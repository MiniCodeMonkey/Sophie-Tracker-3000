$(function() {
	$('#foodModal .food-types button').fastClick(function () {
		var foodType;

		var refresh = false;
		if ($(this).data('value') == 'Other') {
			foodType = prompt('Enter food name:');
			refresh = true;

			if (!foodType) {
				return false;
			}
		} else {
			foodType = $(this).data('value');
		}

		trackEvent($('#foodModal'), 'Food', foodType, '', refresh);

		return false;
	});
});