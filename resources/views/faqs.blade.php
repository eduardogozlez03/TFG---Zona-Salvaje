<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - Zona Salvaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/faqs.css') }}">
    <script type="module" src="{{ asset('assets/js/faqs.js') }}"></script>

</head>
<body>
    <!-- Logo Zona Salvaje -->
    <div class="logo-container">
        <div class="logo" onclick="window.location.href='/'">ZONA SALVAJE</div>
    </div>

    <!-- Header -->
    <header class="faq-header">
        <h1>Preguntas Frecuentes</h1>
        <p>Encuentra respuestas a las preguntas más comunes sobre nuestros servicios, clases y membresías.</p>
    </header>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Acordeón de FAQs -->
        <div class="faq-accordion">
            <!-- FAQ Item 1 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>¿Cómo puedo inscribirme en las clases?</h3>
                    <span class="icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Puedes inscribirte en nuestras clases directamente desde tu área de cliente, seleccionando la clase que te interese y haciendo clic en "Inscribirse". También puedes acudir a nuestras instalaciones y nuestro personal te ayudará con el proceso.</p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>¿Qué necesito para mi primera clase?</h3>
                    <span class="icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Para tu primera clase te recomendamos traer ropa cómoda, una botella de agua y una toalla. El equipo básico está proporcionado por el gimnasio. Si tienes alguna condición médica especial, por favor infórmanos antes de comenzar.</p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>¿Puedo cancelar mi membresía en cualquier momento?</h3>
                    <span class="icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Sí, puedes cancelar tu membresía en cualquier momento desde tu área de cliente o comunicándote con nuestro equipo de atención al cliente. Ten en cuenta que algunas membresías pueden tener políticas específicas de cancelación.</p>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>¿Qué beneficios tiene la membresía VIP?</h3>
                    <span class="icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>La membresía VIP incluye acceso ilimitado a todas las clases, uso prioritario de las instalaciones, descuentos en productos de la tienda, acceso a áreas exclusivas y una sesión personalizada mensual con uno de nuestros entrenadores.</p>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>¿Tienen clases para principiantes?</h3>
                    <span class="icon"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Sí, ofrecemos clases especiales para principiantes donde aprenderás los fundamentos en un ambiente relajado y seguro. Nuestros instructores están especialmente capacitados para adaptar los ejercicios a todos los niveles de condición física.</p>
                </div>
            </div>
        </div>

        <!-- Sección de contacto -->
        <div class="contact-section">
            <h2>¿No encontraste lo que buscabas?</h2>
            <p>Nuestro equipo está listo para ayudarte con cualquier pregunta adicional que puedas tener.</p>
            <a href="{{ route('contacto') }}" class="contact-btn">Contáctanos</a>
        </div>
    </div>

    <!-- Footer -->
    @include('profile.partials.footer')

</body>
</html>