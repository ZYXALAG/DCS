<?php
include "getRacine.php";
require_once "infoBDD.inc.php";
include "$racine/controller/controleurPrincipal.php";
chargerModeles($racine);


if (isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    $action = "defaut";
}

$fichier = controleurPrincipal($action);
include "$racine/controller/$fichier";
?>