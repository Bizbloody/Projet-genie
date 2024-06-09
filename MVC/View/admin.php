<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['user_pseudo'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Admin-specific functionality here
include '../Controller/admin.php';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin-style.css">
    <link rel="stylesheet" href="css/header_style.css">
</head>
<body>

<?php include 'header.html';?>

<div class="bandeau">
    <h1 class="bandeau1">Panneau administrateur</h1>
</div>
    <div class="container">

        <section class="sec">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_pseudo']); ?></h2>

            <div class="crud-section">
                <h2>Associations</h2>
                <a href="new_association.php" class="btn">Add New Association</a>
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Pseudo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($associations as $association): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($association['ID']); ?></td>
                            <td><?php echo htmlspecialchars($association['nom']); ?></td>
                            <td><?php echo htmlspecialchars($association['pseudo']); ?></td>
                            <td>
                                <a href="edit_association.php?id=<?php echo $association['ID']; ?>" class="btn">Edit</a>
                                <a href="delete_association.php?id=<?php echo $association['ID']; ?>" class="btn">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="crud-section">
                <h2>Lieux</h2>
                <!-- <a href="add_lieu.php" class="btn">Add New Lieu</a> -->
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Association</th>
                            <th>Nom</th>
                            <th>NDC/NDL</th>
                            <th>Type</th>
                            <th>Taille</th>
                            <th>Description Taille</th>
                            <th>Étage</th>
                            <th>Description Lieu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lieux as $lieu): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lieu['ID']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['ID_association']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['nom']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['NDC_NDL']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['type']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['taille']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['description_taille']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['etage']); ?></td>
                            <td><?php echo htmlspecialchars($lieu['description_lieu']); ?></td>
                            <td>
                                <!-- <a href="edit_lieu.php?id=<?php echo $lieu['ID']; ?>" class="btn">Edit</a>
                                <a href="delete_lieu.php?id=<?php echo $lieu['ID']; ?>" class="btn">Delete</a> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="crud-section">
                <h2>Reservations</h2>
                <!-- <a href="add_reservation.php" class="btn">Add New Reservation</a> -->
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Association</th>
                            <th>ID Lieu</th>
                            <th>Date Début</th>
                            <th>Date Fin</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reservation['ID']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['ID_association']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['ID_lieu']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['date_debut']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['date_fin']); ?></td>
                            <td><?php echo htmlspecialchars($reservation['status']); ?></td>
                            <td>
                                <!-- <a href="edit_reservation.php?id=<?php echo $reservation['ID']; ?>" class="btn">Edit</a>
                                <a href="delete_reservation.php?id=<?php echo $reservation['ID']; ?>" class="btn">Delete</a> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>