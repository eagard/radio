<?php
if (!ISSET($_SESSION['username']))
{
	// Not logged in.
	if (ISSET($_GET) && 0<count($_GET))
	{
		// A star was clicked.
		echo "<i>You must be logged in to rate songs.</i><br/><br/>";
	}
	else
	{
		// Do nothing special.
	}
}
else
{
	// User is logged in.
	if (ISSET($_GET) && 0<count($_GET))
	{
		// A star was clicked.
		for ($song = 1; $song <= 15; $song++)
		{
			for ($stars = 1; $stars <= 5; $stars++)
			{
				if (ISSET($_GET[$song."_".$stars."_x"]))
				{
					// Remove rating if exists.
					$query = "DELETE FROM RATING WHERE "
					."user='".$_SESSION['username']."' AND song=".$song.";";
					mysql_query($query);
					
					// Now insert the rating.
					$query = "INSERT INTO "
					."RATING(user, song, stars, last_update) VALUES "
					."('".$_SESSION['username']."',".$song.",".$stars.",NOW());";
					if (mysql_query($query))
					{
						echo "<i>Song rating submitted!</i><br/><br/>";
					}
					else
					{
						echo "<i>Rating failed to submit!</i><br/><br/>";
						echo "<i>Query=".$query."</i>";
					}
				}
			}
		}
	}
	else
	{
		// Do nothing special.
	}
}
?>

