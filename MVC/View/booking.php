<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();

// QQN connecté ??
if (!isset($_SESSION['ID'])) {
    // Rediriger vers la page de connexion
    header("Location: ../index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock' ISEP - Réservation de salle</title>
    <script src='../../fullcalendar/core/locales/fr.global.js'></script>
    <script src='../../fullcalendar/core/index.global.js'></script>
    <script src='../../fullcalendar/daygrid/index.global.js'></script>
    <script src='../../fullcalendar/interaction/index.global.js'></script>
    <link rel="stylesheet" href="css/booking.css">
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<?php include 'header.html' ?>
    <div class="bandeau">
        <h1>Réservation d'espace de stockage</h1>
    </div>
    <div class="link">
        <a id="button_list" href="list_storage.php">Accéder à la liste des espaces</a>
    </div>
    <form id="reservationForm">
        <input type="hidden" id="selectedDate" name="selectedDate">
        <select type="storage" id="selectedStorage" name="selectedStorage">
            <option value="">---</option>
        </select>
        <div class="spaceBetweenButtons"></div>
    </form>
    <div id="calendar"></div>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Select a place:</h3>
        <ul id="placeList"></ul>
      </div>
    </div>
    <script src='booking.js'></script>


</body>
</html>
