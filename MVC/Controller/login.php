<?php
// Check if a session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../Model/db.php';
require '../Model/association_queries.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];

    // Prepare and execute the query to fetch user data based on the pseudo
    $result = get_user($conn, $pseudo);
    $user = $result->fetch_assoc();
// Vérifiez le mot de passe
    if ($user && password_verify($mdp, $user['mdp'])) {
        // Stockez les données utilisateur dans la session
        $_SESSION['ID'] = $user['ID'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['role'] = $user['role'];

        // Redirigez en fonction du rôle de l'utilisateur
        if ($user['role'] == 'Admin') {
            header("Location: ../View/admin_dashboard.php");
            exit();
        } else {
            header("Location: ../View/booking.php");
            exit();
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.<br>";
    }

// Fermez la déclaration et la connexion
    $stmt->close();
    $conn->close();
}