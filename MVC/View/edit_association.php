<?php
include '../Controller/edit_association.php';

$options = [
    "Admin" => "Admin",
    "Association" => "Association"
];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Association</title>
    <link rel="stylesheet" href="css/admin-style.css">
</head>
<body>
    <h1>Edit Association</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($association['ID']); ?>">
        <label for="nom">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo htmlspecialchars($association['pseudo']); ?>" required>
        <br>
        <label for="role">Pseudo:</label>
        <select name="role">
            <?php foreach ($options as $value => $label): ?>
                <option value="<?php echo htmlspecialchars($value); ?>" <?php if ($value == $association['role']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="mdp">Mot de passe:</label>
        <input type="password" id="mdp" name="mdp" required>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
