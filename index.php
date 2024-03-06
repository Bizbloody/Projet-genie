<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification des informations de connexion
if (isset($_POST["associations"]) && isset($_POST["mdp"])) {
    $pseudo1 = $_POST["associations"];
    $mdp = $_POST["mdp"];

    // Récupération du mot de passe haché et de idRPPS depuis la base de données
    $sql = "SELECT mdp, pseudo FROM associations WHERE pseudo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pseudo1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["mdp"];
        $pseudo2 = $row["pseudo"];

        // Vérification du mot de passe
        if (password_verify($mdp, $hashedPassword)) {
            // Connexion réussie
            $_SESSION["pseudo"] = $pseudo2;

            // Gestion du cookie "Se souvenir de moi"
            if (isset($_POST['remember'])) {
                // Création du cookie avec une durée de validité d'une semaine
                setcookie('remember_me', $pseudo2, time() + (7 * 24 * 60 * 60), '/');
            }

            header("Location: choix.html");
            exit();
        } else {
            // Mauvaise combinaison NomAssociation/mot de passe
            $erreur = "Adresse e-mail ou mot de passe incorrect";
            echo $mdp, $pseudo1, $pseudo2, $row["mdp"];
        }
    } else {
        // Utilisateur non trouvé
        $erreur = "pas trouvé";
    }
}


// Affichage de l'erreur, le cas échéant
if (isset($erreur)) {
    echo '<p class="erreur">' . $erreur . '</p>';
}

$conn->close();
?>