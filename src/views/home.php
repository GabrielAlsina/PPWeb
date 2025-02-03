<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quaerite - Home</title>
  <link rel="stylesheet" href="../../public/css/home.css" />
  <link rel="stylesheet" href="../../public/css/footer.css">
  <link rel="stylesheet" href="../../public/css/navbar.css">
</head>

<body>
  <!-- Eencabezado -->
  <header class="header">
    <?php include '../views/partials/navbar.php'; ?>
    <div id>
      <p class="tagline">Innovación y Soluciones a Medida</p>
    </div>
  </header>

  <!-- servicios -->
  <section class="services">
    <!--<h2>Nuestros Servicios</h2>-->
    <div class="service-cards">
      <div class="service-card">
        <h3>Desarrollo de Software</h3>
        <p>
          Soluciones a medida para transformar tu negocio y optimizar tus
          procesos.
        </p>
      </div>
      <div class="service-card">
        <h3>Inteligencia Artificial</h3>
        <p>
          Implementación de IA para potenciar la toma de decisiones y la
          eficiencia.
        </p>
      </div>
      <div class="service-card">
        <h3>Robótica</h3>
        <p>
          Desarrollamos soluciones robóticas para automatizar procesos clave
          en tu organización.
        </p>
      </div>
      <div class="service-card">
        <h3>Estoy listo</h3>
        <p>
          ¿Preparado para transformar tu empresa?
        </p>
        <a href="../views/contact.php" class="button-link">⋙ Contáctanos ⋘</a>
      </div>
    </div>
  </section>
  <?php include './partials/footer.php'; ?>
</body>

</html>