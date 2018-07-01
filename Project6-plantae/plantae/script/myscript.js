$(document).ready(function()
{
    //anketa - glasanje
    $(".btnOption").click(function()
    {
        var poll_id = $("#poll_id").val();
        var poll_option = $(this).attr("data-option-id");
        
        $.ajax({
            type: "POST",
            url: "http://localhost/mojrad/plantae/klass/vote",
            data: {poll_id: poll_id, poll_option: poll_option},
            dataType: "json",
            success: function(para)
            {
                $("#ajax-return").html(para);
            }
        });
        
    });
    //prikaz prve slike odabrane galerije
    $(".gallery-link").click(function(e)
    {
        e.preventDefault();
        var gallery_id = $(this).attr("data-gallery-id");
        
        $("#next").show();
        $("#prev").hide();
        
        $.ajax({
            type: "POST",
            url: "http://localhost/mojrad/plantae/land/gallery_ajax",
            data: {gallery_id: gallery_id},
            dataType: "json",
            success: function(param)
            {
                var niz = param.split("$");
                var img_src = niz[0];
                var img_title = niz[1];
                var img_id = niz[2];
                var img_parent = niz[3];
                var cur = niz[4];
                
                $("#pick-picture").html(img_src);
                $("#pick-heading").html(img_title);
                $("#image_data").attr("data-image-id", img_id);
                $("#image_data").attr("data-image-parent", img_parent);
                $("#image_data").attr("data-image-cur", cur);
            }
        });
        
    });
    //prev-next (galerija)
    $("#prev").hide();
    $(".rotate").click(function()
    {
        var image_id = $("#image_data").attr("data-image-id");
        var image_parent = $("#image_data").attr("data-image-parent");
        var cur = $("#image_data").attr("data-image-cur");
        var way = $(this).attr("name");
        
        $.ajax({
            type: "POST",
            url: "http://localhost/mojrad/plantae/land/image_ajax",
            data: {image_id: image_id, image_parent: image_parent, way: way, cur: cur},
            dataType: "json",
            success: function(rep)
            {
                var niz = rep.split("$");
                var img_src = niz[0];
                var img_title = niz[1];
                var img_id = niz[2];
                var img_parent = niz[3];
                var cur = niz[4];
                var next = niz[5];
                var prev = niz[6];
                var total = niz[7];
                
                $("#pick-picture").html(img_src);
                $("#pick-heading").html(img_title);
                $("#image_data").attr("data-image-id", img_id);
                $("#image_data").attr("data-image-parent", img_parent);
                $("#image_data").attr("data-image-cur", cur);
                
                if(prev < 0)
                {
                    if(next >= total)
                    {
                        $("#next").hide();
                        $("#prev").hide();
                    }
                    else
                    {
                        $("#next").show();
                        $("#prev").hide();
                    }
                }
                else if(next >= total)
                {
                    $("#next").hide();
                    $("#prev").show();
                }
                else
                {
                    $("#next").show();
                    $("#prev").show();
                }
            }
        });
        
    });
    //slider
    var x = setTimeout(appslider, 4000);
    $("#slider").mouseover(function()
    {
        $(".move").show();
    });
    $("#slider").mouseleave(function()
    {
        $(".move").hide();
    });
    $(".move").click(function()
    {
        var side = $(this).attr("name");
        var app = $(".app");
        
        if(side=="r")
        {
            var napp = app.next().length ? app.next():app.parent().children(":first");
            app.hide().removeClass("app");
            napp.fadeIn().addClass("app");  
        }
        else
        {
            var papp = app.prev().length ? app.prev():app.parent().children(":last");
            app.hide().removeClass("app");
            papp.fadeIn().addClass("app");
        }
        clearTimeout(x);
        x = setTimeout(appslider, 4000);
    });
    
    function appslider()
    {
        var app = $(".app");
        var napp = app.next().length ? app.next():app.parent().children(":first");
        app.hide().removeClass("app");
        napp.fadeIn().addClass("app");
        x = setTimeout(appslider, 4000);
    }
    
});