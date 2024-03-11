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
?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php
include "$racine/vue/header.php";
include "$racine/controller/$fichier";
include "$racine/vue/footer.php";
?>