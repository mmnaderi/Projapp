<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    login.php             ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	ob_start();
	@session_start();
	include ('../config.php');
	$query = mysql_query("SELECT * FROM `info`");
	while($info = mysql_fetch_array($query)) {
	/////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////
	if (isset($_POST['request']) && $_POST['request'] == 'true') {
		if ($_POST['username'] == $info['username'] && $_POST['password'] == $info['password']) {
			if($_SESSION['admin'] = $_POST['username']) {
			echo('asd');
			}
		}
	}
	if(isset($_GET['act']) && $_GET['act'] == 'exit') {
		unset($_SESSION['admin']);
	}
	if(isset($_SESSION['admin'])) {
		header('Location: index.php');
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Projapp | Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="favicon.ico" rel="shortcut icon">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="container" style="width:250px;">
			<a href="<?php echo($info['url']); ?>/admin" title="Projapp"><img src="images/logo-full.png" alt="Projapp" /></a>
			<div class="wrapper">
				<h1 class="page-title"><font size="5">{</font>Login}</h1>
				<form action="login.php" method="POST">
					<?php if (isset($_POST['request']) && $_POST['request'] == 'true') {?>
					<p><img src="images/error.png" alt="Error" /><font color="red"> username or password is incorrect.</font></p>
					<?php } ?>
					<p class="part">Username: <input type="text" name="username" /></p>
					<p class="part">Password: <input type="password" name="password" /></p>
					<input type="hidden" name="request" value="true" />
					<div class="submit-project"><input type="submit" value="Login »" /></div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
	</body>
</html>
<?php
	}
	mysql_close($connect);
	ob_end_flush();
?>