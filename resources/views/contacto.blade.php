<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Zona Salvaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/contacto.css') }}">
    <script type="module" src="{{ asset('assets/js/contacto.js') }}"></script>

</head>

<body>
    <!-- Logo Zona Salvaje -->
    <div class="logo-container">
        <div class="logo" onclick="window.location.href='/'">ZONA SALVAJE</div>
    </div>

    <!-- Header -->
    <header class="contact-header">
        <h1>Contacta con Nosotros</h1>
        <p>Estamos aquí para ayudarte. Envíanos tus preguntas, sugerencias o solicita información sobre nuestros
            servicios.</p>
    </header>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Grid de información de contacto -->
        <div class="contact-grid">
            <!-- Dirección -->
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Visítanos</h3>
                <p>Calle Real , 23</p>
                <p>Barrio Deportivo</p>
                <p>41710 Utrera , España</p>
            </div>

            <!-- Teléfono -->
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <h3>Llámanos</h3>
                <p><a href="tel:+34911234567">+34 911 234 567</a></p>
                <p>Lunes a Viernes: 9:00 - 21:00</p>
                <p>Sábados: 10:00 - 14:00</p>
            </div>

            <!-- Email -->
            <div class="contact-card">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3>Escríbenos</h3>
                <p><a href="mailto:info@zonasalvaje.com">info@zonasalvaje.com</a></p>
                <p><a href="mailto:clientes@zonasalvaje.com">clientes@zonasalvaje.com</a></p>
                <p>Respondemos en menos de 24h</p>
            </div>
        </div>

        <!-- Formulario de contacto -->
        <div class="contact-form-container">
            <h2>Envíanos un Mensaje</h2>
            <form id="contact-form" method="POST" action="/enviar-mensaje">
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">Teléfono (opcional)</label>
                    <input type="tel" id="phone" name="phone" class="form-control">
                </div>

                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <select id="subject" name="subject" class="form-control" required>
                        <option value="" disabled selected>Selecciona un asunto</option>
                        <option value="info">Información general</option>
                        <option value="membership">Membresías</option>
                        <option value="classes">Clases y horarios</option>
                        <option value="feedback">Sugerencias</option>
                        <option value="other">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Tu mensaje</label>
                    <textarea id="message" name="message" class="form-control" required></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Enviar Mensaje
                </button>
            </form>
        </div>

        <!-- Mapa -->
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3171.123456789!2d-5.87654321!3d37.1801234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1234567890abcdef%3A0xabcdef1234567890!2sUtrera%2C%20Sevilla!5e0!3m2!1ses!2ses!4v1620000000000!5m2!1ses!2ses"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>


        <!-- Horario -->
        <div class="schedule">
            <h3>Horario de Atención</h3>
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Horario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lunes - Viernes</td>
                        <td>7:00 - 23:00</td>
                    </tr>
                    <tr>
                        <td>Sábado</td>
                        <td>8:00 - 21:00</td>
                    </tr>
                    <tr>
                        <td>Domingo</td>
                        <td>9:00 - 14:00</td>
                    </tr>
                    <tr>
                        <td>Festivos</td>
                        <td>10:00 - 14:00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    @include('profile.partials.footer')

</body>

</html>
