<?php
include "ManagerEvolVolumeFacture.php";

$titre = "Informations personnelles - Mediateq";

// Variables
$ManagerEVF = new ManagerEvolVolumeFacture(); 

$ListeProd1_1 = $ManagerEVF.getListeVolumesFacturesFromNom("PRODUIT1_1");
$ListeProd1_4 = $ManagerEVF.getListeVolumesFacturesFromNom("PRODUIT1_4");

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/v_evolVolumeFacture.php";
?>