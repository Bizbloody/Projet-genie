<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ID']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php");
    exit();
}

require '../Model/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $pseudo = $_POST['pseudo'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO associations (role, pseudo, mdp) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $role, $pseudo, $mdp);


    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error adding association.";
    }
}
?>

