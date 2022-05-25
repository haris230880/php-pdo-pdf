<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "practice";
try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   

} catch (PDOExeption $e) {
    echo "Connection failed: ", $e->getMessage();
}

//$conn = null;

?>

