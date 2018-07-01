$(document).ready(function()
{
	//HELICOPTER template
	$('.panel').css
	({
		'display':'none'
	});
	$('#panel1').css
	({
		'display':'block'
	});
	$('#panel4').css
	({
		'display':'block'
	});
	$('.h-panel').hover(function()
	{
		$(this).css
		({
			'cursor':'pointer'
		});
	},function()
	{
		
	});
	$('.h-panel').addClass('arrowdown');
	$('#h-panel1').addClass('arrowup');
	$('#h-panel4').addClass('arrowup');
	
	$('#h-panel1').click(function()
	{
		$('#panel1').slideToggle("fast");
		$('#h-panel1').toggleClass('arrowup');
	});
	$('#h-panel2').click(function()
	{
		$('#panel2').slideToggle("fast");
		$('#h-panel2').toggleClass('arrowup');
	});
	$('#h-panel3').click(function()
	{
		$('#panel3').slideToggle("fast");
		$('#h-panel3').toggleClass('arrowup');
	});
	$('#h-panel4').click(function()
	{
		$('#panel4').slideToggle("fast");
		$('#h-panel4').toggleClass('arrowup');
	});
	$('#h-panel5').click(function()
	{
		$('#panel5').slideToggle("fast");
		$('#h-panel5').toggleClass('arrowup');
	});
	$('#h-panel6').click(function()
	{
		$('#panel6').slideToggle("fast");
		$('#h-panel6').toggleClass('arrowup');
	});
	//MANUFACTURER template
	$('#models-list').css
	({
		'display':'none'
	});
	$('#models-caption').hover(function()
	{
		$(this).css
		({
			'cursor':'pointer'
		});
	},function()
	{
		
	});
	$('#models-caption h3').addClass('arrowdown');
	$('#models-caption').click(function()
	{
		$('#models-list').slideToggle("fast");
		$('#models-caption h3').toggleClass('arrowup');
	});
	//NEWS table zebra
	$('#htable thead')
		.css({ 'color':'#333333','background-color':'#ffffff' });
	$('#htable thead th')
		.css({
			'padding-right':'10px',
			'padding-left':'5px',
			'padding-bottom':'5px',
			'padding-top':'8px'
		});
	$('#table-civil tr:even')
		.css({ 'background-color':'#4dd5ff' });
	$('#table-military tr:odd')
		.css({ 'background-color':'#46b946' });
	$('#htable td')
		.css({ 
			'padding-left':'5px',
			'padding-top':'2px',
			'padding-bottom':'2px'
		});
});