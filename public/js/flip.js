$('#list-button').click(function(){
	$('.card').addClass('flipped').mouseleave(function() {
		$(this).removeClass('flipped');
	});

	return false;
});