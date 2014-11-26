<!DOCTYPE html>

<table>
    <tr>
		<th>Title</th>
		<th>Composer</th>
		<th>Performer</th>
		<th style='width:164px;'>User Rating</th>
		<th style='text-align:center;margin-left:auto;margin-right:auto;'>Source</th>
    </tr>

<?php

// build SELECT query
$query = "SELECT * FROM `RECENT_SONG`, `SONG` WHERE RECENT_SONG.id = SONG.id ORDER BY time_played DESC"; 

if($query_run = mysql_query($query)) {
	while($query_row = mysql_fetch_assoc($query_run)) {
		$title = $query_row['title'];
		$composer = $query_row['composer'];
		$performer = $query_row['performer'];
		$rank = $query_row['rank'];
		$stars = 3;
		$source = $query_row['source'];
	
?>
	<tr>
		<td><?php echo $title;?></td>
		<td><?php echo $composer;?></td>
		<td><?php echo $performer;?></td>
		<td><?php
			for ($i = 0; $i < 5; $i++)
			{
				if ($i < $stars)
				{
					echo "<img src='images/star_full.png' alt='x'/>";
				}
				else
				{
					echo "<img src='images/star_empty.png' alt='o'/>";
				}
			}
		?></td>
		<td style='text-align:center;'>
			<a href='<?php echo "http://".$source; ?>'>
				<img src='images/arrow.png' alt='source'/>
			</a>
		</td>
	</tr>

<?php
	} //end while
} //end if
else {
	echo mysql_error();
}
?>
</table>