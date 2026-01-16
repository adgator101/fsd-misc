<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect('localhost', 'aaditya', 'admin', 'library_db');
if (!$conn) {
    // die('Connection failed');
    echo 'Connection failed: ' . mysqli_connect_error();
}
