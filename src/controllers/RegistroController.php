<?php
// /controllers/registroController.php

include_once '../config/Database.php';
include_once '../models/User.php';

// Crear la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear una instancia del modelo de usuario
$user = new User($db);

// Comprobar si se enviaron datos mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Verificar si el usuario ya existe
    if ($user->userExists($username, $email)) {
        echo "El usuario o el correo electrónico ya están registrados. Volviendo...";
        $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'login.html';
        header("Refresh: 5; url=$previous_page");
    } else {
        // Registrar al nuevo usuario
        if ($user->register($username, $email, $password)) {
            echo "Usuario registrado exitosamente.";
            // Redirigir a una página de login o de bienvenida
            header("Location: ../views/access/login.html");
            exit;
        } else {
            echo "Hubo un error al registrar el usuario.";
        }
    }
}
