<?php
	######### IN THE NAME OF ALLAH ##########
	## Project Name: Projapp               ##
	## File name:    config.php            ##
	## Author:       Mohammad Mahdi Naderi ##
	## Project Site: projapp.mmnaderi.ir   ##
	#########################################
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'pass';
	$dbname = 'projapp';
	/////////////////////////
	error_reporting(E_ERROR);
	$connect = mysql_connect($dbhost,$dbuser,$dbpass);
	$select = mysql_select_db($dbname,$connect);
?>