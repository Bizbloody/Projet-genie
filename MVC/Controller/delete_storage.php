<?php
$env = parse_ini_file('../../.env');

$servername = $env["SERVER_NAME"];
$username = $env["USERNAME"];
$password = $env["PASSWORD"];
$dbname = $env["DB_NAME"];

$conn = new mysqli($servername, $username, $password, $dbname);

function delete_lieu_by_id($conn, $id) {
    // Préparation de la requête
    $stmt = $conn->prepare("DELETE FROM lieu WHERE id = ?");

    // Liaison du paramètre
    $stmt->bind_param("i", $id);

    // Exécution de la requête
    $stmt->execute();

    // Vérification du succès de l'exécution
    if ($stmt->affected_rows > 0) {
        echo "Record deleted successfully";
    } else {
        echo "No record found with the provided ID";
    }

    // Fermeture de la requête
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);

}