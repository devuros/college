function getUrl()
{
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) 
	{
		vars[key] = value;
	});
	return vars;
}
var rec=getUrl()["word"];
function search()
{
	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("MICROSOFT.XMLHTTP");
	}
	xmlhttp.open("GET","search.xml", false);
	xmlhttp.send();
	xmlDoc=xmlhttp.responseXML;
	display(xmlDoc);
}
function display(xmlDoc)
{
	var allterms=xmlDoc.getElementsByTagName("term");
	var nomatch="No results for "+rec;
	var match="1 search result for "+rec;
	
	var matchtitle="Error 404";
	var matchoutput="Search <b>models</b> like: ec120, ec135, uh60...<br/>Or <b>manufacturers</b> like: bell, airbus, sikorsky<br/>Or <b>lessons</b> like: autorotation, rotor, torque";
	
	document.getElementById('search-digit').innerHTML=nomatch;
	var a="";
	
	for(var i=0;i<allterms.length;i++)
	{
		var input=allterms[i].getElementsByTagName('input')[0].childNodes[0].nodeValue;
		var title=allterms[i].getElementsByTagName('title')[0].childNodes[0].nodeValue;
		var output=allterms[i].getElementsByTagName('output')[0].childNodes[0].nodeValue;
		var link=allterms[i].getElementsByTagName('link')[0].childNodes[0].nodeValue;
		
		if(rec.toLowerCase().trim()==input.toLowerCase().trim())
		{
			matchtitle=title;
			matchoutput=output;
			matchlink=link;
			document.getElementById('search-digit').innerHTML=match;
			a="<a href='"+link+"'>"+link.split(".")[0].toUpperCase()+" page </a>";
		}
	}
	document.getElementById('search-term').innerHTML=rec;
	document.getElementById('output-title').innerHTML=matchtitle;
	document.getElementById('output-text').innerHTML=matchoutput;
	document.getElementById('output-link').innerHTML=matchlink;
	if(a!="")
	{
		document.getElementById('output-link').innerHTML=a;
	}
}
// funkcija za pretragu sa SEARCH.html strane!
function localsearch()
{
	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("MICROSOFT.XMLHTTP");
	}
	xmlhttp.open("GET","search.xml", false);
	xmlhttp.send();
	xmlDoc=xmlhttp.responseXML;
	localdisplay(xmlDoc);
}
function localdisplay(xmlDoc)
{
	var term=document.getElementById('TBsearch').value;
	var allterms=xmlDoc.getElementsByTagName("term");
	var nomatch="No results for "+term;
	var match="1 search result for "+term;
	
	var matchtitle="Error 404";
	var matchoutput="Search models like: ec120, ec135, uh60<br/>Or manufacturers like: bell, airbus, sikorsky";
	
	document.getElementById('search-digit').innerHTML=nomatch;
	var a="";
	
	for(var i=0;i<allterms.length;i++)
	{
		var input=allterms[i].getElementsByTagName('input')[0].childNodes[0].nodeValue;
		var title=allterms[i].getElementsByTagName('title')[0].childNodes[0].nodeValue;
		var output=allterms[i].getElementsByTagName('output')[0].childNodes[0].nodeValue;
		var link=allterms[i].getElementsByTagName('link')[0].childNodes[0].nodeValue;
		
		if(term.toLowerCase().trim()==input.toLowerCase().trim())
		{
			matchtitle=title;
			matchoutput=output;
			matchlink=link;
			document.getElementById('search-digit').innerHTML=match;
			a="<a href='"+link+"'>"+link.split(".")[0].toUpperCase()+" page </a>";
		}
	}
	document.getElementById('search-term').innerHTML=term;
	document.getElementById('output-title').innerHTML=matchtitle;
	document.getElementById('output-text').innerHTML=matchoutput;
	document.getElementById('output-link').innerHTML=matchlink;
	document.getElementById('output-link').innerHTML=a;
}