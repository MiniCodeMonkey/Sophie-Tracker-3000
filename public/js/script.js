// Hide address bar on mobile devices
function hideAddressBar()
{
	if (!window.location.hash)
	{
		if (document.height < window.outerHeight)
		{
			document.body.style.height = (window.outerHeight + 50) + 'px';
		}

		setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
	}
}

window.addEventListener("load", function() { if (!window.pageYOffset) { hideAddressBar(); } });
window.addEventListener("orientationchange", hideAddressBar );