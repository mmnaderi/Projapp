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
			$editproject = mysql_query ("UPDATE `projects` SET `name`='".$_POST['project_name']."', `description`='". $_POST['project_description'] ."', `type`='". $_POST['project_type'] ."', `percent`='". $_POST['progress_level'] ."', `file`='".$_FILES['file']['name'] ."' WHERE `id`=". $_GET['id']);
			if(isset($_POST['project_type']) && $_POST['project_type'] == 'public') {
				$target_path = "../public/";
			}
			elseif (isset($_POST['project_type'])) {
				$target_path = "../private/";
			}
			
			/* delete old file
			$projects_query = mysql_query("SELECT * FROM `projects` WHERE `id`=" . $_GET['id']);
			while($projects = mysql_fetch_array($projects_query)) {
				unlink('../'.$projects['type'].'/'.$projects['file']);
			}*/
			
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
		<script src="js/scripts.js"></script>
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
						$project_type = $projects['category'];
					?>
					<form name="form" enctype="multipart/form-data" action="editproject.php?id=<?php echo($_GET['id']); ?>" method="POST"> 
						<p class="part">Project Name: <input type="text" name="project_name" value="<?php echo($projects['name']); ?>" /></p>
						<div class="left">
							<p class="part">
							Project Description:
							<textarea class="project-description" name="project_description"><?php echo($projects['description']); ?></textarea>
							</p>
						</div>
						<div class="left">
							<a class="help">
							<span class="tooltip-right">
								<p>Enter number of progress level of your project. (between 0 and 100)</p>
							</span>
							</a>
							<p class="part">Progress Level: <input type="text" name="progress_level" value="<?php echo($projects['percent']); ?>" /></p>
							<a class="help">
							<span class="tooltip-right">
								<p><strong>Public</strong><br/>Everyone can download your project file</p>
								<p><strong>Private</strong><br/>People can't download or buy your project</p>
								<p><strong>Sale</strong><br/>People can buy your project</p>
							</span>
							</a>
							<p class="part">Project Type:
								<select class="project-type" name="project_type">
									<option value="public" <?php
										if($projects['type'] == 'public') {
											echo('selected="selected"');
										}
									?>>Public</option>
									<option value="private" <?php
										if($projects['type'] == 'private') {
											echo('selected="selected"');
										}
									?>>Private</option>
									<option value="sale" <?php
										if($projects['type'] == 'sale') {
											echo('selected="selected"');
										}
									?>>Sale</option>
								</select>
							</p>
							<a class="help">
							<span class="tooltip-right">
								<p>Enter the category of your project. If your project doesn't have any category select 'Without Category'</p>
							</span>
							</a>
						<p class="part">Project Category:
							<select class="project-category" name="project_category">
								<?php
									$categories_query = mysql_query("SELECT * FROM `categories`");
									while($categories = mysql_fetch_array($categories_query)) {
										echo($category_name);
										if($category_name == $categories['name']) {
											echo('<option selected="selected" value="'.$categories['name'].'">'.$categories['name'].'</option>');
										}
										else {
											echo('<option value="'.$categories['name'].'">'.$categories['name'].'</option>');
										}
									}
								?>
							</select>
						</p>
							<a class="help">
							<span class="tooltip-right">
								<p>Select your project file, Less than <?php echo(ini_get('upload_max_filesize')); ?> on this Server. If you want to enter new file please check the "New File" checkbox & select file.<!-- But your old file will be deleted!--></p>
							</span>
							</a>
						<p class="part">Project File: <?php echo($projects['file'] != '' ? $projects['file'] : 'Without file'); ?></p><input name="check" type="checkbox" onclick="file_enable()"> New File<br/><input id="file" name="file" type="file"  disabled><br />
						<input type="hidden" name="request" value="true" />
						<div class="delete-project"><a href="deleteproject.php?id=<?php echo($_GET['id']); ?>" class="button">Delete Project ×</a></div>
						<div class="submit-project"><input type="submit" value="Edit Project »" /></div>
						</div>
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