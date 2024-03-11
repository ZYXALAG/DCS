<?php

require_once 'Manager.php';
class ManagerEvoMensuelle extends Manager
{

    public function creerAbonne(Abonne $abonne): void
    {
        $q = $this->getPDO()->prepare('INSERT INTO abonne(nom, prenom, dateNaissance, adresse, adresseCourriel, NumeroTelephone, idTypeAbonnement, dateFinAbonnement, MotDePasse) VALUES(:nom, :prenom, :dateNaissance, :adresse, :email, :telephone, :typeAbonnement, :dateFinAbonnement, :motDePasse)');
        $q->execute([
            'nom' => $abonne->getNom(),
            'prenom' => $abonne->getPrenom(),
            'dateNaissance' => $abonne->getDateNaissance(),
            'adresse' => $abonne->getAdresse(),
            'email' => $abonne->getEmail(),
            'telephone' => $abonne->getTelephone(),
            'typeAbonnement' => $abonne->getTypeAbonnement(),
            'dateFinAbonnement' => $abonne->getDateFinAbonnement(),
            'motDePasse' => $abonne->getMotDePasse()
        ]);
    }
}
?>