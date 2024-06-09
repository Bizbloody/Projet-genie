<?php

function get_all_lieu($conn) {
    $stmt = $conn->prepare("SELECT * FROM lieu");

    // Exécution de la requête
    $stmt->execute();

    // Récupération du résultat de la requête
    $result = $stmt->get_result();
    return $result;
}

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
}