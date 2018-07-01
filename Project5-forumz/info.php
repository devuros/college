<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Forums</title>
		<meta name="author" content="Uroš Jovanović">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
		<link rel="shortcut icon" href="images/prava.ico">
		
		<script type="text/javascript" src="script/jquery-3.0.0.js"></script>
		<script type="text/javascript" src="script/script.js"></script>
	</head>
	<body>
		<div id="header-client-wrapper">
			<?php include("header-client.php"); ?>
		</div>
		<header>
			<?php include("header.php"); ?>
		</header>
		<nav>
			<?php include("nav.php"); ?>
		</nav>
		<div id="info-wrapper">
			<div id="privacy-policy">
				<h2>Privacy policy</h2>
				<p>
					Forums Inc. (referred to herein as "Forums"), a fictional company located at 4 Cherry road, Morja, Serbia respect the privacy rights
					of their on-line visitors and recognize the importance of providing a secure environment for the information they collect.
				</p><br/>
				<p>
					It is therefore important to make available to on-line visitors an explanatory document outlining 
					how their personal details are collected, processed and utilized (hereafter the "Privacy Policy"). 
					This Privacy Policy explains the ways in which Forums safeguards the privacy rights of its on-line visitors. 
					By using this website, you accept this Privacy Policy.
					Furthermore, this Privacy Policy may vary from time to time. Please consult this document periodically 
					so that you are aware of any changes. The date of the last update indicates the date of the most recent modifications.
				</p><br/>
				<p>
					This Privacy Policy applies to the whole site.
				</p><br/>
				<h4>What are cookies?</h4><br/>
				<p class="indent">
					Cookies are small data files sent to your hard disk from the Internet sites you visit. Any cookies stored on your computer can 
					be used to recall details such as your password or a previous registration or authentication.
				</p><br/>
				<p class="indent">
					Forums may use cookies on its Internet sites to keep track of the fact that you signed in, so that you do not have to 
					continually enter your password or your registration details.
				</p><br/>
				<p class="indent">
					Forums may use cookies to collect information about the sections of the websites you visit, the products you are 
					interested in, and to track your navigation through its websites.
				</p>
			</div>
			<div id="code-of-conduct">
				<h2>Code of conduct</h2>
				<p>
					The guidelines and rules listed below explain what behavior is expected of you and what behavior you can expect from 
					other community members. Note that the following guidelines are not exhaustive, and may not address all manner of 
					offensive behavior. As such, the forum admin shall have full discretion to address any behavior that they feel is 
					inappropriate. Your access to these forums is a ‘privilege’, and not a ‘right’. Forums reserves the right to suspend your 
					access to these forums at any time for reasons that include, but are not necessarily limited to, your failure to abide by 
					these guidelines.
				</p><br/>
				<h4>Racial / Ethnic</h4>
				<p class="indent">
					This category includes both clear and masked language and/or links to websites containing such language or images which:
					Promote racial/ethical hatred, are recognized as racial/ethical slur, allude to a symbol of hated.
				</p><br/>
				<h4>Extreme Sexuality / Violence</h4>
				<p class="indent">
					This category includes both clear and masked language and/or links to websites containing such language or images which:
					Refer to extreme or violent sexual acts, refer to extremly violent real life actions, pornography.
				</p><br/>
				<h4>Real-Life Threats</h4>
				<p class="indent">
					This category includes both clear and masked language and/or links to websites containing such language or images which:
					Refer to violence in any capacity that is not directly related to the forum.
				</p><br/>
				<h4>Malicious activities</h4>
				<p class="indent">
					Dealing with malicious activities includes: posting links to malicios scripts/viruses/programs.
				</p><br/>
				<h4>Spamming or Trolling</h4>
				<p class="indent">
					This includes: Creating threads for the sole purpose of causing unrest on the forums, Abusing the Reported Post feature by sending false alarms or nonsensical messages,
					Causing disturbances in forum threads, such as picking fights, making off topic posts that ruin the thread, insulting other posters
				</p><br/>
				<h4>Creating Duplicate Threads</h4>
				<p class="indent">
					Creating threads about existing topics, Creating a separate thread about an existing topic for further discussion in more than one category
				</p>
			</div>
			<div id="faq">
				<h2>Frequently asked questions</h2>
				<p><b>Q: My thread got locked? Why is that?</b></p>
				<p>A: Threads can be locked because: they are duplicates of existing thread, read through the forums carefully to see if thread with simular theme has been started.</p><br/>
				<p><b>Q: I can't login, it says: "Your account is deactivated". What does that mean?</b></p>
				<p>A: Your account has been suspended because you violeted the forums code of conduct, check your email.</p><br/>
				<p><b>Q: How does sticky request work?</b></p>
				<p>A: Anyone can send sticky request, but it requires multiple requests, and the post itself needs to be informative in order to be granted sticky.</p><br/>
				<p><b>Q: How can i change my password?</b></p>
				<p>A: To change your password, you need to visit the account settings link in the dropdown menu, then just type your new password and click save changes.</p><br/>
				<p><b>Q: Changing avatar image doesn't work?</b></p>
				<p>A: Avatar image format is limited to jpg/jpeg/png format, other formats are not supported, change the format of your image and upload it.</p><br/>
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<?php include("footer.php"); ?>
		</footer>
	</body>
</html>