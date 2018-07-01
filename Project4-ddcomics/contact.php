<?php
	session_start();
	
	if(isset($_REQUEST["send"]))
	{
		$name=$_REQUEST["name"];
		$email=$_REQUEST["email"];
		$message=$_REQUEST["message"];
		
		$regName="/^([A-z\s]{4,20})+$/";
		$regEmail="/^([A-z0-9\.\_\-]{4,30})+@[a-z]{3,6}.com$/";
		$regMessage="/[A-z\s\.\,]{10,100}/";
		
		if(!preg_match($regName, $name))
		{
			$gIme="Greska ime!";
		}
		if(!preg_match($regEmail, $email))
		{
			$gEmail="Greska email!";
		}
		if(!preg_match($regMessage, $message))
		{
			$gPoruka="Greska poruka!";
		}
		if(isset($greske) and count($greske)==0)
		{
			mail($email, "Contact form ", $message);
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site | Contact</title>
		<meta charset="utf-8">
		<meta name="author" content="Uroš Jovanović">
		<link rel="shortcut icon" href="slike/icon/prava.ico">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		
		<script type="text/javascript" src="jquery-1.9.0.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<header>
			<?php
				include("header.php");
			?>
		</header>
		<div id="main-contact-wrapper">
			<div id="main-contact">
				<div id="contact-form">
					<form action="contact.php" method="POST" name="form-contact" id="form-contact">
						<h2>Contact us</h2>
						<div class="row-input-small">Name *
							<span class="error">
								<?php
									if(isset($gIme))
									{
										echo $gIme;
									}
								?>
							</span>
						</div>
						<div class="row-input-small space">
							<input type="text" name="name" id="tbName" class="input-small" />
						</div>
						<div class="row-input-small">Email *
							<span class="error">
								<?php
									if(isset($gEmail))
									{
										echo $gEmail;
									}
								?>
							</span>
						</div>
						<div class="row-input-small space">
							<input type="text" name="email" id="tbEmail" class="input-small" />
						</div>
						<div class="row-input-small">Message *
							<span class="error">
								<?php
									if(isset($gPoruka))
									{
										echo $gPoruka;
									}
								?>
							</span>
						</div>
						<div class="row-input-small space">
							<textarea name="message" id="taMessage" cols="39" rows="6"></textarea>
						</div>
						<div class="row-input-small">
							<input type="submit" name="send" id="btnSend" value="Send" />
						</div>
					</form>
				</div>
				<div id="contact-information">
					<div class="row-information space">
						<div class="row-information-large">
							<h3>Information</h3>
						</div>
					</div>
					<div class="row-information space">
						<div class="row-information-small color">Address</div>
						<div class="row-information-small">Ringvagen 3<br/> 37500 Falun<br/> Sweden</div>
					</div>
					<div class="row-information space">
						<div class="row-information-small color">Telephone</div>
						<div class="row-information-large">+47 501 643</div>
					</div>
					<div class="row-information space">
						<div class="row-information-small color">Email</div>
						<div class="row-information-large">support@ns.com</div>
					</div>
					<div class="row-information space">
						<div class="row-information-small color">Work hours</div>
						<div class="row-information-large">mon-fri: 8-16h<br/> sat: 8-12h</div>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<?php
				include("footer.php");
			?>
		</footer>
	</body>
</html>