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
	$posted = array();
	foreach ( $_POST as $item_key => $item_value ) {
		$posted[$item_key] = $item_value;
	}
	
	while($info = mysql_fetch_array($query)) {
	/////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////
	if (isset($_POST['request']) && $_POST['request'] == 'true') {
		if ($posted['username'] == $info['username'] && md5( $posted['password'] ) == $info['password']) {
			$_SESSION['admin'] = $posted['username'];
		}
	}
	if(isset($_GET['act']) && $_GET['act'] == 'exit') {
		unset($_SESSION['admin']);
		$exit_message = true;
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
			<div class="login-wrapper">
				<!--<h1 class="page-title"><font size="5">{</font>Login}</h1>-->
				<a href="<?php echo($info['url']); ?>/admin" title="Projapp"><img src="images/login-logo.png" style="margin-bottom:8px;" /></a>
				<form action="login.php" method="POST">
					<?php if (isset($_POST['request']) && $_POST['request'] == 'true') {?>
					<p class="error login-message"><img src="images/error.png" alt="Error" />Username or password is incorrect.</p>
					<?php } ?>
					<?php if (isset($exit_message) && $exit_message == true) { ?>
					<p class="success login-message"><img src="images/complete.png" alt="Complete" />You are now logged out.</p>
					<?php } ?>
					<p class="part"><input type="text" name="username" placeholder="Username" class="login-input" /></p>
					<p class="part"><input type="password" name="password" placeholder="Password" class="login-input" /></p>
					<input type="hidden" name="request" value="true" />
					<div class="submit-login"><input type="submit" value="Login »" class="login-submit punch" /></div>
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
