<?php
include "$racine/model/ManagerAppliGC.php";

$titre = "GC Price";

$ManagerGC = new ManagerAppliGC(); 
$listeGC = $ManagerGC->AllGrandClientID();


$idGrandClient = 690;

if (isset($_POST['clientSelection'])) {
    $idGrandClient = $_POST['clientSelection'];
}



$listeAppbyGC = $ManagerGC->getAppliByGC($idGrandClient);



include "$racine/vue/header.php";
include "$racine/vue/v_top_app_by_GC.php";
include "$racine/vue/footer.php";

?>