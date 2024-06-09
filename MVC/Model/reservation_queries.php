<?php
function get_all_reservation_by_lieu($conn, $lieuId) {
    $query = "SELECT * FROM reservation WHERE ID_lieu = $lieuId;";
    $result = mysqli_query($conn, $query);
    return $result;
}