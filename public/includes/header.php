<div id="header">
	<div id="siteName">
		WUMD Classic Radio Station <br>
	</div>

	<div id="container">
		<aside>
			<?php

			if(loggedIn() === true) {
				echo 'Logged In';
			}
			else {
				include 'loginReg.php';
			}

				
			?>
		</aside>
	</div>
</div>