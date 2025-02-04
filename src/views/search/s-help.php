<?php session_start(); // Inicia la sesión ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda</title>
    <link rel="stylesheet" href="../../../public/css/s-help.css">
    <link rel="stylesheet" href="../../../public/css/navbar.css">
</head>

<body>
    <header>
    <?php
include '../partials/navbar.php';
?>
    </header>
    <main>
        <div>
            <h2>¿Como se usa?</h2>
            <p><strong>Bienvenido a Quaerite</strong>, la herramienta de búsqueda preferida por organizaciones de servicios
                sanatoriales.<br><br>
                A continuación, le explicaremos cómo utilizar este servicio de manera ágil, sencilla y eficaz.
                ¡Comencemos!<br><br>
                <strong>Existen tres maneras de realizar una búsqueda en Quaerite:</strong><br>
                1. Ingresando el código de prestación médica correspondiente (Ej: 121308).<br>
                2. Escribiendo el nombre de la práctica médica (Ej: "Incisión y Drenaje de Quiste Tirogloso").<br>
                3. Seleccionando la imagen que corresponda a la sección anatómica relacionada con la práctica médica
                deseada.<br><br>
                <strong>¡Así de fácil es!</strong> Le deseamos un excelente día en su jornada laboral. Si necesita
                asistencia adicional, no dude en comunicarse con el Departamento de IT, haciendo click en el boton de
                contacto en la página de inicio o bien haciendo click <a href="../contact.php"><strong>AQUÍ</strong></a>.
            </p>    
        </div>
    </main>
</body>

</html>