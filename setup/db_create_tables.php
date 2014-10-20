<?php

// This file is used to create the tables.
// Create the database and local config file first.

////////////////////////////////////////////////////////////
// TABLE LIST
// Here is where we define an array of queries,
// so we can run it over a for loop later.
////////////////////////////////////////////////////////////

$table_list =
[
	1 =>
		[
			"table" => "USER",
			"query" => "
				CREATE TABLE USER
				(
					username VARCHAR(16) NOT NULL,
							PRIMARY KEY(username),
					password VARCHAR(16) NOT NULL
				)
				"
// no comments
		],
	2 =>
		[
			"table" => "SONG",
			"query" => "
				CREATE TABLE SONG
				(
					id INT NOT NULL AUTO_INCREMENT,
							PRIMARY KEY(id),
					title VARCHAR(32) NOT NULL,
					artist VARCHAR(32) NOT NULL,
					audio_filename VARCHAR(32) NOT NULL,
					image_filename VARCHAR(32) NOT NULL
				)
				"
// id: The unique identity of the song, since none of the
//     other attributes are guaranteed unique.
// audio_filename: The song .ogg must be stored in 'music'
// image_filename: The album art must be stored in 'public/image'
		],
	3 =>
		[
			"table" => "RATING",
			"query" => "
				CREATE TABLE RATING
				(
					id INT NOT NULL AUTO_INCREMENT,
							PRIMARY KEY(id),
					user VARCHAR(16) NOT NULL,
							FOREIGN KEY(user)
							REFERENCES USERS(username),
					song INT NOT NULL,
							FOREIGN KEY(song)
							REFERENCES SONGS(id),
					stars INT NOT NULL,
					time DATETIME NOT NULL
				)
				"
// id: Again, used to uniquely identify the rating if needed.
// time: Used so we can get the set of ratings made in the
//       last hour.  Should be time rating is set or changed.
// comment: Note comment is optional.
		],
	4 =>
		[
			"table" => "TOP_SONG",
			"query" => "
				CREATE TABLE TOP_SONG
				(
					number INT NOT NULL,
							PRIMARY KEY(number),
					song INT NOT NULL,
							FOREIGN KEY(song)
							REFERENCES SONGS(id)
				)
				"
// List only contains 10 songs with number set uniquely
// between 1 to 10.
		],
	5 =>
		[
			"table" => "RECENT_SONG",
			"query" => "
				CREATE TABLE RECENT_SONG
				(
					id INT NOT NULL AUTO_INCREMENT,
							PRIMARY KEY(id),
					song INT NOT NULL,
							FOREIGN KEY(song)
							REFERENCES SONGS(id),
					time DATETIME NOT NULL
				)
				"
// id: Increments, so the most recently played are the entries
//     with the five highest id's.
// time: This is the time the song started playing.
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
	// Create the table.
	if (mysqli_query ($connection, $table_list[$i]["query"]))
	{
		echo $table_list[$i]["table"]
				. " table created.\n";
	}
	else
	{
		echo "ERROR: Failed to create "
				. $table_list[$i]["table"]
				. " table:\n"
				. mysqli_error ($connection)
				. "\n"
				. "Halting script.\n";
		mysqli_close ($connection);
		exit (1);
	}
}

// Close the database connection.
mysqli_close ($connection);
echo "OK\n";

?>
