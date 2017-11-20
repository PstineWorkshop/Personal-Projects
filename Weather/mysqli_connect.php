<?php # Script 8.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL 
// and selects the database.

// Set the database access information as constants:
/*$servername = "localhost";
//$username = "root1";
$password = "yes";
$database= "gamehub";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";*/

//*************************************************************************************************//////
DEFINE ('DB_USER', 'danielo2_phillip');
DEFINE ('DB_PASSWORD', 'phillip123');//yes
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'danielo2_weatherapp');

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

?>