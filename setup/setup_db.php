<?php

// This file is used to create and populate the tables.
// It will also remove old tables if there are any already there.
// Create the database and local config file first.

////////////////////////////////////////////////////////////
// CREATE TABLE LIST
// Here is where we define an array of queries,
// so we can run it over a for loop later.
////////////////////////////////////////////////////////////

$create_table_list =
[
	// USER
	// A user is a website user account.  A user account is only needed
	// for certain functionalities, such as rating and using the chat room.
	//
	// register_time & last_login:
	//     Added so users can be periodically removed due to inactivity.
	//     This feature is optional, but would be extra functionality.
	1 =>
	[
		"table" => "USER",
		"query" => "
				CREATE TABLE USER
				(
					username VARCHAR(16) NOT NULL
							ON DELETE CASCADE,
					password VARCHAR(16) NOT NULL,
					register_time DATETIME NOT NULL,
					last_login DATETIME NOT NULL,
					PRIMARY KEY(username)
				)
				"
	],
	// SONG
	// A song is a single audio track played by the radio station.
	// The song and metadata will need to be referenced by many sources.
	// This table would only be written to on creation, or optionally
	// if someone decides to add a song to the playlist.
	//
	// id: The unique identity of the song, since none of the
	//     other attributes are guaranteed unique.
	// audio_filename: The song .ogg must be stored in 'radio/music'
	// image_filename: The album art must be stored in 'radio/public/image'
	// COMPOSER & PERFORMER?
	2 =>
	[
		"table" => "SONG",
		"query" => "
				CREATE TABLE SONG
				(
					id INT NOT NULL,
					title VARCHAR(32) NOT NULL,
					artist VARCHAR(32) NOT NULL,
					audio_filename VARCHAR(32) NOT NULL,
					image_filename VARCHAR(32) NOT NULL,
					PRIMARY KEY(id)
				)
				"
	],
	// RATING TODO REMOVE AUTOINCREMENT AND CHANGE POP TO REFLECT
	// Each user may rate a song between 1 and 5 stars.  A rating cannot be
	// removed, but it can be overwritten.
	//
	// id: Again, used to uniquely identify the rating if needed.
	// time: Used so we can get the set of ratings made in the
	//       last hour.  Should be time rating is set or changed.
	// comment: Note comment is optional.
	3 =>
	[
		"table" => "RATING",
		"query" => "
				CREATE TABLE RATING
				(
					user VARCHAR(16) NOT NULL
							FOREIGN KEY REFERENCES
							USER(username),
					song INT NOT NULL
							FOREIGN KEY REFERENCES
							SONG(id),
					stars INT NOT NULL,
					last_update DATETIME NOT NULL,
					PRIMARY KEY(user,song)
				)
				"
	],
	// TOP_SONG
	// The top X songs of the Y.
	// X is a number (i.e. 10)
	// Y is a time period (i.e. hour/day)
	//
	// number: the rating of the song, going from 1 (best) to X (least best)
	4 =>
	[
		"table" => "TOP_SONG",
		"query" => "
				CREATE TABLE TOP_SONG
				(
					number INT NOT NULL,		
					song INT NOT NULL
							FOREIGN KEY REFERENCES
							SONG(id),
					PRIMARY KEY(number)
				)
				"
	],
	// RECENT_SONG
	// The list of songs recently played.
	//
	// id: Increments, so the most recently played are the entries
	//     with the five highest id's.
	// time: This is the time the song started playing.
	5 =>
	[
		"table" => "RECENT_SONG",
		"query" => "
				CREATE TABLE RECENT_SONG
				(
					id INT NOT NULL AUTO_INCREMENT,
					song INT NOT NULL
							FOREIGN KEY REFERENCES
							SONG(id),
					time_played DATETIME NOT NULL,
					PRIMARY KEY(id)
				)
				"
	]
];


////////////////////////////////////////////////////////////
// POPULATE TABLE LIST
// Prepopulate the table with data.
////////////////////////////////////////////////////////////

$populate_table_list =
[
	1 =>
	[
		"table" => "USER",
		"query" => "INSERT INTO USER(username,password) VALUES
				('eric','password')
				('john','password')
				('ahmed','password');"
	],
	2 =>
	[
		"table" => "SONG",
		"query" => "INSERT INTO SONG
				(id,title,artist,audio_filename,image_filename)
				VALUES
				(1,'song1','song1','song1.mp3','song1.png');"
	],
	// Note RATING, TOP_SONG, and RECENT_SONG tables are populated for
	// test purposes.  This should not be required from algorithms, but
	// improves development environment setup time.
	3 =>
	[
		"table" => "RATING",
		"query" => "INSERT INTO RATING(user,song,stars,time) VALUES
				('eric','song1',1,NOW())
				('john','song2',4,NOW())
				('ahmed','song3',5,NOW());"
	],
	4 =>
	[
		"table" => "TOP_SONG"
		"query" => ""
	],
	5 =>
	[
		"table" => "RECENT_SONG"
		"query" => ""
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
	// Drop table if it exists.
	mysqli_query ($connection, "DROP TABLE IF EXISTS "
			. $table_list[$i]["table"]
			. ";");
	
	// Create the table.
	if (mysqli_query ($connection, $create_table_list[$i]["query"]))
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
	
	// Populate the table.
	if (mysqli_query ($connection, $populate_table_list[$i]["query"]))
	{
		echo $table_list[$i]["table"]
				. " table populated.\n";
	}
	else
	{
		echo "ERROR: Failed to populate "
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
