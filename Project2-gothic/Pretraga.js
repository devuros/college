	var xmlhttp;
	var xmlDoc;
	
function pretraga(){

	if(window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
 
 xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	xmlDoc=xmlhttp.responseXML;
    }
  }
xmlhttp.open("GET","pretraga.xml",false);
xmlhttp.send();
 
 //dohvati();
//}
 //function dohvati(){
 var tbPretraga=document.getElementById('tbPretraga');

 var ispis="";
 var svaPretraga=xmlDoc.getElementsByTagName("trazi");
 var vrstaUsluge;
 var cena;
 var imaRezultata = false;
   ispis+="<h2>Rezultati pretrage - usluga i cena:</h2><br/><hr/><br/>";
  for(var i=0;i<svaPretraga.length;i++){
	  vrstaUsluge=svaPretraga[i].getElementsByTagName('vrstaUsluge')[0].childNodes[0].nodeValue;
	  cena=svaPretraga[i].getElementsByTagName('cena')[0].childNodes[0].nodeValue;	 
    
     
		if (vrstaUsluge.toLowerCase().indexOf(tbPretraga.value.toLowerCase()) > -1){
	
	  ispis+="<span><h3>" + vrstaUsluge + " / " + cena +" rsd</h3></span><br/>";
	  imaRezultata = true;	
      }
  }
  if(imaRezultata){
  ispis+="<br/><hr/><br/>";
  document.getElementById("prikaz").innerHTML=ispis;
	}
else{
		alert("Nije nijedna usluga sa tim nazivom! \n probajte \"sisanje\",\"feniranje\"...");
}

}