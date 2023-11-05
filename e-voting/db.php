<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "voter";

$conn = new mysqli($server,$user,$pass,$db);

if ($conn->connect_error) {
    die("failed". $conn->connect_error);
}


?>