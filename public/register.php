<?php
include 'scripts/init.php';
		if(empty($_POST) === false) {

				$user = $_POST['username'];
				$pass = $_POST['password'];
				$passAgain = $_POST['passwordAgain'];


				if( (empty($user) === true) || (empty($pass) === true) || (empty($passAgain) === true)) {
					$errors[] = 'Must fill in all fields';
				} 
				else if (!($pass === $passAgain)) {
					$errors[] = 'Passwords must match.';
				}
				else if ( (strlen($pass) < 2) || (strlen($pass) > 16) ) {
					$errors[] = 'Passwords must be between 2 and 16 characters';
				}
				
				
				if (empty($errors)) {
					createUser($user, $pass);
					header('Location: index.php');
					exit();
				}

				print_r($errors);
			}


?>
<!DOCTYPE html>

<!-- 	John Battaglia
		Eric Gardner
		Ahmed Altai
		CIS 435 - Fall 2014
		Term Project
		File: register.php
							-->
<html>
<?php
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
			<h1>Registration Page</h1>
				<form action="" method="post">
					<li>
						Username*:<br>
						<input type="text" name="username">
					</li>
					<li>
						Password*:<br>
						<input type="password" name="password">
					</li>
					<li>
						Password again*:<br>
						<input type="password" name="passwordAgain">
					</li>
					<li>
						<input type="submit" value="Register">
					</li>
				</form>
		</div>
		<?php
			include 'includes/footer.php';
		?>
	</div>
</div>
</body>
</html>