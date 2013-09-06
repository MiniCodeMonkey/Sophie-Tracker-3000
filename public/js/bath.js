$(function() {
	$('.eventbutton-bath').fastClick(function () {
		trackEvent(null, 'Bath');
		return false;
	});
});