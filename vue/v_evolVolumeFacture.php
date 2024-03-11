<h2>Liste des volumes facturés pour le produit PRODUIT1_1</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste1_1 as $row): ?>
                <tr>
                    <td><?php echo $row['mois']; ?></td>
                    <td><?php echo $row['volume']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Liste des volumes facturés pour le produit PRODUIT1_4</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste1_4 as $row): ?>
                <tr>
                    <td><?php echo $row['mois']; ?></td>
                    <td><?php echo $row['volume']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>