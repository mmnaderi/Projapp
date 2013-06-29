<?php
	##########################
	## In The Name Of Allah ##
	##########################
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
					<p>This is Project for Projects!!!</p>
					<p>Projapp is a type of Project Managments for show your projects that you developed for Sale, Download &... in your site.</p>
					<p>This Project is OpenSource & Free! :D</p>
					<p>Projapp WebSite: <a href="http://projapp.mmnaderi.ir" title="Projapp.MMNaderi.IR">projapp.mmnaderi.ir</a></p>
					<p>Developed By <font face="Comic Sans MS" size="3"><a href="http://mmnaderi.ir" title="MMNaderi.IR">MMNaderi</a></font> With <font face="Comic Sans MS" size="3"><a href="http://php.net" title="PHP.Net">PHP</font></p>
				</div>
				<div class="clearfix"></div>
			</div>
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