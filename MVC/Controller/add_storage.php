<?php

$env = parse_ini_file('../../.env');

$servername = $env["SERVER_NAME"];
$username = $env["USERNAME"];
$password = $env["PASSWORD"];
$dbname = $env["DB_NAME"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $ID_association = $_POST['association'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $deepness = $_POST['deepness'];
    $campus = $_POST['campus'];
    $floor = $_POST['floor'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO lieu (ID_association, nom, NDC_NDL, type, profondeur, etage, description_lieu, largeur, longueur) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssississi", $ID_association, $name, $campus, $type, $deepness, $floor, $description, $width, $length);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect or reload the page
    header("Location: add_storage.php");
    exit();

}
