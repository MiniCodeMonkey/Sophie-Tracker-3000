$(function() {
	$('#diaperModal button').fastClick(function () {
		trackEvent($('#diaperModal'), 'Diaper', $(this).data('value'));
		return false;
	});
});