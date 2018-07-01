$(document).ready(function()
{
	// GALLERY
	$('#move-next').click(function()
	{
		var move="200px";
		if($('#images-wrapper').css('left')=='-600px')
		{
			
		}
		else
		{
			$('#images-wrapper').animate({ 'left':'-='+move });
		}
	});
	$('#move-prev').click(function()
	{
		var move="200px";
		if($('#images-wrapper').css('left')=='0px')
		{
			
		}
		else
		{
			$('#images-wrapper').animate({ 'left':'+='+move });
		}
	});
	//Prev
	$('#button-prev').hover(function()
	{
		$('#button-prev').css
		({
			'opacity':'1',
			'cursor':'pointer',
			'background-color':'#999999'
		});
	},function()
	{
		$('#button-prev').css
		({
			'opacity':'0.8',
			'background-color':'#b3b3b3'
		});
	});
	//Next
	$('#button-next').hover(function()
	{
		$('#button-next').css
		({
			'opacity':'1',
			'cursor':'pointer',
			'background-color':'#999999'
		});
	},function()
	{
		$('#button-next').css
		({
			'opacity':'0.8',
			'background-color':'#b3b3b3'
		});
	});
});