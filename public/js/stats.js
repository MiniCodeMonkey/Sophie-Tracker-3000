$(document).ready(function() {
	$(".gridster ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [250, 250]
    });

	$.get('stats/diaper', function (data) {
		var ctx = $("#diaperchart").get(0).getContext("2d");

		var options = {
			scaleOverride: true,
			scaleSteps: 10,
			scaleStepWidth: 2,
			scaleStartValue: 0,
			scaleLabel: "<%=value%>",
			scaleFontColor: "#FFF"
		};
		var diaperchart = new Chart(ctx).Line(data, options);
	});
});