<?php

include 'scripts/init.php';




if(empty($_POST) === false) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) === true || empty($username) === true) {
		$errors[] = 'Username or password failed';
	}
	else if (userExists($username) === false) {
		$errors[] = 'That username does not exist at all, ever';
	}
	else if (userActive($username) === false) {
		$errors[] = 'User account is not activated';
	}
	else {
		$login = login($username, $password);
		if($login === false) {
			$errors[] = 'That username/password combo is incorrect silly';
		}
		else {
			$_SESSION['username'] = $login;
			header('Location: index.php');
			exit();
		}
	}

	print_r($errors);



}




?>