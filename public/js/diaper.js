$(function() {
	$('#diaperModal button').click(function () {
		trackEvent($('#diaperModal'), 'Diaper', $(this).data('value'));
		return false;
	});
});