$(document).ready(function()
{
	$('#a-ddmodels').addClass('dropdownwhite');
	$('#a-ddmodels').hover(function()
	{
		$('#a-ddmodels').addClass('dropdownblue');
	},function()
	{
		$('#a-ddmodels').removeClass('dropdownblue');
	});
	
	$('#a-ddcompany').addClass('dropdownwhite');
	$('#a-ddcompany').hover(function()
	{
		$('#a-ddcompany').addClass('dropdownblue');
	},function()
	{
		$('#a-ddcompany').removeClass('dropdownblue');
	});
	
	$('#a-ddlessons').addClass('dropdownwhite');
	$('#a-ddlessons').hover(function()
	{
		$('#a-ddlessons').addClass('dropdownblue');
	},function()
	{
		$('#a-ddlessons').removeClass('dropdownblue');
	});
	
	$('#a-contact').addClass('otherwhite');
	$('#a-contact').hover(function()
	{
		$('#a-contact').addClass('otherblue');
	},function()
	{
		$('#a-contact').removeClass('otherblue');
	});
	
	$('#a-author').addClass('otherwhite');
	$('#a-author').hover(function()
	{
		$('#a-author').addClass('otherblue');
	},function()
	{
		$('#a-author').removeClass('otherblue');
	});
	
	//ZA MODELS
	$('#models').css
	({
		'display':'none',
		'left':"auto"
	});
	// za prikazivanje glavnog diva MODELS
	$('#ddmodels').click(function()
	{
		$('#models').toggle();
		$('#a-ddmodels').toggleClass('dropclick');
	});
	// hover za background color
	$('#models-li1').hover(function()
	{
		$('#models-li1').css
		({
			"background-color":"#f2f2f2",
			"cursor":'default'
		});
	},function()
	{
		$('#models-li1').css
		({
			"background-color":"#ffffff"
		});
	});
	$('#models-li2').hover(function()
	{
		$('#models-li2').css
		({
			"background-color":"#f2f2f2",
			"cursor":'default'
		});
	},function()
	{
		$('#models-li2').css
		({
			"background-color":"#ffffff"
		});
	});
	// click za promenu boje naziva vrste koji je odabran
	$('#models-li2').click(function()
	{
		$('#strongc').css
		({
			"color":"#888888"
		});
		$('#strongm').css
		({
			"color":"#000000"
		});
	});
	$('#models-li1').click(function()
	{
		$('#strongc').css
		({
			"color":"#000000"
		});
		$('#strongm').css
		({
			"color":"#888888"
		});
	});
	// za biranje vrste helicoptera
	$('#models-li2').click(function()
	{
		$('#models-military').css
		({
			'display':"block"
		});
		$('#models-civil').css
		({
			'display':"none"
		});
	});
	$('#models-li1').click(function()
	{
		$('#models-military').css
		({
			'display':"none"
		});
		$('#models-civil').css
		({
			'display':"block"
		});
	});
	//ZA COMPANY
	$('#company-ul').css
	({
		'display':"none",
		'left':"auto",
	});
	$('#ddcompany').hover(function()
	{
		$(this)
		.find('ul')
		.stop(true, true)
		.slideDown('fast');
		$('#a-ddcompany').addClass('otherhover');
	},function()
	{
		$(this)
		.find('ul')
		.stop(true, true)
		.fadeOut('fast');
		$('#a-ddcompany').removeClass('otherhover');
	});
	//ZA LESSONS
	$('#lessons-ul').css
	({
		'display':"none",
		'left':"auto",
	});
	$('#ddlessons').hover(function()
	{
		$(this)
		.find('ul')
		.stop(true, true)
		.slideDown('fast');
		$('#a-ddlessons').addClass('otherhover');
	},function()
	{
		$(this)
		.find('ul')
		.stop(true, true)
		.fadeOut('fast');
		$('#a-ddlessons').removeClass('otherhover');
	});
});