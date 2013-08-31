$(function() {
	updateStats();
	setInterval('updateStats()', 1000 * 60);
});

function updateStats()
{
	$.get('track/stats', function (response) {
		$('.eventbutton-feed').find('.badge').html(response.feed.time);
		$('.eventbutton-pump').find('.badge').html(response.pump.time);
		$('.eventbutton-diaper').find('.badge').html(response.diaper.time);
	});
}