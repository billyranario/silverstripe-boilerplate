// Select Buttons
const mobileMenuToggle = document.querySelector(".mobile-nav-toggle");
const mobileMenuClose = document.querySelector(".mobile-menu-close");
const mobileModal = document.querySelector(".mobile-modal");

// Add click function to buttons
mobileMenuToggle.addEventListener("click", () => {
    toggleMobileMenu();
});
mobileModal.addEventListener("click", () => {
    closeMobileMenu();
});
mobileMenuClose.addEventListener("click", () => {
    closeMobileMenu();
});

animateHeaderOnScroll();

const submenus = document.querySelectorAll(".mobile-submenu");
submenus.forEach((submenu) => {
    const button = submenu.querySelector(".submenu-toggle");

    button.addEventListener("click", () => {
        const menu = submenu.querySelector(".submenu");
        menu.classList.toggle("active");
    });
});

// Function to close mobile menu
function closeMobileMenu() {
    const mobileModal = document.querySelector(".mobile-modal");
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileModal?.classList.remove("active");
    mobileMenu?.classList.remove("active");
}

// Function for toggling mobile menu
function toggleMobileMenu() {
    const mobileModal = document.querySelector(".mobile-modal");
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileModal?.classList.toggle("active");
    mobileMenu?.classList.toggle("active");
}

function animateHeaderOnScroll() {
    const header = document.querySelector("header");
    const scrollTriggerHeight = 100;

    window.addEventListener("scroll", () => {
        const scrolledPastTrigger = window.scrollY > scrollTriggerHeight;

        // Ensure initial top value is set in CSS (e.g., header { top: 2rem; })
        header.style.transition = "background-color 400ms ease, top 400ms ease";

        let targetOpacity;
        if (scrolledPastTrigger) {
            header.style.top = "0";
            targetOpacity = "rgba(255, 255, 255, 0.75)";
        } else {
            switch (header.getAttribute("data-segment")) {
                case "home":
                case "contact":
                case "privacy-policy":
                case "terms-of-engagement":
                case "blog":
                    header.style.top = "0";
                    targetOpacity = "rgba(255, 255, 255, 1)";
                    break;
                default:
                    header.style.top = "2rem";
                    break;
            }
        }
        header.style.backgroundColor = targetOpacity;
    });
}
