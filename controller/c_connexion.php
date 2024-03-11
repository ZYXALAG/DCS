<?php


$titre = "Connexion - Mediateq";


$message = '';
include "$racine/vue/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['AdresseCourriel'];
    $password = $_POST['MotDePasse'];

    $abonneManager = new AbonneManager();
    $authManager = new AuthManager($abonneManager);

    if ($authManager->login($email, $password)) {
        header('Location: ?action=accueil');
        exit();
    } else {
        $couleur = false;
        $message = 'Adresse mail ou mot de passe incorrect.';
    }

    echo '<div id="message" class="alert alert-danger" style="display: block;">';
    echo $message;
    echo '</div>';
}

include "$racine/vue/v_connexion.php";
include "$racine/vue/footer.php";


?>
