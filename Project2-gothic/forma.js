function formular()
{
	var ddDan=document.getElementById("ddDan");
	var ddMesec=document.getElementById("ddMesec");
	var ddGodina=document.getElementById("ddGodina");
	
	var regIme=/^[A-Za-z/S]{3,20}$/;
	var tbIme=document.getElementById("tbIme").value;
	
	var regPrezime=/^[/SA-Za-z]{3,20}$/;
	var tbPrezime=document.getElementById("tbPrezime").value;
	
	var regEmail=/^(\w+[\-\.])*\w+@(\w+\.)+[A-Za-z]+$/;
	var tbEmail=document.getElementById("tbEmail").value;
	
	var regLozinka=/^[A-Za-z/S]{4,20}[0-9]{2,8}$/;
	var tbLozinka=document.getElementById("tbLozinka").value;
	
	var ddPitanje=document.getElementById("ddPitanje");
	
	var regOdgovor=/^[A-Za-z/S]{5,15}$/;
	var tbOdgovor=document.getElementById("tbOdgovor").value;
		
	var greske=new Array();
	var sadrzaj=new Array();
		
	// provera dana, meseca i godine rodjenja
	if(ddDan.selectedIndex=="0")
	{
		greske.push("Morate da odaberete datum rodjenja!");
	}
	else
	{
		sadrzaj.push(ddDan.options[ddDan.selectedIndex].value);
	} 
	if(ddMesec.selectedIndex=="0") 
	{
		greske.push("Morate da odaberete mesec!");
	}
	else
	{
		sadrzaj.push(ddMesec.options[ddMesec.selectedIndex].value);
	}
	if(ddGodina.selectedIndex=="0") 
	{
		greske.push("Morate da odaberete godinu!");
	}
	else
	{
		sadrzaj.push(ddGodina.options[ddGodina.selectedIndex].value);
	} 
	
	// ime provera
	if(!tbIme.match(regIme))
	{
		greske.push("Niste uneli dobro ime!");			
	}
	else
	{
		sadrzaj.push(tbIme);
	}	
	// prezime provera
	if(!tbPrezime.match(regPrezime))
	{
		greske.push("Niste uneli dobro prezime");
	}
	else
	{
		sadrzaj.push(tbPrezime);
	}
	// email provera
	if(!tbEmail.match(regEmail))
	{
		greske.push("Niste uneli dobar mejl!!!");
	}
	// lozinka provera	
	if(!tbLozinka.match(regLozinka))
	{
		greske.push("nije dobra lozinka");
	}
	else
	{
		sadrzaj.push(tbLozinka);
	}
	// pitanje provera	
	if(ddPitanje.selectedIndex=="0") 
	{
		greske.push("Morate da odaberete pitanje!");
	}
	else
	{
		sadrzaj.push(ddPitanje.options[ddPitanje.selectedIndex].value);
	} 
	// odgovor provera
	if(!tbOdgovor.match(regOdgovor))
	{
		greske.push("Niste dobro uneli odgovor!");			
	}
	else
	{
		sadrzaj.push(tbOdgovor);
	}
	// Provera
	if(greske.length == 0)
	{
		var tekst = "";
		for(var i = 0; i < sadrzaj.length; i++)
		{
			tekst += sadrzaj[i] + ("\n");
		}
		tekst +=" ";			
		alert(tekst);
	}
	else
	{
		var listaGresaka = "";			
		for(var i = 0; i < greske.length; i++)
			{
				listaGresaka += greske[i] + ("\n");
			}
		listaGresaka+="";
		alert(listaGresaka);			
		return false;			
	}
}