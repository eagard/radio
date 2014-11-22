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
	include 'scripts/init.php';
	include 'includes/head.php';
?>
<body>
<div id="body">
	<div id="wrapper">
		<?php
			include 'includes/header.php';
			include 'includes/nav.php';
			if(empty($_POST) === false) {
				if( (empty($_POST['username']) === true) ) {
					$errors[] = 'Must fill in all fields';
				}

				print_r($errors);
			}
			

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