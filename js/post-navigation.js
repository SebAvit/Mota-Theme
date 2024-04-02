/**
 * Post Navigation Single Photo
 */
document.addEventListener("DOMContentLoaded", function () {
    let dynamicImage = document.getElementById("dynamicImage");
    let prevLink = document.getElementById("prevLink");
    let nextLink = document.getElementById("nextLink");
    let originalImageSrc = dynamicImage.src;

    if (document.body.classList.contains("single-photo")) {
        originalImageSrc = dynamicImage.src;
    }

    if (prevLink) {
        prevLink.addEventListener("mouseover", function () {
            dynamicImage.style.opacity = "0";
            setTimeout(() => {
                dynamicImage.src = this.getAttribute("data-image");
            }, 50);
        });
        prevLink.addEventListener("mouseout", function () {
            dynamicImage.style.opacity = "0";
            setTimeout(() => {
                dynamicImage.src = originalImageSrc;
                dynamicImage.style.opacity = "1";
            }, 50);
        });
    }

    if (nextLink) {
        nextLink.addEventListener("mouseover", function () {
            dynamicImage.style.opacity = "0";
            setTimeout(() => {
                dynamicImage.src = this.getAttribute("data-image");
            }, 50);
        });
        nextLink.addEventListener("mouseout", function () {
            dynamicImage.style.opacity = "0";
            setTimeout(() => {
                dynamicImage.src = originalImageSrc;
                dynamicImage.style.display = "1";
            }, 50);
        });
    }
});