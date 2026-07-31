// Create intersection observer to fix header
const header = document.querySelector(".header");
const observer = new IntersectionObserver(
    (entries) => {
        console.log(entries);
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                header.classList.remove("fixed");
            } else {
                header.classList.add("fixed");
            }
        });
    },
    {
        rootMargin: "-100px 0px 0px 0px", // top, right, bottom, left margins
    }
);

observer.observe(header);
