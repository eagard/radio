<?php
/* 		John Battaglia
		Eric Gardner
		Ahmed Altai
		CIS 435 - Fall 2014
		Term Project
		File: connect.php
							*/

// Error messages.
$conn_error = 'There has been a problem connecting...';
$db_error = 'That Database doesnt exist...';

// Retrieve local configuration settings.
$localconfig = parse_ini_file ("../localconfig.ini", true);
$dbname = $localconfig["database"]["dbname"];
$dbuser = $localconfig["database"]["dbuser"];
$dbpass = $localconfig["database"]["dbpass"];

//$mysql_host = 'localhost';
//$mysql_user = 'root';
//$mysql_pass = 'root';
//$mysql_db = 'radio'; //database to connect to

@mysql_connect("localhost", $dbuser, $dbpass) or die($conn_error);
@mysql_select_db($dbname) or die($db_error);


?>
