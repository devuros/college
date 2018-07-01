function auditname()
{
	var name=document.getElementById("TBname").value;
	var rename=/^[A-Z][a-z]{2,20}$/;
	if(!name.trim().match(rename))
	{
		document.getElementById("TBname").style.borderColor="#8b0300";
	}
	else
	{
		document.getElementById("TBname").style.borderColor="#a6a6a6";
	}
}
function auditsurname()
{
	var surname=document.getElementById("TBsurname").value;
	var resurname=/^[A-Z][a-z]{4,30}$/;
	if(!surname.trim().match(resurname))
	{
		document.getElementById("TBsurname").style.borderColor="#8b0300";
	}
	else
	{
		document.getElementById("TBsurname").style.borderColor="#a6a6a6";
	}
}
function auditemail()
{
	var email=document.getElementById("TBemail").value;
	var reemail=/^\w([\.]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(!email.trim().match(reemail))
	{
		document.getElementById("TBemail").style.borderColor="#8b0300";
	}
	else
	{
		document.getElementById("TBemail").style.borderColor="#a6a6a6";
	}
}
function auditpass()
{
	var pass=document.getElementById("TBpass").value;
	var regpass=/^[a-z]{4,12}[\.\_\]?[0-9]{1,10}[a-z]*$/;
	if(!pass.match(regpass))
	{
		document.getElementById("TBpass").style.borderColor="#8b0300";
	}
	else
	{
		document.getElementById("TBpass").style.borderColor="#a6a6a6";
	}
}
function auditmatch()
{
	var pass=document.getElementById("TBpass").value;
	var repass=document.getElementById("TBrepass").value;
	var regrepass=/^[a-z]{4,12}[\.\_\]?[0-9]{1,10}[a-z]*$/;
	if(!repass.match(regrepass))
	{
		document.getElementById("TBrepass").style.borderColor="#8b0300";
	}
	else
	{
		document.getElementById("TBrepass").style.borderColor="#a6a6a6";
		if(pass!=repass)
		{
			document.getElementById("pass-report").style.color="#8b0300";
			document.getElementById("pass-report").innerHTML="Passwords do not match";
		}
		else
		{
			document.getElementById("pass-report").innerHTML="";
		}
	}
}
function auditradio()
{
	document.getElementById("radio-wrapper1").style.border="none";
	document.getElementById("radio-wrapper2").style.border="none";
}
function auditday()
{
	document.getElementById("DDLday").style.border="1px solid #A9A9A9";
}
function auditmonth()
{
	document.getElementById("DDLmonth").style.border="1px solid #A9A9A9";
}
function audityear()
{
	document.getElementById("DDLyear").style.border="1px solid #A9A9A9";
}
function auditall()
{
	var name=document.getElementById("TBname").value;
	var rename=/^[A-Z][a-z]{2,20}$/;
	var surname=document.getElementById("TBsurname").value;
	var resurname=/^[A-Z][a-z]{4,30}$/;
	var email=document.getElementById("TBemail").value;
	var reemail=/^\w([\.]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var pass=document.getElementById("TBpass").value;
	var regpass=/^[a-z]{4,12}[\.\_]?[0-9]{1,10}[a-z]*$/;
	var repass=document.getElementById("TBrepass").value;
	var regrepass=/^[a-z]{4,12}[\.\_]?[0-9]{1,10}[a-z]*$/;
	
	var day=document.getElementById("DDLday");
	var month=document.getElementById("DDLmonth");
	var year=document.getElementById("DDLyear");
	var dayOutput;
	var monthOutput;
	var yearOutput;
	
	var male=document.getElementById("RBmale").checked;
	var female=document.getElementById("RBfemale").checked;
	var genderOutput="";
	
	var error=new Array();
	
	if(!name.trim().match(rename))
	{
		error.push("Incorrect name input");
		document.getElementById("TBname").style.borderColor="#8b0300";
	}
	if(!surname.trim().match(resurname))
	{
		error.push("Incorrect surname input");
		document.getElementById("TBsurname").style.borderColor="#8b0300";
	}
	if(!email.match(reemail))
	{
		error.push("Incorrect email input");
		document.getElementById("TBemail").style.borderColor="#8b0300";
	}
	if(!pass.match(regpass))
	{
		error.push("Incorrect password input");
		document.getElementById("TBpass").style.borderColor="#8b0300";
	}
	if(!repass.match(regrepass))
	{
		document.getElementById("TBrepass").style.borderColor="#8b0300";
	}
	else
	{
		document.getElementById("TBrepass").style.borderColor="#a6a6a6";
	}
	if(pass!=repass)
	{
		error.push("Passwords do not match");
	}
	if(day.selectedIndex=="0")
	{
		error.push("Please select date of birth");
		document.getElementById("DDLday").style.border="1px solid #8b0300";
	}
	else
	{
		dayOutput=day.options[day.selectedIndex].value;
	}
	if(month.selectedIndex=="0")
	{
		error.push("Please select month of birth");
		document.getElementById("DDLmonth").style.border="1px solid #8b0300";
	}
	else
	{
		monthOutput=month.options[month.selectedIndex].value;
	}
	if(year.selectedIndex=="0")
	{
		error.push("Please select year of birth");
		document.getElementById("DDLyear").style.border="1px solid #8b0300";
	}
	else
	{
		yearOutput=year.options[year.selectedIndex].value;
	}
	if(male)
	{
		genderOutput=document.getElementById("RBmale").value;
	}
	if(female)
	{
		genderOutput=document.getElementById("RBfemale").value;
	}
	if(genderOutput=="")
	{
		error.push("Select gender");
		document.getElementById("radio-wrapper1").style.border="1px solid #8b0300";
		document.getElementById("radio-wrapper1").style.borderRadius="5px";
		document.getElementById("radio-wrapper2").style.border="1px solid #8b0300";
		document.getElementById("radio-wrapper2").style.borderRadius="5px";
	}
	if(error.length>0)
	{
		var errorOutput="";
		for(var i=0;i<error.length;i++)
		{
			errorOutput+=error[i]+"\n";
		}
		alert(errorOutput);
	}
	else
	{
		/*
		var mail="mailto:signup@hs.com&subject=Sign up&body=Name:"
		+name+"\nSurname:"+surname+"\nGender:"+genderOutput+"\nEmail:"+email+"\nPassword:"+pass+
		"\nBirth:"+dayOutput+"."+monthOutput+"."+yearOutput;
		window.location.href=mail;
		*/
		
		var expire=new Date;
		expire.setMonth(expire.getMonth()+6);
		
		if(document.cookie=email+"="+name+"$"+surname+";expires="+expire.toGMTString())
		{
			alert("Cookie is created!");
			var valid="Name: "+name+"\nSurname: "+surname+"\nGender: "+genderOutput+"\nEmail: "+email+"\nPassword: "+pass+"\nBirth: "+dayOutput+". "+monthOutput+". "+yearOutput;
			alert(valid);
		}
	}
}