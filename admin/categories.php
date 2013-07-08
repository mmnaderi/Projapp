<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    categories.php        ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	ob_start();
	@session_start();
	if(isset($_SESSION['admin'])) {
	include ('../config.php');
	if(isset($_POST['id']) && isset($_POST['name'])) {
		$editcategory = mysql_query ("UPDATE `categories` SET `name`='".$_POST['name']."' WHERE `id`=". $_POST['id']);
		if($editcategory) {
			echo($_POST['name']);
		}
		exit;
	}
	$query = mysql_query("SELECT * FROM `info`");
	while($info = mysql_fetch_array($query)) {
	/////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////
	if (isset($_POST['request']) && $_POST['request'] == 'true') {
		if ($_POST['category_name'] != '') {
			$addcategory = mysql_query ("INSERT INTO `categories` (`id`,`name`) VALUES ('', '". $_POST['category_name'] ."')");
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Projapp | Categories</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="favicon.ico" rel="shortcut icon">
		<link href="style.css" rel="stylesheet" type="text/css">
		<script src="js/jquery-1.10.1.min.js" type="text/javascript"></script>
		<script src="js/scripts.js" type="text/javascript"></script>
	</head>
	<body>
		<div class="container">
			<a href="<?php echo($info['url']); ?>/admin" title="Projapp"><img src="images/logo-full.png" alt="Projapp" /></a>
			<div class="wrapper">
				<?php require('toolbar.php'); ?>
				<div class="primery">
					<h1 class="page-title"><font size="5">{</font>Categories List}</h1>
					<?php if(isset($addcategory) && $addcategory) {?>
					<p><img src="images/complete.png" alt="Complete" /><font color="green"> Perfect! category was added.</font></p>
					<?php } elseif (isset($_POST['request']) && $_POST['request'] == 'true') {?>
					<p><img src="images/error.png" alt="Error" /><font color="red"> Unfortunately There is an error to add category.</font></p>
					<?php } ?>
					<ul class="projects">
						<?php
							}
							mysql_close($connect);
							include ('../config.php');
							$counter = 1;
							$projects_query = mysql_query("SELECT * FROM `categories`");
							//////////////////////////////////////////////////////////////
							$rows = mysql_result(mysql_query("SELECT COUNT(*) FROM `categories`"), 0);
							if (!$rows) { echo("<p>you don't have any categories. :(</p>"); }
							//////////////////////////////////////////////////////////////
							while($categories = mysql_fetch_array($projects_query)) {
							if($categories['name'] != 'Without Category') {
						?>
						<li>
							<div class="name"><?php
								echo($counter);
								$counter=$counter+1;
							?>. <div class="category_name" id="category_name<?php echo($categories['id']); ?>"><?php echo($categories['name']); ?></div>
								<input type="text" id="category_edit<?php echo($categories['id']); ?>" name="category_name" class="category-edit" value="<?php echo($categories['name']); ?>" />
								<img onclick="submit_category(<?php echo($categories['id']); ?>)" id="submit_category_edit<?php echo($categories['id']); ?>" class="submit_category_edit" src="images/submit.png" alt="" />
								<span class="cancel" id="cancel<?php echo($categories['id']); ?>"> or <a onclick="cancel_edit(<?php echo($categories['id']); ?>)">Cancel</a></span>
							</div>
							<div class="edit-category"><img src="images/edit.png" alt="Edit Category" onclick="edit_category(<?php echo($categories['id']); ?>)" /></div>
						</li>
						<?php } } ?>
							<form action="categories.php" method="POST">
							<input type="hidden" name="request" value="true" />
							<p class="part">Category Name: <input type="text" name="category_name" /><input class="submit-category" type="submit" value="Add Category »" /></p>
							
						</form>
					</ul>
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