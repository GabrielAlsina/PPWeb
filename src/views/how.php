<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta tags para asegurar la correcta visualización y compatibilidad -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Tecnologías Utilizadas - Proyecto Web</title>

    <!-- Vinculación de hoja de estilo principal -->
    <link rel="stylesheet" href="../../public/css/how.css">

    <!-- Fuente personalizada para un diseño más profesional -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Merriweather&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Encabezado principal con título y descripción -->
    <header>
        <div class="container">
            <h1>Tecnologías Utilizadas</h1>
            <p>Un enfoque moderno con las mejores herramientas para el desarrollo web.</p>
        </div>
    </header>

    <!-- Cuerpo principal con la información sobre las tecnologías -->
    <main>
        <section class="content">
            <div class="container">
                <!-- Tarjetas de tecnologías que describen el uso en el sistema -->
                <article class="tech-card">
                    <h2>Backend</h2>
                    <p>El sistema está desarrollado en <strong>PHP</strong>, utilizando <strong>MySQL</strong> como base de datos y siguiendo el patrón de diseño <strong>MVC</strong> (Modelo-Vista-Controlador), lo que permite una estructura organizada, escalable y fácil de mantener.</p>
                </article>

                <article class="tech-card">
                    <h2>Frontend</h2>
                    <p>Se emplea <strong>JavaScript</strong> junto con <strong>jQuery</strong> para la manipulación dinámica del DOM y la validación de formularios en el lado del cliente, mejorando la experiencia de usuario y la interacción con el sistema.</p>
                </article>

                <article class="tech-card">
                    <h2>Autenticación</h2>
                    <p>El sistema de autenticación utiliza <strong>sesiones de PHP</strong>, asegurando que los usuarios puedan mantener su estado de inicio de sesión de manera segura durante su navegación, utilizando mecanismos de protección como el cifrado de contraseñas.</p>
                </article>

                <article class="tech-card">
                    <h2>Diseño y Estilo</h2>
                    <p>El sitio web cuenta con un diseño limpio, profesional y adaptativo, implementado con <strong>CSS avanzado</strong>. Utilizamos <strong>Flexbox</strong> y <strong>Grid</strong> para crear una estructura flexible que se adapta a diferentes tamaños de pantalla, asegurando una experiencia de usuario fluida y accesible desde cualquier dispositivo.</p>
                </article>
            </div>
        </section>
    </main>

    <!-- Pie de página con derechos de autor y descripción breve -->
    <footer>
        <p>© 2025 - Proyecto Web con PHP, MySQL, y JavaScript. Desarrollo con enfoque en tecnología moderna y diseño adaptable.</p>
    </footer>

</body>

</html>
