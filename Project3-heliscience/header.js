$(document).ready(function()
{
	// toggle za display Search
	$('#spyglass-img').click(function()
	{
		$('#search-form').toggle();
	});
	// TOGGLE za LOGIN
	$('#hd-login').css
	({
		'display':"none",
		'left':"auto"
	});
	$('#a-login').click(function()
	{
		$('#hd-login').toggle();
	});
	// TOGGLE za CONTENT
	$('#hd-content').css
	({
		'display':"none",
		'left':"auto"
	});
	$('#a-content').click(function()
	{
		$('#hd-content').toggle();
	});
});