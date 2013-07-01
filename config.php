<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    config.php            ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'projapp';
	/////////////////////////
	error_reporting(0);
	$connect = mysql_connect($dbhost,$dbuser,$dbpass);
	$select = mysql_select_db($dbname,$connect);
?>