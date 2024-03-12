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

    /* Ajout de styles pour contrôler la taille du conteneur des graphiques */
    #graph-container {
        display: flex;
        justify-content: center; /* Centrage horizontal */
        margin-top: 10px; /* Espacement entre la liste déroulante et les graphiques */
    }

    /* Ajout de styles pour contrôler la taille des graphiques */
    .graph-canvas {
        max-width: 60%; /* Ajustez cette valeur selon vos besoins */
        margin: 5px; /* Espacement entre les graphiques */
        display: block; /* Afficher initialement le graphique en barres */
    }

    /* Ajout de styles pour la séparation entre les graphiques */
    .graph-separator {
        width: 2px;
        background-color: #ccc; /* Couleur de la séparation */
        margin: 0 150px; /* Marge autour de la séparation */
        margin-left: 0px; /* Décalage de 20 pixels vers la gauche */
    }
</style>

<div id="graph-container">
    <!-- Graphique en secteurs (pie) -->
    <div style="position: relative; width: 600px; height: 600px;">
        <canvas id="pieCanvas" class="graph-canvas" style="position: absolute; top: 100; left: 0; right: 0; bottom: 0;"></canvas>
    </div>

    <!-- Séparation entre les graphiques -->
    <div class="graph-separator" ></div>

    <!-- Graphique en barres -->
    <canvas id="barCanvas" class="graph-canvas"></canvas>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var $listeAppbyGC = <?php echo $listeJSON; ?>;
        var nomsApplis = Object.keys($listeAppbyGC);
        var totalPrix = Object.values($listeAppbyGC);
        var couleurPalette = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 0, 0, 0.2)',
            'rgba(0, 255, 0, 0.2)',
            'rgba(0, 0, 255, 0.2)',
            'rgba(128, 128, 128, 0.2)'
        ];

        // Récupération de l'élément canvas pour afficher le graphique en barres
        var barCanvas = document.getElementById("barCanvas");

        // Création du graphique en barres avec Chart.js
        var barGraph = new Chart(barCanvas, {
            type: 'bar',
            data: {
                labels: nomsApplis,
                datasets: [{
                    label: 'Coût par application',
                    backgroundColor: couleurPalette,
                    borderColor: couleurPalette.map(color => color.replace('0.2', '1')), // Couleur des bordures
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

        // Fonction pour mettre à jour le graphique en barres
        function updateBarGraph(selectedClient) {
            var dataForSelectedClient = $listeAppbyGC[selectedClient];
            barGraph.data.labels = Object.keys(dataForSelectedClient);
            barGraph.data.datasets[0].data = Object.values(dataForSelectedClient);
            barGraph.update();
        }

        // Récupération de l'élément canvas pour afficher le graphique pie
        var pieCanvas = document.getElementById("pieCanvas");

        // Création du graphique pie avec Chart.js
        var pieGraph = new Chart(pieCanvas, {
            type: 'pie',
            data: {
                labels: nomsApplis,
                datasets: [{
                    label: 'Coût par application',
                    backgroundColor: couleurPalette,
                    borderColor: couleurPalette.map(color => color.replace('0.2', '1')), // Couleur des bordures
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

        // Fonction pour mettre à jour le graphique pie
        function updatePieGraph(selectedClient) {
            var dataForSelectedClient = $listeAppbyGC[selectedClient];
            pieGraph.data.labels = Object.keys(dataForSelectedClient);
            pieGraph.data.datasets[0].data = Object.values(dataForSelectedClient);
            pieGraph.update();
        }

        // Écouteur d'événement pour la sélection de la liste déroulante
        document.getElementById("clientSelection").addEventListener('change', function () {
            var selectedClient = this.value;
            updateBarGraph(selectedClient);
            updatePieGraph(selectedClient);
        });

        // Écouteur d'événement pour le bouton de bascule
        document.getElementById("toggleButton").addEventListener('click', function () {
            var pieCanvas = document.getElementById("pieCanvas");
            var barCanvas = document.getElementById("barCanvas");

            if (pieCanvas.style.display === "none") {
                pieCanvas.style.display = "block";
                barCanvas.style.display = "none";
            } else {
                pieCanvas.style.display = "none";
                barCanvas.style.display = "block";
            }
        });
    });
</script>
