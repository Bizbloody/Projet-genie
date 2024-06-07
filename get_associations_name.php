<?php

$env = parse_ini_file('.env');

$servername = $env["SERVER_NAME"];
$username = $env["USERNAME"];
$password = $env["PASSWORD"];
$dbname = $env["DB_NAME"];

$conn = new mysqli($servername, $username, $password, $dbname);

function getAssociations($conn) {
    $stmt = $conn->prepare("SELECT ID, nom FROM associations");
    $stmt->execute();
    $result = $stmt->get_result();
    $associations = array();

    while ($row = $result->fetch_assoc()) {
        $associations[] = $row;
    }

    $stmt->close();
    return $associations;
}

$associations = getAssociations($conn);
$conn->close();

header('Content-Type: application/json');
echo json_encode($associations);