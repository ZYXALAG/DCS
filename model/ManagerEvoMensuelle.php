<?php

require_once 'Manager.php';

class ManagerEvoMensuelle extends Manager
{
    public function getEvoMensuelle()
    {
        $req = $this->getPDO()->prepare('SELECT grandclients.NomGrandClient, YEAR(ligne_facturation.mois) AS Annee, MONTH(ligne_facturation.mois) AS Mois, SUM(ligne_facturation.prix) AS SommePrix FROM `ligne_facturation`
        JOIN centresactivite ON centresactivite.CentreActiviteID = ligne_facturation.CentreActiviteID
        JOIN clients ON clients.CentreActiviteID = centresactivite.CentreActiviteID
        JOIN grandclients ON grandclients.GrandClientID = clients.GrandClientID
        WHERE ligne_facturation.mois >= "2021-01-01" AND ligne_facturation.mois <= "2022-04-01"
        GROUP BY grandclients.NomGrandClient, Annee, Mois
        ORDER BY grandclients.NomGrandClient;');
        $req->execute();

        $resultatsGroupes = array();

        while ($row = $req->fetch()) {
            $client = $row['NomGrandClient'];

            if (!isset($resultatsGroupes[$client])) {
                $resultatsGroupes[$client] = array();
            }

            $resultatsGroupes[$client][] = array(
                'annee' => $row['Annee'],
                'mois' => $row['Mois'],
                'prix' => $row['SommePrix']
            );
        }

        return $resultatsGroupes;
    }
}
?>
