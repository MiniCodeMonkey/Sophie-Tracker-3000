$(function () {
	$('.spinner .spinner-left').click(function () {
		var currentValue = $(this).parent().data('value');
		var step = $(this).parent().data('step');

		var newValue = currentValue -= step;

		if (newValue > 0) {
			$(this).parent().data('value', newValue);
			$(this).parent().find('.amount').html(formatDecimal(newValue));
		}
	});

	$('.spinner .spinner-right').click(function () {
		var currentValue = $(this).parent().data('value');
		var step = $(this).parent().data('step');

		var newValue = currentValue += step;

		$(this).parent().data('value', newValue);
		$(this).parent().find('.amount').html(formatDecimal(newValue));
	});
});

function formatDecimal(value) {
	var integerPart = Math.floor(value);
	var decimalPart = value - integerPart;

	if (decimalPart == 0.25) {
		return integerPart + '&frac14;';
	} else if (decimalPart == 0.5) {
		return integerPart + '&frac12;';
	} else if (decimalPart == 0.75) {
		return integerPart + '&frac13;';
	} else {
		return value;
	}
}