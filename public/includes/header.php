<div id="header">
	<div id="siteName">
		WUMD Classic Radio Station <br>
	</div>
		<div id="logInOut">
	
			<?php

			if(loggedIn() === true) {
				echo "<i>";
				echo $_SESSION['username'];
				echo " | ";
				echo "<a href='logout.php'>Log Out</a>";
				echo "<br/>";
				echo usersActive()." User(s)";
				echo "</i>";
			}
			else {
				echo "<i>";
				echo "<a href='login.php'>Log In</a>";
				echo " | ";
				echo "<a href='register.php'>Register</a>";
				echo "</i>";
			}
			?>
		</div>

		<div id="systemInfo">
			<?php
			/*if(loggedIn() === true) {
				echo "Hello, " . $_SESSION['username'] . "<br>";
				if(usersActive() == 1){
					echo "you are the only user logged in.";
				}
				else {
					echo "there are " . usersActive() ." users logged in.";
				}
			}*/
			?>
		</div>
</div>
