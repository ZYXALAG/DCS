<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Évolution Mensuelle par Client</title>
</head>
<body>
    <div class="container">
        <h1>Évolution Mensuelle par Client</h1>

        <div class="row">
            <div class="col-md-6">
                <label for="client-select">Sélectionnez un client:</label>
                <select id="client-select" class="form-control">
                    <?php foreach ($resultatsGroupes as $client => $donnees): ?>
                        <option value="<?= $client ?>"><?= $client ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="compare-select">Comparer avec:</label>
                <select id="compare-select" class="form-control">
                    <?php foreach ($resultatsGroupes as $client => $donnees): ?>
                        <option value="<?= $client ?>"><?= $client ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <button id="confirm-btn" class="btn btn-primary">Confirmer</button>
            </div>
        </div>

        <canvas id="myChart" class="mt-3"></canvas>

        <!-- Script JavaScript -->
        <script>
            const resultatsGroupes = <?= json_encode($resultatsGroupes) ?>;

            let myChart;

            function drawChart(selectedData, compareData) {
                if (myChart) {
                    myChart.destroy();
                }

                const labels = selectedData.map(data => `${data['annee']}-${data['mois']}`);
                const prixSelected = selectedData.map(data => data['prix']);
                const prixCompare = compareData.map(data => data['prix']);

                const ctx = document.getElementById('myChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Sélectionné',
                            data: prixSelected,
                            borderColor: 'rgb(75, 192, 192)',
                            fill: false
                        }, {
                            label: 'Comparé',
                            data: prixCompare,
                            borderColor: 'rgb(255, 99, 132)',
                            fill: false
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            document.getElementById('confirm-btn').addEventListener('click', function() {
                const selectedClient = document.getElementById('client-select').value;
                const compareClient = document.getElementById('compare-select').value;

                const selectedData = resultatsGroupes[selectedClient];
                const compareData = resultatsGroupes[compareClient];

                drawChart(selectedData, compareData);
            });
        </script>
    </div>
</body>
</html>
