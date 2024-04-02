/**
 * Filered Functions Category - Format - Date
 */
document.addEventListener("DOMContentLoaded", function () {
    // Initialization of filters.
    let selectedFilterCategory = "";
    let selectedFilterFormat = "";
    let selectedFilterDate = "";
    // Variables
    const defaultImagesSection = document.querySelector(".display_none");
    const btnLoadMore = document.querySelector(".div_btn_load_more");
    let initialFiltersSet = true;

    // Function to check filters and manage default section display
    function checkFiltersAndDisplayDefaultSection() {
        if (initialFiltersSet) {
            defaultImagesSection.style.display = "block";
            btnLoadMore.style.display = "block";
        } else {
            // Display none BTN load more
            btnLoadMore.style.display = "none";
        }
    }

    // AJAX Function load resultats
    function loadResults() {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", photo.ajaxurl, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("section_result_filtered").innerHTML =
                    xhr.responseText;

                // Calling the function to check filters after loading the results
                checkFiltersAndDisplayDefaultSection();

                // Update Lightbox Elements
                updateLightboxArray();
            }
        };
        var formData = new FormData();
        formData.append("action", "filter_results");
        formData.append("categoriies", selectedFilterCategory);
        formData.append("formats", selectedFilterFormat);
        formData.append("date", selectedFilterDate);

        xhr.send(formData);
        // During initial loading, check if all filters are empty and hide the default section if necessary
        checkFiltersAndDisplayDefaultSection();
    }

});