<?php

// This file is used to drop the tables.

////////////////////////////////////////////////////////////
// TABLE LIST
// Here is where we define an array of queries,
// so we can run it over a for loop later.
////////////////////////////////////////////////////////////

$table_list =
[
	5 =>
		[
			"table" => "USERS",
			"query" => "DROP TABLE USERS;"
		],
	4 =>
		[
			"table" => "SONGS",
			"query" => "DROP TABLE SONGS"
		],
	3 =>
		[
			"table" => "RATING",
			"query" => "DROP TABLE RATING"
		],
	2 =>
		[
			"table" => "TOP_SONGS",
			"query" => "DROP TABLE TOP_SONGS"
		],
	1 =>
		[
			"table" => "RECENT_SONGS",
			"query" => "DROP TABLE RECENT_SONGS"
		]
];


////////////////////////////////////////////////////////////
// CODE
// This is where we actually set up the tables.
////////////////////////////////////////////////////////////

// Retrieve local configuration settings.
$localconfig = parse_ini_file ("../localconfig.ini", true);

$dbname = $localconfig["database"]["dbname"];
$dbuser = $localconfig["database"]["dbuser"];
$dbpass = $localconfig["database"]["dbpass"];

// Connect to the database.
$connection = mysqli_connect ("localhost",
		$dbuser, $dbpass, $dbname);
if (mysqli_connect_errno ())
{
	echo "ERROR: Database connection failure:\n"
			. mysqli_connect_error ()
			. "\n";
	exit (1);
}


for ($i=1; $i<=5; $i++)
{
	// Drop the table.
	if (mysqli_query ($connection, $table_list[$i]["query"]))
	{
		echo $table_list[$i]["table"]
				. " table dropped.\n";
	}
	else
	{
		echo "ERROR: Cannot drop "
				. $table_list[$i]["table"]
				. " table:\n"
				. mysqli_error ($connection)
				. "\n";
	}
}

// Close the database connection.
mysqli_close ($connection);

?>
