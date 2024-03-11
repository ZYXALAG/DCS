<?php
include "$racine/model/ManagerEvolVolumeFacture.php";

$titre = "Informations personnelles - Mediateq";

// Variables par défaut
$selectedProduct = "bothProducts"; // Par défaut, afficher les deux produits

// Vérification de la sélection de l'utilisateur
if (isset($_POST['productSelection'])) {
    $selectedProduct = $_POST['productSelection'];
}

// Dates de début et de fin par défaut
$dateDebut = "2021-01-01";
$dateFin = "2022-04-30";

// Vérification des dates sélectionnées par l'utilisateur
if (isset($_POST['start_date'])) {
    $dateDebut = $_POST['start_date'];
}
if (isset($_POST['end_date'])) {
    $dateFin = $_POST['end_date'];
}

// Variables
$ManagerEVF = new ManagerEvolVolumeFacture(); 

// Liste des volumes facturés en fonction de la sélection de l'utilisateur
if ($selectedProduct == "product1") {
    $ListeProd1_1 = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_1", $dateDebut, $dateFin);
} elseif ($selectedProduct == "product4") {
    $ListeProd1_4 = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_4", $dateDebut, $dateFin);
} else {
    // Si l'utilisateur a sélectionné les deux produits, fusionnez les deux listes
    $ListeProd1_1 = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_1", $dateDebut, $dateFin);
    $ListeProd1_4 = $ManagerEVF->getListeVolumesFacturesFromNom("PRODUIT1_4", $dateDebut, $dateFin);
}

// Appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/v_evolVolumeFacture.php";
?>
