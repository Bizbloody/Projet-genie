<?php

include 'delete_storage.php';

$env = parse_ini_file('../../.env');

$servername = $env["SERVER_NAME"];
$username = $env["USERNAME"];
$password = $env["PASSWORD"];
$dbname = $env["DB_NAME"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function get_list($c){
    $stmt = $c->prepare("SELECT * FROM lieu");

    // Exécution de la requête
    $stmt->execute();

    // Récupération du résultat de la requête
    $result = $stmt->get_result();

    $storages = array();
    if ($result->num_rows > 0) {
        // Extraction des données de chaque ligne
        while ($row = $result->fetch_assoc()) {
            $storages[] = $row;
        }
    }
    return $storages;
}

$storages = get_list($conn);

if (isset($_POST['delete_button'])) {
    if(isset($_POST['id_to_delete'])) {
        $id_to_delete = $_POST['id_to_delete'];
        delete_lieu_by_id($conn, $id_to_delete);
    }
}

$conn->close();

