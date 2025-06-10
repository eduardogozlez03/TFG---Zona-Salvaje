document.addEventListener("DOMContentLoaded", function () {
    const images = [
        "https://imgur.com/a/MMfZkdc",
        // 'https://i.imgur.com/99hczig.jpeg',
        "https://i.imgur.com/MsOndiL.jpeg",
    ];

    let currentIndex = 0;
    const sliderWrapper = document.getElementById("slider-wrapper");
    const sliderDots = document.getElementById("slider-dots").children;
    let intervalId; // Variable para controlar el intervalo

    function showImage(index) {
        const images = sliderWrapper.getElementsByClassName("slider-image");
        for (let i = 0; i < images.length; i++) {
            images[i].classList.remove("active");
            sliderDots[i].classList.remove("active");
        }
        images[index].classList.add("active");
        sliderDots[index].classList.add("active");
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length;
        showImage(currentIndex);
    }

    function startSlider() {
        clearInterval(intervalId); // Limpiar el intervalo anterior
        intervalId = setInterval(nextImage, 8000); // Iniciar nuevo intervalo
    }

    // Iniciar el slider automáticamente
    startSlider();

    // Configurar los botones de los dots
    for (let i = 0; i < sliderDots.length; i++) {
        sliderDots[i].addEventListener("click", function () {
            currentIndex = i;
            showImage(currentIndex);
            startSlider(); // Reiniciar el intervalo al hacer clic
        });
    }

    // Cards click functionality
    const cards = document.querySelectorAll(".card");
    cards.forEach((card) => {
        card.addEventListener("click", () => {
            cards.forEach((c) => c.classList.remove("active"));
            card.classList.add("active");
        });
    });
});

/* Animación cards */
document.addEventListener("DOMContentLoaded", function () {
    const cardLinks = document.querySelectorAll(".card-icon-link");

    cardLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const targetUrl = this.getAttribute("href");

            // Añade la clase de animación
            this.classList.add("card-clicked");

            // Espera un momento antes de redirigir
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 300); // 300 ms para la transición
        });
    });
});

//Animación SPINNER
document.addEventListener("DOMContentLoaded", function () {
    const cardLinks = document.querySelectorAll(".card-icon-link");

    cardLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const targetUrl = this.getAttribute("href");

            // Temporizador para mostrar el spinner después de 1 segundo
            const spinnerTimeout = setTimeout(() => {
                document.getElementById("loading-spinner").style.display =
                    "flex";
            }, 1000); // 1000 ms = 1 segundo

            // Redirige inmediatamente
            window.location.href = targetUrl;

            // Si la página carga rápido, cancela el spinner
            window.addEventListener("beforeunload", () => {
                clearTimeout(spinnerTimeout);
            });
        });
    });
});
