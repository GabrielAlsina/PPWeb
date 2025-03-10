<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de Quaerite</title>
    <link rel="stylesheet" href="../../public/css/about-us.css">
    <link rel="stylesheet" href="../../public/css/button.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <link rel="stylesheet" href="../../public/css/navbar.css">
</head>

<body>
    <header>
        <?php include "./partials/navbar.php"; ?>
    </header>
    <div id="about-us">
        <h2>¿Quiénes somos?</h2>
        <p>
            Somos Quaerite una empresa joven, en rápido crecimiento, con hambre de aprender e innovar. Fundada en
            2024,
            nacimos con el propósito de dar soluciones de desarrollo en tecnología, especialmente en el ámbito de IT,
            Inteligencia Artificial y Robótica. El nombre "Quaerite" proviene del latín, que invita a la búsqueda
            constante
            de respuestas, soluciones y desafíos. Nos inspira a ser una empresa de búsqueda continua, donde cada
            pregunta es
            una oportunidad para encontrar la mejor solución.
        </p>

        <h3>Misión</h3>
        <p>
            Nuestra misión es clara: dar soluciones efectivas e innovadoras a nuestros clientes, siempre con el objetivo
            de
            generar un impacto positivo.
        </p>

        <h3>Visión</h3>
        <p>
            Nuestra visión es llevar estas soluciones a todos los rincones del mundo en los próximos 20 años,
            convirtiéndonos en un referente global en IT, IA y Robótica.
        </p>

        <h3>Cultura</h3>
        <p>
            Desde nuestros primeros días en el instituto, donde todo comenzó, hemos crecido rápidamente y, hoy en día,
            nos
            encontramos en plena expansión. Nuestra cultura está cimentada en principios sólidos: hacer las cosas con la
            mejor de las voluntades, con ánimo positivo, mente abierta al aprendizaje y siempre trabajando en equipo.
            Creemos que el éxito se construye de la mano de un equipo unido, enfocado en progresar constantemente.
        </p>

        <h3>Valores</h3>
        <p>
            Actualmente somos un equipo de 11 personas apasionadas por aprender y afrontar los retos que se nos
            presentan.
            Valoramos la paz, la tranquilidad y el entusiasmo por aprender. Nos motiva la satisfacción de encontrar
            soluciones a los problemas de nuestros clientes, y trabajamos con un enfoque claro hacia el futuro.
        </p>

        <p>
            ¡Nos encantaría que te unieras a nuestro viaje de innovación y crecimiento! Si tienes alguna
            consulta o
            estás
            interesado en saber más sobre cómo podemos ayudarte, no dudes en contactarnos. ¡Estamos aquí para conversar
            y
            colaborar!
        </p>

        <a class="button-link" href="./contact.php">Contactanos!</a>
    </div>
    <?php include "./partials/footer.php"; ?>
</body>

</html>