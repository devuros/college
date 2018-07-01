$(document).ready(function()
{
	//navi hover
	$('nav .nav-link').hover(function()
	{
		$(this).addClass('hover');
	},function()
	{
		$(this).removeClass('hover');
	});
	//login hover
	$('#header-login .login-link').hover(function()
	{
		$(this).addClass('hover');
	},function()
	{
		$(this).removeClass('hover');
	});
	//hover logo
	$('#header-logo').hover (function()
	{
		$(this).css({'background-color':'orange', 'color':'#000'});
	},function()
	{
		$(this).css({'background-color':'#218c8d', 'color':'#fff'});
	});
	//AJAX za prikaz DETALJA o artiklu
	$(".prikaz-item a").click(function()
	{
		var id_artikl=$(this).attr("href");
		$.ajax
		({
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { idartikl: id_artikl },
			success: function(podatak)
			{
				$("#desc-prikaz").html(podatak);
			}
		});
		return false;
	});
	//AJAX  IZMENA artikla - stampanje artikla
	$('#select-izmena').change(function()
	{
		var id_kate=$(this).val();
		if(id_kate==0)
		{
			alert("Izaberi..");
		}
		else
		{
			$.ajax
			({
				type: "POST",
				url: "ajax.php",
				dataType: "json",
				data: { idkate: id_kate },
				success: function(pod)
				{
					$("#select-izmena-artikli").html(pod);
				}
			});
		}
	});
	//AJAX IZMENA artikla stampanje trenutnih artikla o podatku
	$("#select-izmena-artikli").change(function()
	{
		var id_art=$(this).val();
		$.ajax
		({
			type: "POST",
				url: "ajax.php",
				dataType: "json",
				data: { idartiklizmena: id_art },
				success: function(dt)
				{
					$("#izmena-div").html(dt);
				}
		});
	});
	//dropdown meni
	$('nav ul').css
	({
		'display':'none',
		'left':"auto"
	});
	$('nav .nav-link').hover(function()
	{
		$(this)
		.find('ul')
		.stop(true, true)
		.slideDown('fast');
	},function()
	{
		$(this)
		.find('ul')
		.stop(true, true)
		.fadeOut('fast');
	});
	$('nav ul li').hover(function()
	{
		$(this).addClass("hover");
	},function ()
	{
		$(this).removeClass("hover");
	});
	//AJAX galerija prikaz VELIKE slike i KOMENTARA
	$("#image-many a").click(function()
	{
		var id_slika=$(this).attr("href");
		$.ajax
		({
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { idslika: id_slika },
			success: function(data)
			{
				var niz=data.split("$");
				$("#image-one").html(niz[0]);
				$("#comments-wrapper").html(niz[1]);
			}
		});
		return false;
	});
	//AJAX galerija postavljanje komenatara za odbranu sliku
	$("#btnComment").click(function()
	{
		var ids=$('#image-one img').attr("title");
		var komentar=$('#tbComment').val();
		var dugme=$("#btnComment").val();
		
		if(komentar.length<1)
		{
			alert("Write a comment, please");
		}
		else
		{
			$.ajax
			({
				type: "POST",
				url: "ajax.php",
				dataType: "json",
				data: { idslikakom: ids, comment: komentar, vote: dugme },
				success: function(povratak)
				{
					$("#comments-wrapper").html(povratak);
					
				},
				complete: function()
				{
					$("#tbComment").val("");
				}
		});
		}
	});
	//AJAX dodavanje artikla u KORPU
	$(".prikaz-cart a").click(function()
	{
		var iddodajukorpu=$(this).attr("href");
		
		$.ajax
		({
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { dodajukorpu: iddodajukorpu },
			success: function(da)
			{
				$("#desc-prikaz").html(da);
			},
		});
		return false;
	});
});