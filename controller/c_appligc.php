<?php
include "ManagerAppliGC.php";

$titre = "Wissem";

// Variables
$ManagerGC = new ManagerAppliGC(); 
$listeGC = $ManagerGC.AllGrandClientID();
$listeAppbyGC = $ManagerGC.getAppliByGC();

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/v_top_app_by_GC.php";
?>