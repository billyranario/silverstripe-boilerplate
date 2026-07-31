document.addEventListener("DOMContentLoaded", function() {
    const sponsorCarousels = document.querySelectorAll(".sponsor-carousel");

    sponsorCarousels.forEach((carousel) => {
        // Ensuring all images inside the carousel are loaded before initializing Flickity
        const images = carousel.querySelectorAll('img');
        let imagesLoaded = 0;
        images.forEach(image => {
            if (image.complete) {
                handleImageLoad();
            } else {
                image.addEventListener('load', handleImageLoad);
                image.addEventListener('error', handleImageLoad); // in case the image fails to load
            }
        });

        function handleImageLoad() {
            imagesLoaded++;
            if (imagesLoaded === images.length) {
                initFlickity();
            }
        }

        function initFlickity() {
            const flkty = new Flickity(carousel, {
                autoPlay: true,
                contain: true,
                freeScroll: true,
                pageDots: false,
                prevNextButtons: false,
            });
        }
    });
});
