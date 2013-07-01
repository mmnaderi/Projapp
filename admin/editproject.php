<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    editproject.php       ##
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
	/////////////////////////////////////////////////////////////////////
	if (isset($_POST['request']) && $_POST['request'] == 'true') {
		if ($_POST['project_name'] != '' && $_POST['project_description'] != '' && $_POST['progress_level'] != '') {
			$editproject = mysql_query ("UPDATE `projects` SET `name`='".$_POST['project_name']."', `description`='". $_POST['project_description'] ."', `type`='". $_POST['project_type'] ."', `percent`='". $_POST['progress_level'] ."', `file`='". $info['url'] ."/projects/". $_FILES['file']['name'] ."' WHERE `id`=". $_GET['id']);
			if(isset($_POST['project_type']) && $_POST['project_type'] == 'download') {
				$target_path = "../public/";
			}
			else {
				$target_path = "../private/";
			}
			$target_path = $target_path . basename( $_FILES['file']['name']); 

			if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
				$uploadfile = 1;
			} else{
				$uploadfile = 0;
			}
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Projapp | Edit Project</title>
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
					<h1 class="page-title"><font size="5">{</font>Edit Project}</h1>
					<?php if(isset($editproject) && $editproject) {?>
					<p><img src="images/complete.png" alt="Complete" /><font color="green"> Perfect! project was edited.</font></p>
					<?php } elseif (isset($_POST['request']) && $_POST['request'] == 'true') {?>
					<p><img src="images/error.png" alt="Error" /><font color="red"> Unfortunately There is an error to edit project.</font></p>
					<?php } ?>
					<?php
						}
						mysql_close($connect);
						include ('../config.php');
						$projects_query = mysql_query("SELECT * FROM `projects` WHERE `id`=" . $_GET['id']);
						while($projects = mysql_fetch_array($projects_query)) {
					?>
					<form enctype="multipart/form-data" action="editproject.php?id=<?php echo($_GET['id']); ?>" method="POST"> 
						<p class="part">Project Name: <input type="text" name="project_name" value="<?php echo($projects['name']); ?>" /></p>
						<div class="left">
							<p class="part">Project Description:</p><textarea class="project-description" name="project_description"><?php echo($projects['description']); ?></textarea>
						</div>
						<div class="left">
							<p class="part">Progress Level: <input type="text" name="progress_level" value="<?php echo($projects['percent']); ?>" /></p>
							<p class="part">Project Type:
								<select class="project-type" name="project_type">
									<option value="sale" <?php
										if($projects['type'] == 'sale') {
											echo('selected="selected"');
										}
									?>>For Sale</option>
									<option value="download" <?php
										if($projects['type'] == 'download') {
											echo('selected="selected"');
										}
									?>>For Download</option>
								</select>
							</p>
						</div>
						<p class="part">Project File:</p><input name="file" type="file" /><br />
						<input type="hidden" name="request" value="true" />
						<div class="delete-project"><a href="deleteproject.php?id=<?php echo($_GET['id']); ?>" class="button">Delete Project ×</a></div>
						<div class="submit-project"><input type="submit" value="Edit Project »" /></div>
					</form>
					<?php
						}
					?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</body>
</html>
<?php
	mysql_close($connect);
	}
	else {
		header('Location: login.php');
	}
	ob_end_flush();
?>