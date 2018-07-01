function prijava()
{
	var div = document.createElement('div');
	div.id = 'login-omot';
	var div2 = document.createElement('div');
		div2.id = 'login';
		div.appendChild(div2);
			var form = document.createElement('form');
			form.onsubmit = function() { window.location.href='index.html'; return false; }
				var input = document.createElement('input');
				input.type="text";
				input.placeholder = "Nalog";
				form.appendChild(input);
				input = document.createElement('input');
				input.type="password";
				input.placeholder = "Lozinka";
			form.appendChild(input);
				input = document.createElement('input');
				input.type="submit";
				input.value="Prijavi";
			form.appendChild(input);
			div2.appendChild(form);
			var header = document.getElementById('header-top');
			header.appendChild(div);
	$('#login-omot').css({'margin-top':'-50px','margin-left':'150px'});
	$('#login-omot').animate({'margin-top':'0'},500); 
}
	$('#login').css('margin-right','500px');