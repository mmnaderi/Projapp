<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    index.php             ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	include('config.php');
	include('libraries.php');
	
	// check if Projapp not installed (in database isn't any table)
	if(mysql_num_rows(mysql_query("SHOW TABLES")) == 0) {
		echo($not_installed);
		exit;
	}
	
	// include header of theme
	include($themeurl.'/header.pt');
	
	// check if developer doesn't have any project
	$rows = mysql_result(mysql_query("SELECT COUNT(*) FROM `projects`"), 0);
	if(!$rows) { echo($info['developername']." doesn't have any project. :("); }
	
	$counter = 1;
	// start categories
	$categories_query = mysql_query("SELECT * FROM `categories`");
	while($categories = mysql_fetch_array($categories_query)) {
	echo('<h2 class="category-title">'.$categories['name'].'</h2>');
	
	// start projects in any categories
	$empty_category = mysql_result(mysql_query("SELECT * FROM `projects` WHERE `category`='".$categories['name']."'"), 0);
	if (!$empty_category) { echo('<span class="note">there isn\'t any project on this category.</span>'); }
	$projects_query = mysql_query("SELECT * FROM `projects` WHERE `category`='".$categories['name']."'");
	while($projects = mysql_fetch_array($projects_query)) {
?>
			<li>
				<span class="name"><?php
					echo($counter.". ".$projects['name']);
					$counter=$counter+1;
				?></span>
				<span class="description"><?php echo($projects['description']); ?></span>
				<div class="percent-full"><?php
					if ($projects['percent'] == 100) {
						echo('<img src="admin/images/complete.png" alt="Complete" title="Complete" />');
					}
					else {
						echo('<img src="admin/images/indevelope.png" alt="In Develope" title="In Develope" />');
					}
				?>
					<div class="percent-text"><?php echo($projects['percent']); ?>%</div>
				</div>
				<div class="type"><?php
					if ($projects['type'] == 'download') {
						if($projects['file'] == $info['url'].'/projects/') {
							echo('<img src="admin/images/download.png" alt="For Download" title="For Download" />');
						}
						else {
							echo('<a href="'. $projects['file'] .'"><img src="admin/images/download.png" alt="For Download" title="For Download" /></a>');
						}
					}
					else {
						echo('<a href="mailto:'. $developermail .'"><img src="admin/images/sale.png" alt="For Sale" title="For Sale" /></a>');
					}
				?></div>
			</li>
<?php include($themeurl.'/footer.pt'); ?>
<?php } } ?>