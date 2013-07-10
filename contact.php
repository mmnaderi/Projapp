<?php

// CONTACT FORM

// Checks if the form is submitted
if(isset($_POST['mail'])) { 
	
	$mail = $_POST['mail'];
		
	// Checks if the required fields are filled...
	if(empty($mail['name']) || empty($mail['email']) || empty($mail['telephone']) || empty($mail['message'])) {
		
		// if not, sets an error message
		$message = '<p class="error">Please, fill all the required fields and try again!</p>';
		
	} else {
	
		// else - configure the E-mail
		
		$to = "info@mmnaderi.ir";		// Your E-mail address 
		$subject = "Projapp Contact";	// Subject of the E-mail
		
		$body = "From: ".$mail['name'].
				"\n\n E-Mail: ".$mail['email'].
				"\n\n Subject: ".$mail['telephone'].
				"\n\n Message:\n ".$mail['message'];
		 
		// set an success message and send
		$message = '<p class="success">Your message have been sent successfully!</p>';
		mail($to, $subject, $body);
		unset($mail);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Projapp | Contact</title>

	<meta name="description" content="Portfolio Management System" />
	<meta name="author" content="Mohammad Mahdi Naderi" />
	<meta name="keywords" content="portfolio, web application, portfolio management system, projects system, cms, projapp" />


	<style type="text/css" media="all">
		@import url("css/style.css");
		@import url("css/nivo-slider.css");
		@import url("css/custom-nivo-slider.css");
		@import url("css/jquery.fancybox.css");
	</style>
	
	<!--[if lt IE 8]><style type="text/css" media="all">@import url("css/ie.css");</style><![endif]-->

</head>




<body>
	
	<div id="bgc">
							
		<div class="wrapper">		<!-- wrapper begins -->






			<div id="header">
				<h1><a href="#"><span>Projapp</span></a></h1>
				<span class="description">The Portfolio<br/>Management system</span>
				
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="https://github.com/mmnaderi/Projapp/wiki">Wiki</a></li>
					<li><a href="blog.html">Blog</a></li>
					<li><a href="contact.php" class="active">Contact</a></li>
				</ul>
			</div>		<!-- #header ends -->
			
			
			
			
			
			
			
			
			
			
			<div id="holder">
			
			
			
			
			
				<div class="pagetitle">
					<h2>Contact</h2>
				</div>
				
				
				
				
				
				
				
				
				
				<div id="content">
					
					
					
					
					<div id="wide" class="contact">
						
						<!--<p>Fusce mauris ante, adipiscing id scelerisque eget, vulputate non sem. Vestibulum lobortis, quam sit amet venenatis laoreet, elit lectus sollicitudin erat, ac facilisis nulla ante sed leo. Mauris non neque velit, sed aliquam orci. Suspendisse suscipit, lectus sit amet auctor accumsan, dolor est pellentesque quam, eu fermentum elit sem varius massa. Curabitur id elit enim. Suspendisse tincidunt ante nec nunc pulvinar at blandit purus porta. Aenean ligula tellus, consequat non porttitor quis, rhoncus non nisi.</p>-->
												
			
						<div class="clear sep"></div>
			
						
						<?php
							// This returns the success / error message.
							if(isset($_POST['mail'])) { echo $message; }
						?>
						
						<form action="" method="post">
						
							<fieldset class="left">
								<p><label>Your name:</label> <br />
								<input type="text" class="text" name="mail[name]" <?php if(isset($mail)) { echo 'value="'.$mail['name'].'"'; } ?> /></p>
					
								<p><label>Your E-mail:</label> <br />
								<input type="text" class="text" name="mail[email]" <?php if(isset($mail)) { echo 'value="'.$mail['email'].'"'; } ?> /></p>
								
								<p><label>Subject:</label> <br />
								<input type="text" class="text" name="mail[telephone]" <?php if(isset($mail)) { echo 'value="'.$mail['telephone'].'"'; } ?> /></p>
							</fieldset>
							
							<fieldset class="right">
								<p><label>Your message:</label> <br />
								<textarea name="mail[message]"><?php if(isset($mail)) { echo $mail['message']; } ?></textarea></p>
								
								<p><input type="submit" class="submit" value="Send" /> <span>All the fields are mandatory.</span></p>
							</fieldset>
							
						</form>
						
					</div>		<!-- #wide ends -->
					
					
					
					
					
					
					
					
				</div>		<!-- #content ends -->
			
			
			
			
			</div>		<!-- #holder ends -->
			
			
			
			
			
			
			
			
			<div id="logos">
				<ul>
					<li><a href="http://php.net/"><img src="images/php.png" alt="PHP" /></a></li>
					<li><a href="http://mysql.com/"><img src="images/mysql.png" alt="MySQL" /></a></li>
					<li><a href="http://jquery.com/"><img src="images/jquery.png" alt="jQuery" /></a></li>
					<li><a href="http://wordpress.org/"><img src="images/wp.png" alt="WordPress" /></a></li>
					<li><a href="http://expressionengine.com/"><img src="images/ee.png" alt="Expression Engine" /></a></li>
				</ul>
			</div>		<!-- #logos ends -->
			
			
			
			
			
			
			
			
			
			
			<div id="footer">
				<p class="left"><a href="#"><span>Blur Studio</span></a></p>
				<p class="right">Copyright &copy; 2010. Some rights reserved.</p>
			</div>		<!-- #footer ends -->
			
			
		
		</div>		<!-- wrapper ends -->
		
	
	</div>




	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
	<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="js/jquery.easing.pack.js"></script>
	<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	
	<!-- Twitter badge-->
	<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
	<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/enstyled.json?callback=twitterCallback2&amp;count=1"></script>
	
		
</body>
</html>