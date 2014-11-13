<?php
/* 		John Battaglia
		Eric Gardner
		Ahmed Altai
		CIS 435 - Fall 2014
		Term Project
		File: connect.php
							*/

$conn_error = 'There has been a problem connecting...';
$db_error = 'That Database doesnt exist...';

$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = 'root';
$mysql_db = 'termProject'; //database to connect to

@mysql_connect($mysql_host, $mysql_user, $mysql_pass) or die($conn_error);
@mysql_select_db($mysql_db) or die($db_error);


?>