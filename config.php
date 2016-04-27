<?php
	## In the name of ALLAH
	## Project Name: Projapp
	## File:         config.php
	## Author:       Mohammad Mahdi Naderi <mmnaderi.ir@gmail.com>
	## Repository:   github.com/mmnaderi/Projapp

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'projapp';
	/////////////////////////
	##############################################error_reporting(0);

	//Return value : ?
	$connect = mysql_connect($dbhost,$dbuser,$dbpass);

	// Return value of mysql_select_db:	TRUE on success, FALSE on failure
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
