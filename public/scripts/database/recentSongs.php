<?php include 'updateStars.php'; ?>

<form action='recentsongs.php'>
<table>
    <tr>
    	<th>Day</th>
    	<th>Time</th>
		<th>Title</th>
		<th>Composer</th>
		<th>Performer</th>
		<th style='width:164px;'>User Rating</th>
		<th style='text-align:center;margin-left:auto;margin-right:auto;'>
			Source
		</th>
    </tr>

<?php

// build SELECT query
$query = "
SELECT *
FROM RECENT_SONG INNER JOIN SONG ON RECENT_SONG.song=SONG.id
ORDER BY RECENT_SONG.time_played DESC
";

if($query_run = mysql_query($query)) {
	while($query_row = mysql_fetch_assoc($query_run)) {
		$time_played = $query_row['time_played'];
		$id = $query_row['id'];
		$title = $query_row['title'];
		$composer = $query_row['composer'];
		$performer = $query_row['performer'];
		$rank = $query_row['rank'];
		$source = $query_row['source'];
		// get stars: this code added by eric
		// this code isn't great, but it works
		if (!ISSET($_SESSION['username']))
		{
			// If not logged in, don't use star system.
			$stars = 0;
		}
		else
		{
			$subquery = "SELECT stars FROM RATING WHERE "
					."song=".$id." AND user='".$_SESSION['username']."';";
			if($subquery_run = mysql_query($subquery))
			{
				// Query ran successfully.
				if ($subquery_row = mysql_fetch_assoc($subquery_run))
				{
					// We found an entry!
					$stars = $subquery_row['stars'];
				}
				else
				{
					// No entry for current user.
					$stars = 0;
				}
			}
			else
			{
				// Query failed, don't do anything.  :(
				$stars = 0;
			}
		}
?>
	<tr>
		<td style='text-align:center;'>
			<?php echo date("D", strtotime($time_played));?>
		</td>
		<td style='text-align:center;'>
			<?php echo date("g:i", strtotime($time_played));?>
		</td>
		<td><?php echo $title;?></td>
		<td><?php echo $composer;?></td>
		<td><?php echo $performer;?></td>
		<td><?php
			for ($i = 1; $i <= 5; $i++)
			{
				if ($i <= $stars)
				{
					echo "<input type='image'
						src='images/star_full.png'
						alt='x'
						name='".$id."_".$i."'/>";
				}
				else
				{
					echo "<input type='image'
						src='images/star_empty.png'
						alt='x'
						name='".$id."_".$i."'/>";
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
</form>
