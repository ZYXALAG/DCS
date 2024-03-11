$(document).ready(function() {
    // Affiche le message "Vous êtes connecté"
    $('#message').fadeIn();

    // Disparait après 3 secondes (3000 millisecondes)
    setTimeout(function() {
        $('#message').fadeOut();
    }, 3000);
});

function addRow() {
    var newRow = `
        <div class="form-row mt-3">
            <div class="col-md-4 mb-3">
                <label for="selectIndex">Sélectionner un Index</label>
                <select class="form-control" name="index[]">
                    <!-- Ajoutez vos options ici -->
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="selectOperateur">Sélectionner un Opérateur</label>
                <select class="form-control" name="operateur[]">
                    <!-- Ajoutez vos options ici -->
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="motCle">Mot-clé</label>
                <input type="text" class="form-control" name="motCle[]">
            </div>
        </div>`;

    $('#additionalRows').append(newRow);
}

// Fonction pour effacer le formulaire
function resetForm() {
    $('#advancedSearchForm').trigger("reset");
    $('#additionalRows').empty(); // Efface les lignes dynamiques
}