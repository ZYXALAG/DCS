<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($ListeProd1_1) && !isset($ListeProd1_4) ): ?>
            // Si vous avez une seule liste de volumes
            var mois = <?php echo json_encode(array_column($ListeProd1_1, 'mois')); ?>;
            var volumes = <?php echo json_encode(array_column($ListeProd1_1, 'total_volume')); ?>; // Utilisation de 'total_volume' au lieu de 'volume'
        <?php elseif (!isset($ListeProd1_1) && isset($ListeProd1_4) ): ?>
            // Si vous avez une seule liste de volumes
            var mois = <?php echo json_encode(array_column($ListeProd1_4, 'mois')); ?>;
            var volumes = <?php echo json_encode(array_column($ListeProd1_4, 'total_volume')); ?>; // Utilisation de 'total_volume' au lieu de 'volume'
        <?php else: ?>
            // Si vous avez les deux listes de volumes
            var mois1_1 = <?php echo json_encode(array_column($ListeProd1_1, 'mois')); ?>;
            var volumes1_1 = <?php echo json_encode(array_column($ListeProd1_1, 'total_volume')); ?>; // Utilisation de 'total_volume' au lieu de 'volume'
            var mois1_4 = <?php echo json_encode(array_column($ListeProd1_4, 'mois')); ?>;
            var volumes1_4 = <?php echo json_encode(array_column($ListeProd1_4, 'total_volume')); ?>; // Utilisation de 'total_volume' au lieu de 'volume'
        <?php endif; ?>
        
        // Création de la structure de données pour Chart.js
        <?php if (isset($ListeProd1_1) && isset($ListeProd1_4) ): ?>
            var chartData = {
                labels: mois,
                datasets: [{
                    label: 'Volumes facturés',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1,
                    data: volumes
                }]
            };
        <?php else: ?>
            var chartData = {
                labels: mois1_1, // Utilisation des mêmes mois pour les deux produits
                datasets: [{
                    label: 'Volumes facturés pour PRODUIT1_1',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1,
                    data: volumes1_1
                }, {
                    label: 'Volumes facturés pour PRODUIT1_4',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1,
                    data: volumes1_4
                }]
            };
        <?php endif; ?>

        // Récupération de l'élément canvas pour afficher le graphique
        var graphTarget = document.getElementById("graphVolumesCanvas");

        // Création du graphique avec Chart.js
        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartData
        });
    });

    function resetDates() {
        // Réinitialisation des valeurs des champs de date
        document.getElementById('start_date').value = '2021-01-01';
        document.getElementById('end_date').value = '2022-04-30';
    }
</script>

<form id="productSelectionForm" method="post" action="?action=evolVolumeFacture">
    <div class="btn-group" role="group" aria-label="Choix du produit">
        <input type="radio" class="btn-check" name="productSelection" id="product1Radio" value="product1" <?php if (isset($ListeProd1_1)) { echo "checked"; } ?>>
        <label class="btn btn-outline-primary mx-2" for="product1Radio">
            Produit 1
        </label>

        <input type="radio" class="btn-check" name="productSelection" id="product4Radio" value="product4" <?php if (isset($ListeProd1_4)) { echo "checked"; } ?>>
        <label class="btn btn-outline-primary mx-2" for="product4Radio">
            Produit 4
        </label>

        <input type="radio" class="btn-check" name="productSelection" id="bothProductsRadio" value="bothProducts" <?php if (isset($ListeProd1_4) && isset($ListeProd1_1)) { echo "checked"; } ?>>
        <label class="btn btn-outline-primary mx-2" for="bothProductsRadio">
            Les deux produits
        </label>
    </div>

    <div class="form-group mt-3">
        <label for="start_date">Date de début :</label>
        <input type="date" class="form-control" id="start_date" name="start_date" min="2021-01-01" value="<?php echo $dateDebut; ?>" required>
    </div>

    <div class="form-group">
        <label for="end_date">Date de fin :</label>
        <input type="date" class="form-control" id="end_date" name="end_date" max="2022-04-30" value="<?php echo $dateFin; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary" name="Actualiser">ACTUALISER</button>
    <button type="button" class="btn btn-secondary" onclick="resetDates()">Réinitialiser</button>
</form>



<?php if (isset($ListeProd1_1) && !isset($ListeProd1_4)): ?>
    <!-- Si vous avez une seule liste de volumes -->
    <h2>Liste des volumes facturés pour le produit PRODUIT1_1</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ListeProd1_1 as $row): ?>
                <tr>
                    <td><?php echo $row['mois']; ?></td>
                    <td><?php echo $row['total_volume']; ?></td> <!-- Utilisation de 'total_volume' au lieu de 'volume' -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif (!isset($ListeProd1_1) && isset($ListeProd1_4)): ?>
    <!-- Si vous avez une seule liste de volumes -->
    <h2>Liste des volumes facturés pour le produit PRODUIT1_4</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Volume</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ListeProd1_4 as $row): ?>
                <tr>
                    <td><?php echo $row['mois']; ?></td>
                    <td><?php echo $row['total_volume']; ?></td> <!-- Utilisation de 'total_volume' au lieu de 'volume' -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <!-- Si vous avez les deux listes de volumes -->
    <div class="row">
        <div class="col-md-6">
            <div class="table-responsive">
                <h2>Liste des volumes facturés pour le produit PRODUIT1_1</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Volume</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ListeProd1_1 as $row): ?>
                            <tr>
                                <td><?php echo $row['mois']; ?></td>
                                <td><?php echo $row['total_volume']; ?></td> <!-- Utilisation de 'total_volume' au lieu de 'volume' -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="table-responsive">
                <h2>Liste des volumes facturés pour le produit PRODUIT1_4</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Volume</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ListeProd1_4 as $row): ?>
                            <tr>
                                <td><?php echo $row['mois']; ?></td>
                                <td><?php echo $row['total_volume']; ?></td> <!-- Utilisation de 'total_volume' au lieu de 'volume' -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<div id="graphvolumes">
    <canvas id="graphVolumesCanvas"></canvas>
</div>