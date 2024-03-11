<?php
include "$racine/model/ManagerAppliGC.php";

$titre = "GC Price";

$ManagerGC = new ManagerAppliGC(); 
$listeGC = $ManagerGC->AllGrandClientID();


$idGrandClient = 690;

if (isset($_POST['clientSelection'])) {
    $nomGrandClient = $_POST['clientSelection'];
    $idGrandClient = $ManagerGC->getID($nomGrandClient);
}



$listeAppbyGC = $ManagerGC->getAppliByGC($idGrandClient);



include "$racine/vue/v_top_app_by_GC.php";

?>