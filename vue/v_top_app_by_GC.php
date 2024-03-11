<form id="clientSelectionForm" action="?action=appligc" method="post">
    <div class="form-group" style="display: flex; align-items: center;">
        <label for="clientSelection" style="margin-right: 10px; margin-top: 10px;">Sélectionner un GrandClient :</label>
        <select class="form-control" id="clientSelection" name="clientSelection">
            <?php foreach ($listeGC as $client): ?>
                <?php $selected = ($client['NomGrandClient'] === $_POST['clientSelection']) ? 'selected' : ''; ?>
                <option value="<?php echo $client['NomGrandClient']; ?>" <?php echo $selected; ?>><?php echo $client['NomGrandClient']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary" style="margin-left: 10px;">Valider</button>
    </div>
</form>

<?php
$listeJSON = json_encode($listeAppbyGC);
?>

<style>
    /* Ajout de styles pour contrôler la taille de la liste déroulante */
    .form-control {
        width: 200px; /* Vous pouvez ajuster cette valeur selon vos besoins */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var $listeAppbyGC = <?php echo $listeJSON; ?>;
        var nomsApplis = Object.keys($listeAppbyGC);
        var totalPrix = Object.values($listeAppbyGC);
        
        // Récupération de l'élément canvas pour afficher le graphique
        var graphTarget = document.getElementById("graphCanvas");

        // Création du graphique initial avec Chart.js
        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: {
                labels: nomsApplis,
                datasets: [{
                    label: 'Coût par application',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1,
                    data: totalPrix
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return data.labels[tooltipItem.index] + ': ' + tooltipItem.yLabel + ' €';
                        }
                    }
                }
            }
        });

        // Fonction pour mettre à jour le graphique
        function updateGraph(selectedClient) {
            var dataForSelectedClient = $listeAppbyGC[selectedClient];
            barGraph.data.labels = Object.keys(dataForSelectedClient);
            barGraph.data.datasets[0].data = Object.values(dataForSelectedClient);
            barGraph.update();
        }

        // Écouteur d'événement pour la sélection de la liste déroulante
        document.getElementById("clientSelection").addEventListener('change', function () {
            var selectedClient = this.value;
            updateGraph(selectedClient);
        });
    });
</script>

<div id="chart-container">
    <canvas id="graphCanvas"></canvas>
</div>
