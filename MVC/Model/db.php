<?php
$env = parse_ini_file('../../.env');

$servername = $env["SERVER_NAME"];
$username = $env["USERNAME"];
$password = $env["PASSWORD"];
$dbname = $env["DB_NAME"];


try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch(Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}


