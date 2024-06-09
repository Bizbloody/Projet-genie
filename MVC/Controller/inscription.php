<?php
include '../Model/db.php';
include '../Model/association_queries.php';
$name = $_POST["name"];
$mdp = $_POST["mdp"];

$result = get_user($conn, $name);

if ($result->num_rows > 0) {
    echo "le compte existe deja" ;
    $conn->close();
    header("Location: ../View/inscription.html");

} else {
    $role = 'Association';
    // hachage mdp
    $hashedPassword = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    // Insertion de l'identité
    $sql = "INSERT INTO associations (role, pseudo, mdp) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$role, $_POST["name"], $hashedPassword);
    if ($stmt->execute()) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $result = get_user($conn, $name);
        $user = $result->fetch_assoc();
        $_SESSION['ID'] = $user['ID'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['role'] = $user['role'];
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: ../View/booking.php");

?>