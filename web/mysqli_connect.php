<?php # Script 9.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database, and sets the encoding.

// Set the database access information as constants:
// NOTE: STUDENTS MUST CHANGE THESE!!!
DEFINE ('DB_USER', 'cst173');
DEFINE ('DB_PASSWORD', '354706');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ICS199Group10_dev');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');