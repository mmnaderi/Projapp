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
	$posted = array();
	foreach ( $_POST as $item_key => $item_value ) {
		$posted[$item_key] = $item_value;
	}
	$query = mysql_query("SELECT * FROM `info`");
	while($info = mysql_fetch_array($query)) {
	/////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////
	if (isset($posted['request']) && $posted['request'] == 'true') {
		if ($posted['project_name'] != '' && $posted['project_description'] != '' && $posted['progress_level'] != '') {
			if($_FILES['file']['name'] != '') { 
				$file_query = "`file`='".$_FILES['file']['name']."', "; 
			} else {
				$file_query = "";
			}
			$editproject = mysql_query ("UPDATE `projects` SET `name`='".$posted['project_name']."', `description`='". $posted['project_description'] ."', `type`='". $posted['project_type'] ."', `percent`='". $posted['progress_level'] ."', ".$file_query.", `category`='".$_FILES['project_category'] ."', `content`='".$_FILES['content'] ."' WHERE `id`=". $_GET['id']);
			if(isset($posted['project_type']) && $posted['project_type'] == 'public') {
				$target_path = "../public/";
			}
			elseif (isset($posted['project_type'])) {
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
		<script src="js/jquery-1.10.1.min.js"></script>
		<script src="js/scripts.js"></script>
		<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container-big">
			<a href="<?php echo($info['url']); ?>/admin" title="Projapp"><img src="images/logo-full.png" alt="Projapp" /></a>
			<div class="wrapper">
				<?php require('toolbar.php'); ?>
				<div class="primery-big">
					<h1 class="page-title"><font size="5">{</font>Edit Project}</h1>
					<?php if(isset($editproject) && $editproject) {?>
					<p class="success"><img src="images/complete.png" alt="Complete" />Perfect! project was edited.</p>
					<?php } elseif (isset($posted['request']) && $posted['request'] == 'true') {?>
					<p class="error"><img src="images/error.png" alt="Error" />Unfortunately There is an error to edit project.</p>
					<?php } ?>
					<?php
						}
						mysql_close($connect);
						include ('../config.php');
						$projects_query = mysql_query("SELECT * FROM `projects` WHERE `id`=" . $_GET['id']);
						while($project = mysql_fetch_array($projects_query)) {
						$project_type = $project['category'];
					?>
					<form name="form" enctype="multipart/form-data" action="editproject.php?id=<?php echo($_GET['id']); ?>" method="POST">
						<div class="left">
							<a class="help">
							<span class="tooltip-right">
								<p>Enter your project title.</p>
							</span>
							</a>
							<p class="part">Project Name:</p><input class="project-name" type="text" name="project_name" value="<?php echo($project['name']); ?>" />
							<a class="help">
							<span class="tooltip-right">
								<p>Enter a short description of your project.</p>
							</span>
							</a>
							<p class="part">Project Description:</p><input type="text" class="project-description" name="project_description" value="<?php echo($project['description']); ?>">
							<a class="help">
							<span class="tooltip-right">
								<p>Enter the category of your project. If your project doesn't have any category select 'Without Category'</p>
							</span>
							</a>
							<p class="part">Project Category:</p>
								<select class="project-category" name="project_category">
									<?php
									$categories_query = mysql_query("SELECT * FROM `categories`");
									while($categories = mysql_fetch_array($categories_query)) {
										//echo($category_name);
										if($project['category'] == $categories['name']) {
											echo('<option selected="selected" value="'.$categories['name'].'">'.$categories['name'].'</option>');
										}
										else {
											echo('<option value="'.$categories['name'].'">'.$categories['name'].'</option>');
										}
									}
									?>
								</select>
						</div>
						<div class="right">
							<a class="help">
							<span class="tooltip-right">
								<p>Enter progress level of your project. (between 0 and 100)</p>
							</span>
							</a>
							<p class="part">Progress Level:</p><input type="text" name="progress_level" value="<?php echo($project['percent']); ?>" />
							<a class="help">
							<span class="tooltip-right">
								<p><strong>Public</strong><br/>Everyone can download your project file</p>
								<p><strong>Private</strong><br/>People can't download or buy your project</p>
								<p><strong>Sale</strong><br/>People can buy your project</p>
							</span>
							</a>
							<p class="part">Project Type:</p>
								<select class="project-type" name="project_type">
								<option value="public" <?php
								if($project['type'] == 'public') {
								echo('selected="selected"');
								}
								?>>Public</option>
								<option value="private" <?php
								if($project['type'] == 'private') {
								echo('selected="selected"');
								}
								?>>Private</option>
								<option value="sale" <?php
								if($project['type'] == 'sale') {
								echo('selected="selected"');
								}
								?>>Sale</option>
								</select>
							<a class="help">
							<span class="tooltip-right">
								<p>Select your project file, Less than <?php echo(ini_get('upload_max_filesize')); ?> on this Server. If you want to enter new file please check the "New File" checkbox & select file.</p>
							</span>
							</a>
							<p class="part">Project File: <?php echo($project['file'] != '' ? $project['file'] : 'Without file'); ?> | <input name="check" type="checkbox" onclick="file_enable()"> New File</p><input class="project-file" id="file" name="file" type="file" disabled><br />
							<input type="hidden" name="request" value="true" />
						</div>
						<div class="clearfix"></div>
						<div class="editor">
							<textarea class="ckeditor" name="content"><?php echo($project['content']); ?></textarea>
						</div>
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
			<?php require_once('footer.php'); ?>
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