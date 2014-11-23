<div id="header">
	<div id="siteName">
		WUMD Classic Radio Station <br>
	</div>
		<div id="logInOut">
	
			<?php

			if(loggedIn() === true) {
				echo "<a href='logout.php'>Log out</a>";
			}
			else {
				echo "<a href='login.php'>Log in</a>";
				echo " | ";
				echo "<a href='register.php'>Register</a>";
			}
			?>

		</div>
</div>