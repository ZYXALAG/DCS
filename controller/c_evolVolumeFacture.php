<?php
include "$racine/model/ManagerEvolVolumeFacture.php";

$titre = "Informations personnelles - Mediateq";

// Variables par défaut
$selectedProduct = "bothProducts"; // Par défaut, afficher les deux produits

// Vérification de la sélection de l'utilisateur
if (isset($_POST['productSelection'])) {
    $selectedProduct = $_POST['productSelection'];
}

// Variables
$ManagerEVF = new ManagerEvolVolumeFacture(); 

// Liste des volumes facturés en fonction de la sélection de l'utilisateur
if ($selectedProduct == "product1") {
    $ListeVolumes = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_1");
} elseif ($selectedProduct == "product4") {
    $ListeVolumes = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_4");
} else {
    // Si l'utilisateur a sélectionné les deux produits, fusionnez les deux listes
    $ListeProd1_1 = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_1");
    $ListeProd1_4 = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_4");
}

// Appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/header.php";
include "$racine/vue/v_evolVolumeFacture.php";
include "$racine/vue/footer.php";
?>
