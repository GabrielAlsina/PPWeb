<nav class="navbar">
    <div class="navbar-brand">Quaerite</div>
    <ul class="navbar-links">
        <li><a href="../home.php">Home</a></li>
        <li><a href="../about-us.php">Quienes Somos</a></li>
        <li><a href="#c">Como se hizo</a></li>
        <li><a href="../contacts/contact.php">Contacto</a></li>
        <div class="welcome-user">
            <?php if (isset($_SESSION['username'])): ?>
                <!-- Nombre de usuario con fondo degradado -->
                <li>Bienvenid@ <?php echo htmlspecialchars($_SESSION['username']); ?></li>
                <!-- Enlace de logout con fondo rojo pastel -->
                <li><a href="../../controllers/LogoutController.php">Cerrar sesión</a></li>
            <?php else: ?>
                <!-- Muestra el enlace de login si el usuario no está logueado -->
                <li><a href="/src/views/access/login.html">Iniciar sesión</a></li>
            <?php endif; ?>
        </div>
    </ul>
</nav>