<?php
	include 'scripts/init.php';
?>
<!DOCTYPE html>

<!-- 	John Battaglia
		Eric Gardner
		Ahmed Altai
		CIS 435 - Fall 2014
		Term Project
		File: index.php
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
			<h1>HomePage</h1>

			<?php
			
				
				if(isset($_SESSION['username'])) {
					echo "Logged in";
				}
				else {
					echo "Not logged in";
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