<?php

session_status() === PHP_SESSION_ACTIVE ?: session_start();

// QQN connecté ??
if (!isset($_SESSION['ID'])) {
    // Rediriger vers la page de connexion
    header("Location: home.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de salle</title>
    <script src='../../fullcalendar/core/locales/fr.global.js'></script>
    <script src='../../fullcalendar/core/index.global.js'></script>
    <script src='../../fullcalendar/daygrid/index.global.js'></script>
    <script src='../../fullcalendar/interaction/index.global.js'></script>
    <link rel="stylesheet" href="css/reservation_style.css">
    <link rel="stylesheet" href="css/calendar.css">
</head>
<body>
    <h1>Réservation d'espace de stockage</h1>
    <div class="link">
        <a id="button_list" href="list_storage.php">Accéder à la liste des espaces</a>
    </div>
    <form action="deconnexion.php" method="post">
        <div class="deco">
            <button type="submit" >déconnexion</button>
        </div>
    </form>
    <form id="reservationForm">
        <input type="hidden" id="selectedDate" name="selectedDate">
        <select type="storage" id="selectedStorage" name="selectedStorage">
            <option value="">---</option>
            <option value="storage_id">Storage</option>
        </select>
        <div class="spaceBetweenButtons"></div>
        <button type="submit" >Réserver</button>
    </form>
    <div id="calendar"></div>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Select a place:</h3>
        <ul id="placeList"></ul>
      </div>
    </div>
    <script src='reservation_script.js'></script>


</body>
</html>
