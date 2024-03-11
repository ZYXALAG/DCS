<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste déroulante</title>
</head>
<body>

<select name="maListeDeroulante" id="maListeDeroulante">
    <?php
    // Tableau des valeurs
    $valeurs = $listeGC

    // Générer les options de la liste déroulante
    foreach ($valeurs as $valeur) {
        echo "<option value='$valeur'>$valeur</option>";
    }
    ?>
</select>

</body>
</html>