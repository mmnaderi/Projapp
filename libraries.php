<?php
	// put info table to info array for use easier & and define some others info
	include_once('config.php');
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
	
	// echo this page when the Projapp wasn't installed
	$not_installed = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Not Installed</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="admin/favicon.ico" rel="shortcut icon">
		<link href="admin/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<div class="container wrapper-fix small-wrapper">Please go to <a href="install.php">install page</a>.</div>
	</body>
</html>';
?>
