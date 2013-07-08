<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    about.php             ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	ob_start();
	@session_start();
	if(isset($_SESSION['admin'])) {
	include ('../config.php');
	$query = mysql_query("SELECT * FROM `info`");
	while($info = mysql_fetch_array($query)) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Projapp | About Projapp</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="favicon.ico" rel="shortcut icon">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container">
			<a href="<?php echo($info['url']); ?>/admin" title="Projapp"><img src="images/logo-full.png" alt="Projapp" /></a>
			<div class="wrapper">
				<?php require('toolbar.php'); ?>
				<div class="primery">
					<h1 class="page-title"><font size="5">{</font>About Projapp}</h1>
					<p class="justify">Projapp is a web application that you can use it for show your portfolio & projects. With this application you can publish your free & premium products and you can show status of your projects progress to other people.</p>
					<p>This Project is OpenSource & Free! :D</p>
					<p>Developed By <font face="Comic Sans MS" size="3"><a href="http://mmnaderi.ir" title="MMNaderi.IR">MMNaderi</a></font> With <font face="Comic Sans MS" size="3"><a href="http://php.net" title="PHP.Net">PHP</font></p>
					<p><a href="http://projapp.mmnaderi.ir" title="Persian Projapp Website">Projapp WebSite [fa]</a> | <a href="http://mmnaderi.github.io/Projapp" title="Projapp Github Pages">Projapp Github Pages [en]</a> | <a href="https://github.com/mmnaderi/Projapp" title="Projapp on Github">View on Github</a></p>
					<br/>
					<iframe src="http://ghbtns.com/github-btn.html?user=mmnaderi&repo=Projapp&type=watch&count=true"allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe>
					<iframe src="http://ghbtns.com/github-btn.html?user=mmnaderi&repo=Projapp&type=fork&count=true"allowtransparency="true" frameborder="0" scrolling="0" width="95" height="20"></iframe>
					<iframe src="http://ghbtns.com/github-btn.html?user=mmnaderi&type=follow&count=true"allowtransparency="true" frameborder="0" scrolling="0" width="165" height="20"></iframe>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php require_once('footer.php'); ?>
		</div>
	</body>
</html>
<?php
	}
	mysql_close($connect);
	}
	else {
		header('Location: login.php');
	}
	ob_end_flush();
?>