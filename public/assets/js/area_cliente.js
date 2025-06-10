document.addEventListener('DOMContentLoaded', function() {
    // Navegación por el sidebar
    document.querySelectorAll('.sidebar-nav a').forEach(link => {
        if (link.getAttribute('href').startsWith('#')) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('href');

                document.querySelectorAll('.sidebar-nav a').forEach(a => a.classList.remove(
                    'active'));
                this.classList.add('active');

                document.querySelectorAll('section').forEach(section => {
                    section.style.display = 'none';
                });

                document.querySelector(target).style.display = 'block';
            });
        }
    });

    // Mostrar sección según hash
    const currentHash = window.location.hash || '#info';
    if (currentHash) {
        document.querySelectorAll('section').forEach(section => {
            section.style.display = 'none';
        });
        document.querySelector(currentHash).style.display = 'block';

        document.querySelectorAll('.sidebar-nav a').forEach(a => {
            if (a.getAttribute('href') === currentHash) {
                a.classList.add('active');
            } else {
                a.classList.remove('active');
            }
        });
    }
});