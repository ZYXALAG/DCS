<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Évolution Mensuelle par Client</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Évolution Mensuelle par Client</h1>

    <?php if (isset($resultatsGroupes)): ?>
        <?php foreach ($resultatsGroupes as $client => $donnees): ?>
            <h2><?= $client ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>Année</th>
                        <th>Mois</th>
                        <th>Total Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donnees as $donneesClient): ?>
                        <tr>
                            <td><?= $donneesClient['annee'] ?></td>
                            <td><?= $donneesClient['mois'] ?></td>
                            <td><?= $donneesClient['prix'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune donnée disponible.</p>
    <?php endif; ?>
</body>
</html>
