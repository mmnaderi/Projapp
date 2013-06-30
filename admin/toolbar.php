<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    toolbar.php           ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
?>
<ul class="toolbar">
					<li><a href="<?php echo($info['url']); ?>/admin"><img src="images/toolbar/dashboard.png" alt="Dashboard" /><span class="tooltip">Dashboard</span></a></li>
					<li><a href="<?php echo($info['url']); ?>/admin/addproject.php"><img src="images/toolbar/addproject.png" alt="New Project" /><span class="tooltip">New Project</span></a></li>
					<li><a href="<?php echo($info['url']); ?>/admin/settings.php"><img src="images/toolbar/settings.png" alt="Settings" /><span class="tooltip">Settings</span></a></li>
					<li><a href="<?php echo($info['url']); ?>/admin/categories.php"><img src="images/toolbar/categories.png" alt="Categories" /><span class="tooltip">Categories</span></a></li>
					<hr class="seperator" color="#CDCDCD" />
					<li><a href="<?php echo($info['url']); ?>/admin/about.php"><img src="images/toolbar/about.png" alt="About Projapp" /><span class="tooltip">About Projapp</span></a></li>
					<li><a href="<?php echo($info['url']); ?>"><img src="images/toolbar/home.png" alt="Home" /><span class="tooltip">Home Page</span></a></li>
					<li><a href="<?php echo($info['url']); ?>/admin/login.php?act=exit"><img src="images/toolbar/exit.png" alt="Exit" /><span class="tooltip">Exit</span></a></li>
				</ul>