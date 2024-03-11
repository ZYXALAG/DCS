<?php

require_once 'Manager.php';

class ManagerAppliGC extends Manager
{

    public function getAppliByGC(int $idGrandClient): array
    {
        $liste = [];
        $q = $this->getPDO()->prepare('SELECT a.nomAppli, SUM(lf.prix) AS total_prix
        FROM ligne_facturation lf
        JOIN application a ON lf.IRT = a.IRT
        JOIN clients c ON lf.CentreActiviteID = c.CentreActiviteID
        WHERE c.GrandClientID = :id
        GROUP BY a.nomAppli
        ORDER BY total_prix DESC
        LIMIT 10;
        ');
        $q->execute(['id' => $idGrandClient]);

        while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
            $liste[$row['nomAppli']] = $row['total_prix'];
        }

        return $liste;
    }

    public function AllGrandClientID(): array
    {
        $liste = [];
        $q = $this->getPDO()->prepare('SELECT gc.NomGrandClient FROM grandclients gc');
        $q->execute();

        while ($r = $q->fetch(PDO::FETCH_ASSOC)) {
            $liste[] = $r;
        }

        return $liste;
    }

    public function getID(string $nomGrandClient): int {
        $q = $this->getPDO()->prepare('SELECT gc.GrandClientID FROM grandclients gc WHERE NomGrandClient = :nom');
        $q->execute(['nom' => $nomGrandClient]);
        $resultat = $q->fetch(); // Récupérer le résultat de la requête
    
        // Vérifier si des données ont été retournées
        if ($resultat) {
            // Retourner l'ID du grand client trouvé
            return $resultat['GrandClientID'];
        } else {
            // Retourner une valeur par défaut ou lancer une exception selon le cas
            return 0; // Valeur par défaut en cas d'échec de la recherche
        }
    }
    
}
?>