$(function() {
	$('.eventbutton-sleep').fastClick(function () {
		trackEvent(null, 'Sleep');
		return false;
	});
});