/**
 * Animation header Btn Menu Burger
 */
const menuBurger = document.querySelector(".btn_menu");
const menuMobile = document.querySelector(".header_mobile");
const headerTitleLink = document.querySelector("#header_title_link");
menuBurger.addEventListener("click", () => {
    menuBurger.classList.toggle("is-active");
    menuMobile.classList.toggle("is-active");
});
/**
 * Animation contact Modale + Contact Form
 */
// Class Modal
const popUpOverlay = document.querySelector(".popup_modale");
const popUpContainer = document.querySelector(".popup_container");

// Link Contact Menu Header
const menuContactHeader = document.querySelector(
    ".header__menu__desktop .menu-item-23 a"
);

// Link Contact Menu Mobile
const menuContactMobile = document.querySelector(
    ".header__menu__mobile .menu-item-23 a"
);

// function Open Modale Form
function toggleModal(event) {
    event.preventDefault(); // Empêcher le comportement par défaut du lien
    popUpOverlay.style.display = "flex";
    void popUpOverlay.offsetWidth;
    popUpOverlay.classList.add("is-visible");
    popUpContainer.classList.toggle("is-display");
}

// Open Modale Form
[menuContactHeader, menuContactMobile].forEach(el => {
    el.addEventListener("click", toggleModal);
});

// Open Modale Btn Contact Single Page Photo
const contactSinglePageModal = document.querySelector(".post_contact_link a");
if (contactSinglePageModal) {
    contactSinglePageModal.addEventListener("click", toggleModal);
}

// Function Close Modale Form
function closeModal() {
    popUpOverlay.classList.remove("is-visible");
    popUpContainer.classList.remove("is-display");
}

// Listener event close modal click outside
popUpOverlay.addEventListener("click", event => {
    if (event.target === popUpOverlay) {
        closeModal();
    }
});

// Listener event close modal press key escape
document.addEventListener("keydown", event => {
    if (
        event.key === "Escape" &&
        popUpOverlay.classList.contains("is-open") &&
        popUpContainer.classList.contains("is-visible")
    ) {
        closeModal();
    }
});

// Listener for transition end to hide the modal
popUpOverlay.addEventListener("transitionend", function (event) {
    if (
        event.propertyName === "opacity" &&
        !popUpOverlay.classList.contains("is-visible")
    ) {
        popUpOverlay.style.display = "none";
    }
});


// Function to prefill reference input in the contact form
function prefillReferenceInput() {
    // Get the reference of the photo
    const reference = document.getElementById("ref").innerText;

    // Find the reference input in the contact form
    const referenceInput = document.querySelector('#reference');

    // If the reference input exists and reference is not empty, set its value
    if (referenceInput && reference) {
        referenceInput.value = reference;
    }
}

console.log(reference)


// Listener for the click event on the contact button
const contactButton = document.querySelector('.post_contact_link');
if (contactButton) {
    contactButton.addEventListener('click', handleContactButtonClick);
}

// Function to handle click on the contact button
function handleContactButtonClick(event) {
    event.preventDefault(); // Prevent the default action of the link
    toggleModal(event); // Pass the event to toggleModal function to handle it properly
    prefillReferenceInput()
}

// Function to handle click on contact menu links
function handleContactMenuClick(event) {
    event.preventDefault(); // Prevent the default action of the link
    toggleModal(event); // Pass the event to toggleModal function to handle it properly
    prefillReferenceInput()
}

// Attach click event listeners to both contact menu links
if (menuContactHeader) {
    menuContactHeader.addEventListener("click", handleContactMenuClick);
}

if (menuContactMobile) {
    menuContactMobile.addEventListener("click", handleContactMenuClick);
}



document.addEventListener("DOMContentLoaded", function() {
    // Trouver l'élément "Accueil" du menu
    const accueilLink = document.querySelector(".header__menu__desktop .menu-item-104 a");

    // Trouver l'URL du lien du logo
    const logoLink = document.querySelector(".header_logo_link").getAttribute("href");

    // Mettre à jour l'attribut href de l'élément "Accueil" pour qu'il corresponde à celui du logo
    if (accueilLink) {
        accueilLink.setAttribute("href", logoLink);
    }
});

console.log("h")