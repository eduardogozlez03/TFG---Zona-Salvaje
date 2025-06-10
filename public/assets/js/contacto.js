document.addEventListener('DOMContentLoaded', function() {
    // Animación para el formulario
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        alert('Mensaje enviado con éxito. Nos pondremos en contacto contigo pronto.');
        form.reset();
    });
});