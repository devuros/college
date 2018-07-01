<?php
	session_start();
	
	if(isset($_SESSION["id_user"]))
	{
		header("location: index.php");
	}
	
	if(isset($_REQUEST["register"]))
	{
		$ime=$_REQUEST["first_name"];
		$prezime=$_REQUEST["last_name"];
		$email=$_REQUEST["reg_email"];
		$username=$_REQUEST["reg_username"];
		$password=$_REQUEST["reg_password"];
		
		$dan=$_REQUEST["day"];
		$mesec=$_REQUEST["month"];
		$godina=$_REQUEST["year"];
		$pol=$_REQUEST["gender"];
		
		$regIme="/^([A-z\s]{4,20})+$/";
		$regEmail="/^([A-z0-9\.\_\-]{4,30})+@[a-z]{3,6}.com$/";
		$regCredentials="/^[a-z0-9\!\.]{5,30}$/";
		
		$greske=array();
		
		if(!preg_match($regIme, $ime))
		{
			$greske[]="Greska ime!";
		}
		if(!preg_match($regIme, $prezime))
		{
			$greske[]="Greska prezime!";
		}
		if(!preg_match($regEmail, $email))
		{
			$greske[]="Greska email!";
		}
		if(!preg_match($regCredentials, $username))
		{
			$greske[]="Greska username!";
		}
		if(!preg_match($regCredentials, $password))
		{
			$greske[]="Greska password!";
		}
		else
		{
			$password=md5($password);
		}
		if($dan=="0" or $mesec=="0" or $godina=="0")
		{
			$greske[]="Greska datum rodjenja!";
		}
		else
		{
			$datum=mktime(0,0,0, $mesec, $dan, $godina);
		}
		if($pol=="0")
		{
			$greske[]="Greska pol!";
		}
		if(isset($greske) and count($greske)==0)
		{
			include("konekcija.php");
			
			$upit_user="insert into users values ('', '$ime', '$prezime', '$email', '$username', '$password', '$datum', '$pol', 1, '')";
			$rez_user=mysql_query($upit_user, $konekcija) or die("Greska upis user-a! ".mysql_error());
			
			mysql_close($konekcija);
			
			if($rez_user)
			{
				header("location: login.php");
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>New Site | Register</title>
		<meta charset="utf-8">
		<meta name="author" content="Uroš Jovanović">
		<link rel="shortcut icon" href="slike/icon/prava.ico">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		
		<script type="text/javascript" src="jquery-1.9.0.js"></script>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<div id="main-register">
			<div id="register-wrapper">
				<div id="form-register-wrapper">
					<form action="register.php" method="POST" name="form-register" id="form-register">
						<h1 id="logo">
							<a href="index.php"><i class="fa  fa-laptop"></i> NwS</a>
						</h1>
						<h2>Create an account</h2>
						<div class="row-input-small">First name</div>
						<div class="row-input-small">Last name</div>
						
						<div class="row-input-small space">
							<input type="text" name="first_name" id="tbFirstName" class="input-small" />
						</div>
						<div class="row-input-small space">
							<input type="text" name="last_name" id="tbLastName" class="input-small" />
						</div>
						<div class="row-input-large">Email</div>
						<div class="row-input-large space">
							<input type="text" name="reg_email" id="tbEmail" class="input-large" placeholder="someone@example.com" />
						</div>
						<div class="row-input-small">Username</div>
						<div class="row-input-small">Password</div>
						<div class="row-input-small space">
							<input type="text" name="reg_username" id="tbUsername" class="input-small" />
						</div>
						<div class="row-input-small space">
							<input type="password" name="reg_password" id="tbPassword" class="input-small" />
						</div>
						<div class="row-input-large">Birthdate</div>
						<div class="row-input-large space">
							<select name="day" id="ddDay" class="select-3">
								<option value="0">Day</option>
								<?php
									for($i=1; $i<=31; $i++)
									{
										echo "<option value='".$i."'>".$i."</option>";
									}
								?>
							</select>
							<select name="month" id="ddMonth" class="select-3">
								<option value="0">Month</option>
								<?php
									$meseci= array(
										1=>"January",
										2=>"February",
										3=>"Mach",
										4=>"April",
										5=>"May",
										6=>"Jun",
										7=>"July",
										8=>"August",
										9=>"September",
										10=>"October",
										11=>"November",
										12=>"December"
									);
									foreach($meseci as $m => $mvalue)
									{
										echo "<option value='".$m."'>".$mvalue."</option>";
									}
								?>
							</select>
							<select name="year" id="ddYear" class="select-3">
								<option value="0">Year</option>
								<?php
									for($k=2016; $k>=1950; $k--)
									{
										echo "<option value='".$k."'>".$k."</option>";
									}
								?>
							</select>
						</div>
						<div class="row-input-large">Gender</div>
						<div class="row-input-large space">
							<select name="gender" id="ddGender" class="select-1">
								<option value="0">Select...</option>
								<option value="m">Male</option>
								<option value="f">Female</option>
								<option value="u">Not specified</option>
							</select>
						</div>
						<div class="row-input-large space">
							<input type="submit" name="register" value="Create account" id="btnRegister" />
						</div>
					</form>
					<?php
						if(isset($greske))
						{
							foreach($greske as $g)
							{
								echo $g."<br/>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>