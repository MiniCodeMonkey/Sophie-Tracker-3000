$(function() {
	if ($('#dashboard').length) {
		updateLastEvent();
		setInterval('updateLastEvent()', 1000);
	}
});

function updateLastEvent()
{
	$.get('track/stats', function (response) {
		$('.eventbutton-milk').find('.badge').html(response.milk.time);
		$('.eventbutton-pump').find('.badge').html(response.pump.time);
		$('.eventbutton-diaper').find('.badge').html(response.diaper.time);
		$('.eventbutton-food').find('.badge').html(response.food.time);

		if (response.sleep.type == 'start') {
			if ($('.sleep-items').hasClass('hide')) {
				$('.sleep-items').removeClass('hide');
				$('body, .face.front').animate({ backgroundColor: '#D8D8D8' });
			}
		} else {
			if (!$('.sleep-items').hasClass('hide')) {
				$('.sleep-items').addClass('hide');
				$('body, .face.front').animate({ backgroundColor: '#FFF' });
			}
		}
	});
}