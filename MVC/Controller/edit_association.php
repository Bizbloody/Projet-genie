<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ID']) || $_SESSION['role'] !== 'Admin') {
    header("Location: ../index.php");
    exit();
}

require '../Model/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM associations WHERE ID = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $association = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $role = $_POST['role'];
    $pseudo = $_POST['pseudo'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE associations SET role = ?, pseudo = ?, mdp = ? WHERE ID = ?");
    $stmt->bind_param('sssi', $role, $pseudo, $mdp, $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating association: " . $stmt->error;
    }
}
