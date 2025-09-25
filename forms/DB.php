<?php
$servername = "localhost";
$username = "root";
$password = "Sokoro@12";
$dbname = "api";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO users (id, name, email, phone )
VALUES ('189949','Zack Ogega', 'Zackogega@gmail.com', '0769358333')";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>