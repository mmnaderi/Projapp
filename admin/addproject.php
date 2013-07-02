<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    addproject.php        ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	ob_start();
	@session_start();
	if(isset($_SESSION['admin'])) {
	include ('../config.php');
	$query = mysql_query("SELECT * FROM `info`");
	while($info = mysql_fetch_array($query)) {
	/////////////////////////////////////////////////////////////////////
	function get_categories() {
		include ('../config.php');
		$query = mysql_query("SELECT * FROM `categories`");
		while($categories = mysql_fetch_array($query)) {
			echo('<option value="'.$categories['name'].'">'.$categories['name'].'</option>');
		}
	}
	/////////////////////////////////////////////////////////////////////
	if (isset($_POST['request']) && $_POST['request'] == 'true') {
		if ($_POST['project_name'] != '' && $_POST['project_description'] != '' && $_POST['progress_level'] != '') {
			if($_POST['progress_level'] > 100 || $_POST['progress_level'] < 0) {
				$message = "Please enter progress level between 0 and 100.";
			}
			else {
			$addproject = mysql_query ("INSERT INTO `projects` (`id`,`name`,`description`,`type`,`percent`,`file`,`category`) VALUES ('', '". $_POST['project_name'] ."','". $_POST['project_description'] ."','". $_POST['project_type'] ."','". $_POST['progress_level'] ."','".$_FILES['file']['name']."','". $_POST['project_category'] ."')");
			if(isset($_POST['project_type']) && $_POST['project_type'] == 'public') {
				$target_path = "../public/";
			}
			else {
				$target_path = "../private/";
			}
			$target_path = $target_path . basename( $_FILES['file']['name']);

			if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
				$uploadfile = 1;
			}
			else {
				$uploadfile = 0;
			}
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Projapp | Add Project</title>
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
					<h1 class="page-title"><font size="5">{</font>Add New Project}</h1>
					<?php if(isset($message) && $message != '') { ?>
					<p><img src="images/error.png" alt="Error" /><font color="red"> <?php echo($message); ?></font></p>
					<?php } ?>
					<?php if(isset($addproject) && $addproject) {?>
					<p><img src="images/complete.png" alt="Complete" /><font color="green"> Perfect! project was added.</font></p>
					<?php } elseif (isset($_POST['request']) && $_POST['request'] == 'true') {?>
					<p><img src="images/error.png" alt="Error" /><font color="red"> Unfortunately There is an error to add project.</font></p>
					<?php } ?>
					<form enctype="multipart/form-data" action="addproject.php" method="POST">
						<p class="part">Project Name: <input type="text" name="project_name" /></p>
						<div class="left">
							<p class="part">Project Description:</p><textarea class="project-description" name="project_description"></textarea>
						</div>
						<div class="left">
							<a class="help">
							<span class="tooltip-right">
								<p>Enter number of progress level of your project. (between 0 and 100)</p>
							</span>
							</a>
							<p class="part">Progress Level: <input type="text" name="progress_level" /></p>
							<a class="help">
							<span class="tooltip-right">
								<p><strong>Public</strong><br/>Everyone can download your project file</p>
								<p><strong>Private</strong><br/>People can't download or buy your project</p>
								<p><strong>Sale</strong><br/>People can buy your project</p>
							</span>
							</a>
							<p class="part">Project Type:
								<select class="project-type" name="project_type">
								<option value="public">Public</option>
								<option value="private">Private</option>
								<option value="sale">Sale</option>
								</select>
							</p>
							<a class="help">
							<span class="tooltip-right">
								<p>Enter the category of your project. If your project doesn't have any category select 'Without Category'</p>
							</span>
							</a>
							<p class="part">Project Category:
								<select class="project-category" name="project_category">
									<?php get_categories(); ?>
								</select>
							</p>
							<a class="help">
							<span class="tooltip-right">
								<p>Select your project file. Less than <?php echo(ini_get('upload_max_filesize')); ?> on this Server.</p>
							</span>
							</a>
						<p class="part">Project File:</p><input name="file" type="file" /><br />
						</div>
						<input type="hidden" name="request" value="true" />
						<div class="submit-project"><input type="submit" value="Submit Project »" /></div>
					</form>
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