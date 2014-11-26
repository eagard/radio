<?php
	include 'scripts/init.php';	 
?>

<!DOCTYPE html>

<!-- 	John Battaglia
		Eric Gardner
		Ahmed Altai
		CIS 435 - Fall 2014
		Term Project
		File: search.php
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
			<h1>Search music</h1>
			<form action="" method="post">
			<ul>Search: <input type="text" name="searchTerm"><br></ul>
			<ul><input type="submit" value="Submit"></ul>
			</form>
			<?php
				if(empty($_POST) === false) {
					$searchTerm = $_POST['searchTerm'];
					if( (empty($searchTerm) === true) ) {
						$errors[] = 'Must fill in all fields';
					} 
					else if ( (strlen($searchTerm) < 2) || (strlen($searchTerm) > 16) ) {
						$errors[] = 'Search term must be between 2 and 16 characters';
					}
					if (empty($errors)) { 
    					$query = "SELECT *  FROM `SONG` WHERE `title` LIKE '%$searchTerm%' OR `composer` LIKE '%$searchTerm%' OR `performer` LIKE '%$searchTerm%'";
						if($query_run = mysql_query($query)) {
							$count = 0;
							while($query_row = mysql_fetch_assoc($query_run)) {
								if($count == 0 ) {
									echo "<table>";
									echo "<tr>";
									echo "<th>" . "Title" . "</th>";
									echo "<th>" . "Composer" . "</th>";
									echo "<th>" . "Performer" . "</th>";
									echo "<th style='width:164px;'>" . "User Rating" . "</th>";
									echo "<th style='text-align:center;margin-left:auto;margin-right:auto;'>" . "Source" . "</th>";
									echo "</tr>";
									$count++;
								}

								$title = $query_row['title'];
								$composer = $query_row['composer'];
								$performer = $query_row['performer'];
								$stars = 3;
								$source = $query_row['source'];

								echo "<tr>";
								echo "<td>" . $title . "</td>";
								echo "<td>" . $composer . "</td>";
								echo "<td>" . $performer . "</td>";
								echo "<td>";
								for ($i = 0; $i < 5; $i++) {
									if ($i < $stars) {
										echo "<img src='images/star_full.png' alt='x'/>";
									}
									else {
										echo "<img src='images/star_empty.png' alt='o'/>";
									}
								}
								echo "</td>";
								echo "<td style='text-align:center;'>";
								echo "<a href=";
								echo "http://" . $source; 
								echo ">";
								echo "<img src='images/arrow.png' alt='source'/>";	
								echo "</a>";
								echo "</td>";
							} //end while
							echo "</table>";
						} //end if
						else {
							echo mysql_error();
						}
					}
					else {
						echo outputErrors($errors);
					}		
				} //end if
			?>
		</div>
		<?php
			include 'includes/footer.php';
		?>
	</div>
</div>
</body>
</html>