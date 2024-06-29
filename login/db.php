<?php
$servername = "localhost";
$username = "tth";
$password = "h]3!8rs6V8!@TnXJ";
$dbname = "tth";

// Needs comau125_ in front

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET SESSION sql_mode='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");


//echo "Database Login successful<br>";
