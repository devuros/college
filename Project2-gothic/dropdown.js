$(document).ready(function()
{
	$('#links li ul').css
	({
		display:"none",
		left:"auto"
	});
	$('#links li').hover(function()
	{
		$(this)
			.find('ul')
			.stop(true, true)
			.slideDown('fast');	
	}, 
	function()
	{
		$(this)
			.find('ul')
			.stop(true, true)
			.fadeOut('fast');
	});
});
$(document).ready(function()
{
	$('#header-top li ul').css
	({
		display:"none",
		left:"auto"
	});
	$('#header-top li').hover(function()
	{
		$(this)
			.find('ul')
			.stop(true, true)
			.slideDown('fast');
	},
	function()
	{
		$(this)
			.find('ul')
			.stop(true, true)
			.fadeOut('fast');
	});
});