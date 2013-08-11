<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    project.php           ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	include('config.php');
	include('libraries.php');
	
	// include header of theme
	include($themeurl.'/header.pt');
	$getted = filter_injection( $_GET['id'] );
	if(isset($getted) && $getted != '') {
	
	$projects_query = mysql_query("SELECT * FROM `projects` WHERE `id`='".$getted."'");
	while($project = mysql_fetch_array($projects_query)) {
?>
	<h2 class="category-title"><?php echo($project['name']); ?></h2>
	<?php echo($project['content']); ?>
<?php
	}
	include($themeurl.'/footer.pt');
	}
	else {
		header('Location: index.php');
	}
?>