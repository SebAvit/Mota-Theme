jQuery(document).ready(function($) {
    // Fonction pour mettre à jour les résultats filtrés
    function updateFilteredResults() {
        var categorie = $('#categorie').val();
        var format = $('#format').val();
        var date = $('#date').val();

        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'post',
            data: {
                action: 'filter_photos',
                categorie: categorie,
                format: format,
                date: date
            },
            success: function(response) {
                $('#section_result_filtered').html(response);

                // Vérifier si les filtres sont vides
                if (categorie == '' && format == '' && (date == '' || date == '0')) {
                    $('.div_btn_load_more').show(); // Afficher le bouton
                } else {
                    $('.div_btn_load_more').hide(); // Masquer le bouton
                }
            },
            error: function(error) {
                console.log(error);
            },
        });
    }

    // Écouteur d'événement pour les changements dans les sélecteurs
    $('#categorie, #format, #date').change(function() {
        updateFilteredResults();
    });

    // Appeler updateFilteredResults() lorsque la page est chargée
    updateFilteredResults();
});
