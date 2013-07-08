<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    deleteproject.php     ##
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
		<title>Projapp | Delete Project</title>
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
					<h1 class="page-title"><font size="5">{</font>Delete Project}</h1>
					<?php 
						if (isset($_GET['id'])) {
							$deleteproject = mysql_query("DELETE FROM `projects` WHERE `id`=".$_GET['id']);
							if ($deleteproject) {
								echo('project was deleted!');
							}
						}
						else {
							echo('please choose a project to delete.');
						}
					?>
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