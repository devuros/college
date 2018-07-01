$(document).ready(function()
{
	//visina za search i community
	var wind = $(window).height();
	var client = $("#header-client-wrapper").outerHeight();
	var loc = $("#location").outerHeight();
	var swrap = $("#search-wrapper").outerHeight();
	var fot = $("#footer").outerHeight();
	var vzbir =  wind - (client + loc + swrap + fot) + $(".vh").height();
	$(".vh").height(vzbir);
	//pretraga
	$("#tbSearch").focus(function()
	{
		$(this).css({"border-style":"solid", "border-color":"#014ecb"});
		$("#btnSearch").css({"border-style":"solid", "border-color":"#014ecb"});
	});
	$("#tbSearch").blur(function()
	{
		$(this).css({"border-style":"solid", "border-color":"#999"});
		$("#btnSearch").css({"border-style":"solid", "border-color":"#999"});
	});
	//account div (logout, settings)
	$("#account").css({"display":"none"});
	var click = 1;
	$(".client-link").click(function()
	{
		if(click%2 == 0)
		{
			$("#account").css({"display":"none"});
		}
		else
		{
			$("#account").css({"display":"block"});
		}
		click = eval(click+1);
	});
	//hover za stavke u pretrazi 
	$(".search-post").hover(function()
	{
		$(this).css({"backgroundColor":"#fcfcfc"});
	}, function()
	{
		$(this).css({"backgroundColor":"#f2f2f2"});
	});
	//hover za User-a u pretrazi
	$(".search-user").hover(function()
	{
		$(this).css({"backgroundColor":"#fcfcfc"});
	}, function()
	{
		$(this).css({"backgroundColor":"#f2f2f2"});
	});
});