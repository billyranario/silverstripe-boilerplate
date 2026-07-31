const heroCarousels = document.querySelectorAll(".hero-carousel");

heroCarousels?.forEach((carousel) => {
    const nextBtn = carousel.querySelector("swiper-next");
    const prevBtn = carousel.querySelector("swiper-prev");

    const swiper = new Swiper(carousel, {
        autoplay: {
            delay: 6000,
        },
    });
});
