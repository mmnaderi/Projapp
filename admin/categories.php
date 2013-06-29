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
							while($projects = mysql_fetch_array($projects_query)) {
						?>
						<li>
							<span class="name"><?php
								echo($counter);
								$counter=$counter+1;
							?>. <?php echo($projects['name']); ?></span>
							<div class="edit"><a href="editproject.php?id=<?php echo($projects['id']); ?>"><img src="images/edit.png" alt="Edit Project" /></a></div>
							<div class="percent"><?php
								if ($projects['percent'] == 100) {
									echo('<img src="images/complete.png" alt="Complete" title="Complete" />');
								}
								else {
									echo('<img src="images/indevelope.png" alt="In Develope" title="In Develope" />');
								}
							?><div class="percent-text"><?php echo($projects['percent']); ?>%</div></div>
							<div class="type"><?php
								if ($projects['type'] == 'download') {
									echo('<a href="'. $projects['file'] .'"><img src="images/download.png" alt="For Download" title="For Download" /></a>');
								}
								else {
									echo('<a href="'. $projects['file'] .'"><img src="images/sale.png" alt="For Sale" title="For Sale" /></a>');
								}
							?></div>
						</li>
						<?php } ?>
							<form action="categories.php" method="POST">
							<input type="hidden" name="request" value="true" />
							<p class="part">Category Name: <input type="text" name="category_name" /><input class="submit-category" type="submit" value="Add Category »" /></p>
							
						</form>
					</ul>
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