<?php
function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["accueil"] = "c_accueil.php";
    $lesActions["connexion"] = "c_connexion.php";
    $lesActions["inscription"] = "c_inscription.php";
    $lesActions["deconnexion"] = "c_deconnexion.php";
    $lesActions["modifMdp"] = "c_modification_mdp.php";
    

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["accueil"];
    }
}

function chargerModeles($racine){
}
?>

