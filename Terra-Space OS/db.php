<?php
$conn = mysqli_connect("localhost", "root", "", "terra_space_db");
if (!$conn) { die("Connection Failed: " . mysqli_connect_error()); }
session_start();
?>