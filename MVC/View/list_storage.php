<?php
include '../Controller/get_list_storage.php';
?>


<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/list_storage.css">
    <link rel="stylesheet" href="css/header.css">
  <title>Stock' ISEP - Liste des espaces</title>
</head>

<body>

<?php include 'header.html'; ?>

<div class="bandeau">
    <div class="bandeau1">Liste des espaces</div>
</div>
<div class="conteneur">
    <?php foreach ($storages as $storage): ?>
        <div class="storage">
            <div class="header_box">
                <div class="name"><?php echo $storage['nom']; ?></div>
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
    <a id="add_storage_button" href="new_storage.php">Ajouter un espace</a>

</div>


</body>
</html>