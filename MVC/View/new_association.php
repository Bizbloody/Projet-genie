<?php
include '../Controller/add_association.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Association</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>
<h1>Add Association</h1>
<form method="post">
    <label for="pseudo">Pseudo :</label>
    <input type="text" id="pseudo" name="pseudo" required>
    <br>
    <label for="role">Role :</label>
    <select name="role">
        <option value="">Sélectionner un rôle</option>
        <option value="Admin">Admin</option>
        <option value="Association">Association</option>
    </select>
    <br>
    <label for="mdp">Mot de passe :</label>
    <input type="password" id="mdp" name="mdp" required>
    <br>
    <button type="submit">Add</button>
</form>
</body>
</html>

