<?php
$dbConn = new mysqli("localhost", "root", "", "MedBook");
if($dbConn->connect_error) {
die("Failed to connect to database " . $dbConn->connect_error);
}
?>