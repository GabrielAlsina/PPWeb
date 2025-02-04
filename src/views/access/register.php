<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../../public/css/login.css" />
  <link rel="stylesheet" href="../../../public/css/navbar.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../../public/js/register.js" defer></script>

  <title>Quaerite - Registro</title>
</head>
<body>
  <header>
    <?php include '../partials/navbar.php';?>
  </header>
  <div id="formLogin">
    <h1>Registro</h1>
    <form id="registerForm" action="../../controllers/registroController.php" method="POST">
      <div class="form-group">
        <input
          type="text"
          id="username"
          name="username"
          required
          placeholder="Escribe tu nombre"
        />
      </div>
      <div class="form-group">
        <input
          type="email"
          id="email"
          name="email"
          required
          placeholder="Escribe tu correo"
        />
      </div>
      <div class="form-group">
        <input
          type="password"
          id="pass"
          name="pass"
          required
          placeholder="Escribe tu contraseña"
        />
      </div>
      <div>
        <p>¿Ya tienes cuenta? <a href="./login.php">Inicia sesión aquí</a></p>
      </div>
      <br />
      <button type="reset">Cancelar</button>
      <button type="submit">Registrarse</button>
    </form>
  </div>
</body>
</html>
