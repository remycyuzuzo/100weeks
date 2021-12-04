<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "100weeks";

try {
    $conn = new mysqli($host, $user, $password, $database);
} catch (Exception $e) {
    echo "There was an error: " . $e->getMessage();
}
