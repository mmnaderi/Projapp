<?php
	## In the name of ALLAH
	## Project Name: Projapp
	## File:         install.php
	## Author:       Mohammad Mahdi Naderi <mmnaderi.ir@gmail.com>
	## Repository:   github.com/mmnaderi/Projapp

	//Why I write this? Only God knows :D
	ob_start();

	// Include Database Config
	include('config.php');

	// Check if Projapp was installed (the tables are in database), redirects user to index.php
	// For SELECT, SHOW, DESCRIBE, EXPLAIN and other statements returning resultset, mysql_query() returns a resource on success, or FALSE on error.
	if (mysql_query("SELECT * FROM `info`") !== FALSE
	&& mysql_query("SELECT * FROM `projects`") !== FALSE
	&& mysql_query("SELECT * FROM `categories`") !== FALSE) {
		header("Location: index.php");
	}

	// insert $_POST to $posted array
	if ($_POST) {
		$posted = array();
		foreach ( $_POST as $item_key => $item_value ) {
			$posted[$item_key] = $item_value;
		}
	}

	// check if installation data was sended, insert them to database
	if (isset($posted['developer_name'])
	&& $posted['developer_name'] != ''
	&& isset($posted['developer_mail'])
	&& $posted['developer_mail'] != '') {
		mysql_query ('CREATE TABLE projects( '.
			'`id` INT NOT NULL AUTO_INCREMENT,'.
			'`name` TEXT NOT NULL, '.
			'`description` TEXT NOT NULL , '.
			'`type` TEXT NOT NULL , '.
			'`percent` INT NOT NULL , '.
			'`file` TEXT NOT NULL , '.
			'`category` TEXT NOT NULL , '.
			'`content` TEXT NOT NULL , '.
			'PRIMARY KEY(id))');
		mysql_query ('CREATE TABLE categories( '.
			'`id` INT NOT NULL AUTO_INCREMENT,'.
			'`name` TEXT NOT NULL, '.
			'PRIMARY KEY(id))');
		mysql_query ('CREATE TABLE info( '.
			'`id` INT NOT NULL AUTO_INCREMENT,'.
			'`url` TEXT NOT NULL, '.
			'`username` TEXT NOT NULL, '.
			'`password` TEXT NOT NULL, '.
			'`developername` TEXT NOT NULL, '.
			'`developermail` TEXT NOT NULL, '.
			'`theme` TEXT NOT NULL, '.
			'`language` TEXT NOT NULL, '.
			'PRIMARY KEY(id))');

		// if language direction is ltr select 'Default-ltr' for theme & if it's rtl select 'Default-rtl'
		include("languages/".$posted['language'].".pl");
		$insert_info = mysql_query ("INSERT INTO `info` (`id`,`url`,`username`,`password`,`developername`,`developermail`,`theme`,`language`) VALUES ('', 'http://".dirname($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'])."','".$posted['username']."','".md5($posted['password'])."','".$posted['developer_name']."','".$posted['developer_mail']."','default-".$lang_dir."','".$posted['language']."')");
		$insert_categories = mysql_query ("INSERT INTO `categories` (`id`,`name`) VALUES ('','Without Category')");
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Install Projapp</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="admin/js/jquery.min.js"></script>
		<script type="text/javascript" src="admin/assets/semantic/semantic.min.js"></script>
		<link rel="stylesheet" type="text/css" href="admin/assets/semantic/semantic.min.css">
		<style>
			body {background-color: #27ae60;}
			body > .grid {height: 100%;}
			.column {max-width: 450px;}
			h2 {color: #FFF!important;}
			.ui.piled.segment {margin-top:0 }
		</style>
	</head>
	<body>
		<div class="ui middle aligned center aligned grid">
			<div class="column">
				<h2 class="ui header">
				  <img src="http://semantic-ui.com/images/avatar2/large/patrick.png" class="ui circular image">
				  Install Projapp
				</h2>
				<div class="ui piled segment">
					<?php
						## 1- Connection to mysql error
						// check if connection to the database or selection of database is unsuccess.
						if (!$connect || !$select) {
					?>
					<div class="ui icon negative message">
						<i class="plug icon"></i>
						<div class="content">
							<div class="header">
							Unfortunately Projapp cannot connect to MySql.
							</div>
							<p>First you must edit config.php file in this folder for connection to MySql.</p>
						</div>
					</div>
					<?php
						}

						## 2- if connection to database was succeeded:
						else {
							## 2.1- Installation complete
							// check if databases were inserted print the message
							if ($insert_info === TRUE // for check if datas were inserted in tables
							&& $insert_categories === TRUE // for check if datas were inserted in tables
							&& mysql_query("SELECT * FROM `info`") // for check if tables were created
							&& mysql_query("SELECT * FROM `projects`") // for check if tables were created
							&& mysql_query("SELECT * FROM `categories`")) { // for check if tables were created
					?>
					<div class="ui icon positive message">
  					<i class="birthday icon"></i>
  					<div class="content">
    					<div class="header">
      				Projapp is install successfully.
    					</div>
    					<p>You can go to <a href="index.php">home page</a> or your <a href="admin">admin panel</a>.</p>
  					</div>
					</div>
					<?php
							}

							## 2.2- Installation inputs
							// if Projapp still is not installed
							else {
								##2.2.1- If the user tried to install it but it's absolutely not installed
								if (isset($_POST['request'])) {
									// Drop tables that created incomplete
									$result = mysql_list_tables($dbname);
									$num_rows = mysql_num_rows($result);
									for ($i = 0; $i < $num_rows; $i++) {
										mysql_query("DROP TABLE `".mysql_tablename($result, $i)."`");
									}
					?>
					<div class="ui icon negative message">
						<i class="bug icon"></i>
						<div class="content">
							<div class="header">
							Projapp was not completely installed!
							</div>
							<p>Please fix problem and try again.</p>
						</div>
					</div>
					<?php
								}
					?>
					<form action="install.php" method="POST" class="ui large form">
						<div class="ui icon info message">
							<i class="database icon"></i>
							<div class="content">
								<div class="header">
								Projapp can connect to MySql!
								</div>
								<p>Install it in <strong>3 Seconds!</strong></p>
							</div>
						</div>
						<div class="field">
							<div class="ui left icon input">
								<i class="at icon"></i>
								<input type="text" name="username" placeholder="Username">
							</div>
						</div>
						<div class="field">
							<div class="ui left icon input">
								<i class="lock icon"></i>
								<input type="password" name="password" placeholder="Password">
							</div>
						</div>
						<div class="field">
							<div class="ui left icon input">
								<i class="user icon"></i>
								<input type="text" name="developer_name" placeholder="Name">
							</div>
						</div>
						<div class="field">
							<div class="ui left icon input">
								<i class="mail icon"></i>
								<input type="text" name="developer_mail" placeholder="Email">
							</div>
						</div>

						<div class="ui fluid selection dropdown">
							<i class="ui left input world icon"></i>
							<input type="hidden" name="language">
							<i class="dropdown icon"></i>
							<div class="default text">Language</div>
							<div class="menu">
								<?php
								foreach (glob("languages/*.pl") as $langfilename) {
									include($langfilename);
									echo "<div class=\"item\" data-value=\"{$lang_code}\" data-text=\"{$lang_name}\"><i class=\"{$lang_country} flag\"></i>{$lang_name}</div>";
								}
								?>
							</div>
						</div>
						<div class="ui divider"></div>
						<input type="hidden" name="request" value="true" />
						<input type="submit" value="Install" class="ui fluid large primary submit button" />
					</form>
					<?php
						} // end of 2.2
						} // end of 2
					?>
				</div>
			</div>
		</div>
		<script>
			$('.ui.dropdown')
				.dropdown()
			;
		</script>
	</body>
</html>
<?php
	//Why I write this? Only God knows :D
	ob_end_flush();
?>
