<?php

require '../Model/db.php';

// Function to fetch all associations
function fetchAssociations($conn) {
    $stmt = $conn->prepare("SELECT * FROM associations");
    $stmt->execute();
    $result = $stmt->get_result();
    $associations = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $associations;
}

// Function to fetch all lieux
function fetchLieux($conn) {
    $stmt = $conn->prepare("SELECT * FROM lieu");
    $stmt->execute();
    $result = $stmt->get_result();
    $lieux = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $lieux;
}

// Function to fetch all reservations
function fetchReservations($conn) {
    $stmt = $conn->prepare("SELECT * FROM reservation");
    $stmt->execute();
    $result = $stmt->get_result();
    $reservations = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $reservations;
}

// Fetch all data
$associations = fetchAssociations($conn);
$lieux = fetchLieux($conn);
$reservations = fetchReservations($conn);