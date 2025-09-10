// JS Hamburger menu and close
const hamburgerIcon = document.querySelector(".hamburger-icon");
const closeIcon = document.querySelector(".close-icon");
const menu = document.querySelector(".menu");

hamburgerIcon.addEventListener("click", function () {
    hamburgerIcon.classList.add("hidden");
    closeIcon.classList.remove("hidden");
    menu.classList.remove("hidden");
    menu.classList.add("flex");
});

closeIcon.addEventListener("click", function () {
    closeIcon.classList.add("hidden");
    hamburgerIcon.classList.remove("hidden");
    menu.classList.add("hidden");
    menu.classList.remove("flex");
});

