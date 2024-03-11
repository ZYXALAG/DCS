<!-- controleur inscription -->
<?php
$titre = "Inscription - Mediateq";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = 0;
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $dateNaissance = $_POST['DateNaissance'];
    $adresse = $_POST['Adresse'];
    $email = $_POST['Email'];
    $telephone = $_POST['Telephone'];
    $typeAbonnement = $_POST['TypeAbonnement'];
    $dateFinAbonnement = $_POST['DateFinAbonnement'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $abonneManager = new AbonneManager();   

    $abonne = new Abonne($id, $nom, $prenom, $dateNaissance, $adresse, $email, $telephone, $typeAbonnement, $dateFinAbonnement, $password);
    $abonneManager->creerAbonne($abonne);
}

// appel du script de vue qui permet de gerer l'affichage des donnees
include "$racine/vue/header.php";
include "$racine/vue/v_inscription.php";
include "$racine/vue/footer.php";
?>