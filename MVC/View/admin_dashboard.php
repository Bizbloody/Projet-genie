<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] != 'Admin') {
    header("Location: ../index.php");
    exit();
}

// Admin-specific functionality here
include '../Controller/admin.php';
include '../Controller/get_list_storage.php';


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/list_storage.css">

</head>
<body>

<?php include 'header.html';?>

<div class="bandeau">
    <h1 class="bandeau1">Panneau administrateur</h1>
</div>
    <div class="container">

        <section class="sec">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['pseudo']); ?></h2>

            <div class="crud-section">
                <h2>Associations</h2>
                <a href="new_association.php" class="btn">Add New Association</a>
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Pseudo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($associations as $association): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($association['ID']); ?></td>
                            <td><?php echo htmlspecialchars($association['role']); ?></td>
                            <td><?php echo htmlspecialchars($association['pseudo']); ?></td>
                            <td>
                                <a href="edit_association.php?id=<?php echo $association['ID']; ?>" class="btn">Edit</a>
                                <a href="../Controller/delete_association.php?id=<?php echo $association['ID']; ?>" class="btn">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="crud-section">
                <h2>Espaces de stockage</h2>
                <?php foreach ($storages as $storage): ?>
                    <div class="storage">
                        <div class="header_box">
                            <div class="name"><?php echo $storage['nom']; ?></div>
                            <form action="" method="post">
                                <input type="hidden" name="id_to_delete" value="<?php echo $storage['ID']?>">
                                <button type="submit" name="delete_button">Supprimer</button>
                            </form>
                        </div>
                        <hr class="separator">
                        <div class="details">
                            <div class="asso"><strong>Association propriétaire : </strong><?php echo $storage['ID_association']; ?></div>
                            <div class="size">
                                <div class="type"><strong>Type : </strong><?php echo $storage['type']; ?></div>
                                <div class="volume"><strong>Volume (l x L x P) : </strong><?php echo $storage['largeur']; ?> x <?php echo $storage['longueur']; ?> x <?php echo $storage['profondeur']; ?></div>
                            </div>
                            <div class="place">
                                <div class="campus"><strong>Campus : </strong><?php echo $storage['NDC_NDL']; ?></div>
                                <div class="etage"><strong>Etage : </strong><?php echo $storage['etage']; ?></div>
                            </div>
                            <div class="description_lieu"><strong>Description : </strong><?php echo $storage['description_lieu']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
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