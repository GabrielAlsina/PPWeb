<?php
session_start(); // Inicia la sesión si no se ha iniciado

// Verificar si el usuario está logueado, para evitar destruir una sesión no iniciada
if (isset($_SESSION['user_id'])) {
    // Destruir la sesión
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
}

// Redirigir al usuario a la página de login
header("Location: ../views/home.php");
exit();
?>
