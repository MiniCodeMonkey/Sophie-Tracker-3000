$(document).ready(function() {
	$(".gridster ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [250, 250]
    });

	$.get('stats/update', function (data) {
		// Profile
		$('.profile-age').html(data.profile.age + ' old');

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
			datasetStrokeWidth: 1
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
		$('.last-fed-type').html(data.last_fed.type);

		// Projected time until next feeding
		$('.feed-time-next').html(data.feed_time.next_feed_formatted);
	});
});