<?php
$conn = mysqli_connect("localhost", "root", "", "23ubc544");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>