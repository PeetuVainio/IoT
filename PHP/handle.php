<?php  
include "config.php";

$conn = new mysqli($servername, $username, $password, $dbname);  
if ($conn->connect_error){  
die("connection failed: " . $conn->connect_error);  
}

$name = $_POST['name'];
$viesti = $_POST['viesti'];
$stmt = $conn->prepare('INSERT INTO Keskustelu (nimi, viesti) VALUES (?, ?)');
$stmt->bind_param('ss', $name, $viesti);

$stmt->execute();

$conn->close(); 
 
header("location: index.php");
die();
?>