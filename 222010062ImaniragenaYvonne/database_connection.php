<?php
// Connection details
$host = "localhost";
$user = "Yvonne";
$pass = "222010062";
$database = "Online_store_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>