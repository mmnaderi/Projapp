<?php
	include_once('config.php');

	// check if Projapp not connected to databse or not installed (isn't any table in database), redirects user to install.php
	if (!$connect || !$select
	|| mysql_query("SELECT * FROM `info`") === FALSE
	|| mysql_query("SELECT * FROM `projects`") === FALSE
	|| mysql_query("SELECT * FROM `categories`") === FALSE) {
		header("Location: install.php");
	}

	// put info table to info array for use easier & and define some others info
	$query = mysql_query("SELECT * FROM `info`");
	while($table = mysql_fetch_array($query)) {
		$info = $table;
		$themeurl = ('themes/'.$info['theme']);
	}
	include_once('languages/'.$info['language'].'.pl');

	function check_included($filename) {
		$included_files = get_included_files();
		foreach ($included_files as $file) {
			if($file == $filename) {
				return true;
			}
			else {
				return false;
			}
		}
	}
?>
