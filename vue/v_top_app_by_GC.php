<?php
// Supposons que la liste de données soit stockée dans la variable $liste

// Convertir la liste en JSON pour l'utiliser dans JavaScript
$listeJSON = json_encode($listeGC);
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var listeGC = <?php echo $listeJSON; ?>;
        var nomsApplis = Object.keys(listeGC);
        var totalPrix = Object.values(listeGC);
        
        // Création de la structure de données pour Chart.js
        var chartData = {
            labels: nomsApplis,
            datasets: [{
                label: 'Coût par application',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: totalPrix
            }]
        };

        // Récupération de l'élément canvas pour afficher le graphique
        var graphTarget = document.getElementById("graphCanvas");

        // Création du graphique avec Chart.js
        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartData,
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
    });
</script>

<div id="chart-container">
    <canvas id="graphCanvas"></canvas>
</div>