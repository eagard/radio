<!DOCTYPE html>

<!-- 	John Battaglia
		Eric Gardner
		Ahmed Altai
		CIS 435 - Fall 2014
		Term Project
		File: login.php
							-->
<html> 
<?php 
	include 'scripts/init.php';
	include 'includes/head.php';
?>
<body>
<div id="body">
	<div id="wrapper">
		<?php
			include 'includes/header.php';
			include 'includes/nav.php';
		?>
		<div id="section">
			<h1>Login status</h1>
			<?php
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



		</div>
		<?php
			include 'includes/footer.php';

		?>
	</div>
</div>
</body>
</html>





