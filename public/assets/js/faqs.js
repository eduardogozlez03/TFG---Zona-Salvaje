document.addEventListener('DOMContentLoaded', function() {
    // Acordeón interactivo
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Cerrar otros items abiertos
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Alternar el item actual
            item.classList.toggle('active');
        });
    });
    
    // Abrir el primer item por defecto
    if (faqItems.length > 0) {
        faqItems[0].classList.add('active');
    }
});