const testimonialCarousel = document.querySelectorAll(".testimonial-carousel");

testimonialCarousel?.forEach((carousel) => {
    const flkty = new Flickity(carousel, {
        cellAlign: "center",
        contain: true,
        pageDots: false,
        prevNextButtons: true,
        autoPlay: true
    });
});
