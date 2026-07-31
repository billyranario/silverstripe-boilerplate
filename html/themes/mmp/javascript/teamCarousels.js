const teamCarousels = document.querySelectorAll(".team-carousel");

teamCarousels?.forEach((carousel) => {
    const prevBtn = carousel.querySelector("swiper-prev");
    const nextBtn = carousel.querySelector("swiper-next");

    const swiper = new Swiper(carousel, {
        slidesPerView: "auto",
        navigation: {
            prevEl: ".swiper-prev",
            nextEl: ".swiper-next",
        },
    });
});
