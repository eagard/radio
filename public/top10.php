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
			<i>Top Ten</i><br/><br/>
			<?php
				include 'scripts/database/top10.php';
			?>
			<p> All music is creative commons (cc-by-sa) 2.0 or 2.5. </p>
		</div>
		<?php
			include 'includes/footer.php';
		?>
	</div>
</div>
</body>
</html>
