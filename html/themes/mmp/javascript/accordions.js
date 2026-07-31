const accordions = document.querySelectorAll(".accordion-container");

accordions.forEach((accordion) => {
    const items = accordion.querySelectorAll(".accordion-item");

    items.forEach((item) => {
        const button = item.querySelector(".accordion-toggle");

        button.addEventListener("click", () => {
            items.forEach((i) => {
                if (i !== item) {
                    i.classList.remove("active");
                }
            });

            item.classList.toggle("active");
        });
    });
});
