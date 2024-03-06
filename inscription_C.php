<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else {
    echo "connexion réussie";
}

// Vérification si l'name, mdp ou numLicense existent déjà
$name = $_POST["name"];
$mdp = $_POST["mdp"];

$sql = "SELECT * FROM associations WHERE pseudo = ? OR mdp = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $mdp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Au moins un enregistrement avec le même name, mdp ou numLicense existe déjà, l'inscription échoue
    echo "le compte existe deja" ;
} else {
    // hachage mdp
    $hashedPassword = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    // Insertion de l'identité
    $sql = "INSERT INTO associations (nom, pseudo, mdp) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$_POST["name"], $_POST["name"], $hashedPassword);
    if ($stmt->execute()) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

$conn->close();
?>