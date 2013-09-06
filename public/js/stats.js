$(function() {
	var first = true;
	// Only activate on the stats page
	if (!$('body#stats').length)
		return;

	$(".gridster ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [250, 250]
    });

    // Update stats by polling for updates
    updateStats();
    setInterval('updateStats()', 15000);
});

function updateStats()
{
	$.get('stats/update', function (data) {
		// Profile
		$('.profile-age').html(data.profile.age + ' old');
		$('.profile-hygiene').css('width', (data.profile.attributes.hygiene * 100.0) + '%');
		$('.profile-hunger').css('width', (data.profile.attributes.hunger * 100.0) + '%');
		$('.profile-bladder').css('width', (data.profile.attributes.bladder * 100.0) + '%');
		$('.profile-energy').css('width', (data.profile.attributes.energy * 100.0) + '%');

		if (data.profile.sleeping) {
			$('.box-profile .sleep-items').removeClass('hide');
			$('.profile-age').append('<span>Sleeping (ssh!)</span>');
			$('.profile-energy').parent().addClass('active');
		} else {
			$('.box-profile .sleep-items').addClass('hide');
			$('.profile-energy').parent().removeClass('active');
		}

		// Diaper graph
		var ctx = $("#diaperchart").get(0).getContext("2d");
		var options = {
			scaleOverride: true,
			scaleSteps: 10,
			scaleStepWidth: 2,
			scaleStartValue: 0,
			scaleLabel: "<%=value%>",
			scaleFontColor: "#FFF",
			pointDotRadius: 3,
			datasetStrokeWidth: 1,
			animation: first
		};
		var diaperchart = new Chart(ctx).Line(data.diaper_graph, options);

		// Diaper stats
		$('.diapers-available').html(data.diaper_stats.available);
		$('.diapers-run-out-days').html(data.diaper_stats.run_out.days + '<span>days</span>');
		$('.diapers-run-out-date').html(data.diaper_stats.run_out.date);
		$('.diapers-average').html(Math.round(data.diaper_stats.used_per_day * 10) / 10);

		// Last fed
		$('.last-fed-icon').removeClass()
			.addClass('last-fed-icon')
			.addClass(data.last_fed.icon);


		$('.last-fed-time').html(data.last_fed.formatted_time.replace(' and', ', '));

		var amount = '';
		if (data.last_fed.type == 'left' || data.last_fed.type == 'right') {
			amount = data.last_fed.value + '<span>min.</span>';
		} else {
			amount = data.last_fed.value + '<span>oz.</span>';
		}
		$('.last-fed-amount').html(amount);

		// Projected time until next feeding
		$('.feed-time-next').html(data.feed_time.next_feed_formatted);

		// Day chart
		$.each(data.day_chart, function (index, event) {
			var colorName = null;
			switch (event.type) {
				case 'Feed':
					colorName = 'info';
					break;

				case 'Diaper':
					colorName = 'success';
					break;
					
				case 'Sleep':
					colorName = 'warning';
					break;
					
				case 'Activity':
					colorName = 'warning';
					break;
					
				case 'Medicine':
					colorName = 'danger';
					break;
					
				case 'Bath':
					colorName = 'info';
					break;
					
			}

			if (colorName != null) {
				var bar = $('<div>')
					.addClass('progress-bar')
					.addClass('progress-bar-' + colorName)
					.css('width', (event.width * 100.0) + '%')
					.css('left', (event.time_percent * 100.0) + '%')
					.data('event', event);

				bar.fastClick(function() {
					var event = $(this).data('event');
					var formattedEvent = formatEvent(event);
					$('.box-day-chart .chart-description').html('<strong>' + event.time + '</strong>');

					var description = (formattedEvent.description == 'Started sleeping' ? 'Sleeping' : formattedEvent.description);

					$('.box-day-chart .chart-description').append(description);

					if (formattedEvent.value) {
						$('.box-day-chart .chart-description').append('&mdash; ' + formattedEvent.value)
					}
				});

				$('.box-day-chart .progress').append(bar);
			}
		});
	});

	first = false;
}