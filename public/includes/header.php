<div id="header">
	<div id="siteName">
		WUMD Classic Radio Station <br>
	</div>
		<div id="logInOut">
	
			<?php
			$localconfig = parse_ini_file ("../localconfig.ini", true);
			if (ISSET($localconfig["URL"]["stream"]))
			{
				$radioURL = $localconfig["URL"]["stream"];
				echo "<a href='".$radioURL."' target='_blank'>
						Listen Now!</a><br/>";
			}
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
