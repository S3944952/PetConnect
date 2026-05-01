<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
  Local XAMPP settings are used when the site runs on localhost.
  Jacob5 settings are used when the site is deployed to the RMIT server.
*/

if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1') {
    // Local XAMPP database settings
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'petconnect';
} else {
    // RMIT Jacob5 database settings
    $server = 'talsprddb02.int.its.rmit.edu.au';
    $user = 's3944952';
    $password = 'Rmit123!';
    $database = 's3944952';
}

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_errno) {
    exit('Database connection failed. Please check your connection settings.');
}

$conn->set_charset('utf8mb4');
?>