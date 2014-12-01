<?php
// This file selects the song to play next.
// The song filename is printed in stdout.
// Connect it to the source client.



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
	echo "dbname=".$dbname."\n";
	echo "dbuser=".$dbuser."\n";
	echo "pwd=".getcwd()."\n";
	exit (1);
}

// --------------------------------------------------------
// STEP 1: DETERMINE WHICH SONGS WERE NOT PLAYED RECENTLY
// We do not want to play any song in the last 5.

// We assume all songs are available until they are
// determined to be blocked through the SQL query.
for ($i = 1; $i <= 15; $i++)
{
	$available[$i] = true;
}

// Generate the blocked song list.
$query = "
SELECT song
FROM RECENT_SONG
WHERE id+5 >
(
	SELECT MAX(id)
	FROM RECENT_SONG
);";
$result = mysqli_query ($connection, $query);
// Set the available songs to available in our array.
while ($row = mysqli_fetch_row ($result))
{
	$available[$row[0]] = false;
}

// --------------------------------------------------------
// STEP 2: GIVE SONGS THAT ARE RANKED HIGHER A HIGHER PROBABILITY
// (I know this isn't clean, but I'm not sure how to write functions.)
// (If this needs expanding upon, please clean this up!)

// Every song starts with a multiplier of 1.
for ($i = 1; $i <= 15; $i++)
{
	$multiplier[$i] = 1;
}

// Generate the top 10.
$query = "
SELECT id
FROM SONG
WHERE rank <= 10
;";
$result = mysqli_query ($connection, $query);
// Increment the multiplier of those songs.
while ($row = mysqli_fetch_row ($result))
{
	$multiplier[$row[0]] ++;
}

// Generate the top 5.
$query = "
SELECT id
FROM SONG
WHERE rank <= 5
;";
$result = mysqli_query ($connection, $query);
// Increment the multiplier of those songs.
while ($row = mysqli_fetch_row ($result))
{
	$multiplier[$row[0]] ++;
}

// Generate the top 1.
$query = "
SELECT id
FROM SONG
WHERE rank <= 1
;";
$result = mysqli_query ($connection, $query);
// Increment the multiplier of those songs.
while ($row = mysqli_fetch_row ($result))
{
	$multiplier[$row[0]] ++;
}

// --------------------------------------------------------
// STEP 3: GENERATE THE WEIGHTED SONG ARRAY
// This array only includes songs not recently played.
// It organizes it like a raffle.
// Songs with higher rank are given more tickets.

$ticket = [];
for ($i = 1; $i <= 15; $i++)
{
	if ($available[$i])
	{
		for ($j = 0; $j < $multiplier[$i]; $j++)
		{
			array_push($ticket, $i);
		}
	}
}
//debug//print_r ($ticket);

// --------------------------------------------------------
// STEP 4: SELECT A WEIGHTED RANDOM SONG AND PRINT THE RESULT
// We select one of the tickets from the array above.
// We then print the filename to standard output.

// Make random selection.
$selection = $ticket[rand (0, count($ticket)-1)];
//debug//print ("SELECTION = " . $selection . "\n");

// Get filename of selection.
$query = "SELECT audio_filename FROM SONG WHERE id=".$selection.";";
$result = mysqli_query ($connection, $query);
$row = mysqli_fetch_row ($result);
$file_name = $row[0];

// Write song choice to database.
$query = "INSERT INTO RECENT_SONG(song,time_played) VALUES (".$selection.",NOW());";
mysqli_query ($connection, $query);

// Echo filename to stdout for stream client to read.
print ($file_path . "/music/" . $file_name . "\n");

// Close the database connection.
mysqli_close ($connection);

?>
