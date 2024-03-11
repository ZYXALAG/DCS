<?php
require_once 'Manager.php';

class ManagerEvolVolumeFacture extends Manager
{
    public function getListeVolumesFacturesFromNom(string $nomProduit): array
{
    $liste = []; // Initialisation de la liste

    $q = $this->getPDO()->prepare('SELECT LF.mois, SUM(LF.volume) AS total_volume FROM ligne_facturation LF JOIN produit P ON LF.produitID = P.produitID WHERE P.NOM_PRODUIT = :nom AND LF.mois BETWEEN "2021-01-01" AND "2022-04-30" GROUP BY LF.mois ORDER BY LF.mois ASC;');
    $q->execute(['nom' => $nomProduit]);

    // Parcourir les résultats et les ajouter à la liste
    while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
        $liste[] = $r;
    }

    return $liste; // Retourner la liste des volumes facturés
}

}
?>