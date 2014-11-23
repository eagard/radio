<!DOCTYPE html>

<table>
    <tr>
		<th>Title</th>
		<th>Composer</th>
		<th>Performer</th>
		<th>Rank</th>
		<th>Last Played</th>
    </tr>

<?php

// build SELECT query
$query = "SELECT title, composer, performer, rank, time_played FROM `RECENT_SONG`, `SONG` WHERE RECENT_SONG.id = SONG.id ORDER BY time_played DESC"; 

if($query_run = mysql_query($query)) {
	while($query_row = mysql_fetch_assoc($query_run)) {
		$title = $query_row['title'];
		$composer = $query_row['composer'];
		$performer = $query_row['performer'];
		$rank = $query_row['rank'];
		$time_played = $query_row['time_played'];
	
?>
	<tr>
		<td><?php echo $title;?></td>
		<td><?php echo $composer;?></td>
		<td><?php echo $performer;?></td>
		<td><?php echo $rank;?></td>
		<td><?php echo $time_played;?></td>
	</tr>

<?php
	} //end while
} //end if
else {
	echo mysql_error();
}
?>
</table>