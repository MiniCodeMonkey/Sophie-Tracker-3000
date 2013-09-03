$(document).ready(function() {
	$.get('stats/diaper', function (data) {
		var ctx = $("#diaperchart").get(0).getContext("2d");
		var diaperchart = new Chart(ctx).Line(data);
	});
});