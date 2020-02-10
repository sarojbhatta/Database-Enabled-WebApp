<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cs460"; //name of the database

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if (!$conn){
	die("Connection Error: ".mysqli_connect_error());
}