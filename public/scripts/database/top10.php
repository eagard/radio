<!DOCTYPE html>

<table>
    <tr>
		<th>Stars</th>
		<th>Title</th>
		<th>Composer</th>
		<th>Performer</th>
		<th>Rank</th>		
    </tr>

<?php

// build SELECT query
$query = "SELECT stars, title, composer, performer, rank FROM `RATING`,`SONG` WHERE SONG.id = RATING.song ORDER BY stars DESC LIMIT 10"; 

if($query_run = mysql_query($query)) {
	while($query_row = mysql_fetch_assoc($query_run)) {
		$title = $query_row['title'];
		$composer = $query_row['composer'];
		$performer = $query_row['performer'];
		$rank = $query_row['rank'];
		$stars = $query_row['stars'];
	
?>
	<tr>
		<td><?php echo $stars;?></td>
		<td><?php echo $title;?></td>
		<td><?php echo $composer;?></td>
		<td><?php echo $performer;?></td>
		<td><?php echo $rank;?></td>
	</tr>

<?php
	} //end while
} //end if
else {
	echo mysql_error();
}
?>
</table>