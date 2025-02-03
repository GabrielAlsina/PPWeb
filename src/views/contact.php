<?php session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quaerite - Contacto</title>
    <link rel="stylesheet" href="../../public/css/contacto.css">
    <link rel="stylesheet" href="../../public/css/footer.css">    
    <link rel="stylesheet" href="../../public/css/navbar.css">
</head>

<body>
    <header>
        <?php include "./partials/navbar.php"?>
    </header>
    <main>
        <h1>Formulario de Contacto</h1>
        <form action="../controllers/RegistroContactos.php" method="POST" aria-label="Formulario de contacto">


            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Nombre y apellido">
            </div>


            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required placeholder="mail@server.com">
            </div>


            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}"
                    placeholder="codigo de area sin 0 ni 15 y sin espacios">

            </div>


            <div class="form-group">
                <label for="tema">Tema de Contacto:</label>
                <select id="tema" name="tema" required>
                    <option value="" disabled selected>Selecciona un tema...</option>
                    <option value="soporte">Soporte Técnico</option>
                    <option value="ventas">Ventas</option>
                    <option value="general">Consulta General</option>
                </select>
            </div>


            <div class="form-group">
                <label for="comentarios">Comentarios:</label>
                <textarea id="comentarios" name="comentarios" rows="4"
                    placeholder="Escribe aquí tus comentarios o preguntas"></textarea>
            </div>

            <button type="submit">Enviar</button>
            <button type="reset">Reset</button>

        </form>
    </main>
    <?php include "./partials/footer.php"?>
</body>

</html>