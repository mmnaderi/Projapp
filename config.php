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
	
	/**
	 * Anti SQL Injection attacks
	 * If paramater is an array, returns array or is an string, returns single string
	 * @author	Ehsan
	 * @param	string $object
	 * @uses	mysql_real_escape_string
	 * @uses	trim
	 * @uses	strip_tags
	 * @return	string
	 */
	function filter_injection( $object ) {
		$object = htmlspecialchars( $object );
		$object = trim( $object );
		$object = strip_tags( $object );
		$object = mysql_real_escape_string( $object );
		return $object;
	}
?>