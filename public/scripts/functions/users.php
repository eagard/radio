<?php

function loggedIn() {
	return (isset($_SESSION['username'])) ? true : false;
}

function userExists($username) {

	$username = sanitize($username);

	$query = mysql_query("SELECT COUNT(*) FROM `USER` WHERE `username` = '$username'");

	return (mysql_result($query, 0) == 1) ? true : false;

}

function userActive($username) {

	$username = sanitize($username);

	$query = mysql_query("SELECT COUNT(*) FROM `USER` WHERE `username` = '$username' AND `active` = 1");

	return (mysql_result($query, 0) == 1) ? true : false;

}

function login($username, $password) {
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(*) FROM `USER` WHERE `username` = '$username' AND `password` = '$password'"), 0) == 1) ? $username : false;
}

function createUser($username, $password) {
	$datetime = date('Y-m-d H:i:s');
	$query = "INSERT INTO `radio`.`USER` (`username`, `password`, `register_time`, `last_login`, `active`) VALUES ('$username', '$password', '$datetime', '$datetime', '0')";
	(mysql_query($query));

}


?>