<?php
   // create database connection

   $dbConn = new mysqli('localhost', 'root', '', 'bookstore');
   if($dbConn->connect_error) {
     exit("Failed to connect to database " . $dbConn->connect_error);
   }
?>
