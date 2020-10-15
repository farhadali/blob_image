<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_entry";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
	// Create database
	$sql = "CREATE DATABASE ".$dbname." ";
	if ($conn->query($sql) === TRUE) {
	  $conn = new mysqli($servername, $username, $password, $dbname);
	} else {
	  $conn = new mysqli($servername, $username, $password, $dbname);
	}
}


if ($conn){
	$sql = "CREATE TABLE IF NOT EXISTS users(
			    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
			    photo mediumblob  NOT NULL,
			    full_name text(60) NOT NULL,
			    user text(12) NOT NULL,
			    email text(70) NOT NULL ,
			    mobile text(15) NOT NULL,
			    active INTEGER(1) NOT NULL,
			    password text(400) NOT NULL
			)";
        if(mysqli_query($conn,$sql)) {
            //echo "Created user table";
        } else{
            
        }
    } else {
        echo "error : DB is not connected";
    } 

?>