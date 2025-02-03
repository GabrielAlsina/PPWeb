<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../public/css/login.css" />
    <link rel="stylesheet" href="../../../public/css/navbar.css" />
    <title>Quaerite - Login</title>
  </head>
  <body>
    <?php 
    include '../partials/navbar.php';
    ?>
    <div id="formLogin">
      <h1>Iniciar Sesión</h1>
      <form action="../../controllers/LoginController.php" method="POST">
        <div class="form-group">
       <!-- <label for="username">Nombre de Usuario:</label> -->
          <input
            type="text"
            id="username"
            name="username"
            required
            placeholder="Ingrese su usuario"
          />
        </div>

        <div class="form-group">
         <!-- <label for="password">Contraseña:</label> -->
          <input
            type="password"
            id="password"
            name="password"
            required
            placeholder="Ingrese su contraseña"
          />
        </div>

        <div>
          <p>
            ¿No tienes cuenta? <a href="./register.html">Regístrate aquí</a>
          </p>
        </div>
        <br />

        <button type="reset">Cancelar</button>
        <button type="submit">Iniciar Sesión</button>
      </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../public/js/login.js"></script>
  </body>
</html>
