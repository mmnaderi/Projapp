<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    index.php             ##
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
		<title>Projapp | Dashboard</title>
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
					<h1 class="page-title"><font size="5">{</font>Projects List}</h1>
					<ul class="projects">
					<?php
						include ('../config.php');
						$counter = 1;
						//////////////////////////////////////////////////////////////
						$rows = mysql_result(mysql_query("SELECT COUNT(*) FROM `projects`"), 0);
						if (!$rows) { echo("you don't have any project. :("); }
						//////////////////////////////////////////////////////////////
						$categories_query = mysql_query("SELECT * FROM `categories`");
						while($categories = mysql_fetch_array($categories_query)) {
						if($categories['name'] != 'Without Category') {
							echo('<h2 class="category-title">'.$categories['name'].'</h2>');
						}
						
						$empty_category = mysql_result(mysql_query("SELECT * FROM `projects` WHERE `category`='".$categories['name']."'"), 0);
						if (!$empty_category && $categories['name'] != 'Without Category') { echo('<span class="note">There isn\'t any project in this category.</span>'); }
						$projects_query = mysql_query("SELECT * FROM `projects` WHERE `category`='".$categories['name']."'");
						while($projects = mysql_fetch_array($projects_query)) {
					?>
						<li>
							<span class="name"><?php
								/*echo($counter);
								$counter=$counter+1;*/
							?><?php echo($projects['name']); ?></span>
							<div class="edit"><a href="editproject.php?id=<?php echo($projects['id']); ?>"><img src="images/edit.png" alt="Edit Project" /></a></div>
							<div class="percent"><?php
								if ($projects['percent'] == 100) {
									echo('<img src="images/complete.png" alt="Complete" title="Complete" />');
								}
								else {
									echo('<img src="images/indevelop.png" alt="In Develope" title="In Develop" />');
								}
							?><div class="percent-text"><?php echo($projects['percent']); ?>%</div></div>
							<div class="type"><?php
								if($projects['file'] != '') {
									echo('<a href="download.php?url='.'../'.$projects['type'].'/'.$projects['file'].'"><img src="images/download.png" alt="Download" title="Download" /></a>');
								}
								else {
									echo('<img src="images/not-download.png" alt="Without File" title="Without File" />');
								}
								if($projects['type'] == 'public') {
									echo('<img src="images/public.png" alt="Public" title="Public" />');
								}
								if($projects['type'] == 'sale') {
									echo('<img src="images/sale.png" alt="For Sale" title="For Sale" />');
								}
								if($projects['type'] == 'private') {
									echo('<img src="images/private.png" alt="Private" title="Private" />');
								}
							?></div>
						</li>
						<?php } } ?>
						</ul>
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