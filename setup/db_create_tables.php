<?php

$localconfig = parse_ini_file ("../localconfig.ini", true);

// Retrieve local configuration settings.
$dbname = $localconfig["database"]["dbname"];
$dbuser = $localconfig["database"]["dbuser"];
$dbpass = $localconfig["database"]["dbpass"];

// Connect to the database.
$connection = mysqli_connect ("localhost", $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno ())
{
	echo "Database connection failure:\n" . mysqli_connect_error ();
	exit (1);
}

// Create the user table.
if (mysqli_query ($connection,"
		CREATE TABLE USERS
		(
			username VARCHAR(16) NOT NULL,
			password VARCHAR(16) NOT NULL,
			PRIMARY KEY(username)
		)
		"))
{
	echo "USERS table created.";
}
else
{
	echo "Error creating users table:\n" . mysqli_error ($connection);
}

// Close the database connection.
mysqli_close ($connection);

?>
