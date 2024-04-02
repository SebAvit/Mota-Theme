/**
 * Animation + Navigation Lightbox Modale
 */
// Class Lightbox Overlay
const lightboxOverlay = document.querySelector(".lightbox_overlay");
// Class Btn Open Lightbox
const lightboxOpen = document.querySelectorAll(".icon_fullscreen");
// Close Lightbox - Btn Class
const closeLightbox = document.querySelector(".close_lightbox");
// Btn Before
const beforeArrow = document.querySelector(".before_arrow");
const beforeChevron = document.querySelector(".before_chevron");
// Btn After
const afterArrow = document.querySelector(".after_arrow");
const afterChevron = document.querySelector(".after_chevron");
// Lightbox Reference
const lightboxRef = document.querySelector(".lightbox_reference");
// Lightbox Category
const lightboxCateg = document.querySelector(".lightbox_categoriies");
// Lightbox Title
const lightboxTitre = document.querySelector(".lightbox_title");
// Create variable to stock elements .icon_fullscreen
let allLightboxDivs = Array.from(document.querySelectorAll(".icon_fullscreen"));
// Update variable when add suplly elements
function updateLightboxArray() {
    allLightboxDivs = Array.from(document.querySelectorAll(".icon_fullscreen"));
}

// Function Update Lightbox
function updateLightbox(div) {
    // Update Image
    const lightboxImage = lightboxOverlay.querySelector(".lightbox_image");
    let imageSrc = div.getAttribute("data-image");
    lightboxImage.setAttribute("src", imageSrc);

    // Update Categorie
    const lightboxcateg = lightboxOverlay.querySelector(".lightbox_categoriies");
    let imagecateg = div.getAttribute("data-categoriies");
    lightboxcateg.textContent = imagecateg;

    // Update Title
    const lightboxTitle = lightboxOverlay.querySelector(".lightbox_title");
    let imageTitle = div.getAttribute("data-title");
    lightboxTitle.textContent = imageTitle;

    // Update Reference
    const lightboxReference = lightboxOverlay.querySelector(".lightbox_reference");
    let imageRef = div.getAttribute("data-reference");
    lightboxReference.textContent = imageRef;
}

// Function Close Lightbox + Animation
closeLightbox.addEventListener("click", () => {
    lightboxOverlay.classList.remove("active-lightbox");
    lightboxOverlay.addEventListener(
        "transitionend",
        function () {
            lightboxOverlay.classList.remove("show-lightbox");
        },
        { once: true }
    );
    // Reset Lightbox Elements display when closing lightbox
    setTimeout(() => {
        beforeArrow.classList.remove("is_display_none");
        beforeChevron.classList.remove("is_display_none");
        afterArrow.classList.remove("is_display_none");
        afterChevron.classList.remove("is_display_none");
        lightboxRef.classList.remove("is_display_none");
        lightboxCateg.classList.remove("is_display_none");
        lightboxTitre.classList.remove("is_display_none");
    }, "200");
});
// Function Open Lightbox + Animation
document.addEventListener("click", function (e) {
    const div = e.target.closest(".icon_fullscreen");
    if (!div) return;
    e.preventDefault();

    // Checking if in <article class="post_photo_img">
    const isInPostPhotoImg = div.closest(".post_photo_img");
    if (isInPostPhotoImg) {
        beforeArrow.classList.add("is_display_none");
        beforeChevron.classList.add("is_display_none");
        afterArrow.classList.add("is_display_none");
        afterChevron.classList.add("is_display_none");
        lightboxRef.classList.add("is_display_none");
        lightboxCateg.classList.add("is_display_none");
        lightboxTitre.classList.add("is_display_none");
    }

    // Animation Open Lightbox
    lightboxOverlay.classList.add("show-lightbox");
    setTimeout(() => {
        lightboxOverlay.classList.add("active-lightbox");
    }, 50);

    // Title
    const imageTitre = div.getAttribute("data-title");
    let lightboxTitle = lightboxOverlay.querySelector(".lightbox_title");
    lightboxTitle.textContent = imageTitre;

    // Img
    const imageSrc = div.getAttribute("data-image");
    let lightboxImage = lightboxOverlay.querySelector(".lightbox_image");
    lightboxImage.setAttribute("src", imageSrc);

    // Categorie
    const imagecateg = div.getAttribute("data-categoriies");
    let lightboxcateg = lightboxOverlay.querySelector(".lightbox_categoriies");
    lightboxcateg.textContent = imagecateg;

    // Reference
    const imageRef = div.getAttribute("data-reference");
    let lightboxReference = lightboxOverlay.querySelector(".lightbox_reference");
    lightboxReference.textContent = imageRef;

    // Trouver l'index actuel de 'div' dans la liste des .icon_fullscreen
    const currentIndex = Array.from(
        document.querySelectorAll(".icon_fullscreen")
    ).indexOf(div);

    // Set Attribute Current Index
    lightboxOverlay.setAttribute("data-current-index", currentIndex);
    //
    updateLightbox(div);
});

// Function Before Navigation
function navigateBefore() {
    let currentIndex = parseInt(
        lightboxOverlay.getAttribute("data-current-index"),
        10
    );
    if (currentIndex > 0 && currentIndex < allLightboxDivs.length) {
        currentIndex--;
        lightboxOverlay.setAttribute("data-current-index", currentIndex);
        updateLightbox(allLightboxDivs[currentIndex]);
    }
}
// Click Before Navigation
beforeArrow.addEventListener("click", navigateBefore);
beforeChevron.addEventListener("click", navigateBefore);

// Function After Navigation
function navigateAfter() {
    let currentIndex = parseInt(
        lightboxOverlay.getAttribute("data-current-index"),
        10
    );
    if (currentIndex >= 0 && currentIndex < allLightboxDivs.length - 1) {
        currentIndex++;
        lightboxOverlay.setAttribute("data-current-index", currentIndex);
        updateLightbox(allLightboxDivs[currentIndex]);
    }
}
// Click After Navigation
afterArrow.addEventListener("click", navigateAfter);
afterChevron.addEventListener("click", navigateAfter);
