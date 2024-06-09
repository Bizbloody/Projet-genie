<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/new_storage.css">
  <title>Ajouter un espace de stockage</title>
  <script src='new_storage.js'></script>
  <script src="get_associations_name.js"></script>
    <link rel="stylesheet" href="css/header_style.css">
</head>
<body>

<?php include 'header.html'; ?>

<div class="bandeau">
  <div class="bandeau1">Nouvel espace</div>
</div>
<div class="conteneur">
  <form name="add_storage" method="post" action="../Controller/add_storage.php" onsubmit="return validateForm()">
  <div class="conteneur2">
      <div class="input">
        <label class="name_label">Nom :</label>
        <input type="text" name="name" class="mail1">
        <span class="error" id="nameError"></span>
      </div>
      <div class="input">
        <label class="association_label">Association propriétaire :</label>
        <select id="association" name="association">
          <option value="">Sélectionnez une association propriétaire</option>
        </select>
        <span class="error" id="associationError"></span>
      </div>
      <div class="input">
        <label class="type_label">Type :</label>
        <select id="type" name="type">
          <option value="">Sélectionnez un type</option>
          <option value="Armoire">Armoire</option>
          <option value="Etagère">Etagère</option>
          <option value="Boîte">Boîte</option>
          <option value="Surface au sol">Surface au sol</option>
        </select>
        <span class="error" id="typeError"></span>
      </div>
      <div class="size">
        <div class="input">
          <label class="width_label">Largeur (en cm) :</label>
          <input type="number" name="width" class="width">
          <span class="error" id="widthError"></span>
        </div>
        <div class="input">
          <label class="length_label">Longueur (en cm) :</label>
          <input type="number" name="length" class="length">
          <span class="error" id="lengthError"></span>
        </div>
        <div class="input">
          <label class="deepness_label">Profondeur (en cm) :</label>
          <input type="number" name="deepness" class="deepness">
          <span class="error" id="deepnessError"></span>
        </div>
      </div>
      <div class="place">
        <div class="input">
          <label class="campus_label">Campus :</label>
          <select id="campus" name="campus" onchange="updateFloorOptions()">
            <option value="">Sélectionnez un campus</option>
            <option value="NDC">NDC</option>
            <option value="NDL">NDL</option>
          </select>
          <span class="error" id="campusError"></span>
        </div>
        <div class="input">
          <label class="floor_label">Etage :</label>
          <select id="floor" name="floor">
            <option value="">Sélectionnez un étage</option>
          </select>
          <span class="error" id="floorError"></span>
        </div>
      </div>
      <div class="input">
        <label class="description_label">Description :</label>
        <div class="box3"><input type="text" name="description" class="description"></div>
        <span class="error" id="descriptionError"></span>
      </div>

  </div>
  <div class="buttons">
    <input type="submit" name="Submit" value="Valider">
    <a id="add_storage_button" href="list_storage.php">Annuler</a>
  </div>
  </form>


</div>


</body>
</html>

