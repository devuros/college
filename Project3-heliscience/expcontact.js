function auditform()
{
	var name=document.getElementById("TBname").value;
	var rename=/^[A-z]{3,20}$/;
	var email=document.getElementById("TBemail").value;
	var reemail=/^\w([\.]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var message=document.getElementById("TAmessage").value;
	var remessage=/^[\w\d\s\.\!\,]{10,500}$/;
	
	var error=new Array();
	
	if(!name.trim().match(rename))
	{
		error.push("Please enter your name");
	}
	if(!email.match(reemail))
	{
		error.push("Please a valid email address");
	}
	if(!message.match(remessage))
	{
		error.push("Your message must contain between 10 and 500 characters");
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
		// var mail="mailto:contact@hs.com&subject=Contact request&body=Name: "+name+"\nEmail: "+email+"\nMessage: "+message;
		// window.location.href=mail;
		var valid="Name: "+name+"\nEmail: "+email+"\nMessage: "+message;
		alert(valid);
	}
}