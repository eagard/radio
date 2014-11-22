<?php 
include 'scripts/init.php';
			if(empty($_POST) === false) {

				$username = $_POST['username'];
				$password = $_POST['password'];

				if(empty($username) === true || empty($password) === true) {
					$errors[] = 'Username or password failed';
				}
				else if (userExists($username) === false) {
					$errors[] = 'That username does not exist at all, ever';
				}
				else if (userActive($username) === false) {
					$errors[] = 'User account is not activated';
				}
				else { //sucess
					$login = login($username, $password);
					if($login === false) {
						$errors[] = 'That username/password combo is incorrect silly';
					}
					else {
						$_SESSION['username'] = $login; //set username
						header('Location: index.php');
						exit();
					}
				}

				if(count($errors) > 0){
					echo outputErrors($errors);
				}
				
			}
			?>

<?php 
	
?>
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
			<form action="" method="post">
			<ul id="login">
				<li>
					Username:<br>
					<input type="text" name="username">
				</li>
				<li>
					Password:<br>
					<input type="password" name="password">
				</li>
				<li>
					<input type="submit" value="Log in">
				</li>
			</ul>
			</form>

			



		</div>
		<?php
			include 'includes/footer.php';

		?>
	</div>
</div>
</body>
</html>





