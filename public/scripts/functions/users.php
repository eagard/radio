<?php


function loggedIn() {
	return (isset($_SESSION['userID'])) ? true : false;
}


function userExists($username) {

	$username = sanitize($username);

	$query = mysql_query("SELECT COUNT(`userID`) FROM `users` WHERE `username` = '$username'");

	return (mysql_result($query, 0) == 1) ? true : false;

}

function userActive($username) {

	$username = sanitize($username);

	$query = mysql_query("SELECT COUNT(`userID`) FROM `users` WHERE `username` = '$username' AND `active` = 1");

	return (mysql_result($query, 0) == 1) ? true : false;

}

function userIDFromUsername($username) {
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT `userID` FROM `users` WHERE `userName` = '$username'"), 0, 'userID');
}

function login($username, $password) {
	$userID = userIDFromUsername($username);
	$username = sanitize($username);
	return (mysql_result(mysql_query("SELECT COUNT(`userID`) FROM `users` WHERE `userName` = '$username' AND `password` = '$password'"), 0) == 1) ? $userID : false;
}

?>