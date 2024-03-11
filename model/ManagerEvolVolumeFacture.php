<?php
require_once 'Manager.php';

class ManagerEvolVolumeFacture extends Manager
{
    public function getListeVolumesFacturesFromNom(string $nomProduit, string $dateDebut, string $dateFin): array
    {
        $liste = []; // Initialisation de la liste

        $q = $this->getPDO()->prepare('
            SELECT LF.mois, SUM(LF.volume) AS total_volume 
            FROM ligne_facturation LF 
            JOIN produit P ON LF.produitID = P.produitID 
            WHERE P.NOM_PRODUIT = :nom 
            AND LF.mois BETWEEN :dateDebut AND :dateFin 
            GROUP BY LF.mois 
            ORDER BY LF.mois ASC;
        ');

        $q->execute([
            'nom' => $nomProduit,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin
        ]);

        // Parcourir les résultats et les ajouter à la liste
        while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = $r;
        }

        return $liste; // Retourner la liste des volumes facturés
    }

    public function getAllProducts(): array
    {
        $products = [];

        $q = $this->getPDO()->query('SELECT produitID, NOM_PRODUIT FROM produit');

        while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
            $products[$row['NOM_PRODUIT']] = $row['produitID'];
        }

        return $products;
    }
}
?>