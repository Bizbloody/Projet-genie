<?php

include '../Model/db.php';
include '../Model/lieu_queries.php';

function get_list($conn){
    $result = get_all_lieu($conn);

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
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}

$conn->close();

