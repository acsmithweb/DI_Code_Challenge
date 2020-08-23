<?php
$servername = "localhost";
$username = "root";
$password = NULL;

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS DI_CHALLENGE_DB";
if ($conn->query($sql) === TRUE) {
 echo "Database created successfully \n";
} else {
 echo "Error creating database: " . $conn->error . "\n";
}
$conn->select_db("DI_CHALLENGE_DB");

// create ContactInfo table
$sql = "CREATE TABLE IF NOT EXISTS contact_info (ContactId int PRIMARY KEY AUTO_INCREMENT, Name varchar(255) NOT NULL, Email varchar(255) NOT NULL, Phone varchar(30), Message Text NOT NULL)";
if ($conn->query($sql) === TRUE) {
 echo "Table created successfully \n";
} else {
 echo "Error creating table: " . $conn->error . "\n";
}

// Add example data to ContactInfo table
$sql = "INSERT INTO contact_info (Name, Email, Phone, Message) VALUES ('Aaron Smith', 'aaronsmithweb@gmail.com', '4138675309', 'this is a cool message for all the people'), ('Mario Chase', 'mariochaseweb@gmail.com', null, 'Some other interesting message for everyone')";
if ($conn->query($sql) === TRUE) {
 echo "Records added successfully \n";
} else {
 echo "Error creating records: " . $conn->error . "\n";
}
$conn->close();
?>
