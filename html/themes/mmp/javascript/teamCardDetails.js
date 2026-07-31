const teamcards = document.querySelectorAll(".teamcard");

teamcards?.forEach((card) => {
    const toggleButtons = card.querySelectorAll(".toggle");

    toggleButtons.forEach((button) => {
        button.addEventListener("click", () => {
            card.classList.toggle("active");
        });
    });

    const closeButtons = card.querySelectorAll(".close");

    closeButtons.forEach((button) => {
        button.addEventListener("click", () => {
            card.classList.remove("active");
        });
    });
});

function customSmoothScroll(target, offset = 100, duration = 2000) {
    window.scrollTo(0, 0);
    const targetPosition =
        target.getBoundingClientRect().top + window.scrollY - offset;
    const startPosition = 0;
    const distance = targetPosition - startPosition;
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = easeInOutQuad(
            timeElapsed,
            startPosition,
            distance,
            duration
        );
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }

    function easeInOutQuad(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
}

window.onload = () => {
    const id = window.location.hash.slice(1);
    const element = document.getElementById(id);

    if (element) {
        customSmoothScroll(element, 100, 1000);
    }
};
