
<!DOCTYPE html>

<table>
    <tr>
		<th>ID</th>	
		<th>Title</th>
		<th>Composer</th>
		<th>Performer</th>
		<th>Rank</th>
    </tr>

<?php

// build SELECT query
$query = "SELECT * FROM SONG"; //PUT THE TABLE NAME HER

if($query_run = mysql_query($query)) {
	while($query_row = mysql_fetch_assoc($query_run)) {
		$id = $query_row['id'];
		$title = $query_row['title'];
		$composer = $query_row['composer'];
		$performer = $query_row['performer'];
		$rank = $query_row['rank'];
	
?>
	<tr>
		<td><?php echo $id;?></td>
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