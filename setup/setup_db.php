<?php

// This file is used to create and populate the tables.
// It will also remove old tables if there are any already there.
// Create the database and local config file first.

// Only the song table *needs* to be populated.
// The rest are populated for easier testing.

////////////////////////////////////////////////////////////
// CREATE TABLE LIST
// Here is where we define an array of queries,
// so we can run it over a for loop later.
////////////////////////////////////////////////////////////

// ChangeList
//
// Rank changed to be nullable attribute of song.
// Therefore, removed the TOP_SONGS table.

$table_list =
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
		"drop" => "
				DROP TABLE IF EXISTS USER;
				",
		"create" => "
				CREATE TABLE USER
				(
					username VARCHAR(16) NOT NULL,
					password VARCHAR(16) NOT NULL,
					register_time DATETIME NOT NULL,
					last_login DATETIME NOT NULL,
					PRIMARY KEY(username)
				);
				",
		"populate" => "
				INSERT INTO USER(username,password)
				VALUES
				('eric','password'),
				('john','password'),
				('ahmed','password');
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
	//
	// Notes
	//   All music is creative commons (cc by sa) 2.0 or 2.5.
	//   This should be noted on any page that lists music.
	2 =>
	[
		"table" => "SONG",
		"drop" => "
				DROP TABLE IF EXISTS SONG;
				",
		"create" => "
				CREATE TABLE SONG
				(
					id INT NOT NULL,
					title VARCHAR(32) NOT NULL,
					composer VARCHAR(32) NOT NULL,
					performer VARCHAR(32) NOT NULL,
					audio_filename VARCHAR(64) NOT NULL,
					source VARCHAR(32) NOT NULL,
					rank INT,
					PRIMARY KEY(id)
				)
				",
		"populate" => "
				INSERT INTO SONG
				(id,title,composer,performer,audio_filename,source)
				VALUES
				(1,'Suite Espanola',
				'Issac Albeniz','Gordon Rowland',
				'Isaac_Albeniz_-_suite_espanola_op._47_-_leyenda.ogg',
				'www.musopen.com'),
				(2,'Bassoon Pieces',
				'Carl Almenräder','Arthur Grossman',
				'Carl_Almenrader_-_Bassoon_Pieces.ogg',
				'www.ibiblio.org/pandora'),
				(3,'Sonata in B Major',
				'Carl Philipp Emanuel Bach','Alex Murray & Martha Goldstein',
				'Carl_Philipp_Emanuel_Bach_-_Sonata_in_Bb_major.ogg',
				'www.ibiblio.org/pandora'),
				(4,'Prelude and Fugue in A Minor',
				'Johann Sebastian Bach','Samuel Cormier-Iijima',
				'Bach_Prelude_and_Fugue_in_A_Minor.ogg',
				'www.jsbach.net'),
				(5,'String Quartet 4 - Allegro 1',
				'Gustavo Becerra-Schmidt','Phila. String Quartet',
				'Becerra_string_quartet_4_-_1allegro.ogg',
				'mit.edu'),
				(6,'Kreutzer Sonana Presto',
				'Ludwig van Beethoven','Carrie Rehkopf',
				'Violinist_CARRIE_REHKOPF-BEETHOVEN_KREUTZER_SONATA_Presto.ogg',
				'themichels.org/carrie'),
				(7,'Sonata in B Minor',
				'Michael Blavet','Alex Murray & Martha Goldstein',
				'Michel_Blavet_-_Sonata_in_B_minor.ogg',
				'www.ibiblio.org/pandora'),
				(8,'Quintet No.3 in F Major - Movement 1',
				'Giuseppe Cambini','Soni Ventorum Wind Quintet',
				'Giovanni_Giuseppe_Cambini_-_Quintet_No._3_in_F_major_1.ogg',
				'www.ibiblio.org/pandora'),
				(9,'Quintet No.2 in D Minor - Movement 2',
				'Giuseppe Cambini','Soni Ventorum Wind Quintet',
				'Giovanni_Giuseppe_Cambini_-_Quintet_No._2_in_D_minor_3.ogg',
				'www.ibiblio.org/pandora'),
				(10,'Symphony No.9 in E Minor - From the New World',
				'Antonin Dvorak','Skidmore College Orchestra',
				'Antonin_Dvorak_-_symphony_no._9_in_e_minor.ogg'
				'www.musopen.org'),
				(11,'Toccata and Suite in A Minor',
				'Johann Jakob Froberger','Sylvia Kind',
				'Johann_Jakob_Froberger_-_Toccata_and_Suite_in_A_minor.ogg',
				'www.ibiblio.org/pandora'),
				(12,'Fantasy in E Minor',
				'Johann Jakob Froberger','Martha Goldstein',
				'Johann_Jakob_Froberger_-_Fantasy_-_e_minor.ogg'
				'www.ibiblio.org/pandora'),
				(13,'Suite i, no. 2 in F Major',
				'George Frederic Handel','Ivan Ilić'
				'George_Frideric_Handel_-_suite_no._2_in_f_major.ogg'
				'www.musopen.com'),
				(14,'Sonata in E Minor',
				'George Frederic Handel','Al Goldstein & Martha Goldstein',
				'Handel_-_Sonata_in_E_minor_-_Grave.ogg'
				'www.ibiblio.org/pandora'),
				(15,'Sonata for Bassoon with Piano Accompaniment',
				'Comille Saint-Saens','Arthur Grossman & Joseph Levine',
				'Camille_Saint-Saens_-_Sonata_for_bassoon_with_piano.ogg',
				'www.ibiblio.org/pandora');
				"
	],
	// RATING
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
		"drop" => "
				DROP TABLE IF EXISTS RATING;
				",
		"create" => "
				CREATE TABLE RATING
				(
					user VARCHAR(16) NOT NULL,
					FOREIGN KEY (user)
							REFERENCES USER(username)
							ON DELETE CASCADE,
					song INT NOT NULL,
					FOREIGN KEY (song)
							REFERENCES SONG(id),
					stars INT NOT NULL,
					last_update DATETIME NOT NULL,
					PRIMARY KEY(user,song)
				)
				",
		"populate" => "
				INSERT INTO RATING(user,song,stars,last_update)
				VALUES
				('eric',1,1,NOW()),
				('john',2',4,NOW()),
				('ahmed','2',5,NOW());
				"
	],
	// RECENT_SONG
	// The list of songs recently played.
	//
	// id: Increments, so the most recently played are the entries
	//     with the five highest id's.
	// time: This is the time the song started playing.
	4 =>
	[
		"table" => "RECENT_SONG",
		"drop" => "
				DROP TABLE IF EXISTS RECENT_SONG;
				",
		"create" => "
				CREATE TABLE RECENT_SONG
				(
					id INT NOT NULL AUTO_INCREMENT,
					song INT NOT NULL,
							FOREIGN KEY (song)
							REFERENCES SONG(id),
					time_played DATETIME NOT NULL,
					PRIMARY KEY(song,time_played)
				)
				",
		"populate" => "
				INSERT INTO RECENT_SONG(song,time_played)
				VALUES
				(1,NOW());
				"
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


for ($i=1; $i<=4; $i++)
{
	// Drop table if it exists.
	mysqli_query ($connection, $table_list[$i]["drop"]);
	
	// Create the table.
	if (mysqli_query ($connection, $table_list[$i]["create"]))
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
	if (mysqli_query ($connection, $table_list[$i]["populate"]))
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
