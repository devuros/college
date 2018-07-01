$(document).ready(function () {

    //$(".has-popup a.static").html('Products <i class="fa fa-angle-down"></i>');
    $(".has-popup a.static").append(' <i class="fa fa-angle-down"></i>');

    //login hover
    $('#header-login .login-link').hover(function () {
        $(this).addClass('hover');
    }, function () {
        $(this).removeClass('hover');
    });
    //hover logo
    $('#header-logo').hover(function () {
        $(this).css({ 'background-color': 'orange', 'color': '#000' });
    }, function () {
        $(this).css({ 'background-color': '#218c8d', 'color': '#fff' });
    });

    //AJAX_ProductDetails

    $(".prikaz-item a").click(function (e) {
        e.preventDefault();
    	var idProduct = $(this).attr("data-product");
    	
    	$.ajax
        ({
    	    type: "POST",
    	    url: "RemoteRequest.asmx/ProductDetails",
    	    data: { 'idProduct': idProduct },
    	    dataType: "json",
    	    success: function (xpeke)
    	    {
    	        xpeke.forEach(function (x) {
    	            $("#desc-prikaz").html(x);
    	        });
    	    }
    	});
    });

    //$(".prikaz-item a").click(function(){
    //	var id_artikl = $(this).attr("href");
    //	$.ajax
    //	({
    //		type: "POST",
    //		url: "ajax.php",
    //		dataType: "json",
    //		data: { idartikl: id_artikl },
    //		success: function(podatak)
    //		{
    //			$("#desc-prikaz").html(podatak);
    //		}
    //	});
    //	return false;
    //});

    //dropdown meni

    //$('nav ul').css
	//({
	//    'display': 'none',
	//    'left': "auto"
	//});
    //$('nav .nav-link').hover(function () {
    //    $(this)
	//	.find('ul')
	//	.stop(true, true)
	//	.slideDown('fast');
    //}, function () {
    //    $(this)
	//	.find('ul')
	//	.stop(true, true)
	//	.fadeOut('fast');
    //});
    //$('nav ul li').hover(function () {
    //    $(this).addClass("hover");
    //}, function () {
    //    $(this).removeClass("hover");
    //});

    //navi hover

	//$('nav .nav-link').hover(function(){
	//	$(this).addClass('hover');
	//},function(){
	//	$(this).removeClass('hover');
	//});

    //AJAX IZMENA artikla - stampanje artikla

	//$('#select-izmena').change(function(){
	//	var id_kate=$(this).val();
	//	if(id_kate==0){
	//		alert("Izaberi..");
	//	}
	//	else{
	//		$.ajax
	//		({
	//			type: "POST",
	//			url: "ajax.php",
	//			dataType: "json",
	//			data: { idkate: id_kate },
	//			success: function(pod)
	//			{
	//				$("#select-izmena-artikli").html(pod);
	//			}
	//		});
	//	}
    //});

    //AJAX IZMENA artikla stampanje trenutnih artikla o podatku

	//$("#select-izmena-artikli").change(function(){
	//	var id_art=$(this).val();
	//	$.ajax
	//	({
	//		type: "POST",
	//		url: "ajax.php",
	//		dataType: "json",
	//		data: { idartiklizmena: id_art },
	//		success: function(dt)
	//		{
	//			$("#izmena-div").html(dt);
	//		}
	//	});
	//});

    //AJAX galerija prikaz VELIKE slike i KOMENTARA

	//$("#image-many a").click(function(){
	//	var id_slika=$(this).attr("href");
	//	$.ajax
	//	({
	//		type: "POST",
	//		url: "ajax.php",
	//		dataType: "json",
	//		data: { idslika: id_slika },
	//		success: function(data)
	//		{
	//			var niz=data.split("$");
	//			$("#image-one").html(niz[0]);
	//			$("#comments-wrapper").html(niz[1]);
	//		}
	//	});
	//	return false;
	//});

    //AJAX dodavanje artikla u KORPU

	//$(".prikaz-cart a").click(function(){
	//	var iddodajukorpu=$(this).attr("href");
		
	//	$.ajax
	//	({
	//		type: "POST",
	//		url: "ajax.php",
	//		dataType: "json",
	//		data: { dodajukorpu: iddodajukorpu },
	//		success: function(da)
	//		{
	//			$("#desc-prikaz").html(da);
	//		},
	//	});
	//	return false;
    //});

});

//Javascript

//function kreiranje(){
//	var request=false;
//	try
//	{
//		request=new XMLHttpRequest();
//		return request;
//	}
//	catch(trymicrosoft)
//	{
//		try
//		{
//			request=new ActiveXObject("Msxml2.XMLHTTP");
//			return request;
//		}
//		catch(othermicrosoft)
//		{
//			try
//			{
//				request=new ActiveXObject("Microsoft.XMLHTTP");
//				return request;
//			}
//			catch(failed)
//			{
//				request=false;
//			}
//		}
//	}
//}

//prva
//function detalji(id){
//	req=kreiranje();
//	if(!req)
//	{
//		alert("Error HTTP failed!");
//	}
//	else
//	{
//		req.open("GET", "ajax.php?idartikl="+id, true);
//		req.onreadystatechange=ispis_detalji;
//		req.send(null);
//	}
//}
//druga
//function ispis_detalji(){
//	if(req.readyState==4)
//	{
//		document.getElementById("desc-prikaz").innerHTML=req.responseText;
//	}
//}