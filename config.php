<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'pass';
	$dbname = 'projapp';
	//////////////////////////////
	error_reporting(E_ERROR);
	$connect = mysql_connect($dbhost,$dbuser,$dbpass);
	$select = mysql_select_db($dbname,$connect);
?>