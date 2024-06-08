<?php
// Détruire la session existante pour fermer la session
session_start();
session_destroy();

// Rediriger vers la page de connexion ou toute autre page appropriée après la déconnexion
header("Location: ../View/index.html");
exit();
?>