$(document).ready(function()
{
	//za skrivanje podkategorija
	$(".category-title").click(function()
	{
		$(this).next(".category-toggle").slideToggle();
		$(this).find("i").toggleClass("fa-minus-square-o");
		$(this).find("i").toggleClass("fa-plus-square-o");
	});
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
	//za senku
	$(".article-latest").hover(function()
	{
		$(this).addClass("strong-shadow");
	},function()
	{
		$(this).removeClass("strong-shadow");
	});
	//slider
	var ukupno=$(".set").length;
	var pomeraj=parseInt($(".set").css("width"));
	var skriveno=1;
	$("#holder").css("width", eval(ukupno*pomeraj));
	
	racunaj(skriveno, "a");
	function racunaj(para,gde)
	{
		var levo=eval(para-1);
		var desno=eval(para+1);
		
		if(levo<1)
		{
			if(desno > ukupno)
			{
				//prva strana nema desno
			}
			else
			{
				$("#left-arrow-div").css({"display":"none"});
				$("#right-arrow-div").fadeIn(400);
			}
		}
		else if(desno>ukupno)
		{
			$("#left-arrow-div").fadeIn(400);
			$("#right-arrow-div").css({"display":"none"});
		}
		else
		{
			$("#left-arrow-div").fadeIn(400);
			$("#right-arrow-div").fadeIn(400);
		}
		
		if(gde=="desno")
		{
			$("#holder").animate({ "left":"-="+pomeraj}, 400);
		}
		if(gde=="levo")
		{
			$("#holder").animate({ "left":"+="+pomeraj}, 400);
		}
	}
	
	$("#right-arrow-div").click(function()
	{
		skriveno=eval(skriveno+1);
		gde="desno";
		racunaj(skriveno,gde);
	});
	$("#left-arrow-div").click(function()
	{
		skriveno=eval(skriveno-1);
		gde="levo";
		racunaj(skriveno,gde);
	});
	
	//hover na strelice
	$("#left-arrow-div").hover(function()
	{
		$(this).css({"backgroundColor":"#ffb900", "color":"#fff"});
	},function()
	{
		$(this).css({"backgroundColor":"#f25022", "color":"#ffb900"});
	});
	$("#right-arrow-div").hover(function()
	{
		$(this).css({"backgroundColor":"#ffb900", "color":"#fff"});
	},function()
	{
		$(this).css({"backgroundColor":"#f25022", "color":"#ffb900"});
	});
	//hover na Podkategorije 
	$(".category-sub").hover(function()
	{
		$(this).css({"backgroundColor":"#fcfcfc"});
	}, function()
	{
		$(this).css({"backgroundColor":"#f2f2f2"});
	});
	
	//hover za Popular Topics
	$("#aside-posts a").hover(function()
	{
		$(this).find(".aside-posts").css({"backgroundColor":"#fafafa"});
	}, function()
	{
		$(this).find(".aside-posts").css({"backgroundColor":"#fff"});
	});
	
	//hover na red - listu svih thread-ova u jednoj podkategoriji
	$("#subcat-topics .one-row:not(.sticky)").hover(function()
	{
		$(this).css({"backgroundColor":"rgba(255, 185, 0, 0.8)"});
		$(this).find(".subject-div").css({"color":"#fff"});
		$(this).find(".replies-div").css({"color":"#fff"});
		$(this).find(".last-time-div").css({"color":"#fff"});
	},function()
	{
		$(this).css({"backgroundColor":"#f2f2f2"});
		$(this).find(".subject-div").css({"color":"#f25022"});
		$(this).find(".replies-div").css({"color":"#000"});
		$(this).find(".last-time-div").css({"color":"#000"});
	});
	$("#subcat-topics .sticky").hover(function()
	{
		$(this).css({"backgroundColor":"rgba(255, 185, 0, 0.8)"});
		$(this).find(".subject-div").css({"color":"#fff"});
		$(this).find(".replies-div").css({"color":"#fff"});
		$(this).find(".last-time-div").css({"color":"#fff"});
	},function()
	{
		$(this).css({"backgroundColor":"rgba(0, 179, 179, 0.12)"});
		$(this).find(".subject-div").css({"color":"#f25022"});
		$(this).find(".replies-div").css({"color":"#000"});
		$(this).find(".last-time-div").css({"color":"#000"});
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
	//provera da li je logovan da bi dodao POST za taj thread
	$(".btnPost").click(function()
	{
		var urls = window.location.href;
		var parametar = urls.split("?")[1];
		var idPaket = parametar.split("&")[0];
		var idthread = idPaket.split("=")[1];
		
		$.ajax
		({		
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			success: function(redirect)
			{
				if(redirect=="login")
				{
					window.location.href="login.php?thread="+idthread;
				}
				if(redirect=="post-form")
				{
					//window.location.href="thread.php?"+parametar";
					goToByScroll("thread-new-post");
				}
			}
		});
	});
	//funkcija koja dinamicki radi scroll na element po ID-u
	function goToByScroll(id)
	{
		$('html,body').animate({scrollTop: $("#"+id).offset().top},'fast');
	}
	//provera da li je logovan da bi napravio novi Thread
	$("#subcat-new-thread").hide();
	$(".btnThread").click(function()
	{
		var urlSubcat = window.location.href;
		var parametarSubcat = urlSubcat.split("?")[1];
		var idSubcat = parametarSubcat.split("=")[1];
		
		$.ajax
		({		
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			success: function(reply)
			{
				if(reply=="login")
				{
					window.location.href="login.php?subcat="+idSubcat;
				}
				if(reply=="post-form")
				{
					//sakrij sadrzaj i prikazi formu za pravljanje Thread-a.
					$("#subcat-new-thread").toggle();
				}
			}
		});
	});
	$("#icon-close").click(function()
	{
		$("#subcat-new-thread").hide();
	});
	//za prikazivanje Like i quote za post
	$(".thread-post").hover(function()
	{
		$(this).find($(".div-post-hover")).show();
	}, function()
	{
		$(this).find($(".div-post-hover")).hide();
	});
	//za Like
	$(".like").click(function()
	{
		var idPost = $(this).val();
		var sad = $(this).parent().prev().text();
		var ispis = $(this).parent().prev();
		
		$.ajax
		({		
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { postid : idPost },
			success: function(rep)
			{
				if(rep == "uspelo glasanje")
				{
					if(sad == "")
					{
						sad = 0;
					}
					else
					{
						sad = parseInt(sad);
					}
					var zbir = eval(sad + 1);
					ispis.html("+"+zbir);
				}
				if(rep == "glasao")
				{
					var zbir = eval(sad - 1);
					if(zbir == 0)
					{
						ispis.html("");
					}
					else
					{
						ispis.html("+"+zbir);
					}
				}
			}
		});
	});
	//za Citiranje post-a
	$(".quote").click(function()
	{
		var idPostQuote = $(this).val();
		var div = $(this).parent().parent().prev();
		var by = $(this).parent().parent().prev().prev().find(".author-name").text();
		var vreme = $(this).parent().prev().prev().text();
		var tekst = div.html();
		
		tinymce.activeEditor.execCommand('mceInsertContent', false, "<blockquote><div>Posted by "+by+"<span class='right'>"+ vreme+"</span></div>"+tekst+"</blockquote><p>");
	});
	//za Report post-a
	$(".report").click(function()
	{
		var idReportPost = $(this).val();
		
		$.ajax
		({		
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { "idReportPost" : idReportPost },
			success: function()
			{
			}
		});
	});
	//za Request Sticky thread
	$("#btnSticky").click(function()
	{
		var idSticky = $(this).val();
		
		$.ajax
		({
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { "idSticky" : idSticky },
			success: function()
			{
			}
		});
	});
	//za Report thread-a
	$("#btnReport").click(function()
	{
		var idReportThread = $(this).val();
		
		$.ajax
		({		
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { "idReportThread" : idReportThread },
			success: function()
			{
			}
		});
	});
	//zebra na dashboardu
	$(".dashboard-item table tbody tr:odd").css({ "backgroundColor":"#f8f8f8" });
	
	//za disable User-a
	$(".disableUser").click(function()
	{
		var idDisableUser = $(this).val();
		
		$.ajax
		({		
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { "idDisableUser" : idDisableUser },
			success: function()
			{
			}
		});
	});
	//panel Akcije
	$(".btnAction").click(function()
	{
		var action = $(this).attr("name");
		var idType = $(this).val();
		var type = $(this).attr("data-item-type");
		var idReport = $(this).attr("data-item-reportid");
		
		if(idReport == null)
		{
			idReport = 0;
		}
		
		$.ajax
		({		
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: { "type": type, "idType": idType, "action": action, "idReport": idReport },
			success: function()
			{
			}
		});
	});
	//za Sticky Request
	$(".btnRequest").click(function()
	{
		var requestType = $(this).attr("name");
		var requestId = $(this).val();
		
		if(requestType == "no")
		{
			$.ajax
			({		
				type: "POST",
				url: "ajax.php",
				dataType: "json",
				data: { "requestType": requestType, "requestId": requestId },
				success: function()
				{
				}
			});
		}
		else
		{
			var requestThreadId = $(this).attr("data-threadid");
			
			$.ajax
			({		
				type: "POST",
				url: "ajax.php",
				dataType: "json",
				data: { "requestType": requestType, "requestId": requestId, "requestThreadId": requestThreadId },
				success: function()
				{
				}
			});
		}
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
	//hover na link za pagination
	$(".btnPagination").hover(function()
	{
		$(this).css({"backgroundColor":"#fff", "color":"#ffb900"});
	}, function()
	{
		$(this).css({"backgroundColor":"#ffb900", "color":"#fff"});
	});
});