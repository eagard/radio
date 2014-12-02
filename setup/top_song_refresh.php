<?php
// This file refreshes the top 10 list based on user ratings.
// The current top song list is pulled in for half of the rating.
// The other half is computed using the most recent user ratings.
// These are combined so top songs can be influenced by user ratings,
// but not 100% dependent on them.

// Retrieve local database configuration settings.
$localconfig = parse_ini_file (dirname(dirname(__FILE__))."/localconfig.ini", true);

$dbname = $localconfig["database"]["dbname"];
$dbuser = $localconfig["database"]["dbuser"];
$dbpass = $localconfig["database"]["dbpass"];
$file_path = $localconfig["file"]["path"];

// Connect to the database.
$connection = mysqli_connect ("localhost", $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno ())
{
	echo "ERROR: Database connection failure:\n"
			. mysqli_connect_error ()
			. "\n";
	exit (1);
}

// --------------------------------------------------------
// STEP 1: FETCH THE CURRENT TOP 10 LIST
// Reset the list.
// CODE DOESN'T WORK AND IS NO LONGER NECESSARY
/*for ($i = 1; $i <= 15; $i++)
{
	$rating[$i] = 0;
}
// Query the list for set ratings.
// Should only set the top 10.  Rest remain at 0.
$query = "
SELECT id, rank
FROM SONG
WHERE rank NOT NULL;
";
$result = mysqli_query ($connection, $query);
while ($row = mysqli_fetch_row ($result))
{
	$rating[$row["rank"]] = $row[""];
}
print("OLD\n");
print_r($rating);*/

// --------------------------------------------------------
// STEP 2: TEST BY RANDOMIZING THIS STUFF

/*for ($i = 1; $i <= 10; $i++)
{
	$x = rand (1, 15);
	while ($rating[$x] != 0)
	{
		$x = rand (1, 15);
	}
	$rating[$x] = $i;
}*/

// --------------------------------------------------------
// STEP 1: CHANGE THE RATINGS BY THE STARS
// 3 stars does not affect star value.
// Less stars decreases and more increases star value.
// The highest star value song gets the highest rating.
// This is repeated until the top 10 are chosen.

// Initialize the ratings to zero.
for ($song = 1; $song <= 15; $song++)
{
	$rating[$song] = 0;
}

// Set the "star values."
for ($song = 1; $song <= 15; $song++)
{
	// Initialize the star values to zero.
	$star_value[$song] = 0;
	// Get list of star ratings.
	$query = "
	SELECT stars
	FROM RATING
	WHERE song=".$song.";";
	$result = mysqli_query ($connection, $query);
	// Modify star value based on ratings.
	while ($row = mysqli_fetch_row ($result))
	{
		$star_value[$song] += $row[0] - 3;
	}
}
print_r($star_value);

// Set the top songs using the star values.
for ($top = 1; $top <= 10; $top++)
{
	$max = max ($star_value);
	$min = min ($star_value);
		// Search star values for max value.
	$found = false;
	for ($song = 1; $song <= 15 && !$found; $song++)
	{
		if ($star_value[$song] == $max)
		{
			$rating[$song] = $top;
			// Stop searching.
			$found = true;
			// Prevent song from reappearing in top 10.
			$star_value[$song] = $min - 1;
		}
	}
}
print_r($rating);

// --------------------------------------------------------
// STEP 2: UPDATE THE LIST IN THE DATABASE
// Convert 0's to NULL.

for ($i = 1; $i <= 15; $i++)
{
	$query = "
	UPDATE SONG
	SET rank=".(($rating[$i]!=0)?$rating[$i]:"NULL")."
	WHERE id=".$i.";";
	$result = mysqli_query ($connection, $query);
}

// Close the database connection.
mysqli_close ($connection);

?>
