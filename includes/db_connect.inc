<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'petconnect';
} else {
    $server = 'talsprddb02.int.its.rmit.edu.au';
    $user = 's3944952';
    $password = 'PASTE_YOUR_JACOB5_PASSWORD_HERE';
    $database = 's3944952';
}

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_errno) {
    exit('Database connection failed.');
}
?>