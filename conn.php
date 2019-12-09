<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION)) session_start(); // Starts a session to pass your session variables

if($_SERVER["SERVER_NAME"] == "dev.petervigilante.com") {
    // PRODUCTION - Connects to PLESK Database
    $conn = mysqli_connect("localhost", "cats_db_user", "e9jg8Y6$", "cats_network");
} else {
    // DEVELOPMENT/LOCAL - Connects to MAMP database
    $conn = mysqli_connect("localhost", "root", "root", "cats_network");
}

if( mysqli_connect_errno( $conn ) ){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>