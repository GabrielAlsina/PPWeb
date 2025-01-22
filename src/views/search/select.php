<?php session_start(); // Inicia la sesión ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quaerite - Selección</title>
    <link rel="stylesheet" href="../../../public/css/select.css" />
    <link rel="stylesheet" href="../../../public/css/navbar.css" />
    <link rel="stylesheet" href="../../../public/css/footer.css" />
  </head>

  <body>
    <header>
      <?php include '../partials/navbar.php'; ?>
    </header>
    <div class="card">
      <h2>Opciones de Búsqueda</h2>
      <ul>
        <li><a href="./s-code.php">Busqueda</a></li>
        <li><a href="./s-anatomic.html">Aproximación Anatómica</a></li>
        <li><a href="./s-help.html">Ayuda</a></li>
      </ul>
    </div>
    <?php include '../partials/footer.php'; ?>
  </body>
</html>
