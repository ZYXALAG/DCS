<?php
$titre = "Modification Mdp - Mediateq";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $passwordTested = $_POST['Password'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Ajoutez ici la vérification du mot de passe côté serveur
    if ($newPassword !== $confirmNewPassword) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        $authManager = new AuthManager(new AbonneManager());

        // Ajoutez ici la vérification du mot de passe actuel avec la méthode appropriée
        if ($authManager->setNewPassword($passwordTested, $newPassword)) {
            header('Location:?action=infoPerso');
        } else {
            $erreur = "Mot de passe incorrect";
        }
    }
}

// appel du script de vue qui permet de gérer l'affichage des données
include "$racine/vue/header.php";
// affichage de l'erreur
if (isset($erreur)) {
    echo '<div id="message" class="alert alert-danger" style="display: block;">';
    echo $erreur;
    echo '</div>';
}
include "$racine/vue/v_modification_mdp.php";
include "$racine/vue/footer.php";
?>
