<?php
function get_user($conn, $pseudo) {
    $sql = "SELECT * FROM associations WHERE pseudo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pseudo);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getAssociations($conn) {
    $stmt = $conn->prepare("SELECT ID, pseudo FROM associations WHERE role='Association'");
    $stmt->execute();
    $result = $stmt->get_result();
    $associations = array();

    while ($row = $result->fetch_assoc()) {
        $associations[] = $row;
    }

    $stmt->close();
    return $associations;
}