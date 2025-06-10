document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll("form");
    const flashEffect = document.getElementById("flash-effect");

    forms.forEach((form) => {
        form.addEventListener("submit", () => {
            // Guardar posición del scroll
            sessionStorage.setItem("scrollPosition", window.scrollY);

            // Mostrar efecto flash
            if (form.querySelector(".join-btn")) {
                flashEffect.classList.add("flash-green");
            } else if (form.querySelector(".leave-btn")) {
                flashEffect.classList.add("flash-red");
            }

            flashEffect.style.opacity = "1";

            setTimeout(() => {
                flashEffect.style.opacity = "0";
                setTimeout(() => {
                    flashEffect.classList.remove("flash-green", "flash-red");
                }, 300);
            }, 1000);
        });
    });

    // Restaurar posición del scroll
    const scrollPosition = sessionStorage.getItem("scrollPosition");
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition));
        sessionStorage.removeItem("scrollPosition");
    }
});
